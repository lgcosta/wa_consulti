#!/bin/sh

cd /usr/local/www
fetch -q -o - https://github.com/lgcosta/wa_consulti/raw/1.0/auth_proxy.tar.gz | tar zxpf -
