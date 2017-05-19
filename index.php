<?php

ini_set('display_errors', 1);

require_once 'database.php';

class Index
{
    private $db;

    public function __construct()
    {
        $instance = Database::getInstance();
        $this->db = $instance->getConnection();
    }

    private function getProduct()
    {
        $query = 'SELECT product.id, product.name, product.price, product.category_id, category.name AS category FROM product, category WHERE product.category_id = category.id ORDER BY product.id ASC';
        return $this->db->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    private function renderHtml($template, $data = array())
    {
        if(!empty($data)){
            extract($data);
        }
        require_once ($template);
    }

    public function getCategory()
    {
        return $this->db->query('SELECT * FROM category')->fetchAll(PDO::FETCH_ASSOC);
    }

    public function run()
    {
        $product = $this->getProduct();
        $category = $this->getCategory();

        $this->renderHtml('template.php', ['product' => $product, 'category' => $category]);
    }
}

(new Index())->run();