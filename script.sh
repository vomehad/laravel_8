#!/bin/bash

US=`whoami`;
passwd="/etc/passwd";

mysql=`sed 's/:.*//' $passwd | grep "$US"`;

if $mysql
 then echo 'Start by MYSQL';
else
    echo 'start another';
fi
