#!make

help: _header
	${info }
	@echo Opciones:
	@echo ------------------------
	@echo start / stop / restart
	@echo ------------------------
	@echo stats / logs / workspace
	@echo clean
	@echo ------------------------

_urls: _header
	${info }
	@echo Sitios disponibles:
	@echo ----------------------------------
	@echo [iTutor] http://localhost
	@echo [phpMyAdmin] http://localhost:8080
	@echo ----------------------------------

_header:
	@echo ----------------
	@echo iTutor en Docker
	@echo ----------------

_start-command:
	@docker compose up -d --remove-orphans

start: _start-command _urls

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
