<?php
require_once 'connection.php';

//Colocando o valor do "id" da tabela em uma variável
session_start();
$idUser=$_SESSION["id"];

//consultando o banco de dados
$tarefas = "SELECT task FROM tasks WHERE id_user=$idUser";
$tarefas2 = mysqli_query($conn,$tarefas);

//Verificando se há algum resultado
if(($tarefas2) AND ($tarefas2->num_rows!=0))
{
    while($tarefas3 = mysqli_fetch_assoc($tarefas2))
    {
        echo $tarefas3['task']."<br>";
    }
}
