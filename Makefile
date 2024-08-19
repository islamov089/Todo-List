du: memory
	docker compose up -d

dup: memory
	docker compose up

dd:
	docker compose down

dr:
	docker compose down
	sudo rm -rf docker/storage/mysql

db:
	docker compose up --build -d

de:
	docker exec -it example-php bash

de-node:
	docker compose exec node sh

de-node-run-dev:
	docker compose exec node npm run dev

ds:
	docker compose stop

queue:
	docker compose exec php-cli php artisan queue:work

horizon:
	docker compose exec php-cli php artisan horizon

horizon-pause:
	docker compose exec php-cli php artisan horizon:pause

horizon-continue:
	docker compose exec php-cli php artisan horizon:continue

horizon-terminate:
	docker compose exec php-cli php artisan horizon:terminate


perm:
	#sudo chgrp -R www-data storage bootstrap/cache
	#sudo chmod -R ug+rwx storage bootstrap/cache
	sudo chown www-data -R storage bootstrap/cache
	sudo chmod 777 -R storage

init: perm
	docker exec -it example-php sh -c "composer update && php artisan key:generate && php artisan migrate --seed"



rebuild: dr db init
