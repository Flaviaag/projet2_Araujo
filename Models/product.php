<?php

class Product extends Model{
    private $id;
    private $name;
    private $quantity;
    private $price;
    private $urlimg;
    private $description;
    
    public function _construct($name, $quantity, $price, $urlimg, $description  ) {
        $this->name = $name;
        $this->quantity = $quantity;
        $this->price = $price;
        $this->urlimg = $urlimg;
        $this->description = $description;

        $this->getConnection();
    }

    public function findBySlug(string $slug){
        $sql = "SELECT * FROM ".$this->table." WHERE 
       `slug`='".$slug."'";
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC); 
        }
    
        //INCLUIR OUTROS METODOS
    
    public function getId() {
        return $this->id;
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function getQuantity() {
        return $this->quantity;
    }
    
    public function getPrice() {
        return $this->price;
    }
    
    public function getUrlimg() {
        return $this->urlimg;
    }
    
    public function getDescription() {
        return $this->description;
    }


    // Métodos para interagir com o banco de dados ou outra fonte de dados
    public static function getAll() {
        // Simulação de dados - substituir por lógica de acesso a banco de dados
        return [
            new Product('T-shirt sportiv', 29.99),
            new Product('Pantalon de marche', 39.99),
            // ...
        ];
    }

    public function index(){
        $this->loadModel('product');
        $products = $this->Product->getAll();

        var_dump($products);
    }

    // Outros métodos para obter detalhes, adicionar ao carrinho, etc.
}