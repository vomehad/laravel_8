FROM mysql:latest

ADD my.conf /etc/mysql/conf.d/my.cnf
RUN mysql -u $DB_USERNAME -p$DB_PASSWORD | CREATE SCHEMA $DB_DATABASE;

CMD ["--character-set-server=utf8mb4", "--collation-server=utf8mb4_general_ci", "--skip-character-set-client-handshake"]
