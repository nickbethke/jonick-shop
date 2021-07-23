<?php

class User
{
    public $data;
    public $ID = 0;
    public function __construct($id = 0, $name = "")
    {
        if ($id instanceof self) {
            $this->init($id->data);
            return;
        } elseif (is_object($id)) {
            $this->init($id);
            return;
        }
        if ($id) {
            $data = self::get_data_by('id', $id);
        } else {
            $data = self::get_data_by('login', $name);
        }

        if ($data) {
            $this->init($data);
        } else {
            $this->data = new stdClass;
        }
    }
    public function init($data)
    {
        if (!isset($data->ID)) {
            $data->ID = 0;
        }
        $this->data = $data;
        $this->ID   = (int) $data->ID;
    }
    static function get_data_by($field, $value)
    {
        global $db;

        if ('ID' === $field) {
            $field = 'id';
        }

        if ('id' === $field) {
            // Make sure the value is numeric to avoid casting objects, for example,
            // to int 1.
            if (!is_numeric($value)) {
                return false;
            }
            $value = (int) $value;
            if ($value < 1) {
                return false;
            }
        } else {
            $value = trim($value);
        }

        if (!$value) {
            return false;
        }

        switch ($field) {
            case 'id':
                $user_id  = $value;
                $db_field = 'id_user';
                break;
            case 'email':
                $user_id  = false;
                $value    = $value;
                $db_field = 'email';
                break;
            case 'login':
                $user_id  = false;
                $value    = $value;
                $db_field = 'login';
                break;
            default:
                return false;
        }

        $user = $db->query("SELECT * FROM `users` WHERE $db_field = '" . $value . "' LIMIT 1")->fetchRow();
        if (!$user || empty($user)) {
            return false;
        } else {
            $user = json_decode(json_encode($user));
        }
        return $user;
    }
    /**
     * @return User|Error
     */
    public static function authenticate($user, $username, $password)
    {
        $password = trim($password);

        if ($user instanceof User) {
            return $user;
        }

        if (empty($username) || empty($password)) {
            return new Error("The username field or the password field is empty");
        }
        if (strpos($username, '@')) {
            $user = get_user_by('email', $username);
        } else {
            $user = get_user_by('login', $username);
        }
        if (!$user) {
            return new Error("The username is not registered on this site. If you are unsure of your username, try your email address instead.");
        }

        if (!check_password($password, $user->get_password(), $user->get_ID())) {
            return new Error(sprintf("The password you entered for the username %s is incorrect", $username));
        }
        return $user;
    }
    public function get_ID()
    {
        return $this->ID;
    }
    public function get_password()
    {
        return $this->data->pass;
    }
}
