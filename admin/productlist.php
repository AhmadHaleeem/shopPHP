<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include "../classes/Product.php"; ?>
<?php include_once "../helpers/Format.php" ?>
<?php
    $product = new Product();
    $fm = new Format();

    if (isset($_GET['delproduct'])) {
        $id = $_GET['delproduct'];
        $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['delproduct']);
        $delProduct = $product->delProductById($id);
    }
?>
<div style="flex: none; max-width: 80%;" class="col-lg-6 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Product List</h4>
            <?php
                if (isset($delProduct)) {
                    echo $delProduct;
                }
            ?>
            <table class="table table-hover table-responsive">
                <thead style="background: #333;color: #fff;">
                <tr>
                    <th>Serial Number</th>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Brand</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Type</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $getProducts = $product->getAllProduct();
                if ($getProducts) {
                    $i = 0;
                    while ($result = $getProducts->fetch_assoc()) {
                        $i++;
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $result['productName']; ?></td>
                            <td><?php echo $result['catName']; ?></td>
                            <td><?php echo $result['brandName']; ?></td>
                            <td><?php echo $fm->textShorten($result['body'], 50); ?></td>
                            <td>$<?php echo $result['price']; ?></td>
                            <td><img style="margin-bottom: -22px;" src="<?php echo $result['image']; ?>" alt="" height="40px" width="60px"> </td>
                            <td>
                                <?php
                                if ($result['type'] == 0) {
                                    echo 'Featured';
                                } else {
                                    echo "General";
                                }
                                ?>
                            </td>
                            <td>
                                <a class="btn btn-gradient-primary btn-sm" href="productedit.php?productid=<?php echo $result['productId']; ?>">Edit</a>
                                <a class="btn btn-gradient-danger btn-sm" onclick="return confirm('Are you sure to delete')" href="?delproduct=<?php echo $result['productId']; ?>">Delete</a>
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


<?php include 'inc/footer.php';?>



