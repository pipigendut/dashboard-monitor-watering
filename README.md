# Dashboard Monitor Watering
Application built using Laravel for purpose monitor watering in realtime using mqtt as pubsub.
Login is required to see dashboard.

## Prerequisite
- [Docker](https://www.docker.com/) v20.10.22
- [Docker compose](https://docs.docker.com/compose/) +v2.15.1

## How to use

### Configuration
- Touch .env.production based on .env.example

### Running
Build docker container
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
```

## License
The application is open-source
