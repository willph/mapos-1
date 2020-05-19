# Map-OS

⚠️ Aviso: Trabalho em progresso!

![Version](https://img.shields.io/badge/version-0.1.0-blue.svg?longCache=true&style=flat-square)
![License](https://img.shields.io/badge/license-MIT-green.svg?longCache=true&style=flat-square)
![Tests](https://github.com/map-os/mapos/workflows/Tests/badge.svg)
![StyleCI](https://github.styleci.io/repos/249856074/shield?branch=master)
![Issues](https://img.shields.io/github/issues/map-os/mapos.svg?longCache=true&style=flat-square)
![Contributors](https://img.shields.io/github/contributors/map-os/mapos.svg?longCache=true&style=flat-square)

![MapOS](https://raw.githubusercontent.com/RamonSilva20/mapos/master/assets/img/logo.png)

## Requerimentos

* PHP 7.2 ou superior
* Banco de dados (por exemplo: MySQL, PostgreSQL, SQLite)
* Servidor Web (por exemplo: Apache, Nginx, IIS)

## Framework

Map-OS usa o [Laravel](http://laravel.com), o melhor framework PHP atualmente, como base.

## Instalação

* Instale o [Composer](https://getcomposer.org/download) e o [Npm](https://nodejs.org/en/download)
* Clone o repositório: `git clone https://github.com/map-os/mapos.git`
* Depois acesse a pasta MAPOS, `cd mapos`
* Instale as dependências `composer install ; npm install ; npm run production`
* Crie o arquivo de configuração de variáveis de ambiente `cp .env.production .env`
* Configure as variáveis de ambiente e a conexão com o banco de dados no arquivo .env
* Rode os seeders `php artisan migrate:fresh --seed`
* Rode `php artisan key:generate`
* Rode `php artisan serve` para iniciar o servidor. 
* Acesse o Map-OS no navegador: http://localhost:8000 ou url que você configurar.
* E logue com as credenciais

```bash
Login: admin@admin.com
Senha: admin
```

## Contribuindo

Por favor, seja muito claro em suas pull requests, as pull requests podem ser rejeitadas sem motivo.

Ao contribuir com código para o Map-OS, você deve seguir os padrões de codificação PSR-2. A regra de ouro é: Imite o código Map-OS existente.

## Changelog

Por favor, consulte [Changelog](CHANGELOG.md) para obter mais informações sobre todas as atualizações.

## Segurança

Se você descobrir algum problema relacionado à segurança, envie um email para gian_bine@hotmail.com ao invés de usar o issue tracker.

## Créditos

* [Ramon Silva](https://github.com/RamonSilva20)
* [Willmerson](https://github.com/willph)
* [Gianluca Bine](https://github.com/Pr3d4dor)
* [Todos os Contribuidores](../../contributors)

## Licença

O Map-OS é distribuído utilizando a [MIT License](LICENSE.md).
