<?php

class UserOrder extends DatabaseObject
{

    static protected $table_name = 'userOrder';
    static protected $db_columns = ["id", "orderId", "username", "deliveryMethod", "deliveryNote", "payment", "addedOn"];

    public $id;
    public $orderId;
    public $username;
    public $deliveryMethod;
    public $deliveryNote;
    public $payment;
    public $addedOn;
    public function __construct($args = [])
    {
        $this->orderId = $args['orderId'] ?? "";
        $this->username = $args['username'] ?? "";
        $this->deliveryMethod = $args['deliveryMethod'] ?? "";
        $this->deliveryNote = $args['deliveryNote'] ?? "";
        $this->payment = $args['payment'] ?? "1";
        $this->addedOn = $args['addedOn'] ?? date('Y-m-d H:i:s');
    }
}