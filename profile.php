<?php
ob_start();
include 'inc/header.php';
    $login = Session::get('customerLogin');
    if ($login == false) {
        header('Location: login.php');
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

<?php include 'inc/footer.php'; ?>
<?php
ob_end_flush();
?>

