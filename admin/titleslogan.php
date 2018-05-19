<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<div style="width: 70%;">
    <div>
        <h2>Update Site Title and Description</h2>
        <div>
         <form>
            <div class="form-group">
                <label>Website Title</label>
                <input type="text" placeholder="Enter Website Title..."  name="title" class="form-control" />
            </div>
            <div class="form-group">
                <label>Website Slogan</label>
                <input type="text" placeholder="Enter Website Slogan..." name="slogan" class="form-control" />
            </div>
            <input type="submit" name="submit" Value="Update" class="btn btn-gradient-primary mr-2"/>

            </form>
        </div>
    </div>
</div>
<?php include 'inc/footer.php';?>