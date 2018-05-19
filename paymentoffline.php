<?php
    ob_start();
    include 'inc/header.php';
    $login = Session::get('customerLogin');
    if ($login == false) {
        header('Location: login.php');
    }

    if (isset($_GET['orderId']) && $_GET['orderId'] == 'order') {
        $customerId = Session::get('customerId');
        $insertOrderData = $cart->orderProduct($customerId);
        $deleteData = $cart->delCustomerCart();
        header('Location: success.php');
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
    .division {
        width: 50%;
        float:left;
    }
    .tabletwo {
        float: right;text-align: left;
        width:60%;
        border:2px solid #ddd;
        margin-right:56px;
        margin-top:12px;
    }
    .tabletwo tr td {
        text-align: justify;
        padding:5px 10px;
    }
    .orderNow a {
        width: 200px;
        margin:20px auto 0;
        text-align: center;
        padding: 5px;
        font-size: 30px;
        display: block;
        background: crimson;
        color: #fff;
        border:1px solid #ccc;
        text-decoration:none;
        margin-bottom: 10px;
    }

</style>
<div class="main">
    <div class="content">
        <div class="section group">
           <div class="division">
               <table class="tblone">
                   <tr>
                       <th>NO</th>
                       <th>Product</th>
                       <th>Price</th>
                       <th>Quantity</th>
                       <th>Total</th>
                   </tr>
                   <?php
                   $getProduct = $cart->getCartProduct();
                   if ($getProduct) {
                       $i = 0;
                       $sum = 0;
                       $qty = 0;
                       while ($result = $getProduct->fetch_assoc()) {
                           $i++;
                           ?>
                           <tr>
                               <td><?php echo $i; ?></td>
                               <td><?php echo $result['productName']; ?></td>
                               <td>$<?php echo $result['price']; ?></td>
                               <td><?php echo $result['quantity']; ?></td>
                               <td>
                                   $<?php
                                   $total = $result['price'] * $result['quantity'];
                                   echo $total;
                                   ?>
                               </td>
                           </tr>
                           <?php
                           $qty = $qty + $result['quantity'];
                           $sum = $sum + $total
                           ?>
                           <?php
                       }
                   }
                   ?>

               </table>

               <table class="tabletwo" style="float:right;text-align:left;" width="40%">
                   <tr>
                       <td>Sub Total</td>
                       <td>:</td>
                       <td>$<?php echo $sum; ?></td>
                   </tr>
                   <tr>
                       <td>VAT</td>
                       <td>:</td>
                       <td>10% ($<?php echo $vat = $sum * 0.1; ?>)</td>
                   </tr>
                   <tr>
                       <td>Grand Total</td>
                       <td>:</td>
                       <td>
                           <?php
                           $vat = $sum * 0.1;
                           $gTotal = $sum + $vat;
                           echo '$' .$gTotal;
                           ?>
                       </td>
                   </tr>
                   <tr>
                       <td>Quantity</td>
                       <td>:</td>
                       <td><?php echo $qty; ?></td>
                   </tr>
               </table>
           </div>
            <div class="division">
                <?php
                $id = Session::get('customerId');
                $getData = $cmr->getCustomerData($id);
                if ($getData) {
                    while ($result = $getData->fetch_assoc()) {
                        ?>
                        <table class="tblone">
                            <tr>
                                <td colspan="3">
                                    <h2>Your Profile Details</h2>
                                </td>
                            </tr>
                            <tr>
                                <td width="20%">Name</td>
                                <td width="5%">:</td>
                                <td width=""><?php echo $result['name']; ?></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>:</td>
                                <td><?php echo $result['email']; ?></td>
                            </tr>
                            <tr>
                                <td>Phone</td>
                                <td>:</td>
                                <td><?php echo $result['phone']; ?></td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td>:</td>
                                <td><?php echo $result['address']; ?></td>
                            </tr>
                            <tr>
                                <td>City</td>
                                <td>:</td>
                                <td><?php echo $result['city']; ?></td>
                            </tr>
                            <tr>
                                <td>Zip</td>
                                <td>:</td>
                                <td><?php echo $result['zip']; ?></td>
                            </tr>
                            <tr>
                                <td>Country</td>
                                <td>:</td>
                                <td><?php echo $result['country']; ?></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <a href="profileEdit.php">Edit Details</a>
                                </td>
                            </tr>
                        </table>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <div class="orderNow">
        <a href="?orderId=order">Order</a>
    </div>
</div>

<?php include 'inc/footer.php'; ?>
<?php
ob_end_flush();
?>

