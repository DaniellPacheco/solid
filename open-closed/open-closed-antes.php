<?php

// Exemplo sem SOLID

class Item {
    public float $valor;
    public float $peso;

    public function __construct(float $valor, float $peso)
    {
        $this->valor = $valor;
        $this->peso = $peso;
    }
}

class Pedido {
    private \DateTime $data;
    private array $items;
    private string $tipoFrete;

    public function __construct(\DateTime $data, array $items, string $tipoFrete)
    {
        $this->data = \DateTimeImmutable::createFromMutable($data);
        $this->items = $items;
        $this->tipoFrete = $tipoFrete;
    }

    public function getPesoTotal(): float
    {
        return array_reduce($this->items, function($soma, Item $item) {
            return $soma + $item->peso;
        });
    }

    public function getValorItems(): float 
    {
        return array_reduce($this->items, function($soma, Item $item) {
            return $soma + $item->valor;
        });
    }

    public function getValorFrete(): float
    {
        if($this->tipoFrete == 'PAC') {
            if($this->getValorItems() > 120.00) {
                return 0;
            }

            return ($this->getPesoTotal() * 1.5);
        }

        if($this->tipoFrete == 'SEDEX') {
            return ($this->getPesoTotal() * 3);
        }
    }

    public function getDataEntrega(): \DateTime
    {
        if($this->tipoFrete == 'PAC') {
            return $this->data->modify('+15 days');
        }

        if($this->tipoFrete == 'SEDEX') {
            return $this->data->modify('+5 days');
        }
    }
}