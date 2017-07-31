# php-builderscon-example

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

## Spark UI
spark-shell
http://builderscon-example.app:4040/

## Kafka trifecta
http://192.168.10.10:8888/

## Spark Streaming Sample Application
[stremaing sample readme](/spark-streams/README.md).

