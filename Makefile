.PHONY: pull reset-logs clear dump-autoload reset-cache update-schema


all:
	@echo "No default rule"

reset-logs:
	rm -rf var/logs;

reset-cache:
	rm -rf var/cache;

clear:
	php bin/console cache:clear

pull:
	git pull

update-schema:
	php bin/console doctrine:schema:update --force

dump-autoload:
	composer dump-autoload --optimize --no-dev --classmap-authoritative

