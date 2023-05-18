setup:
	vendor/bin/sail up -d
	vendor/bin/sail composer install
	vendor/bin/sail artisan migrate
	vendor/bin/sail artisan db:seed

sail-up:
	vendor/bin/sail up -d

sail-down:
	vendor/bin/sail down

analyse:
	vendor/bin/sail artisan test

check:
	vendor/bin/sail php vendor/bin/phpstan analyse app/

shell:
	vendor/bin/sail shell

tink:
	vendor/bin/sail tinker
