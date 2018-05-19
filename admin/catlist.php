<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include "../classes/Category.php"; ?>
<?php
    $cat = new Category();
    if (isset($_GET['delcat'])) {
        $id = $_GET['delcat'];
        $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['delcat']);
        $delCat = $cat->delCatById($id);
    }
?>
        <div style="width: 100%">
            <div>
                <h2>Category List</h2>
                <div class="block">
                    <?php
                        if (isset($delCat)) {
                            echo $delCat;
                        }
                    ?>
                    <table class="table table-hover table-responsive" id="example" style="width: 100%;display: table;">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Category Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
                    <?php
                        $cats = $cat->getAllCat();
                        if ($cats) {
                            $i = 0;
                            while($result = $cats->fetch_assoc()) {
                                $i++;
                    ?>
						<tr class="even gradeC">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['catName']; ?> </td>
							<td>
                                <a class="btn btn-gradient-info btn-sm" href="catedit.php?catid=<?php echo $result['catId']; ?>">Edit</a>
                                <a class="btn btn-gradient-danger btn-sm" onclick="return confirm('Are you sure to delete')" href="?delcat=<?php echo $result['catId']; ?>">Delete</a>
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
<script type="text/javascript">
	$(document).ready(function () {
	    setupLeftMenu();

	    $('.datatable').dataTable();
	    setSidebarHeight();
	});
</script>
<?php include 'inc/footer.php';?>

