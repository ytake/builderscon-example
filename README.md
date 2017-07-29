# php-builderscon-example

required php7.1, Scala2.11.11

include Cassandra 3.11, Kafka 0.11.0, Spark 2.2.0  

## Spark UI
spark-shell
http://builderscon-example.app:4040/

## Kafka trifecta

http://192.168.10.10:8888/

## spark application

```bash
$ ~/builderscon-example/spark-streams]$ spark-submit --class jp.comnect.spark.KafkaStreamApplication target/scala-2.11/spark-streams_2.11-1.0.jar localhost 9999
```
