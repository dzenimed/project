<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require dirname(__FILE__).'/../vendor/autoload.php';
require dirname(__FILE__).'/dao/AccountDao.class.php';

Flight::route('/', function(){
    echo 'hello world!';
});

Flight::route('/hello2', function(){
    echo 'hello world2!';
});

Flight::route('/accounts', function(){
    $dao= new AccountDao();
    $accounts=$dao->get_all(0, 10);
    Flight::json($accounts);
});

Flight::start();

?>
