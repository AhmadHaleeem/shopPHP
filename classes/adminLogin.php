<?php
    $filePath = realpath(dirname(__FILE__));
    include ($filePath . "/../lib/Session.php");
    Session::checkLogin();
    include_once ($filePath . "/../lib/Database.php");
    include_once ($filePath . "/../helpers/Format.php");
//    Admin Login class
class Adminlogin {
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function adminLogin($adminUser, $adminPass) {
        $adminUser = $this->fm->validation($adminUser);
        $adminPass = $this->fm->validation($adminPass);

        $adminUser = mysqli_real_escape_string($this->db->link, $adminUser);
        $adminPass = mysqli_real_escape_string($this->db->link, $adminPass);
        if (empty($adminUser) || empty($adminPass)) {
            $loginMsg = '<div class="alert alert-danger">Username or Password must not be empty</div>';
            return $loginMsg;
        } else {
            $query = "SELECT * FROM tbl_admin WHERE adminUser = '$adminUser' AND adminPass = '$adminPass'";
            $result = $this->db->select($query);
            var_dump($result);
            if ($result != false) {
                $value = $result->fetch_assoc();
                Session::set('adminlogin', true);
                Session::set('adminId', $value['adminId']);
                Session::set('adminUser', $value['adminUser']);
                Session::set('adminName', $value['adminName']);
               header('Location: dashboard.php');
            }else {
                $loginMsg = '<div class="alert alert-danger">Username or Password not match</div>';
                return $loginMsg;
            }
        }
    }


}

?>