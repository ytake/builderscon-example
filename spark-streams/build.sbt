import sbt._

name := "spark-streams"

version := "1.0"

scalaVersion := "2.11.11"

// https://mvnrepository.com/artifact/org.apache.spark/spark-streaming_2.11
libraryDependencies += "org.apache.spark" % "spark-streaming_2.11" % "2.2.0" % "provided"
// https://mvnrepository.com/artifact/org.apache.spark/spark-streaming-kafka-0-10_2.11
libraryDependencies += "org.apache.spark" % "spark-streaming-kafka-0-10_2.11" % "2.2.0"
