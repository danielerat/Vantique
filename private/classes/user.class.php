<?php

class User extends DatabaseObject
{

    static protected $table_name = "users";
    static protected $db_columns = ['id', 'first_name', 'last_name', 'username', 'email', 'phone', 'hashed_password', 'created_on'];
    public $id;
    public $first_name;
    public $last_name;
    public $username;
    public $email;
    public $phone;
    protected $hashed_password;
    public $created_on;
    public $password;
    public $confirm_password;
    public $password_required = true;
    public function __construct($args = [])
    {
        $this->first_name = $args['first_name'] ?? '';
        $this->last_name = $args['last_name'] ?? '';
        $this->username = $args['username'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->phone = $args['phone'] ?? '';
        $this->created_on = $args['created_on'] ?? date('Y-m-d H:i:s');
        $this->password = $args['password'] ?? '';
        $this->confirm_password = $args['confirm_password'] ?? '';
    }

    public function full_name()
    {
        return $this->first_name . " " . $this->last_name;
    }

    protected function set_hashed_password()
    {
        $this->hashed_password = password_hash($this->password, PASSWORD_BCRYPT);
    }
    public function verify_password($password)
    {
        return password_verify($password, $this->hashed_password);
    }



    // We can manually hash the password before passing it to our create or update functions
    //or we can alter the original create  inherited class and add our code to it
    protected function create()
    {
        $this->set_hashed_password();
        return parent::create();
    }
    protected function update()
    {
        if ($this->password != "") {
            // Password have been set , therefore , we need to validate it , hash it and set it
            $this->set_hashed_password();
        } else {
            //passowrn not being updated
            $this->password_required = false;
        }

        return parent::update();
    }

    protected function validate()
    {
        $this->errors = [];

        if (is_blank($this->first_name)) {
            $this->errors[] = "First name cannot be blank.";
        } elseif (!has_length($this->first_name, array('min' => 2, 'max' => 255))) {
            $this->errors[] = "First name must be between 2 and 255 characters.";
        }

        if (is_blank($this->last_name)) {
            $this->errors[] = "Last name cannot be blank.";
        } elseif (!has_length($this->last_name, array('min' => 2, 'max' => 255))) {
            $this->errors[] = "Last name must be between 2 and 255 characters.";
        }

        if (is_blank($this->email)) {
            $this->errors[] = "Email cannot be blank.";
        } elseif (!has_length($this->email, array('max' => 255))) {
            $this->errors[] = "Last name must be less than 255 characters.";
        } elseif (!has_valid_email_format($this->email)) {
            $this->errors[] = "Email must be a valid format.";
        }

        if (is_blank($this->username)) {
            $this->errors[] = "Username cannot be blank.";
        } elseif (!has_length($this->username, array('min' => 4, 'max' => 255))) {
            $this->errors[] = "Username must be between 8 and 255 characters.";
        } elseif (!user_has_unique_username($this->username, $this->id ?? 0)) {
            $this->errors[] = "Unsername is already Taken, pick another one.";
        }


        if (is_blank($this->phone)) {
            $this->errors[] = "Phone Number cannot be blank.";
        } elseif (!has_length($this->phone, array('min' => 8, 'max' => 15))) {
            $this->errors[] = "Phone Number Not Allowed";
        }

        if ($this->password_required) {
            if (is_blank($this->password)) {
                $this->errors[] = "Password cannot be blank.";
            } elseif (!has_length($this->password, array('min' => 8))) {
                $this->errors[] = "Password must contain 8 or more characters";
            } elseif (!preg_match('/[A-Z]/', $this->password)) {
                $this->errors[] = "Password must contain at least 1 uppercase letter";
            } elseif (!preg_match('/[a-z]/', $this->password)) {
                $this->errors[] = "Password must contain at least 1 lowercase letter";
            } elseif (!preg_match('/[0-9]/', $this->password)) {
                $this->errors[] = "Password must contain at least 1 number";
            } elseif (!preg_match('/[^A-Za-z0-9\s]/', $this->password)) {
                $this->errors[] = "Password must contain at least 1 symbol";
            }
            if (is_blank($this->confirm_password)) {
                $this->errors[] = "Confirm password cannot be blank.";
            } elseif ($this->password !== $this->confirm_password) {
                $this->errors[] = "Password and confirm password must match.";
            }
        }

        return $this->errors;
    }

    static public function find_by_username($username)
    {
        $sql = "SELECT * FROM " . static::$table_name;
        $sql .= " where username='" . self::$db->escape_string($username) . "' limit 1";
        $object_array = static::find_by_sql($sql);
        if (!empty($object_array)) {
            // Since it's only one object then thre is no need to retrun a whole array with data 
            return array_shift($object_array);
        } else {
            return false;
        }
    }
}