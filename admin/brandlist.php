<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include "../classes/Brand.php"; ?>
<?php
    $brand = new Brand();
    if (isset($_GET['delbrand'])) {
        $id = $_GET['delbrand'];
        $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['delbrand']);
        $delBrand = $brand->delBrandById($id);
    }
?>
        <div style="width:100%;">
            <div>
                <h2>Brand List</h2>
                <div class="block">
                    <?php
                        if (isset($delBrand)) {
                            echo $delBrand;
                        }
                    ?>
                    <table class="table table-hover table-responsive" id="example" style="width: 100%;display: table;">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Brand Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
                    <?php
                        $brands = $brand->getAllBrand();
                        if ($brands) {
                            $i = 0;
                            while($result = $brands->fetch_assoc()) {
                                $i++;
                    ?>
						<tr class="even gradeC">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['brandName']; ?> </td>
							<td>
                                <a class="btn btn-gradient-info btn-sm" href="brandedit.php?brandid=<?php echo $result['brandId']; ?>">Edit</a>
                                <a class="btn btn-gradient-danger btn-sm" onclick="return confirm('Are you sure to delete')" href="?delbrand=<?php echo $result['brandId']; ?>">Delete</a>
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

