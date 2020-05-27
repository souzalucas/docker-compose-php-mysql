# Docker Compose - PHP MySQL 
Ambiente de desenvolvimento PHP, MySQL no servidor Apache utilizando o Docker Compose.

## Execução
Para criar os containers, utilize o comando:

``` sh
$ docker-compose up
```

## Como Funciona
O Dockerfile `php7-apache2-dockerfile` foi criado no mesmo diretório do `docker-compose.yml`

```
FROM php:7.2-apache
WORKDIR /var/www/html
RUN docker-php-ext-install mysqli
```
Em `build:` o Dockerfile acima é referenciado para gerar a imagem e container do PHP e do Apache
``` yml
version: '3'

services:
  apache:
    build:
      dockerfile: php7-apache2-dockerfile
      context: .
    image: seu-usuario/php7-apache2-dockerfile
    container_name: php7-apache2
    restart: always
    ports:
      - '80:80'
    volumes:
      - ./html:/var/www/html
    depends_on:
      - mysqldb
    links:
      - mysqldb

  mysqldb:
    container_name: mysqlServer
    image: mysql:5.7
    restart: always
    ports:
      - '3307:3306'
    environment:
      - MYSQL_ROOT_PASSWORD=root
      - MYSQL_DATABASE=banco
```
Teste a conexão com o `index.php`

``` PHP
<html>
<?php

echo 'Versão Atual do PHP: ' . phpversion();

$servername = "mysqlServer";
$username = "root";
$password = "root";

// Criando Conexão
$conn = new mysqli($servername, $username, $password);

// Testando Conexão
if ($conn->connect_error) {
    die("Falha na Conexão: " . $conn->connect_error);
}
echo "<br /> Conexão Bem Sucedida";
?>

</html>
```

## Referências
[Docker Documentation](https://docs.docker.com)

[Fórum Docker: Criando containers sem dor de cabeça](https://cursos.alura.com.br/forum)

