<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<div style="width: 70%">
    <div>
        <h2>Update Social Media</h2>
        <div>
         <form>
                <div class="form-group">
                    <label>Facebook</label>
                    <input type="text" name="facebook" placeholder="Facebook link.." class="form-control" />
                </div>

                <div class="form-group">
                    <label>Twitter</label>
                    <input type="text" name="twitter" placeholder="Twitter link.." class="form-control" />
                </div>

                <div class="form-group">
                    <label>LinkedIn</label>
                    <input type="text" name="linkedin" placeholder="LinkedIn link.." class="form-control" />
                </div>
                <label>Google Plus</label>
                <div class="form-group">
                    <input type="text" name="googleplus" placeholder="Google Plus link.." class="form-control" />
                </div>
                <input type="submit" name="submit" Value="Update" class="btn btn-gradient-primary mr-2" />

            </form>
        </div>
    </div>
</div>
<?php include 'inc/footer.php';?>