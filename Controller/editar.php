<?php
require_once 'connection.php';
require_once '../Model/checagem.php';
require_once '../Model/NovaTarefa.php';

$name = $_SESSION["name"];
$idUser = $_SESSION["id"];
echo "Nome do usuário: ";
echo $name.'<br><br>';

cabecalhoChecagem();

// Deixando a entrada "tarefa"
    //com uma informação qualquer, para não gerar erro
    $dados= array(
        'tarefa'=>'',
        );

        //Caso haja um erro
        $erros_validacao=array();

    $tarefa = new NovaTarefa;

    //contador de itens
        $contador=0;

    if (isset($_POST['tarefa']) && $_POST['tarefa'] !='')
    {
        $dados = array();

        $tarefa->setTarefa($_POST['tarefa']);
        $tarefaGet=$tarefa->getTarefa();
        if (isset($tarefaGet))
        {
            $dados['tarefa']=$tarefaGet;
            $contador+=1;
        }
        else
        {
            $erros_validacao['tarefa']='A tarefa está em branco';
        }

        $transporte[]=$dados;
    }

    $task=$dados['tarefa'];

    $id=$_GET['id'];

    $tarefa="SELECT * FROM tasks WHERE Id=$id";
    $tarefa2=mysqli_query($conn,$tarefa);
    $tarefa3 = mysqli_fetch_assoc($tarefa2);

?>
    
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Editar a tarefa</title>
  </head>
  <body>
    <h3 style="padding: 10px;">Edição da tarefa</h3>


    <form method='POST' style="padding: 10px;"><font size="5">
            <label>
            Editar a tarefa aqui, máximo de 100 caracteres:
                <input type="text" required name="tarefa" size="50px" maxlength="100" value="<?php echo $tarefa3['task']; ?>"/>
            </label>

            <button class="btn btn-outline-success" type="submit">Editar</button>
            <a class="btn btn-outline-dark" href="listarTarefa.php" role="button">Voltar</a>
    </form>

    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
  
<?php
        
        if($contador==1)
        {
            $sqlEdit="UPDATE tasks SET task='$task' WHERE id='$id'";

            if(mysqli_query($conn, $sqlEdit))
            {
              echo "<script language='javascript' type='text/javascript'>
              alert('Registro atualizado com sucesso!');
              location.href='listarTarefa.php';
              </script>";
            }else
            {
                echo "Error: " . $sqlEdit . "<br>" . mysqli_error($conn);
            }
            mysqli_close($conn);
        }


