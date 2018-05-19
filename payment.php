<?php
ob_start();
include 'inc/header.php';
$login = Session::get('customerLogin');
if ($login == false) {
    header('Location: login.php');
}
?>

<style>
    .payment {
        width:600px;
        min-height:250px;
        text-align: center;
        border:1px solid #ddd;
        margin: 0 auto;
        padding:50px;
    }
    .payment h2 {
        border-bottom: 1px solid #ddd;
        margin-bottom: 40px;
        padding-bottom: 10px;
    }
    .payment a {
        background: #ff0000 none repeat scroll 0 0;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
        color: #fff;
        font-size: 21px;
        padding: 5px 30px;
        text-decoration: none;
    }
    .back a{
        width: 160px;
        margin:5px auto 0;
        padding-bottom: 7px;
        padding-top: 7px;
        text-align: center;
        display: block;
        background: #555;
        border:1px solid #333;
        color: #fff;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
        text-decoration: none;
    }
</style>
<div class="main">
    <div class="content">
        <div class="section group">
            <div class="payment">
                <h2>Choose Payment Option</h2>
                <a href="paymentoffline.php">Offline Payment</a>
                <a href="paymentonline.php">Online Payment</a>
            </div>
            <div class="back">
                <a href="cart.php">Previous</a>
            </div>
        </div>
    </div>
</div>

<?php include 'inc/footer.php'; ?>
<?php
ob_end_flush();
?>

