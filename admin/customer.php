<?php  ob_start(); ?>
<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
    $filePath = realpath(dirname(__FILE__));
    include ($filePath . '/../classes/Customer.php');
?>

<?php
    if (!isset($_GET['custId']) && $_GET['custId'] == NULL) {
        echo "<script>window.location = 'inbox.php';</script>";
    } else {
        $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['custId']);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        echo "<script>window.location = 'inbox.php';</script>";
    }
?>
<style>input {font-size:16px !important;}label {font-size: 18px!important;}</style>
<div style="max-width:80%;width: 60%;">
    <div>
        <h2>Customer Details</h2>
        <div class="block copyblock">
            <?php
            if (isset($updateCat)) {
                echo $updateCat;
            }
            $customer = new Customer();
            $getCustomer = $customer->getCustomerData($id);
            if ($getCustomer) {
                while ($result = $getCustomer->fetch_assoc()) {
                    ?>
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input id="name" type="text" readonly  class="form-control" value="<?php echo $result['name']; ?>"/>
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input id="address" type="text" readonly  class="form-control" value="<?php echo $result['address']; ?>"/>
                        </div>
                        <div class="form-group">
                            <label for="city">City</label>
                            <input id="city" type="text" readonly  class="form-control" value="<?php echo $result['city']; ?>"/>
                        </div>
                        <div class="form-group">
                            <label for="country">Country</label>
                            <input id="country" type="text" readonly  class="form-control" value="<?php echo $result['country']; ?>"/>
                        </div>
                        <div class="form-group">
                            <label for="zip">ZipCode</label>
                            <input id="zip" type="text" readonly  class="form-control" value="<?php echo $result['zip']; ?>"/>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input id="phone" type="text" readonly  class="form-control" value="<?php echo $result['phone']; ?>"/>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" type="text" readonly  class="form-control" value="<?php echo $result['email']; ?>"/>
                        </div>
                        <input type="submit" name="submit" Value="Ok" class="btn btn-gradient-primary mr-2"/>
                    </form>
                    <?php
                }
            }
            ?>
        </div>
    </div>
</div>
<?php include 'inc/footer.php';?>
<?php  ob_end_flush(); ?>
