#!/bin/sh

host="localhost"
db="shankara_krupa"
usr="root"
pwd="mysql"

echo "drop database if exists shankara_krupa; create database shankara_krupa;" | /usr/bin/mysql -uroot -pmysql

perl insert_author.pl $host $db $usr $pwd
perl insert_feat.pl $host $db $usr $pwd
perl insert_series.pl $host $db $usr $pwd
perl insert_articles.pl $host $db $usr $pwd
