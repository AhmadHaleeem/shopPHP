<?php ob_start(); ?>
<?php include 'inc/header.php'; ?>
<?php include 'inc/slider.php'; ?>
<?php
    $login = Session::get('customerLogin');
    if ($login == false) {
        header('Location: login.php');
    }

    if(isset($_GET['delWlistId'])) {
        $productId = $_GET['delWlistId'];
        $delWList = $product->delWlistData($cmrId, $productId);
    }
?>
 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Wlist Product</h2>
                    <?php

                        if (isset($delWList)) {
                            echo $delWList;
                        }
                    ?>
						<table class="tblone">
							<tr>
								<th>SL</th>
								<th>Product Name</th>
								<th>Price</th>
                                <th>Image</th>
								<th>Action</th>
							</tr>
                            <?php
                                $getWlist = $product->checkWlistData($cmrId);
                                if ($getWlist) {
                                    $i = 0;
                                    while ($result = $getWlist->fetch_assoc()) {
                                    $i++;
                            ?>
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $result['productName']; ?></td>
                                <td>$<?php echo $result['price']; ?></td>
								<td><img style="width: 80px;height: 65px" src="admin/<?php echo $result['image']; ?>" alt="<?php echo $result['productName']; ?>"/></td>
                                <td>
                                    <a class="btn btn-success btn-sm" href="preview.php?proid=<?php echo $result['productId']; ?>">Buy Now</a>
                                    <a class="btn btn-danger btn-sm" href="?delWlistId=<?php echo $result['productId']; ?>">Remove</a>
                                </td>
							</tr>
                            <?php
                                    }
                                }
                            ?>
                        </table>

					</div>
					<div class="shopping">
						<div class="shopleft" style="width: 100%;text-align: center">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
</div>
<?php include 'inc/footer.php'; ?>
<?php ob_end_flush(); ?>
