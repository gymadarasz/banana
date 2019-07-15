# BANANA TEST

install:

clone or download this repository and run:

```
$ composer install
```

phpunit tests also added:
```
$ ./vendor/bin/phpunit --bootstrap vendor/autoload.php tests/
```

import postman collection from:
```
postman/Banana.postman_collection.json
```

Or call from browser:
```
http://localhost/banana/index.php?stops=[%20{%20%22from%22:%20%22Adolfo%20Su%C3%A1rez%20Madrid%E2%80%93Barajas%20Airport,%20Spain%22,%20%22to%22:%20%22London%20Heathrow,%20UK%22%20},%20{%20%22from%22:%20%22Fazenda%20S%C3%A3o%20Francisco%20Citros,%20Brazil%22,%20%22to%22:%20%22S%C3%A3o%20Paulo%E2%80%93Guarulhos%20International%20Airport,%20Brazil%22%20},%20{%20%22from%22:%20%22London%20Heathrow,%20UK%22,%20%22to%22:%20%22Loft%20Digital,%20London,%20UK%22%20},%20{%20%22from%22:%20%22Porto%20International%20Airport,%20Portugal%22,%20%22to%22:%20%22Adolfo%20Su%C3%A1rez%20Madrid%E2%80%93Barajas%20Airport,%20Spain%22%20},%20{%20%22from%22:%20%22S%C3%A3o%20Paulo%E2%80%93Guarulhos%20International%20Airport,%20Brazil%22,%20%22to%22:%20%22Porto%20International%20Airport,%20Portugal%22%20}%20]
```