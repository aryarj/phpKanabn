<?php
    function listarEstagio($tarefas2, $user2, $status)
    {
        foreach($tarefas2 as $t)
        {
            $task='';
            $idUser = '';
            
            if($t['status']==$status)
            {
                $task = $t['task'];
                $idUser = $t['id_user'];
                foreach($user2 as $u)
                {
                    $nameUser = '';
                    if($u['id']==$idUser)
                    {
                        $nameUser = $u['name'];
                        echo '<div id="'.$t['id'].'" class="decor_in"
                        ondragstart="drag(event)" draggable="true">'.$task.' - '.$nameUser.' </div>';

                    }
                }
            } 
        }
    }