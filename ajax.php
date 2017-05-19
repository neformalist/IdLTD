<?php

/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 16.05.17
 * Time: 15:52
 */

require_once 'database.php';


class Ajax
{
    const ACTION_DELETE = 0;
    const ACTION_UPDATE = 1;
    const ACTION_CREATE = 2;

    private $db;
    private $data;

    public function __construct()
    {
        $instance = Database::getInstance();
        $this->db = $instance->getConnection();
    }

    private function parseRequest()
    {
        if(!empty($_POST)){
            $this->data = new stdClass();
            foreach ($_POST as $key => $value){
                $this->data->$key = $value;
            }
            return $this;
        }
        return false;
    }

    private function update()
    {
        $query = 'UPDATE product   
                  SET name = :nam, price = :price, category_id = :cat  
                  WHERE id = :id';
        $stm = $this->db->prepare($query);
        $prepareArray = ['nam'=>$this->data->name,
                        'price'=>$this->data->price,
                        'cat'=>$this->data->cat,
                        'id'=>$this->data->id];
        if($stm->execute($prepareArray)){
            return $this->getProduct($this->data->id);
        }
        return false;
    }

    private function getProduct($id)
    {
        $query = "SELECT product.id, product.name, product.price, product.category_id, category.name AS category   
                  FROM product, category  
                  WHERE product.category_id = category.id AND product.id = $id";
        return $this->db->query($query)->fetch(PDO::FETCH_ASSOC);
    }

    private function create()
    {
        $query = 'INSERT INTO product (name, price, category_id) VALUES (:nam, :price, :cat)';
        $stm = $this->db->prepare($query);
        $prepare = ['nam'=>$this->data->name,
                    'price'=>$this->data->price,
                    'cat'=>$this->data->cat];
        if($stm->execute($prepare)){
            return $this->getProduct($this->db->lastInsertId());
        }
        return false;
    }

    private function delete($id)
    {
        $query = 'DELETE FROM product WHERE  id = :id';
        $stm = $this->db->prepare($query);
        $setting = ['id'=>$id];
        if($stm->execute($setting)){
            return true;
        }
        return false;
    }

    public function run()
    {
        if($this->parseRequest()){
            if($this->data->action == self::ACTION_UPDATE){
                echo json_encode($this->update(), JSON_UNESCAPED_UNICODE);
            } elseif ($this->data->action == self::ACTION_DELETE){
                echo $this->delete($this->data-id);
            } elseif ($this->data->action == self::ACTION_CREATE){
                echo json_encode($this->create(), JSON_UNESCAPED_UNICODE);
            }
        }
    }
}

(new Ajax())->run();