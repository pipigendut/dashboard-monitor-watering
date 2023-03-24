# Dashboard Monitor Watering
Application built using Laravel for purpose monitor watering in realtime using mqtt as pubsub.
Login is required to see dashboard.

## Prerequisite
- [Docker](https://www.docker.com/) v20.10.22
- [Docker compose](https://docs.docker.com/compose/) +v2.15.1

## How to use

### Configuration
- Touch .env based on .env.example

### Running

Setup cerbot
1. commented nginx conf for ssl
2. RUN
```bash
docker compose run --rm certbot certonly --webroot --webroot-path /var/www/certbot/ -d pipigendut.tech
docker compose run --rm certbot certonly --standalone --preferred-challenges http -d pipigendut.tech
```
3. uncommented nginx conf for ssl
4. RUN
```bash
docker-compose up -d
```

## Additional
### Authentication mqtt
Change user password / create a new user
```bash
docker-compose exec mosquitto mosquitto_passwd -b /mosquitto/config/password.txt admin password
docker-compose restart
```

Delete user
```bash
docker-compose exec mosquitto mosquitto_passwd -D /mosquitto/config/password.txt user
docker-compose restart
```

### Config DB

Do below if error not allowed ip
```
mysql -p


CREATE USER 'user'@'host' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON *.* TO 'user'@'host' WITH GRANT OPTION;
FLUSH PRIVILEGES;
```

## Ref
https://mindsers.blog/post/https-using-nginx-certbot-docker/
https://www.digitalocean.com/community/tutorials/how-to-install-and-secure-the-mosquitto-mqtt-messaging-broker-on-ubuntu-16-04
https://eff-certbot.readthedocs.io/en/stable/install.html

## License
The application is open-source
