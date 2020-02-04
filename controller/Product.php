<?php 
  class Product extends Database
  {
    public function all() 
    {
      $sql = "SELECT * FROM products";
      $query = $this->connect()->query($sql);
      $result = $query->fetchAll(PDO::FETCH_OBJ);
      return $result;
    }

    public function findByCode($code)
    {
      $sql = "SELECT * FROM products WHERE code = '$code'";
      $query = $this->connect()->query($sql);
      $result = $query->fetch(PDO::FETCH_OBJ);
      if ($result) {
        return $result;
      } else {
        return null;
      }
    }

    public function create($product) 
    {
      extract($product); // This will descructuring product(array) become ($code, $name, $type, $price)

      $sql = "INSERT INTO products (code, name, type, price) VALUES ('$code', '$name', '$type', '$price')";
      $query = $this->connect()->prepare($sql);
      $result = $query->execute();
      return $result;
    }

    public function update($past_code, $product)
    {
      extract($product); // This will descructuring product(array) become ($code, $name, $type, $price)

      $sql = "UPDATE products SET
        code = '$code',  
        name = '$name',  
        type = '$type',  
        price = '$price'
        WHERE code = '$past_code'  
      ";
      $query = $this->connect()->prepare($sql);
      $result = $query->execute();
      return $result;
    }

    public function delete($code)
    {
      $sql = "DELETE FROM products WHERE code = '$code'";
      $query = $this->connect()->prepare($sql);
      $result = $query->execute();
      return $result;
    }

    // public function search($query)
    // {
    //   $sql = "SELECT * FROM products WHERE name LIKE '%$query%'";
    //   $query = $this->connect()->query($sql);
    //   $result = $query->fetchAll(PDO::FETCH_OBJ);
    //   return $result;
    // }
  }
  