<?php
    require_once 'connection.php';

    //consultando o banco de dados
    //Selecionando os usuários
    $user = "SELECT * FROM users";
    $user2 = mysqli_query($conn,$user);

    //Selecionando as tarefas
    //$tarefas = "SELECT task FROM tasks WHERE id_user=$idUser";
    $tarefas = "SELECT * FROM tasks";
    $tarefas2 = mysqli_query($conn,$tarefas);
    /*$tarefas3[] = '';

    //Verificando se há algum resultado
    if(($tarefas2) AND ($tarefas2->num_rows!=0))
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
                    $name = '';
                    if($u['id']==$idUser)
                    {
                        $name = $u['name'];
                        echo '<div id="'.$t['id_user'].'" style="padding: 20px;border:1px solid #ccc; margin:10px 0"
                        ondragstart="drag(event)" draggable="true">'.$task.' - '.$name.' </div>';

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
                    $name = '';
                    if($u['id']==$idUser)
                    {
                        $name = $u['name'];
                        echo '<div id="'.$t['id_user'].'" style="padding: 20px;border:1px solid #ccc; margin:10px 0"
                        ondragstart="drag(event)" draggable="true">'.$task.' - '.$name.' </div>';

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
                    $name = '';
                    if($u['id']==$idUser)
                    {
                        $name = $u['name'];
                        echo '<div id="'.$t['id_user'].'" style="padding: 20px;border:1px solid #ccc; margin:10px 0"
                        ondragstart="drag(event)" draggable="true">'.$task.' - '.$name.' </div>';

                    }
                }
            } 
        }
    ?>
</div>

    <div style="clear:both; height: 20px"></div>
    <button class="btn" onclick="setReportsToTask();">SAVE</button>
    
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
        
    }
    

</script>