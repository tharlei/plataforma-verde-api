<p align="center">
 <img width="128" src="https://i.imgur.com/H8M9D5f.png"/>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white"/>
  <img src="https://img.shields.io/badge/PHP-4f5b93?style=for-the-badge&logo=php&logoColor=white"/>
</p>

## Sumário

:small_blue_diamond: [Deploy](#deploy)

:small_blue_diamond: [Documentação](#documentação)

:small_blue_diamond: [Requisitos](#requisitos)

:small_blue_diamond: [Execute projeto](#execute-projeto)

:small_blue_diamond: [Tecnologias utilizadas](#tecnologias-utilizadas)

:small_blue_diamond: [Autor](#autor)

:small_blue_diamond: [Licença](#licença)

## Deploy

> Link da API: https://plataforma-verde-api.tk

## Documentação

> Documentação no Postman: https://documenter.getpostman.com/view/4827382/2s83YVJ6bA

## Pré-requisitos

:warning: [PHP:^8.1](https://www.php.net/releases/8.1/en.php)

:warning: [Composer](https://getcomposer.org/download/)

:warning: [MySQL](https://hub.docker.com/_/mysql)

## Como rodar a aplicação :arrow_forward:

No terminal, clone o projeto:

```
git clone https://gitlab.com/tharlei/plataforma-verde-api.git
```

Entre na pasta

```
cd plataforma-verde-api
```

Instale as dependências do composer:

```
composer install
```

Copie .env.example e preencha .env:

```
cp .env.example .env
```

Gerar a chave do projeto:

```
php artisan key:generate
```

Execute as migrations:

```
php artisan migrate
```

De permissão as pastas:

```
sudo chgrp -R www-data storage bootstrap/cache && sudo chmod -R ug+rwx storage bootstrap/cache
```

Execute o projeto no modo desenvolvimento

```
php artisan serve
```

## Tecnologias utilizadas

-   [PHP 8.1](https://www.php.net/)
-   [Laravel 9.x](https://laravel.com/docs/9.x)

## Autor

[<img src="https://avatars2.githubusercontent.com/u/32899049?s=460&u=946f73939bb511fa8ae40ed80764cc4dbffe359f&v=4" width=115><br><sub>Tharlei Aleixo</sub>](https://github.com/Tharlei)

## Licença

The [MIT License]() (MIT)

Copyright :copyright: 2022 - app-ce4b9bea
