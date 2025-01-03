#!make

help: _header
	${info }
	@echo Opciones:
	@echo ------------------------
	@echo start / stop / restart
	@echo start-traefik
	@echo ------------------------
	@echo stats / logs / workspace
	@echo clean
	@echo ------------------------

_urls: _header
	${info }
	@echo Sitios disponibles:
	@echo ------------------------------------------------
	@echo [iTutor] http://localhost
	@echo [iTutor (Debug)] http://localhost/itutor_dev.php
	@echo [phpMyAdmin] http://localhost:8080
	@echo ------------------------------------------------

_urls-traefik: _header
	${info }
	@echo Sitios disponibles:
	@echo --------------------------------------------------
	@echo [iTutor] http://itutor.test
	@echo [iTutor (Debug)] http://itutor.test/itutor_dev.php
	@echo [phpMyAdmin] http://phpmyadmin.itutor.test
	@echo --------------------------------------------------

_header:
	@echo ----------------
	@echo iTutor en Docker
	@echo ----------------

_start-command:
	@docker compose up -d --remove-orphans

_start-traefik-command:
	@docker compose -f docker-compose.yml -f docker-compose.traefik.yml up -d --remove-orphans

start: _start-command _urls

start-traefik: _start-traefik-command _urls-traefik

stop:
	@docker compose stop

restart: stop start

stats:
	@docker stats

logs:
	@docker compose logs web

workspace:
	@docker compose exec web /bin/bash

clean:
	@docker compose down -v --remove-orphans
