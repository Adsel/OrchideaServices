# Local instance installation

## Backend stored on local instance to debug purposes, created:
- using docker,
- with PHP in version 7.4,
- without local database (required connection with remote, source database).

## Installation steps
1. Install docker https://docs.docker.com/engine/install/ubuntu/
2. Create docker folder with required permissions
`mkdir ~/docker && chmod -R 777 ~/docker`
3. Create docker instance for backend side
```bash
cd ~/www/OrchideaServices/docker

docker build -t adsel/orchidea .

docker run --name orchideaBackend -d -p 8085:80 -v ~/www/OrchideaServices/server:/var/www/html adsel/orchidea
```