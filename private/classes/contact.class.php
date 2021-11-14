<?php

class Contact extends DatabaseObject
{

    static protected $table_name = 'contact';
    static protected $db_columns = ["id", "names", "email", "subject", "message", "addedOn"];

    public $id;
    public $names;
    public $email;
    public $subject;
    public $message;
    public $addedOn;
    public function __construct($args = [])
    {
        $this->names = $args['names'] ?? "";
        $this->email = $args['email'] ?? "";
        $this->subject = $args['subject'] ?? "";
        $this->message = $args['message'] ?? "";
        $this->addedOn = $args['addedOn'] ??  date('Y-m-d H:i:s');
    }
}