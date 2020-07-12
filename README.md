# DemoApp

>  Przykładowa aplikacja oparta na frameworku Laravel



## Instalacja

Pobierz i rozpakuj plik DemoApp.rar, wejdź do rozpakowanego katalogu.

Zainstaluj wszystkie zależności z użyciem Composera

    composer install

Skopiuj plik **.env.example**, nazwij **.env** i uzupełnij konfigurację. Szczególną uwagę zwróć na pola dotyczące bazy danych i mailera, są one wymagane do poprawnego działania aplikacji.

    cp .env.example .env

Wygeneruj unikatowy klucz aplikacji

    php artisan key:generate


Uruchom migracje (**Utwórz połączenie z bazą danych w pliku .env przed wykonaniem migracji**)

    php artisan migrate

Uruchom lokalny, roboczy serwer dla aplikacji

    php artisan serve

Strona jest już dostępna pod adresem http://localhost:8000

**TL;DR lista komend**

    composer install
    cp .env.example .env
    php artisan key:generate


## Generowanie przykładowych danych

**Możesz uzupełnić bazę danych losowymi użytkownikami i danymi za pomocą seederów**

    php artisan db:seed

Przykładowy użytkownik który zostanie wygenerowany to Admin. Aby zalogować się na jego konta użyj loginu: **admin@admin.com** i hasła **Admin12!@**.


