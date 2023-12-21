<?php

class OrderProduct {
    private $user;
    private $panier;
    private $status;
    private $price;
    private $quantity;
    private $productid;
    private $orderid;

    public function __construct(User $user, Panier $panier, Status $status, Price $price, Quantity $quantity) {
        $this->user = $user;
        $this->panier = $panier;
        $this->status = 'Pending' || 'Confirmed'; // Pode adicionar mais estados conforme necessário
        
        $this->price= $price;
        $this->quantity = $quantity;
    }

      
    public function processOrder() {
        // Lógica para processar o pedido, por exemplo, atualizar o status para 'Processado'
        $this->status = 'Processed';
    }

    
    public function getStatus() {
        return $this->status;
    }
}

?>