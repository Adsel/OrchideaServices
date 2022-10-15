# Local instance installation

## Backend stored on local instance to debug purposes:

### Installation steps - LINUX
**Disclaimer**:
The instruction assumes that the project is cloned to the location:
`/home/${USER}/www/orchidea-event-services`

1. Install docker https://docs.docker.com/engine/install/ubuntu/
2. Create docker folder with required permissions
   ```
   mkdir ~/docker && chmod -R 777 ~/docker
   ```
3. Create docker instance for mysql
   ```bash
   mkdir ~/docker/orchidea_mysql && sudo chmod 777 ~/docker/orchidea_mysql

   sudo docker pull mysql:5.7
   sudo docker run -p 3307:3306 --name orchideaMysql -v /home/${USER}/docker/orchidea_mysql:/var/lib/mysql -e MYSQL_ROOT_PASSWORD=123456 -d mysql:5.7 --sql-mode="NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION"
   sudo docker start orchideaMysql
   ```
4. Create PhpMyAdmin instance
   ```bash
   sudo docker pull phpmyadmin/phpmyadmin 
   sudo docker run --name orchideaPhpMyAdmin -d --link orchideaMysql:db -p 8888:80 phpmyadmin/phpmyadmin
   ```
5. Check if phpmyadmin and mysql works properly 
   - Open web browser `localhost:8888`:
   ```bash
   # login
   root
   # password
   123456
   ``` 
6. Create required structure
   ```bash
   sudo docker exec -it orchideaMysql bash
   mysql -u root -p123456

   CREATE DATABASE orchidea;
   # Exit from mysql mode
   exit;
   
   # Exit from docker shell
   exit;

   cd ~/www/server/migrations/
   
   sudo docker exec -i orchideaMysql mysql -uroot -p123456 orchidea < 15-10-2022-initial-data.sql
   ```
7. Create docker instance for backend side
    ```bash
    cd ~/www/orchidea-event-services/docker
    
    sudo docker build -t adsel/orchidea .
    
    sudo docker run --name orchideaBackend -d -p 8080:80 -v ~/www/orchidea-event-services/server:/var/www/html adsel/orchidea
    ```
8. Install composer dependencies
   ```bash
   sudo docker exec -it orchideaBackend bash 
   
   cd /var/www/html
   
   composer install
   ```
