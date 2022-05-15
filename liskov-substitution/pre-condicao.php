<?php

// O princípio de Liskov diz que nós não devemos reforçar pré-condições

// Exemplo - Reforçar condição diminuindo o range de atuação (irá ocorrer erro)

class CalculadoraPrazo {
    
    public function data(int $dias): DateTimeInterface
    {
        if($dias > 0)
            return (new DateTime())->modify("+$dias days");
        
        throw new \InvalidArgumentException("Prazo precisa ser maior que zero");
    }

}

class CalculadoraPrazoCLT extends CalculadoraPrazo
{

    public function data(int $dias): \DateTimeInterface
    {
        if($dias >= 0)
            return (new DateTime())->modify("+ $dias days");

        throw new InvalidArgumentException("Prazo precisa ser maior ou igual a zero");
    }
}

class CalculadoraPrazoCPC extends CalculadoraPrazo
{
    public function data(int $dias): DateTimeInterface
    {
        if(in_array($dias, range(1,30))){
            return (new DateTime())->modify("+ $dias days");
        }

        throw new InvalidArgumentException("Prazo precisa ser entre 1 a 30");
    }   
}

// Válido
$dias = 31;
$calculadora = new CalculadoraPrazo();
echo $calculadora->data($dias)->format('d/m/Y') . PHP_EOL;

// Válido
$calculadora = new CalculadoraPrazoCLT();
echo $calculadora->data($dias)->format('d/m/Y') . PHP_EOL;

// Inválido
$calculadora = new CalculadoraPrazoCPC();
echo $calculadora->data($dias)->format('d/m/Y') . PHP_EOL;  