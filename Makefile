help:
	@echo 'Opciones:'
	@echo ''
	@echo 'start | stop'

start:
	@docker-compose up -d

stop:
	@docker-compose stop
