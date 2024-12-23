<?php


function start()
{
    $class = $_GET['classe'] ?? 'Home';
    $method = $_GET['metodo'] ?? 'index';
    $id = $_GET['id'] ?? null;

    $class = $class . 'Controller';

    include_once __DIR__ . '/controller/' . $class . ".php";

    $controller = new $class();

    if ($id) {
        $controller->$method($id);
        return;
    }

    $controller->$method();
}

start();

// http://localhost:3000
// http://localhost:3000/index.php?classe=Client&metodo=index
// http://localhost:3000/index.php?classe=Client&metodo=create
// http://localhost:3000/index.php?classe=Client&metodo=store
// http://localhost:3000/index.php?classe=Client&metodo=edit&id=1
