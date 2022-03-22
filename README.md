
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


## Install:

### Copy file `.env.example` to `.env`
```bash
cp .env.example .env
```

### Setting App && DB:
```bash
docker-compose up --build -d
```

### Setting App && DB:
```bash
docker exec -it app php artisan migrate:fresh --seed
```

### Composer install
```bash
docker exec -it app composer install
```


```bash
docker exec -it app php artisan queue:work --queue=high,default
```



## Just up
```bash
docker-compose up --force-recreate -d
```

## Utils:

### Enter in container:
```bash
docker exec -it app bash
```

### URLs:
| Env   | Url                         |   
|-------|-----------------------------|
| Local | http://localhost:8080/health |
| QA    | -                           |







## Execute tests:
```bash
docker exec -it app ./vendor/bin/phpunit
```

## Deploy ?

### Scripts:
```
php composer.phar --no-dev --prefer-dist install 
php artisan key:generate  
```
