<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include "../classes/Category.php"; ?>
<?php
    $cat = new Category();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $catName = $_POST['catName'];
        $insertCat = $cat->catInsert($catName);
    }
?>
        <div style="width: 100%">
            <div class="box round first grid">
                <h2>Add New Category</h2>
               <div class="block copyblock">
                   <?php
                        if (isset($insertCat)) {
                            echo $insertCat;
                        }
                   ?>
                 <form action="catadd.php" method="post">
                    <div class="form-group">
                        <input type="text" name="catName" placeholder="Enter Category Name..." class="form-control"  />
                    </div>
                    <input type="submit" class="btn btn-gradient-primary mr-2" value="Submit">
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>