CREATE KEYSPACE builderscon WITH replication = {'class': 'SimpleStrategy', 'replication_factor': '1'}  AND durable_writes = true;

CREATE TABLE builderscon.counter (
  stream text,
  message text,
  counter int,
  PRIMARY KEY ((stream), message)
);

CREATE MATERIALIZED VIEW builderscon.counter_desc AS
SELECT stream, message, counter FROM builderscon.counter
WHERE message IS NOT NULL
AND stream IS NOT NULL
AND counter IS NOT NULL
PRIMARY KEY (stream, message, counter)
WITH CLUSTERING ORDER BY (counter DESC);

CREATE MATERIALIZED VIEW builderscon.counter_asc AS
SELECT stream, message, counter FROM builderscon.counter
WHERE message IS NOT NULL
AND stream IS NOT NULL
AND counter IS NOT NULL
PRIMARY KEY (stream, message, counter)
WITH CLUSTERING ORDER BY (counter ASC);
