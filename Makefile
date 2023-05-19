setup:
	cp -n .env.example .env
	composer install
	vendor/bin/sail down
	vendor/bin/sail up -d
	vendor/bin/sail artisan migrate
	vendor/bin/sail artisan db:seed

sail-up:
	vendor/bin/sail up -d

sail-down:
	vendor/bin/sail down

test:
	vendor/bin/sail artisan test

analyse:
	vendor/bin/sail php vendor/bin/phpstan analyse app/

shell:
	vendor/bin/sail shell

tink:
	vendor/bin/sail tinker
