#!/bin/bash

BASEDIR=$(dirname $0)
cd $BASEDIR

php phpunit.phar --colors --debug --verbose --bootstrap phpunit_bootstrap.php --coverage-text=../../../../tests/coverage_project ../../../../tests/

while read line
do
    name=$line
    echo "$name"
done < ../../../../tests/coverage_project