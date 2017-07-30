# Spark Stream sample

```bash
$ sbt compile
$ sbt package
```

## spark application

```bash
$ spark-submit --class jp.comnect.spark.KafkaStreamApplication spark-streams/target/scala-2.11/spark-streams_2.11-1.0.jar
```

## append jar
http://central.maven.org/maven2/org/apache/kafka/kafka-clients/0.10.2.0/kafka-clients-0.10.2.0.jar
http://central.maven.org/maven2/org/apache/spark/spark-streaming-kafka-0-10_2.11/2.2.0/spark-streaming-kafka-0-10_2.11-2.2.0.jar

