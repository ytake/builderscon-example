# builderscon-example

required php7.1, Scala2.11.11, Vagrant

include Cassandra 3.11, Kafka 0.11.0, Spark 2.2.0  

## SetUp

### Beginning

```bash
$ vagrant up
```

### Cassandra DDL

```bash
$ cd builderscon-example/bin
$ ./create.sh
```

### Composer

```bash
$ composer install
```

## Sample
このサンプルはkafkaのmessage-topicにメッセージを送信し、
Spark Streamingでメッセージごとの集計を行い、Cassandraへ保存するサンプルです。
保存結果は `192.168.10.10` にアクセスしてください、
jsonで結果が返却されます。

### producer
kafkaにメッセージを送信します

```
$ php kafka-console kafka:produce message-topic hello
```

*helloの部分適当な文字列を入れてください*

### consumer
kafkaに送られたメッセージを取得します

```
$ php kafka-console kafka:consume message-topic
```

## Spark Streaming Sample Application
spark streamingの実行は下記を参照してください

[stremaing sample readme](/spark-streams/README.md).

## Spark UI

spark-submit実行中は下記にアクセスすることで稼働状況が描画されます

spark-shell
http://192.168.10.10:4040/

## Kafka trifecta

kafkaのtopic確認などは下記にアクセスしてください

http://192.168.10.10:8888/



