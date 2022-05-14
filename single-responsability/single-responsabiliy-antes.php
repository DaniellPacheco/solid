<?php

// Exemplo sem SOLID

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

    public function calcularINSS(): float
    {
        $inss = 0;
        switch (true) {
            case ($this->salarioBruto <= 1751.82):
                $inss = 8;
                break;
            case ($this->salarioBruto >= 1751.82 && $this->salarioBruto <= 2919.72):
                $inss = 9;
                break;
            default:
                $inss = 11;
                break;
        }

        return round(($inss/100)*$this->salarioBruto, 2);
    }
}

$f1 = new Funcionario('Jose', '123', 3000.00);
echo $f1->calcularINSS();