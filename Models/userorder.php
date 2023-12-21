<?php
class UserOrder {
    private $itens = [];
    private $id;
    private $orderdate;
    private $userid;
    private $ref;
    private $total;

    public function addItem(Product $product, $quantity) {
        $this->itens[] = ['product' => $product, 'quantity' => $quantity];
    }

    public function removeItem($index) {
        unset($this->itens[$index]);
        $this->itens = array_values($this->itens); // Reindexar o array após a remoção
    }

    public function getTotal() {
        $total = 0;
        foreach ($this->itens as $item) {
            $total += $item['product']->getPrice() * $item['quantity'];
        }
        return $total;
    }

    public function getItens() {
        return $this->itens;
    }
}
?>