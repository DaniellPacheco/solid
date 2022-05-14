<?php

class Funcionario {
    private string $nome;
    private string $matricula;
    private float $salarioBruto;

    public function __construct(string $nome, string $matricula, float $salarioBruto)
    {
        $this->name = $nome;
        $this->matricula = $matricula;
        $this->salarioBruto = $salarioBruto;
    }

    /**
     * Get the value of nome
     */ 
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Get the value of matricula
     */ 
    public function getMatricula()
    {
        return $this->matricula;
    }

    /**
     * Get the value of salarioBruto
     */ 
    public function getSalarioBruto()
    {
        return $this->salarioBruto;
    }
}

class CalculadoraSalario {
    private Funcionario $funcionario;

    function __construct(Funcionario $funcionario)
    {
        $this->funcionario = $funcionario;
    }

    public function calcularINSS(): float
    {
        $inss = 0;
        $salarioBruto = $this->funcionario->getSalarioBruto();

        switch (true) {
            case ($salarioBruto <= 1751.82):
                $inss = 8;
                break;
            case ($salarioBruto >= 1751.82 && $salarioBruto <= 2919.72):
                $inss = 9;
                break;
            default:
                $inss = 11;
                break;
        }

        return round(($inss/100)*$salarioBruto, 2);
    }
    
        
}

$f1 = new Funcionario('Joao', '123', 3000.00);
$c1 = new CalculadoraSalario($f1);
echo $c1->calcularINSS();