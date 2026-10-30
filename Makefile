#!make

help: _header
	${info }
	@echo Opciones:
	@echo ------------------------
	@echo build
	@echo start / stop / restart
	@echo start-traefik
	@echo ------------------------
	@echo stats / logs / workspace
	@echo test / sweep
	@echo clean
	@echo ------------------------

_urls: _header
	${info }
	@echo Sitios disponibles:
	@echo --------------------------------------------------
	@echo [iTutor] http://localhost
	@echo [iTutor \(Debug\)] http://localhost/itutor_dev.php
	@echo [phpMyAdmin] http://localhost:8080
	@echo --------------------------------------------------

_urls-traefik: _header
	${info }
	@echo Sitios disponibles:
	@echo -----------------------------------------------------
	@echo [iTutor] https://itutor.test
	@echo [iTutor \(Debug\)] https://itutor.test/itutor_dev.php
	@echo [phpMyAdmin] https://phpmyadmin.itutor.test
	@echo -----------------------------------------------------

_header:
	@echo ----------------
	@echo iTutor en Docker
	@echo ----------------

build:
	@docker compose build --pull

_start-command:
	@docker compose up -d --remove-orphans

_start-traefik-command:
	@docker compose -f docker-compose.yml -f docker-compose.traefik.yml up -d --remove-orphans

start: _start-command _urls

start-traefik: _start-traefik-command _urls-traefik

stop:
	@docker compose down

restart: stop start

test: _start-command
	@docker compose --profile tools run --rm tests

# Recorrido exhaustivo de rutas: detecta deprecated/warning/notice/fatal
# en cada respuesta (usa el front controller de debug)
sweep: _start-command
	@php tests/route_sweep.php --base=http://localhost --pass=all

stats:
	@docker stats

logs:
	@docker compose logs web

workspace:
	@docker compose exec web /bin/bash

clean:
	@docker compose down -v --remove-orphans
