# Local instance installation

## Backend stored on local instance to debug purposes:
- created using docker,
- with PHP in version 7.4,
- without local database (required connection with remote, source database).

## Installation steps
1. Install docker https://docs.docker.com/engine/install/ubuntu/
2. Create docker folder with required permissions
`mkdir ~/docker && chmod -R 777 ~/docker`
3. Create docker database

a) create instance
```bash
    sudo docker pull mysql:5.7
    
    mkdir ~/docker/mysql_orchidea/IMPORT -p
    sudo chmod 777 -R ~/docker/mysql_orchidea
    
    sudo docker run -p 3307:3306 --name orchideaDb -v /home/${USER}/docker/mysql_orchidea:/var/lib/mysql -e MYSQL_ROOT_PASSWORD=local1234 -d mysql:5.7 --sql-mode="NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION"
    
    sudo docker start orchideaDb
```
b) load database dump
```bash
sudo docker exec -it orchideaDb bash
cd /var/lib/mysql/IMPORT
ls

mysql -u root -plocal1234;

CREATE DATABASE orchidea_local;

use orchidea_local;

source [filename].sql
```

4. Create docker instance for backend side
```bash
cd ~/www/orchidea-event-services/docker

docker build -t adsel/orchidea .

docker run --name orchideaBackend -d -p 8085:80 -v ~/www/orchidea-event-services/server:/var/www/html adsel/orchidea
```
5. Install composer dependencies
```bash
docker exec -it orchideaBackend bash 

cd /var/www/html

composer install

composer dump
```
