# Currency Service

Для запуска миграций: 
`vendor/bin/phinx migrate`

Для заполнения базы данными: 
`vendor/bin/phinx seed:run`

Пользователь:
`username: express`
`password: password`

Авторизация необязательна, прото нужно указать bearer авторизационный токен в заголовках: по умолчанию `123`.

- GET /currencies — возвращает список курсов валют с возможность пагинации
- GET /currency/ — возвращает курс валюты для переданного id

Для обновления курса валют на базе: 

`php console/app.php currency:update`
