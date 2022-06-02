-include .env

php_container := $(APP_NAME)_php
mysql_container := $(APP_NAME)_mysql

rebuild-up:
	@docker-compose up -d --build --remove-orphans
	@echo "Make: rebuild and up containers.\n"

build:
	docker-compose build
	@echo "Make: Build containers.\n"

up:
	@docker-compose up -d --remove-orphans
	@echo "Make: Up containers.\n"

down:
	@docker-compose down

stop:
	@docker-compose stop

php-bash:
	docker exec -it --user www-data $(php_container) bash

php-install:
	docker exec -it --user www-data $(php_container) sh -c "composer i"

php-update:
	docker exec -it --user www-data $(php_container) sh -c "composer u"

mysql-bash:
	docker exec -it --user mysql $(mysql_container) bash

migrate-up:
	docker exec -it $(php_container) sh -c "php artisan migrate"

migrate-reset:
	docker exec -it $(php_container) sh -c "php artisan migrate:reset"

dev:
	yarn dev

yarn:
	yarn watch

prod:
	yarn prod
