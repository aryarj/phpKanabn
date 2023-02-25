<?php
    require_once 'connection.php';
    require_once '../Model/checagem.php';
    require_once '../Model/NovaTarefa.php';
    cabecalhoChecagem();

    $name = $_SESSION["name"];
    $idUser = $_SESSION["id"];
    echo "Nome do usuário: ";
    echo $name.'<br><br>';
    $id = $_GET['id'];
?>
<html>
    <head>
       <meta charset="utf-8"/>
          
    </head>
    <body>
        <h2 align="center"><b>Você tem certeza que deseja apagar essa tarefa?</b></h2>
        
    </body>
</html>
    
<?php
//consultando o banco de dados
$tarefas = "SELECT * FROM tasks WHERE id=$id";
$tarefas2 = mysqli_query($conn,$tarefas) or die(mysqli_error($conn));;

//Verificando se há algum resultado
if(($tarefas2) AND ($tarefas2->num_rows!=0))
{
    
    echo "<table align=center border='1'>";
        echo '<tr align=center>';
        echo '<th>Tarefa</th>';
        echo '</tr>';
        
        while($tarefas3 = mysqli_fetch_assoc($tarefas2))
        {
            $id=$tarefas3['id'];
            echo '<tr align=center>';
            echo '<td>'.$tarefas3['task'].'</td>';
            echo '<td><a align="center" href="listarTarefa.php">Não</a></td>';
            echo '<td><a align="center" href="apagar.php?id='.$id.'">Sim</a></td>';
            echo '</tr>';
        }
    echo "</table>";
    mysqli_close($conn);
}