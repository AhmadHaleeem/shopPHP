<?php
    $filePath = realpath(dirname(__FILE__));
    include_once ($filePath . "/../lib/Database.php");
    include_once ($filePath . "/../helpers/Format.php");

class Product {
    /**
     * Product constructor.
     */
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function productInsert($data, $file) {
        $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
        $catId      = mysqli_real_escape_string($this->db->link, $data['catId']);
        $brandId    = mysqli_real_escape_string($this->db->link, $data['brandId']);
        $body       = mysqli_real_escape_string($this->db->link, $data['body']);
        $price      = mysqli_real_escape_string($this->db->link, $data['price']);
        $type       = mysqli_real_escape_string($this->db->link, $data['type']);

        $permited  = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $file['image']['name'];
        $file_size = $file['image']['size'];
        $file_temp = $file['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "upload/" . $unique_image;

        if ($productName == '' || $catId == '' || $brandId == '' || $body == '' || $price == '' || $type == "") {
            $productMsg = "<div class='alert alert-danger'>Fields field must not be empty</div>";
            return $productMsg;
        } elseif ($file_size >1048567) {
            echo "<span style='position: relative;top: 30px;left: 220px' class='alert alert-danger'>Image Size should be less then 1MB!</span>";
        } elseif (in_array($file_ext, $permited) === false) {
            echo "<span style='position: relative;top: 30px;left: 220px' class='alert alert-danger'>You can upload only:-"
                .implode(', ', $permited)."</span>";
        } else {
            move_uploaded_file($file_temp, $uploaded_image);
            $query = "INSERT INTO tbl_product (productName, catId, brandId, body, price, image, type) VALUES ('$productName', '$catId', '$brandId', '$body', '$price', '$uploaded_image', '$type')";
            $productInsert = $this->db->insert($query);
            if ($productInsert) {
                $productMsg = "<div class='alert alert-success'>Product inserted successfully</div>";
                return $productMsg;
            } else {
                $productMsg = "<div class='alert alert-danger'>Product not inserted</div>";
                return $productMsg;
            }
        }
    }

    public function productUpdate($data, $file, $id) {
        $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
        $catId      = mysqli_real_escape_string($this->db->link, $data['catId']);
        $brandId    = mysqli_real_escape_string($this->db->link, $data['brandId']);
        $body       = mysqli_real_escape_string($this->db->link, $data['body']);
        $price      = mysqli_real_escape_string($this->db->link, $data['price']);
        $type       = mysqli_real_escape_string($this->db->link, $data['type']);

        $permited  = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $file['image']['name'];
        $file_size = $file['image']['size'];
        $file_temp = $file['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "upload/" . $unique_image;

        if ($productName == '' || $catId == '' || $brandId == '' || $body == '' || $price == '' || $type == "") {
            $productMsg = "<div class='alert alert-danger'>Fields field must not be empty</div>";
            return $productMsg;
        } else {
            if (!empty($file_name)) {
                if ($file_size >1048567) {
                    echo "<span style='position: relative;top: 30px;left: 220px' class='alert alert-danger'>Image Size should be less then 1MB!</span>";
                } elseif (in_array($file_ext, $permited) === false) {
                    echo "<span style='position: relative;top: 30px;left: 220px' class='alert alert-danger'>You can upload only:-"
                        .implode(', ', $permited)."</span>";
                } else {
                    move_uploaded_file($file_temp, $uploaded_image);
                    $query = "UPDATE tbl_product
                                                SET
                                                productName = '$productName',
                                                catId       = '$catId',
                                                brandId     = '$brandId',
                                                body        = '$body',
                                                price       = '$price',
                                                image       = '$uploaded_image',
                                                type        = '$type'
                                                WHERE productId = '$id'
                                                ";
                    $productInsert = $this->db->insert($query);
                    if ($productInsert) {
                        $productMsg = "<div class='alert alert-success'>Product update successfully</div>";
                        return $productMsg;
                    } else {
                        $productMsg = "<div class='alert alert-danger'>Product not updated</div>";
                        return $productMsg;
                    }
                }
                } else {
                $query = "UPDATE tbl_product
                                                SET
                                                productName = '$productName',
                                                catId       = '$catId',
                                                brandId     = '$brandId',
                                                body        = '$body',
                                                price       = '$price',
                                                type        = '$type'
                                                WHERE productId = '$id'
                                                ";
                $productInsert = $this->db->insert($query);
                if ($productInsert) {
                    $productMsg = "<div class='alert alert-success'>Product update successfully</div>";
                    return $productMsg;
                } else {
                    $productMsg = "<div class='alert alert-danger'>Product not updated</div>";
                    return $productMsg;
                }
                }
            }

        }

    public function getAllProduct() {
        $query =
            "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName
                                              FROM tbl_product
                                              INNER JOIN tbl_category
                                              ON tbl_product.catId = tbl_category.catId
                                               INNER JOIN tbl_brand
                                              ON tbl_product.brandId = tbl_brand.brandId
                                              ORDER BY tbl_product.productId DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function getProductById($id) {
        $query = "SELECT * FROM tbl_product WHERE productId = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function delProductById($id) {
        $query = "SELECT * FROM tbl_product WHERE productId = '$id'";
        $getData = $this->db->select($query);
        if ($getData) {
            while($delImage = $getData->fetch_assoc()) {
                $delLink = $delImage['image'];
                unlink($delLink);
            }
        }
        $delQuery = "DELETE FROM tbl_product WHERE productId = '$id'";
        $delData = $this->db->delete($delQuery);
        if ($delData) {
            $productMsg = "<div class='alert alert-success'>Product deleted successfully</div>";
            return $productMsg;
        } else {
            $productMsg = "<div class='alert alert-danger'>Product not deleted</div>";
            return $productMsg;
        }
    }

    public function getFeaturedProduct() {
        $query ="SELECT * FROM tbl_product WHERE type = '0' ORDER BY productId DESC LIMIT 4";
        $result = $this->db->select($query);
        return $result;
    }

    public function getNewProduct() {
        $query ="SELECT * FROM tbl_product  ORDER BY productId DESC LIMIT 4";
        $result = $this->db->select($query);
        return $result;
    }

    public function getSingleProduct($id){
        $query =
            "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName
                                              FROM tbl_product
                                              INNER JOIN tbl_category
                                              ON tbl_product.catId = tbl_category.catId
                                               INNER JOIN tbl_brand
                                              ON tbl_product.brandId = tbl_brand.brandId
                                              WHERE productId = '$id'
                                              ORDER BY tbl_product.productId DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function latestFromIphone() {
        $query ="SELECT * FROM tbl_product WHERE brandId = '4' ORDER BY productId DESC LIMIT 1";
        $result = $this->db->select($query);
        return $result;
    }

    public function latestFromSamsung() {
        $query ="SELECT * FROM tbl_product WHERE brandId = '3' ORDER BY productId DESC LIMIT 1";
        $result = $this->db->select($query);
        return $result;
    }

    public function latestFromAcer() {
        $query ="SELECT * FROM tbl_product WHERE brandId = '7' ORDER BY productId DESC LIMIT 1";
        $result = $this->db->select($query);
        return $result;
    }

    public function latestFromCanon() {
        $query ="SELECT * FROM tbl_product WHERE brandId = '5' ORDER BY productId DESC LIMIT 1";
        $result = $this->db->select($query);
        return $result;
    }

    public function productByCategory($id) {
        $catId  = mysqli_real_escape_string($this->db->link, $id);
        $query  = "SELECT * FROM tbl_product WHERE catId = '$catId'";
        $result = $this->db->select($query);
        return $result;
    }

    public function insertCompareData($cmprId, $cmrId) {
        $customerId = mysqli_real_escape_string($this->db->link, $cmrId);
        $productId   = mysqli_real_escape_string($this->db->link, $cmprId);

        $compareQuery = "SELECT * FROM tbl_compare WHERE cmrId = '$cmrId' AND productId = '$productId'";

        $query = "SELECT * FROM tbl_product WHERE productId = '$productId'";
        $result = $this->db->select($query)->fetch_assoc();
        $check = $this->db->select($compareQuery);
        if ($check) {
            $productMsg = "<div class='alert alert-danger mt-2'>Already Added!</div>";
            return $productMsg;
        }
        if ($result) {
                $productId = $result['productId'];
                $productName = $result['productName'];
                $price = $result['price'];
                $image = $result['image'];

                $query = "INSERT INTO tbl_compare 
                                      (cmrId, productId, productName,  price, image) 
                                      VALUES 
                                      ('$customerId', '$productId', '$productName', '$price', '$image')";
                $insertedRow = $this->db->insert($query);
                if ($insertedRow) {
                    $productMsg = "<div class='alert alert-success mt-2'>Added to compare successfully</div>";
                    return $productMsg;
                } else {
                    $productMsg = "<div class='alert alert-danger mt-2'>Not Added!</div>";
                    return $productMsg;
                }
        }
    }

    public function getComparedData($cmrId) {
        $query = "SELECT * FROM tbl_compare WHERE cmrId = '$cmrId' ORDER BY id DESC ";
        $result = $this->db->select($query);
        return $result;
    }

    public function delComparedDate($cmrId) {
        $delQuery = "DELETE FROM tbl_compare WHERE cmrId = '$cmrId'";
        $delData = $this->db->delete($delQuery);
        if ($delData) {
            $productMsg = "<div class='alert alert-success'>Product deleted successfully</div>";
            return $productMsg;
        } else {
            $productMsg = "<div class='alert alert-danger'>Product not deleted</div>";
            return $productMsg;
        }
    }

    public function saveWlistData($id, $cmrId) {
        $query = "SELECT * FROM tbl_wlist WHERE cmrId = '$cmrId' AND productId = '$id'";
        $check = $this->db->select($query);
        if ($check) {
            $productMsg = "<div class='alert alert-danger mt-2'>Already Added!</div>";
            return $productMsg;
        }

        $productQuery = "SELECT * FROM tbl_product WHERE productId = '$id'";
        $result = $this->db->select($productQuery)->fetch_assoc();
        if ($result) {
                $productId   = $result['productId'];
                $productName = $result['productName'];
                $price       = $result['price'];
                $image       = $result['image'];

                $query = "INSERT INTO tbl_wlist 
                                      (cmrId, productId, productName, price, image) 
                                      VALUES 
                                      ('$cmrId', '$productId', '$productName', '$price', '$image')";
                $insertedRow = $this->db->insert($query);
            if ($insertedRow) {
                $productMsg = "<div class='alert alert-success mt-2'>Added ! Check Wishlist Page successfully</div>";
                return $productMsg;
            } else {
                $productMsg = "<div class='alert alert-danger mt-2'>Not Added!</div>";
                return $productMsg;
            }
        }
    }

    public function checkWlistData($cmrId) {
        $query = "SELECT * FROM tbl_wlist WHERE cmrId = '$cmrId' ORDER BY id DESC ";
        $result = $this->db->select($query);
        return $result;
    }

    public function delWlistData($cmrId, $productId) {
        $delQuery = "DELETE FROM tbl_wlist WHERE cmrId = '$cmrId' AND productId = '$productId'";
        $delData = $this->db->delete($delQuery);
        if ($delData) {
            $productMsg = "<div class='alert alert-success'>Wish List Product deleted successfully</div>";
            return $productMsg;
        } else {
            $productMsg = "<div class='alert alert-danger'>Wish List Product not deleted</div>";
            return $productMsg;
        }
    }
}