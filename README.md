```bash
git clone <repository-url>
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
# Создание базы данных
php bin/console doctrine:database:create

# Выполнение миграций
php bin/console doctrine:migrations:migrate --no-interaction
```

```
http://localhost:8080
```