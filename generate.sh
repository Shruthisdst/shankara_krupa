#!/bin/sh

host="localhost"
db="shankara_krupa"
usr="root"
pwd="mysql"

echo "DROP DATABASE IF EXISTS $db; CREATE DATABASE IF NOT EXISTS $db CHARACTER SET utf8 COLLATE utf8_general_ci;" | /usr/bin/mysql -uroot -p$pwd

perl insert_author.pl $host $db $usr $pwd
perl insert_feat.pl $host $db $usr $pwd
perl insert_articles.pl $host $db $usr $pwd
