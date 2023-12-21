<?php

class Role {
    private $id;
    private $name;
    private $description;
}

class User {
    private $id;
    private $username;
    private $firstname;
    private $lastname;
    private $email;
    private $password;
    private $billingadressid;
    private $shippingadressid;
    private $roleid;
    private $token;

    // ... (seu código)

    public function getToken() {
        return $this->token;
    }
}

class Product {
    private $id;
    private $name;
    private $quantity;
    private $price;
    private $urlimg;
    private $description;

    // ... (seu código)
}

class Adress {
    private $streetname;
    private $streetnb;
    private $city;
    private $province;
    private $zipCode;
    private $country;
}

class UserOrder {
    private $items = [];
    private $id;
    private $orderdate;
    private $userid;
    private $ref;
    private $total;

    public function addItem(Product $product, $quantity) {
        $this->items[] = ['product' => $product, 'quantity' => $quantity];
    }

    public function removeItem($index) {
        unset($this->items[$index]);
        $this->items = array_values($this->items); // Reindexar o array após a remoção
    }

    public function getTotal() {
        $total = 0;
        foreach ($this->items as $item) {
            $total += $item['product']->getPrice() * $item['quantity'];
        }
        return $total;
    }

    public function getItems() {
        return $this->items;
    }
}

class OrderProduct {
    private $user;
    private $panier;
    private $status;
    private $price;
    private $quantity;
    private $productid;
    private $orderid;

    public function __construct(User $user, UserOrder $panier, $status, $price, $quantity, $productid, $orderid) {
        $this->user = $user;
        $this->panier = $panier;
        $this->status = $status; 
        $this->price = $price;
        $this->quantity = $quantity;
        $this->productid = $productid;
        $this->orderid = $orderid;
    }

    public function processOrder() {
        // Lógica para processar o pedido, por exemplo, atualizar o status para 'Processado'
        $this->status = 'Processed';
    }

    public function getStatus() {
        return $this->status;
    }
}

// Exemplo de uso:

// Criar usuário
$user = new User('John', 'john@email.com', 'password123');

// Criar produto
$product1 = new Product('Product 1', 50.00, 10, 'url1', 'Description 1');

// Adicionar produtos ao carrinho
$userOrder = new UserOrder();
$userOrder->addItem($product1, 2);

// Fazer pedido
$orderProduct = new OrderProduct($user, $userOrder, 'Pending', $product1->getPrice(), 2, $product1->getId(), $userOrder->getId());
$orderProduct->processOrder();

// Exibir informações do pedido
echo "Status do Pedido: " . $orderProduct->getStatus() . "\n";
echo "Total do Pedido: $" . $userOrder->getTotal() . "\n";
echo "Itens do Pedido:\n";
foreach ($userOrder->getItems() as $item) {
    echo $item['product']->getName() . " - Quantidade: " . $item['quantity'] . "\n";
}