#!/bin/sh
sudo yum install nc nmap -y

SELF_IP=`ifconfig enp0s8 | awk '/inet / {print $2}'`

## scala install
wget http://downloads.typesafe.com/scala/2.12.2/scala-2.12.2.tgz
tar xvf scala-2.12.2.tgz
sudo mv scala-2.12.2 /usr/local/lib/scala
sudo echo 'export SCALA_HOME=/usr/local/lib/scala' >> /etc/profile.d/scala.sh
sudo echo 'export PATH=$PATH:$SCALA_HOME/bin' >> /etc/profile.d/scala.sh
sudo source /etc/profile.d/scala.sh
scala -version
sudo rm -rf scala-2.12.2.tgz

## sbt install
sudo curl https://bintray.com/sbt/rpm/rpm | sudo tee /etc/yum.repos.d/bintray-sbt-rpm.repo
sudo yum install -y sbt

## spark install
wget https://d3kbcqa49mib13.cloudfront.net/spark-2.2.0-bin-hadoop2.7.tgz
tar xzvf spark-2.2.0-bin-hadoop2.7.tgz
sudo mv spark-2.2.0-bin-hadoop2.7 /opt/spark
sudo echo "
export SPARK_HOME=/opt/spark
export PATH=\$PATH:\$SPARK_HOME/bin
export SPARK_LOCAL_IP=$SELF_IP
" >> /etc/profile.d/spark.sh
sudo source /etc/profile.d/spark.sh

sudo rm -rf spark-2.2.0-bin-hadoop2.7.tgz

sudo cp /opt/spark/conf/spark-defaults.conf.template /opt/spark/conf/spark-defaults.conf
sudo echo "
spark.driver.extraJavaOptions -Dderby.system.home=/tmp/derby -Dderby.stream.error.file=/tmp/stream_error
spark.sql.warehouse.dir /tmp/warehouse
" >> /opt/spark/conf/spark-defaults.conf
sudo cp /opt/spark/conf/spark-env.sh.template /opt/spark/conf/spark-env.sh

## kafka
wget http://www-us.apache.org/dist/kafka/0.11.0.0/kafka_2.12-0.11.0.0.tgz
tar -xvf kafka_2.12-0.11.0.0.tgz
sudo mv kafka_2.12-0.11.0.0 /opt/kafka
sudo rm -rf kafka_2.12-0.11.0.0.tgz

sudo /opt/kafka/bin/zookeeper-server-start.sh -daemon /opt/kafka/config/zookeeper.properties

sudo echo "
advertised.listeners=PLAINTEXT://$SELF_IP:9092
" >> /opt/kafka/config/server.properties
sudo sed -i "s|zookeeper.connect=localhost:2181|zookeeper.connect=$SELF_IP:2181|g" /opt/kafka/config/server.properties

sudo /opt/kafka/bin/kafka-server-start.sh -daemon /opt/kafka/config/server.properties

sudo cat > /etc/yum.repos.d/cassandra.repo << EOF
[cassandra]
name=Apache Cassandra
baseurl=https://www.apache.org/dist/cassandra/redhat/311x/
gpgcheck=1
repo_gpgcheck=1
gpgkey=https://www.apache.org/dist/cassandra/KEYS
EOF

sudo yum -y install cassandra

sudo mv /etc/cassandra/default.conf/cassandra.yaml /etc/cassandra/conf/cassandra.yaml
sudo sed -i "s|seeds: \"127.0.0.1\"|seeds: \"$SELF_IP\"|g" /etc/cassandra/conf/cassandra.yaml
sudo sed -i "s|listen_address: localhost|listen_address: $SELF_IP|g" /etc/cassandra/conf/cassandra.yaml
sudo sed -i "s|rpc_address: localhost|rpc_address: $SELF_IP|g" /etc/cassandra/conf/cassandra.yaml
sudo sed -i "s|start_rpc: false|start_rpc: true|g" /etc/cassandra/conf/cassandra.yaml

sudo systemctl enable cassandra
sudo systemctl start cassandra

echo "export CQLSH_HOST=$SELF_IP" >> /home/vagrant/.bash_profile
echo "export CQLSH_NO_BUNDLED=true" >> /home/vagrant/.bash_profile

sudo yum install python-pip -y
sudo pip install --upgrade pip
sudo pip install cassandra-driver

wget https://github.com/ldaniels528/trifecta/releases/download/v0.22.0rc8-0.10.1.0/trifecta-ui-0.22.0rc8b-0.10.1.0.zip
unzip trifecta-ui-0.22.0rc8b-0.10.1.0.zip
mv trifecta-ui-0.22.0rc8b-0.10.1.0 trifecta-ui
rm -rf trifecta-ui-0.22.0rc8b-0.10.1.0.zip

nohup ./trifecta-ui/bin/trifecta-ui -Dhttp.port=8888 &
sudo /opt/kafka/bin/kafka-topics.sh --create --zookeeper localhost:2181 --replication-factor 1 --partitions 1 --topic test
