<?php

class UserOrder extends DatabaseObject
{

    static protected $table_name = 'userOrder';
    static protected $db_columns = ["id", "orderId", "username", "deliveryMethod", "deliveryNote", "payment", "status", "addedOn"];

    public $id;
    public $orderId;
    public $username;
    public $deliveryMethod;
    public $deliveryNote;
    public $payment;
    public $status;
    public $addedOn;
    public function __construct($args = [])
    {
        $this->orderId = $args['orderId'] ?? "";
        $this->username = $args['username'] ?? "";
        $this->deliveryMethod = $args['deliveryMethod'] ?? "";
        $this->deliveryNote = $args['deliveryNote'] ?? "";
        $this->payment = $args['payment'] ?? "1";
        $this->status = $args['status'] ?? "1";
        $this->addedOn = $args['addedOn'] ?? date('Y-m-d H:i:s');
    }

    public function getOrderStatus($id)
    {
        switch ($id) {
            case 1:
                return "<span class='badge badge-danger'>Pending</span>";
                break;
            case 2:
                return "<span class='badge badge-primary'>Processing</span>";
                break;
            case 3:
                return "<span class='badge badge-warning'>Shipping</span>";
                break;
            case 4:
                return "<span class='badge badge-success'>Delivered</span>";
                break;
            default:
                return "<span class='badge badge-danger'>ERROR</span>";
        }
    }
    public function deliverySpeed($id)
    {
        switch ($id) {
            case 0:
                return "<span class='badge badge-secondary'> Free </span>";
                break;
            case 1:
                return "<span class='badge badge-secondary'>Emergency 30mn</span>";
                break;
            case 2:
                return "<span class='badge badge-secondary'>Within An Hour</span>";
                break;
            case 3:
                return "<span class='badge badge-secondary'>Next Day</span>";
                break;
            default:
                return "<span class='badge badge-secondary'>ERROR</span>";
        }
    }


    // find product by a given sub sub category 
    static public function find_order_by_status($id)
    {
        $sql = "SELECT * from " . static::$table_name;
        $sql .= " WHERE status='" . self::$db->escape_string($id) . "'";
        return static::find_by_sql($sql);
    }

    static public function find_by_order_id($id)
    {
        $sql = "SELECT * FROM " . static::$table_name . " Where orderId='" . self::$db->escape_string($id) . "'";
        $object_array = static::find_by_sql($sql);
        if (!empty($object_array)) {
            // Since it's only one object then thre is no need to retrun a whole array with data 
            return array_shift($object_array);
        } else {
            return false;
        }
    }
}