<?php
    require_once './Controller/connection.php';
    require_once 'Model/checagem.php';
    require_once './Model/NovaTarefa.php';
    cabecalhoChecagem();

    $name = $_SESSION["name"];
    $idUser = $_SESSION["id"];
    echo "Nome do usuário: ";
    echo $name.'<br><br>';

    //consultando o banco de dados
    //Selecionando os usuários
    $user = "SELECT * FROM users WHERE name<>'admin'";
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

    //Verificando se há algum resultado
   /* if(($tarefas2) AND ($tarefas2->num_rows!=0))
    {
        while($tarefas3 = mysqli_fetch_assoc($tarefas2))
        {
            echo $tarefas3['task']."<br>";
        }
    }*/
?>

<br><br>

<div id="tasks_in" style="width: 400px; height: flex; padding: 20px; float:left; overflow-y:auto; 
    border: 1px solid #ccc; border-radius: 5px" ondrop="drop_in(event)" ondragover="allowDrop(event)">
<h4>Não iniciado</h4>
    <?php
        foreach($tarefas2 as $t)
        {
            $task='';
            $idUser = '';
            
            if($t['status']==1)
            {
                $task = $t['task'];
                $idUser = $t['id_user'];
                foreach($user2 as $u)
                {
                    $nameUser = '';
                    if($u['id']==$idUser)
                    //if($u['id'])
                    {
                        $nameUser = $u['name'];
                        echo '<div id="'.$t['id_user'].'" style="padding: 20px;border:1px solid #ccc; margin:10px 0"
                        ondragstart="drag(event)" draggable="true">'.$task.' - '.$nameUser.' </div>';

                    }
                }
            } 
        }
    ?>
</div>

<div id="tasks_middle" style="width: 400px; height: flex; padding: 20px; float:left; margin-left: 10px; overflow-y:auto;
     border: 1px solid #ccc; border-radius: 5px;" ondrop="drop_middle(event)" ondragover="allowDrop(event)">
<h4>Em progresso</h4>
        <?php
        foreach($tarefas2 as $t)
        {
            $task='';
            $idUser = '';
            if($t['status']==2)
            {
                $task = $t['task'];
                $idUser = $t['id_user'];
                foreach($user2 as $u)
                {
                    $nameUser = '';
                    if($u['id']==$idUser)
                    {
                        $nameUser = $u['name'];
                        echo '<div id="'.$t['id_user'].'" style="padding: 20px;border:1px solid #ccc; margin:10px 0"
                        ondragstart="drag(event)" draggable="true">'.$task.' - '.$nameUser.' </div>';

                    }
                }
            } 
        }
        ?>
</div>

<div id="tasks_out" style="width: 400px; height: flex; padding: 20px; float:left; margin-left: 10px; overflow-y:auto; 
    border: 1px solid #ccc; border-radius: 5px" ondrop="drop_out(event)" ondragover="allowDrop(event)">
<h4>Completo</h4>
    <?php
        foreach($tarefas2 as $t)
        {
            $task='';
            $idUser = '';
            if($t['status']==3)
            {
                $task = $t['task'];
                $idUser = $t['id_user'];
                foreach($user2 as $u)
                {
                    $nameUser = '';
                    if($u['id']==$idUser)
                    {
                        $nameUser = $u['name'];
                        echo '<div id="'.$t['id_user'].'" style="padding: 20px;border:1px solid #ccc; margin:10px 0"
                        ondragstart="drag(event)" draggable="true">'.$task.' - '.$nameUser.' </div>';

                    }
                }
            } 
        }
    ?>
</div>


    <!--<div style="clear:both; height: 20px"></div>
    <button class="btn" onclick="setReportsToTask();">SAVE</button>-->

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
    /*function setReportsToTask()
    {
        var lista = []
        $("#tasks_middle").find("div").each(function()
        {
            lista.push(this.id);
        });
        $.post("prepareTaskToBD.php",{task:"<?php echo $_GET["id"];?>",
            reports:lista},function(data)
            {
                if(data == 1)
                {
                    alert('success');
                }
                else
                {
                    alert('Error:' + data);
                }
            });
        
    }*/

</script>


<div style="clear:both; height: 20px"></div>
<?php
    // Deixando a entrada "tarefa"
    //com uma informação qualquer, para não gerar erro
    $dados= array(
        'tarefa'=>'',
        );

        //Caso haja um erro
        $erros_validacao=array();

    $tarefa = new NovaTarefa;

    // variáveis de confirmação se todos os requisitos foram preenchidos
        $confTarefa=false;
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
            $confTarefa=true;
            $contador+=1;
        }
        else
        {
            $erros_validacao['tarefa']='A tarefa está em branco';
        }

        $transporte[]=$dados;
    }

    $lista_dados[]=array();

    if(isset($transporte)){
        $lista_dados=$transporte;
    }else{
        $lista_dados=array();
    }

    //tarefa e se há essa informação
    if($confTarefa)
    {
        $paraFazer=$dados['tarefa'];
    }else
    {
        $paraFazer ='sem informação';
    }
?>
    <?php if($name!='admin'):?>
        <form method='POST'><font size="5">
            <label>
            Incluir nova tarefa
                <input type="text" required name="tarefa" placeholder="Digitar aqui"/>
            </label>
            <?php if(isset($erros_validacao['tarefa'])):?>
                        <span class="erro" >
            <?php echo $erros_validacao['tarefa'];?>
                        </span>
            <?php endif;?>
            <button type="submit">Enviar</button>
        </form>
    <?php endif; ?>
<?php
    if($contador==1)
    {
        // Publicando a tarefa
        $id_user = $_SESSION["id"];
         //echo ("<script>location.href='#';</script>");
         $sqlGravar="INSERT INTO tasks(task, status, id_user) VALUES ('$paraFazer',1,'$id_user')";     

         if(mysqli_query($conn,$sqlGravar)){
            echo "<script language='javascript' type='text/javascript'>
            alert('Registro incluído com sucesso!');
            window.location.href='task_reports.php';
            </script>";
        }else{
            echo "<script language='javascript' type='text/javascript'>
            alert('Registro não incluído!');
            window.location.href='task_reports.php';
            </script>";
        }
        mysqli_close($conn);
    }
    

    
?>
    <br><br>
    <?php if($name!='admin'):?>
        <div style = "clear:both; height: 5px;"></div>
        <a href ="Controller/listarTarefa.php" class="button">Apagar tarefas</a>
    <?php endif; ?>
    <br><br>
    <div style = "clear:both; height: 5px;"></div>
    <a href ="Controller/sair.php" class="button">Sair</a>
    


