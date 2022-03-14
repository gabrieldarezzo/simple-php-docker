Consumir uma API,  
Ex:  
`https://pokeapi.co/api/v2/pokemon/1/` 


https://pokeapi.co/api/v2/pokemon/idPokemano/ 1 ~ 10228

=====
Produzir/Consumir uma fila (SQS)
=====
Dentro do Worker 
Gerar um .pdf (lib?)
Gerar um PDF do Pokemano (pelo SQS)
=====
DataDog?
=====



https://pokeapi.co/api/v2/pokemon/1/


First:
```bash
docker-compose up --build -d
```

Just up
```bash

```

```bash
docker exec -it ccb2ac8a5aaa sh
```


```bash
docker-compose --env-file .env up --build
```


```bash
docker exec -it app bash
```

## Testes:
```bash
docker exec -it app ./vendor/bin/phpunit
```

```
php composer.phar --no-dev --prefer-dist install 
php artisan key:generate  
```
