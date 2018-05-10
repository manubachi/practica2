#!/bin/sh

BASE_DIR=$(dirname $(readlink -f "$0"))
if [ "$1" != "test" ]
then
    psql -h localhost -U practica -d practica < $BASE_DIR/practica.sql
fi
psql -h localhost -U practica -d practica_test < $BASE_DIR/practica.sql
