<?php  ob_start(); ?>
<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include "../classes/Brand.php"; ?>
<?php
    if (!isset($_GET['brandid']) && $_GET['brandid'] == NULL) {
        echo "<script>window.location = 'brandlist.php';</script>";
    } else {
        $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['brandid']);
    }
    $brand = new Brand();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $brandName = $_POST['brandName'];
        $updateBrand = $brand->brandUpdate($brandName, $id);
    }
?>
        <div style="width:100%;">
            <div>
                <h2>Update Brand</h2>
               <div class="block copyblock">
                   <?php
                        if (isset($updateBrand)) {
                            echo $updateBrand;
                        }

                        $getBrand = $brand->getBrandById($id);
                        if ($getBrand) {
                            while ($result = $getBrand->fetch_assoc()) {
                   ?>
                 <form action="" method="post">
                    <div class="form-group">
                        <input type="text" name="brandName" placeholder="Enter Category Name..." class="form-control" value="<?php echo $result['brandName']; ?>"/>
                    </div>

                        <input type="submit" name="submit" Value="Update" class="btn btn-gradient-primary mr-2"/>

                    </form>
                    <?php
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>
<?php  ob_end_flush(); ?>
