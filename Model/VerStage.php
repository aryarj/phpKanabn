<?php 

class VerStage
{
    //Atributos
    private $stage1;
    private $stage2;
    private $stage3;
        
    //Métodos
    // Nenhum método nesse caso
    

    //Getters
    function getStage1()
    {
        return $this->stage1;
    }
    
    function getStage2()
    {
        return $this->stage2;
    }

    function getStage3()
    {
        return $this->stage3;
    }
    //Setters
    function setStage1($stage1)
    {
        $this->stage1=$stage1;
    }

    function setStage2($stage2)
    {
        $this->stage2=$stage2;
    }

    function setStage3($stage3)
    {
        $this->stage3=$stage3;
    }
}
