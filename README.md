Installation
============

After cloning the repository

```shell
$ cd <my_directory>
$ composer install
```

to run the script :

```shell
$ php ./script.php
$ # or
$ php ./iterator.php
```

to run the tests :

```shell
$ ./vendor/bin/phpunit --testdox # or using windows : .\vendor\bin\phpunit --testdox
$ # if you want to have the coverage
$ # you either need :
$ #  * pcov
$ #  * xdebug
$ # then
$ ./vendor/bin/phpunit --coverage-html ./coverage --testdox
```
