<?php

class Database{
    private static $host="localhost";
    private static $dbname="ecommerce";
    private static $username="root";
    private static $password="";
    private static $cont="";
    public static function connect()
    {
        if(self::$cont==null)
        {
           try{
            self::$cont=new PDO("mysql:host=".self::$host.";dbname=".self::$dbname,self::$username,self::$password);
           }
           catch(PDOException $e)
           {
            echo $e->getMessage();
           }
            
        }
        return self::$cont;
    }
    public static function disconnect()
    {
        self::$cont=null;
    }
}


?>