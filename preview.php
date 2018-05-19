<?php
ob_start();
?>
<?php
    include  'inc/header.php';
    include 'inc/slider.php';

    if (isset($_GET['proid'])) {
        $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['proid']);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        $quantity = $_POST['quantity'];
        $addCart = $cart->addToCart($quantity, $id);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['compare'])) {
        $productId = $_POST['productId'];
        $insertCompare = $product->insertCompareData($id, $cmrId);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['wlist'])) {
        $saveWlist = $product->saveWlistData($id, $cmrId);
    }
?>
<style>
    .myButton {
        width:100px;
        float: left;
        margin-right:50px;
    }
</style>
 <div class="main">
    <div class="content">
    	<div class="section group">
				<div class="cont-desc span_1_of_2">
                    <?php
                        $getProduct = $product->getSingleProduct($id);
                        if ($getProduct) {
                            while($result = $getProduct->fetch_assoc()) {
                    ?>
					<div class="grid images_3_of_2">
						<img src="admin/<?php echo $result['image']; ?>" alt="" />
					</div>
				<div class="desc span_3_of_2">
					<h2><?php echo $result['productName']; ?>t </h2><div class="price">
						<p>Price: <span>$<?php echo $result['price']; ?></span></p>
						<p>Category: <span><?php echo $result['catName']; ?></span></p>
						<p>Brand:<span><?php echo $result['brandName']; ?></span></p>
					</div>

				<div class="add-cart">
					<form action="" method="post">
						<input type="number" class="buyfield" name="quantity" value="1"/>
						<input type="submit" class="buysubmit" name="submit" value="Buy Now"/>
					</form>


				</div>

                <?php
                    if (isset($addCart)) {
                        echo $addCart;
                    }
                if (isset($insertCompare)) {
                    echo $insertCompare;
                }

                if (isset($saveWlist)) {
                        echo $saveWlist;
                }
                ?>
                 <?php
                        $login = Session::get('customerLogin');
                        if ($login == true) {
                    ?>
                <div class="add-cart">
                    <div class="myButton">
                        <form action="" method="post">
                            <input type="hidden" class="buyfield" name="productId" value="<?php echo $result['productId']; ?>"/>
                            <input type="submit" class="buysubmit" name="compare" value="Add to compare">
                        </form>
                    </div>
                    <div class="myButton">
                        <form action="" method="post">
                            <input type="submit" class="buysubmit" name="wlist" value="Save to list">
                        </form>
                    </div>
                <?php } ?>
                </div>
			</div>
			<div class="product-desc">
			<h2>Product Details</h2>
                <p>
                    <?php echo $result['body']; ?>
                </p>
	    </div>
			<?php
                }
            }
            ?>
	</div>
    <div class="rightsidebar span_3_of_1">
        <h2>CATEGORIES</h2>
        <ul>
            <?php
            $getCats = $cat->getAllCat();
            if ($getCats) {
                while ($result = $getCats->fetch_assoc()) {
                    ?>
                    <li><a href="productbycat.php?catId=<?php echo $result['catId']; ?>"><?php echo $result['catName']; ?></a></li>
                    <?php
                }
            }
            ?>
        </ul>

    </div>
 		</div>
 	</div>
	</div>

<?php include 'inc/footer.php'; ?>
<?php
    ob_end_flush();
?>
