<?php

class ContaBancaria
{
    protected float $saldo;

    public function __construct(float $saldoInicial)
    {
        $this->saldo = $saldoInicial;
    }

    public function sacar(float $valor): float
    {
        if(($this->saldo - $valor) >= 0)
            $this->saldo -= $valor;
        return $this->saldo;
    }
}

class ContaBancariaVip extends ContaBancaria
{
    private const TAXA = 10.00;

    public function sacar(float $valor): float
    {
        if(($this->saldo - $valor) >= self::TAXA)
            $this->saldo -= $valor;
        return $this->saldo;
    }
}

class ContaBancariaIlimitada extends ContaBancaria
{
    public function sacar(float $valor): float
    {
        $this->saldo -= $valor;
        return $this->saldo;
    }
}

// Certo
$saldo_inicial = 100.00;
$conta = new ContaBancaria($saldo_inicial);
$conta->sacar(80.00);
echo $conta->sacar(21.00);

// Correto - Reforçamos a saída
$saldo_inicial = 100.00;
$conta = new ContaBancariaVip($saldo_inicial);
$conta->sacar(80.00);
echo $conta->sacar(15);

// Errado - Enfraquecemos a saída
$saldo_inicial = 100.00;
$conta = new ContaBancariaIlimitada($saldo_inicial);
$conta->sacar(80.00);
echo $conta->sacar(150.00);