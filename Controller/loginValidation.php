<?php
session_start();
require_once 'connection.php';
require_once '../Model/LoginModel.php';

$validacao = new LoginModel;

$validacao->setEmail('');
$validacao->setEmail($_POST['email']);
$validacao->setPassword($_POST['password']);
$email=$validacao->getEmail();
$password=$validacao->getPassword();

// Verificando se o login e a password digitados correspondem aos armazenados
//$logar = mysqli_query($conexao, "SELECT * FROM usuario WHERE login = '$login' AND password = '$password'") or die("Erro ao selecionar!");
$logar = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email' AND password = '$password'") or die("Erro ao selecionar!");
$logar2=$logar->fetch_array();
if(mysqli_num_rows($logar)>0){
    $_SESSION["name"] = $logar2['name'];
    $_SESSION["id"]=$logar2['id'];
    
    echo ("<script>location.href='../task_reports.php';</script>");
} else {
    echo ("<script>alert('email ou senha inválido!');</script>");
    echo ("<script>location.href='../index.php';</script>");
}

mysqli_close($conection);

?> 