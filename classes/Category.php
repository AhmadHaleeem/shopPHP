<?php
    $filePath = realpath(dirname(__FILE__));
    include_once ($filePath . "/../lib/Database.php");
    include_once ($filePath . "/../helpers/Format.php");
// Category Class

class Category {
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function catInsert($catName) {
        $catName = $this->fm->validation($catName);
        $catName = mysqli_real_escape_string($this->db->link, $catName);

        if (empty($catName)) {
            $catMsg = "<div class='alert alert-error'>Category field must not be empty</div>";
            return $catMsg;
        } else {
            $query = "INSERT INTO tbl_category (catName) VALUES ('$catName')";
            $catInsert = $this->db->insert($query);
            if ($catInsert) {
                $catMsg = "<div class='alert alert-success'>Category inserted successfully</div>";
                return $catMsg;
            } else {
                $catMsg = "<div class='alert alert-danger'>Category not inserted</div>";
                return $catMsg;
            }
        }
    }

    public function getAllCat() {
        $query = "SELECT * FROM tbl_category ORDER BY catId DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function getCatById($id) {
        $query = "SELECT * FROM tbl_category WHERE catId = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function catUpdate($catName, $id) {
        $catName = $this->fm->validation($catName);
        $catName = mysqli_real_escape_string($this->db->link, $catName);
        $id = mysqli_real_escape_string($this->db->link, $id);

        if (empty($catName)) {
            $catMsg = "<span class='alert alert-error'>Category field must not be empty</span>";
            return $catMsg;
        } else {
            $query = "UPDATE tbl_category SET catName = '$catName' WHERE catId = '$id'";
            $updated_row = $this->db->update($query);
            if ($updated_row) {
                $catMsg = "<div class='alert alert-success'>Category updated successfully</div>";
                return $catMsg;
            } else {
                $catMsg = "<div class='alert alert-danger'>Category not updated</div>";
                return $catMsg;
            }
        }
    }

    public function delCatById($id) {
        $query = "DELETE FROM tbl_category WHERE catId = '$id'";
        $delData = $this->db->delete($query);
        if ($delData) {
            $catMsg = "<div class='alert alert-success'>Category deleted successfully</div>";
            return $catMsg;
        } else {
            $catMsg = "<div class='alert alert-danger'>Category not deleted</div>";
            return $catMsg;
        }
    }

}
