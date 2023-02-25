<?php

class LoginModel
{
    //Atributos
    private $email;
    private $password;
    
    //Métodos
    // Nenhum método nesse caso
    

    //Getters
    function getEmail()
    {
        return $this->email;
    }
    function getPassword()
    {
        return $this->password;
    }


    //Setters
    function setEmail($email)
    {
        $this->email=$email;
    }
    function setPassword($password)
    {
        $this->password=$password;
    }
}