<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include "../classes/Brand.php"; ?>
<?php
    $brand = new Brand();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $brandName = $_POST['brandName'];
        $insertBrand = $brand->brandInsert($brandName);
    }
?>
        <div style="width: 100%">
            <div class="">
                <h2>Add New Brand</h2>
               <div class="block copyblock">
                   <?php
                        if (isset($insertBrand)) {
                            echo $insertBrand;
                        }
                   ?>
                 <form action="brandadd.php" method="post" >
                    <div class="form-group">
                        <input id="brandName" type="text"  name="brandName" placeholder="Enter Brand Name..." class="form-control" />
                    </div>
                    <input type="submit" class="btn btn-gradient-primary mr-2" value="Submit">
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>