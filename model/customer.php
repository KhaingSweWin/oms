<?php
include_once __DIR__."/../includes/db.php";

class Customer{
    private $pdo;
    public function getCustomerList()
    {
       // 1.Get connection
        $this->pdo=Database::connect();
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        // write sql 
        $sql="select * from customers";
        // prepare sql
        $statement=$this->pdo->prepare($sql);
        // execute statment
        $statement->execute();
        //result
        $customers=$statement->fetchAll(PDO::FETCH_ASSOC);
        return $customers;

    }
    public function createCustomer($name,$email,$phone,$address)
    {
        // 1.Get connection
        $this->pdo=Database::connect();
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        //sql
        $sql="insert into customers(name,email,phone,address) values (:name,:email,:phone,:address)";
        //prepare sql
        $statement=$this->pdo->prepare($sql);
        //bind parameters
        $statement->bindParam(":name",$name);
        $statement->bindParam(":email",$email);
        $statement->bindParam(":phone",$phone);
        $statement->bindParam(":address",$address);
        ///run sql
        //$statement->execute();

        if($statement->execute())
        {
            return true;
        }
        else
        {
            return false;
        }


    }
}


?>