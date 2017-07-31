#!/usr/bin/env bash

SELF_IP=`ifconfig enp0s8 | awk '/inet / {print $2}'`
cqlsh $SELF_IP --file=cassandra_ddl/schema.cql

