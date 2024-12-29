<?php

function start()
{
    $class = $_GET['classe'] ?? 'Home';
    $method = $_GET['metodo'] ?? 'index';
    $id = $_GET['id'] ?? null;

    $class = ucfirst($class) . 'Controller';

    $file = __DIR__ . '/controller/' . $class . '.php';

    try {
        if (!file_exists($file)) {
            throw new Exception("Controlador '$class' não encontrado.");
        }

        include_once $file;

        if (!class_exists($class)) {
            throw new Exception("Classe '$class' não encontrada.");
        }

        $controller = new $class();

        if (!method_exists($controller, $method)) {
            throw new Exception("Método '$method' não encontrado na classe '$class'.");
        }

        if ($id) {
            $controller->$method($id);
            return;
        }

        $controller->$method();
    } catch (Exception $e) {
        echo 'Erro: ' . $e->getMessage();
    }
}

start();
