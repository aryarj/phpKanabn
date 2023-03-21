<?php
    require_once '../Controller/connection.php';
    require_once '../Model/checagem.php';
    require_once '../Model/NovaTarefa.php';
    require_once '../Model/listar.php';
    require_once '../Model/VerStage.php';
    cabecalhoChecagem();

    $name = $_SESSION["name"];
    $idUser = $_SESSION["id"];
    echo "Nome do usuário: ";
    echo $name.'<br><br>';

    // Deixando as entradas "e1, e2 e e3"
    //com uma informação qualquer, para não gerar erro
   $stage= array(
        'e1'=>'',
        'e2'=>'',
        'e3'=>'',
        );
    
    $s = new VerStage;

    if(isset($_GET['e1']) && $_GET['e1']!='')
    {
        $s -> setStage1($_GET['e1']);
        $stage['e1'] = $s ->getStage1();
    }
    if(isset($_GET['e2']) && $_GET['e2']!='')
    {
        $s -> setStage2($_GET['e2']);
        $stage['e2'] = $s ->getStage2();
    }
    if(isset($_GET['e3']) && $_GET['e3']!='')
    {
        $s -> setStage3($_GET['e3']);
        $stage['e3'] = $s ->getStage3();
    }

    //consultando o banco de dados
    //Selecionando os usuários
    $user = "SELECT * FROM users WHERE name <>'admin'";
    $user2 = mysqli_query($conn,$user);

    //Selecionando as tarefas
    if($name=='admin')
    {
        $tarefas = "SELECT * FROM tasks";
    }
    else
    {
        $tarefas = "SELECT * FROM tasks WHERE id_user=$idUser";
    }
    
    $tarefas2 = mysqli_query($conn,$tarefas);
        
    $tarefas3[] = '';
    $tarefaStatus[] = '';

?>
<!DOCTYPE html>
<html lang="pt=br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/format.css">
    <title>Kanban</title>
</head>
<body>

<!--Colocando os quadros dentro de uma tabela, para que eles não fiquem "dançando" na página-->
<table>
    <tr>
        <td>
            <div id="tasks_in" class="decor" ondrop="drop_in(event)" ondragover="allowDrop(event)">
            <h4>Não iniciado</h4> 
                <?php
                       if($stage["e1"]!=1)
                       {
                            listarEstagio($tarefas2, $user2,1);
                       }
                       else
                       {
                            echo "<h2>Ocultado</h2>";
                       }

                   
                ?>
            </div>
        </td>
               
        <td>
            <div id="tasks_middle" class="decor separation_left" ondrop="drop_middle(event)" ondragover="allowDrop(event)">
            <h4>Em progresso</h4>
                    <?php
                        if($stage["e2"]!=1)
                        {
                            listarEstagio($tarefas2, $user2,2);
                        }
                        else
                        {
                             echo "<h2>Ocultado</h2>";
                        }
                    
                    ?>
            </div>
        </td>
                
        <td>
            <div id="tasks_out" class="decor separation_left"
                 ondrop="drop_out(event)" ondragover="allowDrop(event)">
            <h4>Completo</h4>
                <?php
                        if($stage["e3"]!=1)
                        {
                            listarEstagio($tarefas2, $user2,3);
                        }
                        else
                        {
                             echo "<h2>Ocultado</h2>";
                        }

                ?>
            </div>
        </td>
    </tr>
</table>

<?php if($name!='admin'):?>
    <div style="clear:both; height: 20px"></div>
    <button class="btn" onclick="setReportsToTask();">SALVAR AS ALTERAÇÕES DE MOVIMENTAÇÃO DAS TAREFAS</button>
<?php endif; ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>-->

<script type="text/javascript"> 
    function drag(ev) {
      ev.dataTransfer.setData("text", ev.target.id);
    }

    function drop_in(ev) {
      ev.preventDefault();
      var data = ev.dataTransfer.getData("text");
      document.getElementById("tasks_in").appendChild(document.getElementById(data));
    }

    function drop_middle(ev) {
      ev.preventDefault();
      var data = ev.dataTransfer.getData("text");
      document.getElementById("tasks_middle").appendChild(document.getElementById(data));
    }

    function drop_out(ev) {
      ev.preventDefault();
      var data = ev.dataTransfer.getData("text");
      document.getElementById("tasks_out").appendChild(document.getElementById(data));
    }

    function allowDrop(ev) {
      ev.preventDefault();
    }

//Atualização Banco de dados, recolhendo as tarefas nas divs
    function setReportsToTask()
    {
        var lista1 = [];
        var lista2 = [];
        var lista3 = [];
        
        $("#tasks_in").find("div").each(function()
        {
            lista1.push(this.id);
        });

        $("#tasks_middle").find("div").each(function()
        {
            lista2.push(this.id);
        });

        $("#tasks_out").find("div").each(function()
        {
            lista3.push(this.id);
        });

        $.post("../Model/updateBD.php",
            {
            idTask1: lista1,
            idStatus1: 1,
            idTask2: lista2,
            idStatus2: 2,
            idTask3: lista3,
            idStatus3: 3,
            },

            function(data)
                {
                    if(data != 1)
                    {
                        alert('successo');
                    }
                    else
                    {
                        alert('Error:' + data);
                    }
                });
        
    }

</script>
<br><br>

<div style="clear:both; height: 20px"></div>

</body>
</html>
