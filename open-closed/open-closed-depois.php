<?php

// Exemplo com SOLID

class Item {
    public float $valor;
    public float $peso;

    public function __construct(float $valor, float $peso)
    {
        $this->valor = $valor;
        $this->peso = $peso;
    }
}

abstract class Frete {
    protected Pedido $pedido;

    /**
     * Get the value of pedido
     */ 
    public function getPedido()
    {
        return $this->pedido;
    }

    /**
     * Set the value of pedido
     *
     * @return  self
     */ 
    public function setPedido($pedido)
    {
        $this->pedido = $pedido;

        return $this;
    }

    public abstract function getValorFrete(): float;
    public abstract function getDataEntrega(): \DateTimeInterface;

}

class Pac extends Frete {
    
    public function getDataEntrega(): \DateTimeInterface
    {
        return $this->pedido->getData()->modify('+15 days');
    }

    public function getValorFrete(): float
    {
        if($this->pedido->getValorItems() > 120.00) {
            return 0;
        }

        return ($this->pedido->getPesoTotal() * 1.5);
    }

}

class Sedex extends Frete {
    
    public function getDataEntrega(): \DateTimeInterface
    {
        return $this->pedido->getData()->modify('+5 days');
    }

    public function getValorFrete(): float
    {
        return ($this->pedido->getPesoTotal() * 3);
    }

}

class Pedido {

    private \DateTime $data;
    private array $items;
    private Frete $frete;

    public function __construct(\DateTime $data, array $items, Frete $frete)
    {
        $this->data = $data;
        $this->items = $items;
        $this->frete = $frete;

        // relacionamento bidirecional Pedido <--- ---> Frete
        $this->frete->setPedido($this);
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


    /**
     * Get the value of data
     */ 
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set the value of data
     *
     * @return  self
     */ 
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get the value of items
     */ 
    public function getItems()
    {
        return $this->items;
    }

    /**
     * Set the value of items
     *
     * @return  self
     */ 
    public function setItems($items)
    {
        $this->items = $items;

        return $this;
    }

    /**
     * Get the value of frete
     */ 
    public function getFrete()
    {
        return $this->frete;
    }

    /**
     * Set the value of frete
     *
     * @return  self
     */ 
    public function setFrete($frete)
    {
        $this->frete = $frete;

        return $this;
    }
}

$pedido = new Pedido(new DateTime(), [new Item(40.50, 2), new Item(90.20, 18)], new Pac());
echo $pedido->getFrete()->getValorFrete().PHP_EOL;
echo $pedido->getFrete()->getDataEntrega()->format("d/m/Y");
