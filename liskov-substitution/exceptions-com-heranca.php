<?php

// Exemplo do Príncipio da Substituição de Liskob com Execptions

class ComidaBaixaQualidadeException extends Exception {}
class ComidaGatoBaixaQualidadeException extends ComidaBaixaQualidadeException {}
class ComidaSemQualidadeException extends Exception {}

class Animal {}
class Comida {
    private DateTimeInterface $dataValidade;
    
    public function __construct(DateTimeInterface $dataValidade)
    {
        $this->dataValidade = $dataValidade;
    }

    public function isConsumivel(): bool
    {
        return ($this->dataValidade >= (new DateTime('Today')));
    }

}

class Dono {
    public function alimentar(Animal $animal, Comida $comida)
    {
        if(!$comida->isConsumivel()) {
            throw new ComidaBaixaQualidadeException();
        }
    }
}

class DonoFelino extends Dono
{
    public function alimentar(\Animal $animal, \Comida $comida) {
        if(!$comida->isConsumivel()) {
            throw new ComidaGatoBaixaQualidadeException();
        }
    }
}

class DonoGenerico extends Dono
{
    public function alimentar(\Animal $animal, \Comida $comida)
    {
        if(!$comida->isConsumivel()) {
            throw new ComidaSemQualidadeException();
        }
    }
}

function testar(Dono $dono)
{
    try {
        $dono->alimentar(new Animal(), new Comida(new DateTime('yesterday')));
    } catch (ComidaBaixaQualidadeException $ex) {
        echo "comida de baixa qualidade";
    }
}

// Exemplo correto
$dono = new DonoFelino();
// Exemplo inválido
$dono2 = new DonoGenerico();
testar($dono2);
