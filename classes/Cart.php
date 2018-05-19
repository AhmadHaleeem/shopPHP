<?php
    $filePath = realpath(dirname(__FILE__));
    include_once  ($filePath . "/../lib/Database.php");
    include_once ($filePath ."/../helpers/Format.php");
class Cart {
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function addToCart($quantity, $id)
    {
        $quantity = $this->fm->validation($quantity);
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);
        $productId = mysqli_real_escape_string($this->db->link, $id);
        $sId = session_id();
        $checkQuery = "SELECT * FROM tbl_cart WHERE productId = '$productId' AND sId = '$sId'";
        $getPro = $this->db->select($checkQuery);
        if ($getPro) {
            $cartMsg = "<div class='alert alert-danger mt-4'>Product already added</div>";
            return $cartMsg;
        } else {
            $sQuery = "SELECT * FROM tbl_product WHERE productId = '$productId'";
            $result = $this->db->select($sQuery)->fetch_assoc();

            $productName = $result['productName'];
            $price = $result['price'];
            $image = $result['image'];
            $query = "INSERT INTO tbl_cart 
                                      (sId, productId, productName, price, quantity, image) 
                                      VALUES 
                                      ('$sId', '$productId', '$productName', '$price', '$quantity', '$image')";
            $insertedRow = $this->db->insert($query);
            if ($insertedRow) {
                header('Location: cart.php');
            } else {
                header('Location: 404.php');
            }
        }
    }

    public function getCartProduct(){
        $sId = session_id();
        $query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
        $result = $this->db->select($query);
        return $result;
    }

    public function updateCartQuantity($cartId, $quantity) {
        $cartId   = mysqli_real_escape_string($this->db->link, $cartId);
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);
        $query = "UPDATE tbl_cart SET quantity = '$quantity' WHERE cartId = '$cartId'";
        $updated_row = $this->db->update($query);
        if ($updated_row) {
            header('Location: cart.php');
        } else {
            $cartMsg = "<div class='alert alert-danger'>Quantity not updated</div>";
            return $cartMsg;
        }
    }

    public function delProductByCart($cartId){
        $cartId   = mysqli_real_escape_string($this->db->link, $cartId);
        $query    = "DELETE FROM tbl_cart WHERE cartId = '$cartId'";
        $delData  = $this->db->delete($query);
        if ($delData) {
            header('Location: cart.php');
        } else {
            $cartMsg = "<div class='alert alert-danger'>Product not deleted</div>";
            return $cartMsg;
        }
    }

    public function checkCartTable(){
        $sId = session_id();
        $query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
        $result = $this->db->select($query);
        return $result;
    }

    public function delCustomerCart() {
        $sId = session_id();
        $query = "DELETE FROM tbl_cart WHERE sId = '$sId'";
        $this->db->delete($query);
    }

    public function orderProduct($customerId) {
        $sId = session_id();
        $query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
        $getProduct = $this->db->select($query);
        if ($getProduct) {
            while($result = $getProduct->fetch_assoc()) {
                $productId = $result['productId'];
                $productName = $result['productName'];
                $quantity = $result['quantity'];
                $price = $result['price'] * $quantity;
                $image = $result['image'];

                $query = "INSERT INTO tbl_order 
                                      (cmrId, productId, productName, quantity, price, image) 
                                      VALUES 
                                      ('$customerId', '$productId', '$productName', '$quantity', '$price', '$image')";
                $insertedRow = $this->db->insert($query);
            }
        }
    }

    public function payableAmount($cmrId) {
        $query = "SELECT price FROM tbl_order WHERE cmrId = '$cmrId' AND date = now()";
        $result = $this->db->select($query);
        return $result;
    }

    public function getOrderProduct($cmrId) {
        $query = "SELECT * FROM tbl_order WHERE cmrId = '$cmrId' ORDER BY date DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function checkOrder($cmrId) {
        $query = "SELECT * FROM tbl_order WHERE cmrId = '$cmrId'";
        $result = $this->db->select($query);
        return $result;
    }

    public function getAllOrderProduct() {
        $query = "SELECT * FROM tbl_order ORDER BY date DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function productShifted($id, $date, $price) {
        $id   = mysqli_real_escape_string($this->db->link, $id);
        $date   = mysqli_real_escape_string($this->db->link, $date);
        $price   = mysqli_real_escape_string($this->db->link, $price);
        $query = "UPDATE tbl_order SET status = '1' WHERE cmrId = '$id' AND date = '$date' AND price = '$price'";
        $updated_row = $this->db->update($query);
        if ($updated_row) {
            header('Location: inbox.php');
        } else {
            $orderMsg = "<div class='alert alert-danger'>Order not updated</div>";
            return $orderMsg;
        }
    }

    public function delProductShifted($id, $date, $price) {
        $id   = mysqli_real_escape_string($this->db->link, $id);
        $date   = mysqli_real_escape_string($this->db->link, $date);
        $price   = mysqli_real_escape_string($this->db->link, $price);

        $query = "DELETE FROM tbl_order WHERE cmrId = '$id' AND date = '$date' AND price = '$price'";
        $delData = $this->db->delete($query);
        if ($delData) {
            $productMsg = "<div class='alert alert-success'>Data deleted successfully</div>";
            return $productMsg;
        } else {
            $productMsg = "<div class='alert alert-danger'>Data not deleted</div>";
            return $productMsg;
        }
    }

    public function productconfirmed($id, $date, $price) {
        $id   = mysqli_real_escape_string($this->db->link, $id);
        $date   = mysqli_real_escape_string($this->db->link, $date);
        $price   = mysqli_real_escape_string($this->db->link, $price);

        $query = "UPDATE tbl_order SET status = '2' WHERE cmrId = '$id' AND date = '$date' AND price = '$price'";
        $updated_row = $this->db->update($query);
        if ($updated_row) {
            $productMsg = "<div class='alert alert-success'>Data updated successfully</div>";
            return $productMsg;
        } else {
            $productMsg = "<div class='alert alert-danger'>Order not updated</div>";
            return $productMsg;
        }
    }
}

