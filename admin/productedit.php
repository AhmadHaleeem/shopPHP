<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include "../classes/Brand.php"; ?>
<?php include "../classes/Product.php"; ?>
<?php include "../classes/Category.php"; ?>
<?php
    if (!isset($_GET['productid']) && $_GET['productid'] == NULL) {
        echo "<script>window.location = 'productlist.php';</script>";
    } else {
        $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['productid']);
    }
    $product = new Product();
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        $updateProduct = $product->productUpdate($_POST, $_FILES, $id);
    }
?>
<div style="width:90%;margin-left: 20px">
    <div >
        <h2>Edit Product</h2>
        <div class="block">
            <?php
                if (isset($updateProduct)) {
                    echo $updateProduct;
                }
            ?>
            <?php
                $getProduct = $product->getProductById($id);
                if ($getProduct) {
                    while($myProduct = $getProduct->fetch_assoc()) {
            ?>
         <form action="" method="post" enctype="multipart/form-data" style="width: 90%;">

                        <label>Name</label>

                        <div class="form-group">
                            <input type="text" name="productName" placeholder="Enter Product Name..." class="form-control"  value="<?php echo $myProduct['productName']; ?>"/>
                        </div>


                        <label>Category</label>

                        <div class="form-group">

                        <select id="select" name="catId" class="form-control">
                            <option>Select Category</option>
                            <?php
                                $category = new Category();
                                $getCats = $category->getAllCat();
                                if ($getCats) {
                                    while ($result = $getCats->fetch_assoc()) {

                            ?>
                            <option
                                    <?php
                                        if ($myProduct['catId'] == $result['catId']) { ?>
                                            selected = "selected"
                                       <?php } ?>
                                    value="<?php echo $result['catId']; ?>"><?php echo $result['catName']; ?>
                                   <?php  ?>

                            </option>
                            <?php
                                    }
                                }
                            ?>
                        </select>
                        </div>

                        <label>Brand</label>

                        <div class="form-group">

                        <select id="select" name="brandId" class="form-control">
                            <option>Select Brand</option>
                            <?php
                            $brand = new Brand();
                            $getBrands = $brand->getAllBrand();
                            if ($getBrands) {
                                while ($result = $getBrands->fetch_assoc()) { ?>
                                    <option
                                    <?php
                                    if ($myProduct['brandId'] == $result['brandId']) { ?>
                                        selected = "selected"
                                    <?php } ?>
                                    value="<?php echo $result['brandId']; ?>"><?php echo $result['brandName']; ?>
                                    <?php  ?>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                        </div>


                        <label>Description</label>


                        <div class="form-group">
                            <textarea rows="7" class="form-control" name="body"><?php echo $myProduct['body']; ?></textarea>
                        </div>

                        <label>Price</label>

                        <div class="form-group">
                        <input type="text" placeholder="Enter Price..." class="form-control" name="price" value="<?php echo $myProduct['price']; ?>"/>
                        </div>

                        <label>Upload Image</label>

                        <div class="form-group">
                         <img src="<?php echo $myProduct['image']; ?>" alt="" height="120px" width="200px"><br>
                         <input type="file" name="image" class="form-control"/>
                        </div>


                        <label>Product Type</label>

                        <div class="form-group">
                        <select id="select" name="type" class="form-control">
                            <option>Select Type</option>
                            <?php
                                if ($myProduct['type'] == 0) { ?>
                                    <option selected value="0">Featured</option>
                                    <option  value="1">General</option>
                               <?php } else { ?>
                                    <option  value="0">Featured</option>
                                    <option selected value="1">General</option>
                               <?php }
                            ?>
                        </select>
                        </div>

                        <input type="submit" name="submit" Value="Save"  class="btn btn-gradient-primary mr-2"/>

            </form>
            <?php
                    }
                }
            ?>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>


