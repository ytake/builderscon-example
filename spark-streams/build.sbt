import sbt._

name := "spark-streams"

version := "1.0"

scalaVersion := "2.11.11"

mainClass := Option("jp.comnect.spark.KafkaStreamApplication")


libraryDependencies += "org.apache.spark" % "spark-core_2.11" % "2.2.0"
libraryDependencies += "org.apache.spark" % "spark-streaming_2.11" % "2.2.0"
libraryDependencies += "org.apache.spark" % "spark-streaming-kafka-0-10_2.11" % "2.2.0"
libraryDependencies += "org.apache.kafka" % "kafka-clients" % "0.10.2.0"
// https://mvnrepository.com/artifact/org.apache.kafka/kafka_2.11
libraryDependencies += "org.apache.kafka" % "kafka_2.11" % "0.10.1.1"
resolvers += "Spark Packages Repo" at "https://dl.bintray.com/spark-packages/maven"
libraryDependencies += "datastax" % "spark-cassandra-connector" % "2.0.1-s_2.11"
// https://mvnrepository.com/artifact/org.apache.spark/spark-sql_2.11
libraryDependencies += "org.apache.spark" % "spark-sql_2.11" % "2.2.0" % "provided"
