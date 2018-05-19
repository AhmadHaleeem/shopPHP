<?php include 'inc/header.php'; ?>
<?php
    $login = Session::get('customerLogin');
    if ($login == false) {
        header('Location: login.php');
    }

    if (isset($_GET['customerId'])) {
        $id = $_GET['customerId'];
        $date = $_GET['date'];
        $price = $_GET['price'];
        $confirm = $cart->productconfirmed($id, $date, $price);
    }
?>
<style>
    .tblone {
        text-align: justify;
    }
</style>
<div class="main">
    <div class="content">
        <div class="section group">
            <div class="order">
                <h2>Your Ordered Details</h2>
                <table class="tblone">
                    <tr>
                        <th>No</th>
                        <th>Product Name</th>
                        <th>Image</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    $cmrId = Session::get('customerId');
                    $getOrder = $cart->getOrderProduct($cmrId);
                    if ($getOrder) {
                        $i = 0;
                        while ($result = $getOrder->fetch_assoc()) {
                            $i++;
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $result['productName']; ?></td>
                                <td><img src="admin/<?php echo $result['image']; ?>" alt="<?php echo $result['productName']; ?>"/></td>
                                <td><?php echo $result['quantity']; ?></td>
                                <td>
                                    $<?php
                                        echo $result['price'];
                                    ?>
                                </td>
                                <td><?php echo $fm->formatDate($result['date']); ?></td>
                                <td>
                                    <?php
                                        if ($result['status'] == '0') {
                                            echo '<span class="bg-warning p-2 text-white">Pending</span>';
                                        } elseif ($result['status'] == '1') { ?>
                                                <span class="bg-secondary p-2 text-white">
                                                    Shifted
                                                </span>
                                      <?php  } else {
                                            echo '<span class="bg-info p-2 text-white">Ok</span>';
                                        }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        if ($result['status'] == '1') { ?>
                                            <a class="bg-success p-2 text-white" href="?customerId=<?php echo $cmrId; ?>&price=<?php echo $result['price']; ?>&date=<?php echo $result['date']; ?>">Confirm</a>
                                        <?php } elseif ($result['status'] == '2')  {
                                            echo '<span class="bg-info p-2 text-white">Ok</span>';
                                        }  elseif ($result['status'] == '0') {
                                            echo '<span class="bg-primary p-2 text-white">Pending</span>';
                                        }
                                    ?>
                                </td>
                            </tr>
                        <?php
                        }
                    }
                    ?>
                </table>
            </div>
        </div>
        <div class="clear">

        </div>
    </div>
</div>

<?php include 'inc/footer.php'; ?>


