<?php
ob_start();
    include 'inc/header.php';
    $login = Session::get('customerLogin');
    if ($login == false) {
        header('Location: login.php');
    }
    $id = Session::get('customerId');
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
        $updateProfile = $cmr->customerUpdate($_POST, $id);
    }
?>

<style>
    .tblone {
        width:500px;
        margin:0 auto;
        border:2px solid #ddd;
    }
    .tblone tr td{
        text-align: justify;
    }
    .tblone input[type='text'] {
        width: 400px;
        padding:5px;
        font-size:15px;
    }
</style>
<div class="main">
    <div class="content">
        <div class="section group">
            <?php
            $id = Session::get('customerId');
            $getData = $cmr->getCustomerData($id);
            if ($getData) {
                while ($result = $getData->fetch_assoc()) {
                    ?>
                    <form action="" method="post">
                        <table class="tblone">
                            <?php
                                if (isset($updateProfile)) {
                                    echo "<tr><td colspan='2'>" . $updateProfile ."</td> </tr>";
                                }
                            ?>
                            <tr>
                                <td colspan="3">
                                    <h2>Update Profile Details</h2>
                                </td>
                            </tr>
                            <tr>
                                <td width="20%">Name</td>
                                <td width=""><input type="text" name="name" value="<?php echo $result['name']; ?>" /> </td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td><input type="text" name="email" value="<?php echo $result['email']; ?>" /> </td>
                            </tr>
                            <tr>
                                <td>Phone</td>
                                <td><input type="text" name="phone" value="<?php echo $result['phone']; ?>" /> </td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td><input type="text" name="address" value="<?php echo $result['address']; ?>" /> </td>
                            </tr>
                            <tr>
                                <td>City</td>
                                <td><input type="text" name="city" value="<?php echo $result['city']; ?>" /> </td>
                            </tr>
                            <tr>
                                <td>Zip</td>
                                <td><input type="text" name="zip" value="<?php echo $result['zip']; ?>" /> </td>
                            </tr>
                            <tr>
                                <td>Country</td>
                                <td><input type="text" name="country" value="<?php echo $result['country']; ?>" /> </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <input type="submit" name="update" value="Save"/>
                                </td>

                            </tr>
                        </table>
                        <?php
                             }
                        }
                        ?>
                    </form>

        </div>
    </div>
</div>

<?php include 'inc/footer.php'; ?>
<?php
ob_end_flush();
?>

