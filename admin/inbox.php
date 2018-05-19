<?php ob_start(); ?>
<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php
    $filePath = realpath(dirname(__FILE__));
    include ($filePath . '/../classes/Cart.php');
    $cart = new Cart();
    $fm = new Format();
?>

<?php
    if (isset($_GET['shiftId'])) {
        $id = $_GET['shiftId'];
        $date = $_GET['date'];
        $price = $_GET['price'];
        $shift = $cart->productShifted($id, $date, $price);
    }

    if (isset($_GET['delProductId'])) {
        $id = $_GET['delProductId'];
        $date = $_GET['date'];
        $price = $_GET['price'];
        $delOrder = $cart->delProductShifted($id, $date, $price);
    }
?>

    <div style="width: 100%">
        <div>
            <h2>Inbox</h2>
            <div class="block">
                <?php
                if (isset($shift)) {
                    echo $shift;
                }

                if (isset($delOrder)) {
                    echo $delOrder;
                }
                ?>
                <table class="table table-hover table-responsive" id="example" style="width: 100%;display: table;text-align: center">
                    <thead style="background: #333;color: #fff;">
                    <tr>
                        <th>ID</th>
                        <th>Order Time</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Customer ID</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        $cart = new Cart();
                        $fm = new Format();
                        $getOrder = $cart->getAllOrderProduct();
                        if ($getOrder) {
                            while ($result = $getOrder->fetch_assoc()) {
                    ?>
                        <tr>
                            <td><?php echo $result['cmrId']; ?></td>
                            <td><?php echo $fm->formatDate($result['date']); ?></td>
                            <td><?php echo $result['productName']; ?></td>
                            <td><?php echo $result['quantity']; ?></td>
                            <td>$<?php echo $result['price']; ?></td>
                            <td><?php echo $result['cmrId']; ?></td>
                            <td><a class="btn btn-gradient-warning btn-sm" href="customer.php?custId=<?php echo $result['cmrId']; ?>">View Details</a> </td>
                            <td>
                                <?php
                                    if ($result['status'] == '0') { ?>
                                        <a class="btn btn-gradient-info btn-sm" href="?shiftId=<?php echo $result['cmrId']; ?>&price=<?php echo $result['price']; ?>&date=<?php echo $result['date']; ?>">Shifted</a>
                                   <?php } elseif($result['status'] == '1') { ?>
                                        <a class="btn btn-gradient-dark btn-sm" href="">Pending</a>
                                    <?php } else { ?>
                                        <a class="btn btn-gradient-danger btn-sm" href="?delProductId=<?php echo $result['cmrId']; ?>&price=<?php echo $result['price']; ?>&date=<?php echo $result['date']; ?>">Delete</a>

                                   <?php }
                                ?>

                            </td>
                        </tr>
                    <?php
                            }
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>




<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();

        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
<?php ob_end_flush(); ?>
