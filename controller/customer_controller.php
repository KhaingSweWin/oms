<?php
include_once __DIR__."/../model/customer.php";

class CustomerController extends Customer{

    public function getCustomers()
    {
        $customers=$this->getCustomerList();
        return $customers;
    }
    public function addCustomer($name,$email,$phone,$address)
    {
        $result=$this->createCustomer($name,$email,$phone,$address);
        return $result;
    }



}



?>