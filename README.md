# IIUC VIRTUAL QUIZ

#### To install it you have to follow regarding commands (windows).

> install any local server i.e (xampp / laragon)

> Php version has to ^7.2

> install composer.

> git clone `https://github.com/AbirShanto007/IIUC_Virtual_Exam`

> cp .env.example .env

> cd to project and run `composer update`

> php artsian key:generate

> php artisan config:cache

> php artisan migrate

> php artisan serve

## For Student Panel

> url("/");
## For teacher Panel

> url("/teacher_login");
## For admin Panel

> url("/admin_login");
