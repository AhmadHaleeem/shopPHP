<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include "../classes/Brand.php"; ?>
<?php include "../classes/Product.php"; ?>
<?php include "../classes/Category.php"; ?>
<?php
    $product = new Product();
    if ($_SERVER['REQUEST_METHOD'] == 'POST' ) {
        $insertProduct = $product->productInsert($_POST, $_FILES);
    }
?>


<div style="width: 100%;" class="card">
    <div class="card-body">
        <?php
            if (isset($insertProduct)) {
                echo $insertProduct;
            }
        ?>
        <h4 class="card-title">Add product</h4>
        <p class="card-description">
        </p>
        <form  method="post" action="productadd.php" enctype="multipart/form-data">
            <div class="form-group">
                <label for="productName">Product Name</label>
                <input name="productName" type="text" class="form-control" id="productName" placeholder="Product Name">
            </div>

            <div class="form-group" >
                <label for="selectCategory">Select Category</label>
                <select id="selectCategory" class="form-control" name="catId">
                    <option>Select Category</option>
                    <?php
                    $category = new Category();
                    $getCats = $category->getAllCat();
                    if ($getCats) {
                        while ($result = $getCats->fetch_assoc()) {

                            ?>
                            <option value="<?php echo $result['catId']; ?>"><?php echo $result['catName']; ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="form-group" >
                <label for="selectBrand">Select Brand</label>
                <select id="selectBrand" class="form-control" name="brandId">
                    <option>Select Brand</option>
                    <?php
                    $brand = new Brand();
                    $getBrands = $brand->getAllBrand();
                    if ($getBrands) {
                        while ($result = $getBrands->fetch_assoc()) {

                            ?>
                            <option value="<?php echo $result['brandId']; ?>"><?php echo $result['brandName']; ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="exampleTextarea1">Description</label>
                <textarea name="body" class="form-control" id="exampleTextarea1" rows="7"></textarea>
            </div>

            <div class="form-group">
                <label for="price">Price</label>
                <input id="price" name="price" type="text" class="form-control"  placeholder="Price">
            </div>

            <div class="form-group">
                <label>File upload</label>
                <input type="file" name="img[]" class="file-upload-default">
                <div class="input-group col-xs-12">
                    <input name="image" type="file" class="form-control file-upload-info"  placeholder="Upload Image">
                </div>
            </div>

            <div class="form-group" >
                <label for="type">Select Type</label>
                <select id="type" class="form-control" name="type">
                    <option>Select Type</option>
                    <option value="0">Featured</option>
                    <option value="1">General</option>
                </select>
            </div>

            <input type="submit" class="btn btn-gradient-primary mr-2" value="Submit">
        </form>
    </div>
</div>

<?php include 'inc/footer.php';?>





