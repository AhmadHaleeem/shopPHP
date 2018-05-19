<?php
    ob_start();
    include 'inc/header.php';
    $login = Session::get('customerLogin');
    if ($login == false) {
        header('Location: login.php');
    }
?>
<style>
    .payment {width:600px;  min-height:250px;  text-align: center;  border:1px solid #ddd;  margin: 0 auto;  padding:50px;
    }
    .payment h2 {border-bottom: 1px solid #ddd;  margin-bottom: 40px;  padding-bottom: 10px;
    }
    .payment p {font-size: 18px;  line-height: 25px;  text-align: left;  }
</style>

<div class="main">
    <div class="content">
        <div class="section group">
            <div class="payment">
                <h2 >Success</h2>
                <?php
                    $cmrId = Session::get('customerId');
                    $amount = $cart->payableAmount($cmrId);
                    if ($amount) {
                        $sum = 0;
                        while($result = $amount->fetch_assoc()) {
                            $price = $result['price'];
                            $sum = $sum + $price;
                        }
                    }
                ?>
                <P>Total Payable Amount (including vat) : <?php $vat = $sum * 0.1; $total = $sum + $vat; echo '<span style="font-weight: bold;" class="text-danger">' . '$' . $total . '</span>'; ?></P>
               <p>Thanks for Purchase. Receive your Order Successfully. We will contact you ASAP with delivery details. Here is your order details... <a href="orderDetails.php">Visit here</a> </p>
            </div>
        </div>
    </div>
</div>

<?php include 'inc/footer.php'; ?>
<?php
ob_end_flush();
?>

