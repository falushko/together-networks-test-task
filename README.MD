# Together Networks Test Task


На PHP 7 применяя знания SOLID и паттернов необходимо: 
Реализовать возможность импорта пользователей из csv файла в базу данных. 
- Csv файл должен быть размером от 40mb. 
- Csv файл может содержать в себе часть не валидных данных. 
- Импорт большого числа пользователей в базу не должен повлиять на общую производительность работы. 
- Необходимо покрыть юнит тестами код на 100%. Реализовать возможность поиска импортированных пользователей по ФИО или email. 
- Результат поиска должен быть кешированный. Выложить исходники на github - отправить линк для проверки. 
- Использования фреймворков не допускается. Поля для импорта: ID Пользователя ФИО Пользователя Email Валюта Сумма

## How to use

To check this task run migration to create users table (database `test_task` should be 
created before):
```
php executors/migrate.php
```
Then run import:
```
php executors/import.php
```
Now you can make a search by email or name:
```
php executors/search.php "Cora Rios"
php executors/search.php "dipu@tanfoh.gl" 
```
First search will perform upon a database, then redis cache will be used.
Requires php, mysql, redis to be installed (didn't have time to put it under docker-compose).
