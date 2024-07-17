start:
	docker compose up -d
	@echo "visit http://localhost:8888"

stop:
	docker compose stop

down:
	docker compose down

init:
	make stop
	make start
	docker exec -it oscars-app composer install --no-interaction --no-ansi --prefer-dist --no-progress --optimize-autoloader