<?php
include_once __DIR__."/../includes/db.php";
class Category{

    private $pdo;
    public function getCatList()
    {
        // 1.Get connection
        $this->pdo=Database::connect();
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        // write sql 
        $sql="select * from categories";
        // prepare sql
        $statement=$this->pdo->prepare($sql);
        // execute statment
        $statement->execute();
        //result
        $results=$statement->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }
    public function getParents()
    {
        // 1.Get connection
        $this->pdo=Database::connect();
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        // write sql 
        $sql="select * from categories where parent=0";
        // prepare sql
        $statement=$this->pdo->prepare($sql);
        // execute statment
        $statement->execute();
        //result
        $results=$statement->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }
    public function addCat($name,$parent)
    {
        // 1.Get connection
        $this->pdo=Database::connect();
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        //sql
        $sql="insert into categories(name,parent) values (:name,:parent)";
        //prepare sql
        $statement=$this->pdo->prepare($sql);
        //bind parameters
        $statement->bindParam(":name",$name);
        $statement->bindParam(":parent",$parent);
        
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

    public function getCatInfo($id)
    {
        // 1.Get connection
        $this->pdo=Database::connect();
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        // write sql 
        $sql="select * from categories where id = :id";
        // prepare sql
        $statement=$this->pdo->prepare($sql);
        $statement->bindParam(":id",$id);
        // execute statment
        $statement->execute();
        //result
        $result=$statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    public function updateCat($id,$name,$parent)
    {
        // 1.Get connection
        $this->pdo=Database::connect();
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        // write sql 
        $sql="update categories set name=:name, parent=:parent where id=:id";
        // prepare sql
        $statement=$this->pdo->prepare($sql);
        $statement->bindParam(":id",$id);
        $statement->bindParam(":name",$name);
        $statement->bindParam(":parent",$parent);
        // execute statment
        return $statement->execute();
        
       
    }
    public function deleteCat($id)
    {

        try{
            // 1.Get connection
       $this->pdo=Database::connect();
       $this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
       // write sql 
       $sql="delete from categories where id=:id";
       // prepare sql
       $statement=$this->pdo->prepare($sql);
       $statement->bindParam(":id",$id);
       
       // execute statment
        $sql1="select * from categories where parent=:id";
        $statement1=$this->pdo->prepare($sql1);
        $statement1->bindParam(":id",$id);
        $statement1->execute();
        $children=$statement1->fetchAll(PDO::FETCH_ASSOC);
        if(count($children)>0)
        {
            return false;
        }
        else
        {
            return $statement->execute(); 

        }

       
        }
        catch(PDOException $e)
        {
            return false;
        }
       
    }
    public function getCategoriesPage($page)
    {
        $items_per_page=5;
        $offset= ($page-1) * $items_per_page;
          // 1.Get connection
          $this->pdo=Database::connect();
          $this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
          // write sql 
          $sql="select * from categories limit $offset,$items_per_page";
          // prepare sql
          $statement=$this->pdo->prepare($sql);
          
          // execute statment
          $statement->execute();
          $results=$statement->fetchAll(PDO::FETCH_ASSOC);
          return $results;
    }
}



?>