<?php
    $filePath = realpath(dirname(__FILE__));
    include_once ($filePath . "/../lib/Database.php");
    include_once ($filePath . "/../helpers/Format.php");

class Brand {
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function brandInsert($brandName) {
        $brandName = $this->fm->validation($brandName);
        $brandName = mysqli_real_escape_string($this->db->link, $brandName);

        if (empty($brandName)) {
            $brandMsg = "<div class='alert alert-danger'>Category field must not be empty</div>";
            return $brandMsg;
        } else {
            $query = "INSERT INTO tbl_brand (brandName) VALUES ('$brandName')";
            $brandInsert = $this->db->insert($query);
            if ($brandInsert) {
                $brandMsg = "<div class='alert alert-success'>Brand inserted successfully</div>";
                return $brandMsg;
            } else {
                $brandMsg = "<div class='alert alert-danger'>Brand not inserted</div>";
                return $brandMsg;

            }
        }
    }

    public function getBrandById($id) {
        $query = "SELECT * FROM tbl_brand WHERE brandId = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function getAllBrand() {
        $query = "SELECT * FROM tbl_brand ORDER BY brandId DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function delBrandById($id) {
        $query = "DELETE FROM tbl_brand WHERE brandId = '$id'";
        $delData = $this->db->delete($query);
        if ($delData) {
            $brandMsg = "<div class='alert alert-success'>Brand deleted successfully</div>";
            return $brandMsg;
        } else {
            $brandMsg = "<div class='alert alert-danger'>Brand not deleted</div>";
            return $brandMsg;
        }
    }

    public function brandUpdate($brandName, $id) {
        $brandName = $this->fm->validation($brandName);
        $brandName = mysqli_real_escape_string($this->db->link, $brandName);
        $id = mysqli_real_escape_string($this->db->link, $id);

        if (empty($brandName)) {
            $brandMsg = "<span class='alert alert-danger'>Brand field must not be empty</span>";
            return $brandMsg;
        } else {
            $query = "UPDATE tbl_brand SET brandName = '$brandName' WHERE brandId = '$id'";
            $updated_row = $this->db->update($query);
            if ($updated_row) {
                $brandMsg = "<div class='alert alert-success'>Brand updated successfully</div>";
                return $brandMsg;
            } else {
                $brandMsg = "<div class='alert alert-danger'>Brand not updated</div>";
                return $brandMsg;
            }
        }
    }
}