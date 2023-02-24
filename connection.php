<?php

$bdServidor='127.0.0.1';
$bdUsuario='root';
$bdSenha='';
$bdBanco='kanban';

// Estabelece a conexão com o Banco de Dados
$conn = mysqli_connect($bdServidor, $bdUsuario, $bdSenha, $bdBanco);

if (mysqli_connect_errno()) {
        echo "Problemas para conectar no banco. Verifique os dados!";
        die();
        }

/*
if ( $conn->connect_errno ) {
        error_log('Problemas para conectar ao banco: ' . $conn->connect_errno);
    }
*/ 