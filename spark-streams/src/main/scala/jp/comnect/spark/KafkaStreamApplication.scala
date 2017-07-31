package jp.comnect.spark

import org.apache.spark.streaming.kafka010._
import org.apache.spark.streaming.kafka010.LocationStrategies.PreferConsistent
import org.apache.spark.streaming.kafka010.ConsumerStrategies.Subscribe
import org.apache.kafka.common.serialization.StringDeserializer
import org.apache.spark.streaming.{Seconds, StreamingContext}
import org.apache.spark.sql.SparkSession
import com.datastax.spark.connector._
import org.json4s._
import org.json4s.jackson.JsonMethods._

/**
  *
  */
object KafkaStreamApplication {
  def main(args: Array[String]) {
    val kafkaParams = Map[String, Object](
      "bootstrap.servers" -> "localhost:9092",
      "key.deserializer" -> classOf[StringDeserializer],
      "value.deserializer" -> classOf[StringDeserializer],
      "group.id" -> "kafka_builderscon_stream",
      "auto.offset.reset" -> "latest",
      "enable.auto.commit" -> (false: java.lang.Boolean)
    )
    //
    val spark = SparkSession
      .builder
      .master("local[*]")
      .appName("buildersconSmaple")
      .config("spark.cassandra.connection.host", "192.168.10.10")
      .getOrCreate()
    val streamingContext = new StreamingContext(spark.sparkContext, Seconds(5))

    streamingContext.checkpoint("/tmp/")
    val topics = Array("message-topic")
    val stream = KafkaUtils.createDirectStream[String, String](
      streamingContext,
      PreferConsistent,
      Subscribe[String, String](topics, kafkaParams)
    )
    val pairs = stream.map(record => (record.value, 1))
    val count = pairs.updateStateByKey(updateFunc)

    sys.ShutdownHookThread {
      System.out.println("Gracefully stopping SparkStreaming Application")
      streamingContext.stop(true, true)
      System.out.println("SparkStreaming Application stopped")
    }

    count.foreachRDD((rdd, time) => {
      val count = rdd.count()
      if (count > 0) {
        rdd.map(record => ("spark", streamMessageParse(record._1.toString).message, record._2))
          .saveToCassandra("builderscon", "counter", SomeColumns("stream", "message", "counter"))
      }
    })
    count.print()
    streamingContext.start()
    streamingContext.awaitTermination()
  }

  def updateFunc(newValue: Seq[Int], previousValue: Option[Int]) = {
    val newVal = newValue.sum + previousValue.getOrElse(0)
    Some(newVal)
  }

  // spark message case class
  case class SparkStreamMessage(message: String) extends Serializable
  def streamMessageParse(msg: String): SparkStreamMessage = {
    implicit val formats = DefaultFormats
    val m = parse(msg).extract[SparkStreamMessage]
    return m
  }

  // for cassandra
  case class SeqCounter(stream: String, message: String, counter: Long)
}
