FROM php:7.4-cli
COPY . /usr/src/myapp
WORKDIR /usr/src/myapp
CMD [ "php", "-S", "localhost:3000", "./docker-test.php" ]
