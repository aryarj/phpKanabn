<?php
    require_once 'connection.php';
    require_once '../Model/checagem.php';
    require_once '../Model/NovaTarefa.php';
    cabecalhoChecagem();

    $name = $_SESSION["name"];
    $idUser = $_SESSION["id"];
    echo "Nome do usuário: ";
    echo $name.'<br><br>';
    

//consultando o banco de dados
$tarefas = "SELECT * FROM tasks WHERE id_user=$idUser";
$tarefas2 = mysqli_query($conn,$tarefas);

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
            echo '<td><a href="apagarPergunta.php?id='.$id.'">Apagar</a></td>';
            echo '<td><a href="#">Editar</a></td>';
            echo '</tr>';
        }
    echo "</table>";
    mysqli_close($conn);
}
?>
<br><br>
<a href ='../task_reports2.php' class="button">Voltar</a>
