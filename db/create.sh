#!/bin/sh

if [ "$1" = "travis" ]
then
    psql -U postgres -c "CREATE DATABASE practica_test;"
    psql -U postgres -c "CREATE USER practica PASSWORD 'practica' SUPERUSER;"
else
    [ "$1" != "test" ] && sudo -u postgres dropdb --if-exists practica
    [ "$1" != "test" ] && sudo -u postgres dropdb --if-exists practica_test
    [ "$1" != "test" ] && sudo -u postgres dropuser --if-exists practica
    sudo -u postgres psql -c "CREATE USER practica PASSWORD 'practica' SUPERUSER;"
    [ "$1" != "test" ] && sudo -u postgres createdb -O practica practica
    sudo -u postgres createdb -O practica practica_test
    LINE="localhost:5432:*:practica:practica"
    FILE=~/.pgpass
    if [ ! -f $FILE ]
    then
        touch $FILE
        chmod 600 $FILE
    fi
    if ! grep -qsF "$LINE" $FILE
    then
        echo "$LINE" >> $FILE
    fi
fi
