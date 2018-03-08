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

_Raw query of the solution:_
```
SELECT
  b.driver_id,
  COUNT(*) filter (WHERE state = 'COMPLETED') AS number_of_completed_rides,
  COUNT(*) filter (WHERE state <> 'COMPLETED') AS number_of_cancelled_rides,
  COUNT(distinct passenger_id) filter (WHERE state = 'COMPLETED') AS number_of_unique_passengers,
  SUM(fare) filter (WHERE state = 'COMPLETED') AS total_fare,
  ROUND(SUM(fare) filter (WHERE state = 'COMPLETED') * 0.2, 2) AS total_commission,
FROM
  bookings b JOIN drivers d ON b.driver_id = d.driver_id
WHERE
  d.email SIMILAR TO '%fv(drive|taxi)%',
GROUP BY b.driver_id
HAVING
  COUNT(*) filter (WHERE state = 'COMPLETED') > 10 AND
  COUNT(distinct passenger_id) filter (WHERE state = 'COMPLETED') < 5
ORDER BY b.driver_id
```

### Q3
- Implementation please see the function _`transformAddress()`_ in `app/Http/Controllers/API/DHLAddressController.php`
- Unit test please see `tests/Feature/DHLAddressTest.php`.
