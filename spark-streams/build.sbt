import sbt._

name := "spark-streams"

version := "1.0"

scalaVersion := "2.11.11"

mainClass := Option("jp.comnect.spark.KafkaStreamApplication")

resolvers += "Spark Packages Repo" at "https://dl.bintray.com/spark-packages/maven"

libraryDependencies ++= Seq(
  "org.apache.spark" % "spark-core_2.11" % "2.2.0",
  "org.apache.spark" % "spark-streaming_2.11" % "2.2.0",
  "org.apache.spark" % "spark-sql_2.11" % "2.2.0" % "provided",
  "org.apache.spark" % "spark-streaming-kafka-0-10_2.11" % "2.2.0",
  "org.apache.kafka" % "kafka-clients" % "0.10.2.0",
  "org.apache.kafka" % "kafka_2.11" % "0.10.1.1",
  "org.json4s" % "json4s-jackson_2.11" % "3.2.11",
  "org.json4s" % "json4s-core_2.11" % "3.2.11",
  "org.json4s" % "json4s-ast_2.11" % "3.2.11",
  "com.datastax.spark" % "spark-cassandra-connector_2.11" % "2.0.1",
  "com.google.guava" % "guava" % "16.0.1"
)
