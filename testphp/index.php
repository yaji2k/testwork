<?php
define('WWW', __DIR__);
include WWW . '/libs/functions.php';
use controllers\Controller;

spl_autoload_register(function ($class) {
    $file = WWW . '/' . str_replace('\\', '/', $class) . '.php';
    //$file = APP . "/controllers/$class.php";
    if(is_file($file)) {
    require_once $file;
    }
});

$page = new Controller();

$page->indexAction();   

/** Запуск метода migrateTable() приводит к созданию таблицы(если еще не создана) 
 * и заполнению таблицы данными. */
//$page->migrateTable();

