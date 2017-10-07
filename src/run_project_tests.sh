#!/bin/bash

BASEDIR=$(dirname $0)
cd $BASEDIR

php phpunit.phar --colors --debug --verbose --bootstrap phpunit_bootstrap.php  ../