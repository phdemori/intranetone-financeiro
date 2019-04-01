
# Cadastro do módulo financeiro para IntranetOne
Cadastro do módulo financeiro (plano de contas, contas a pagar e contas a receber).
## Conteúdo
 
## Instalação

```sh
composer require agileti/iofinanceiro
```
```sh
php artisan io-financeiro:install
```

- Configure o webpack conforme abaixo 
```js
...
let financeiro = require('intranetone-financeiro');
io.compile({
  services:{
    ...
    new financeiro()
    ...
  }
});

```
- Compile os assets e faça o cache
```sh
npm run dev|prod|watch
php artisan config:cache
```
