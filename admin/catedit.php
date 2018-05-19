<?php  ob_start(); ?>
<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include "../classes/Category.php"; ?>
<?php
    if (!isset($_GET['catid']) && $_GET['catid'] == NULL) {
        echo "<script>window.location = 'catlist.php';</script>";
    } else {
        $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['catid']);
    }
    $cat = new Category();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $catName = $_POST['catName'];
        $updateCat = $cat->catUpdate($catName, $id);
    }
?>
        <div style="width:100%;">
            <div>
                <h2>Update Category</h2>
               <div class="block copyblock">
                   <?php
                        if (isset($updateCat)) {
                            echo $updateCat;
                        }

                        $getCat = $cat->getCatById($id);
                        if ($getCat) {
                            while ($result = $getCat->fetch_assoc()) {
                   ?>
                 <form action="" method="post">
                    <div class="form-group">
                        <input type="text" name="catName" placeholder="Enter Category Name..." class="form-control" value="<?php echo $result['catName']; ?>"/>
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
