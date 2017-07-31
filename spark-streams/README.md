# Spark Stream Sample

Kafka -> Spark Streaming -> Cassandra

```bash
$ sbt compile
$ sbt package
```

## spark application

```bash
$ spark-submit --class jp.comnect.spark.KafkaStreamApplication /home/vagrant/builderscon-example/spark-streams/target//scala-2.11/spark-streams_2.11-1.0.jar
```

## append jar

```bash
$ wget http://central.maven.org/maven2/org/apache/kafka/kafka-clients/0.10.2.0/kafka-clients-0.10.2.0.jar
$ sudo mv kafka-clients-0.10.2.0.jar /opt/spark/jars/

$ wget http://central.maven.org/maven2/org/apache/spark/spark-streaming-kafka-0-10_2.11/2.2.0/spark-streaming-kafka-0-10_2.11-2.2.0.jar
$ sudo mv spark-streaming-kafka-0-10_2.11-2.2.0.jar /opt/spark/jars/

$ wget http://central.maven.org/maven2/org/json4s/json4s-jackson_2.11/3.2.11/json4s-jackson_2.11-3.2.11.jar
$ sudo mv json4s-jackson_2.11-3.2.11.jar /opt/spark/jars/

$ wget http://central.maven.org/maven2/org/json4s/json4s-core_2.11/3.2.11/json4s-core_2.11-3.2.11.jar
$ sudo mv json4s-core_2.11-3.2.11.jar /opt/spark/jars/

$ wget http://central.maven.org/maven2/org/json4s/json4s-ast_2.11/3.2.11/json4s-ast_2.11-3.2.11.jar
$ sudo mv json4s-ast_2.11-3.2.11.jar /opt/spark/jars/

$ wget http://central.maven.org/maven2/com/google/guava/guava/16.0.1/guava-16.0.1.jar
$ sudo mv guava-16.0.1.jar /opt/spark/jars/

$ wget http://central.maven.org/maven2/com/datastax/spark/spark-cassandra-connector_2.11/2.0.1/spark-cassandra-connector_2.11-2.0.1.jar
$ sudo mv spark-cassandra-connector_2.11-2.0.1.jar /opt/spark/jars/

$ wget http://central.maven.org/maven2/com/twitter/jsr166e/1.1.0/jsr166e-1.1.0.jar
$ sudo mv jsr166e-1.1.0.jar /opt/spark/jars/
```
