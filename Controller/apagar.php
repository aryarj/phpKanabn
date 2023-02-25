<?php
    require_once 'connection.php';
    
    $id = $_GET['id'];
     

     // marcando um registro para ser apagado/ocultado
    $sql = "DELETE FROM tasks WHERE id=$id";
    if(mysqli_query($conn,$sql)){
        echo "<script language='javascript' type='text/javascript'>
        alert('Registro apagado com sucesso!');
        window.location.href='listarTarefa.php';
        </script>";
    }else{
        echo "<script language='javascript' type='text/javascript'>
        alert('Registro não apagado!');
        window.location.href='listarTarefa.php';
        </script>";
    }
    mysqli_close($conexao);