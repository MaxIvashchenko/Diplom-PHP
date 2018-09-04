## Инструкции по установке и первому запуску

http://mydiplom.info/ - основная страница

http://mydiplom.info/admin - страница админа


1. Установить git в нужную директорию, затем клонировать репозиторий 
   (git clone https://github.com/MaxIvashchenko/Diplom-PHP.git)
2. Установить composer (composer install)
3. Создать файл .env и скопировать данные с файл .env.exmaple и заполнить логин, пароль и имя базы данных.
4. Сформировать ключ (php artisan key:generate)
5. Произвести миграцию в базы данных (php artisan migrate)

## Панель администратора
Для входа в меню администратора требуется добавить /admin
- Имя: admin
- E-mail: admin@admin.com
- Пароль: admin

## Схема таблиц БД
https://drive.google.com/open?id=18G5R6S9VIZXVUSy_NIzFV2J1Q2Oj7zAh
