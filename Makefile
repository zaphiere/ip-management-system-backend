HTTPD_CONTAINER = ip_management_httpd
PHP_CONTAINER = ip_management_php
REQUIREMENTS = docker docker-compose vi npm node
check:
	$(foreach REQUIREMENT, $(REQUIREMENTS), \
		$(if $(shell command -v $(REQUIREMENT) 2> /dev/null), \
			$(info `$(REQUIREMENT)` has been found. OK!), \
			$(error Please install `$(REQUIREMENT)` before running setup.) \
		) \
	)
setup: check
	cp ./.env.local ./.env
	cp docker-compose.dev.yml docker-compose.override.yml
	vi ./.env
	vi docker-compose.override.yml
	docker-compose up -d --build
	docker exec $(HTTPD_CONTAINER) chmod -R 775 /var/www/ip-management-backend/storage
	docker exec $(PHP_CONTAINER) composer install --prefer-dist
	docker exec $(PHP_CONTAINER) php artisan key:generate
	make setup-table
    make setup-jwt
	make clear-cache

setup-table:
	docker exec $(PHP_CONTAINER) php artisan migrate:fresh --seed

migrate:
	docker exec $(PHP_CONTAINER) php artisan migrate

bash:
	docker exec -it $(PHP_CONTAINER) bash

setup-jwt:
    docker exec $(PHP_CONTAINER) php artisan vendor:publish --provider="PHPOpenSourceSaver\JWTAuth\Providers\LaravelServiceProvider"
    docker exec $(PHP_CONTAINER) php artisan jwt:secret
