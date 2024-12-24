<?php

class HomeController
{
    public function index()
    {
        header("Location: ../view/home/homepage.php");
    }
}
