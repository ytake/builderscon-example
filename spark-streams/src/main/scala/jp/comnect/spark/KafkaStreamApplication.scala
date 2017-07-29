package jp.comnect.spark

import kafka.serializer.StringDecoder
import org.apache.spark.{SparkContext, SparkConf}
import org.apache.spark.streaming.kafka010._
import org.apache.spark.streaming.kafka010.LocationStrategies.PreferConsistent
import org.apache.spark.streaming.kafka010.ConsumerStrategies.Subscribe
import org.apache.spark.streaming.{Seconds, StreamingContext}
import org.apache.spark.streaming.dstream.InputDStream
import org.apache.kafka.common.serialization.StringDeserializer
import org.apache.spark.{SparkContext, SparkConf}
import org.apache.spark.streaming.{Seconds, StreamingContext}


/**
  *
  */
object KafkaStreamApplication {
  def main(args: Array[String]) {
    val kafkaParams = Map[String, Object](
      "bootstrap.servers" -> "localhost:9092",
      "key.deserializer" -> classOf[StringDeserializer],
      "value.deserializer" -> classOf[StringDeserializer],
      "group.id" -> "use_a_separate_group_id_for_each_stream",
      "auto.offset.reset" -> "latest",
      "enable.auto.commit" -> (false: java.lang.Boolean)
    )
    val conf = new SparkConf().setAppName("buildersconSmaple")
    val streamingContext = new StreamingContext(conf, Seconds(5))
    val topics = Array("message-topic")
    val stream = KafkaUtils.createDirectStream[String, String](
      streamingContext,
      PreferConsistent,
      Subscribe[String, String](topics, kafkaParams)
    )

    sys.ShutdownHookThread {
      System.out.println("Gracefully stopping SparkStreaming Application")
      streamingContext.stop(true, true)
      System.out.println("SparkStreaming Application stopped")
    }
    streamingContext.start
    streamingContext.awaitTermination

    stream.print()
  }
}
