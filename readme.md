# Connect to php
docker exec -it php81-container bash

# Connect to MYSQL
docker exec -it mysql8-container mysql -p
docker exec -it mysql8-container mysql -u root -p

# Migration
symfony console doctrine:database:create