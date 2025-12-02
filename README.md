```bash
git clone https://github.com/mapsz/password-generator-test
cd password-generator-test
```

```bash
docker-compose up -d
```

```bash
docker-compose exec php bash
```

```bash
composer install
```

```bash
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate --no-interaction
```

```
http://localhost:8080
```