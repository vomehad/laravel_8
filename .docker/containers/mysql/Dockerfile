FROM mysql:latest

ADD my.cnf /etc/mysql/conf.d/my.cnf

RUN groupmod -g 1000 mysql
RUN usermod -u 1000 mysql

CMD ["--character-set-server=utf8mb4", "--collation-server=utf8mb4_general_ci", "--skip-character-set-client-handshake"]

EXPOSE 3306
