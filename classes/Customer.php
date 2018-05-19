<?php
    $filePath = realpath(dirname(__FILE__));
    include_once ($filePath ."/../lib/Database.php");
    include_once ($filePath ."/../helpers/Format.php");
class Customer {
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function customerRegisteration($data) {
        $name     = mysqli_real_escape_string($this->db->link, $data['name']);
        $city     = mysqli_real_escape_string($this->db->link, $data['city']);
        $address  = mysqli_real_escape_string($this->db->link, $data['address']);
        $country  = mysqli_real_escape_string($this->db->link, $data['country']);
        $zip      = mysqli_real_escape_string($this->db->link, $data['zip']);
        $phone    = mysqli_real_escape_string($this->db->link, $data['phone']);
        $email    = mysqli_real_escape_string($this->db->link, $data['email']);
        $password = mysqli_real_escape_string($this->db->link, md5($data['password']));

        if ($name == '' || $city == '' || $address == '' || $country == '' || $zip == '' || $phone == "" || $email == "" || $password == "") {
            $registerMsg = "<div class='alert alert-danger'>Fields field must not be empty</div>";
            return $registerMsg;
        }
        $mailQuery = "SELECT * FROM tbl_customer WHERE email = '$email' LIMIT 1";
        $mailCheck = $this->db->select($mailQuery);
        if ($mailCheck != false) {
            $registerMsg = "<div class='alert alert-danger'>Email already exist</div>";
            return $registerMsg;
        } else {
            $query = "INSERT INTO tbl_customer 
                                              (name, city, address, country, zip, phone, email, pass) 
                                              VALUES 
                                              ('$name', ' $city', '$address', '$country', '$zip', '$phone', '$email', '$password')";
            $customerInsert = $this->db->insert($query);
            if ($customerInsert) {
                $customerMsg = "<div class='alert alert-success'>customer registered successfully</div>";
                return $customerMsg;
            } else {
                $customerMsg = "<div class='alert alert-danger'>customer not registered</div>";
                return $customerMsg;
            }
        }
    }

    public function customerLogin($data) {
        $email    = mysqli_real_escape_string($this->db->link, $data['email']);
        $password = mysqli_real_escape_string($this->db->link, md5($data['password']));
        if (empty($email) || empty($password)) {
            $loginMsg = "<div class='alert alert-danger'>Fields field must not be empty</div>";
            return $loginMsg;
        }

        $query = "SELECT * FROM tbl_customer WHERE email = '$email' AND pass = '$password'";
        $userLogin = $this->db->select($query);
        if ($userLogin != false) {
            $value = $userLogin->fetch_assoc();
            Session::set('customerLogin', true);
            Session::set('customerId', $value['id']);
            Session::set('customerName', $value['name']);
            header('Location: cart.php');
        } else {
            $loginMsg = "<div class='alert alert-danger'>Email or Password are not matched!</div>";
            return $loginMsg;
        }
    }

    public function getCustomerData($id) {
        $query = "SELECT * FROM tbl_customer WHERE id = '$id'";
        $userData = $this->db->select($query);
        return $userData;
    }

    public function customerUpdate($data, $id) {
        $name     = mysqli_real_escape_string($this->db->link, $data['name']);
        $city     = mysqli_real_escape_string($this->db->link, $data['city']);
        $address  = mysqli_real_escape_string($this->db->link, $data['address']);
        $country  = mysqli_real_escape_string($this->db->link, $data['country']);
        $zip      = mysqli_real_escape_string($this->db->link, $data['zip']);
        $phone    = mysqli_real_escape_string($this->db->link, $data['phone']);
        $email    = mysqli_real_escape_string($this->db->link, $data['email']);

        if ($name == '' || $city == '' || $address == '' || $country == '' || $zip == '' || $phone == "" || $email == "") {
            $updateProfileMsg = "<div class='alert alert-danger'>Fields field must not be empty</div>";
            return $updateProfileMsg;
        } else {
            $query = "UPDATE tbl_customer SET
                                            name    = '$name',
                                            city    = '$city',
                                            address = '$address',
                                            country = '$country',
                                            zip     = '$zip',
                                            phone   = '$phone',
                                            email   = '$email'
                                         WHERE id = '$id'";
            $updated_row = $this->db->update($query);
            if ($updated_row) {
                $updateProfileMsg = "<div class='alert alert-success'>Customer Profile updated successfully</div>";
                return $updateProfileMsg;
            } else {
                $updateProfileMsg = "<div class='alert alert-danger'>Customer Profile not updated</div>";
                return $updateProfileMsg;
            }
        }
    }


}