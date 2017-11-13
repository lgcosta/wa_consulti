#!/bin/sh

cd /usr/local/www
fetch -q -o - giturl | tar zxpf -
