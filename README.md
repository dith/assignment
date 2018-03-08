# assignment
#### Requirements:
 * PHP >= 7.1.3
 * OpenSSL PHP Extension
 * PDO PHP Extension
 * Mbstring PHP Extension
 * Tokenizer PHP Extension
 * XML PHP Extension
 * Ctype PHP Extension
 * JSON PHP Extension
 * Postgresql >= 9.4.15
 
#### Setup:
 1. `$ git clone git@github.com:dith/assignment.git `_`<target_folder>`_
 1. `$ cd `_`<target_folder>`_
 1. `$ composer install`
 1. `$ php artisan key:generate`
 1. `$ cp .env.example .env`, then configure _`.env`_ as necessary, i.e. set `DB_CONNECTION=pgsql`,`DB_PORT` etc accordingly.
 1. `$ php artisan migrate`
 1. run the tests: `$ phpunit`

### Q1
- Implementation please see the function _`getDetailsOnly()`_ in `app/Misc/AssignmentQ1.php`.
- Unit test please see `tests/Unit/AssignmentQ1Test.php`.

### Q2
- Implementation please see the function _`extractBookingData()`_ in `app/Misc/AssignmentQ2.php`.
- Unit test please see `tests/Unit/AssignmentQ2Test.php`.
