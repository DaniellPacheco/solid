<?php

// Contravariância

class Alimento {}
class AlimentoAnimal extends Alimento {}

abstract class Animal {
    protected string $nome;

    public function __construct(string $nome)
    {
        $this->nome = $nome;
    }

    public function comer(AlimentoAnimal $alimento)
    {
        echo $this->nome . ": nhac nhac comendo " . get_class($alimento) . PHP_EOL;
    }
}

class Gato extends Animal {}
class Cachorro extends Animal {
    public function comer(Alimento $alimento)
    {
        echo $this->nome . ": chomp chomp, comendo " . get_class($alimento) . PHP_EOL;
    }
}

interface AbrigoAnimal {
    public function adotar(string $nome): Animal;
}

class AbrigoGato implements AbrigoAnimal {
    public function adotar(string $nome): Gato {
        return new Gato($nome);
    }
}

class AbrigoCachorro implements AbrigoAnimal {
    public function adotar(string $nome): Cachorro
    {
        return new Cachorro($nome);
    }
}

$gatinho = (new AbrigoGato())->adotar("Darwin");
$whiskas = new AlimentoAnimal();
$gatinho->comer($whiskas);

$doguinho = (new AbrigoCachorro())->adotar("Bolota");
$arroz = new Alimento();
$doguinho->comer($arroz);