<?php
session_start();

function cabecalhoChecagem()
{
    $name = $_SESSION["name"];
    

    // Se não houver usuário, volta-se a página de login com o método "header"
    if(!isset($name))
    {
    session_destroy();
    header('location:index.php');
    }
}
