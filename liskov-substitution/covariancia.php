<?php

// Covariância

abstract class Animal {
    protected string $nome;
    public function __construct(string $nome)
    {
        $this->nome = $nome;
    }

    abstract public function fazerSom();
}

class Cachorro extends Animal
{
    public function fazerSom()
    {
        echo $this->nome . ": au au!" . PHP_EOL;
    }
}

class Gato extends Animal
{
    public function fazerSom()
    {
        echo $this->nome . ": miau!" . PHP_EOL;
    }
}

interface AbrigoAnimal
{
    public function adotar(string $nome): Animal;
}

class AbrigoGato implements AbrigoAnimal
{
    public function adotar(string $nome): Gato
    {
        return new Gato($nome);
    }
}

class AbrigoCachorro implements AbrigoAnimal
{
    public function adotar(string $nome): Cachorro
    {
        return new Cachorro($nome);
    }
}

$gatinho = (new AbrigoGato)->adotar("Darwin");
$gatinho->fazerSom();

$doguinho = (new AbrigoCachorro)->adotar("Bolota");
$doguinho->fazerSom();