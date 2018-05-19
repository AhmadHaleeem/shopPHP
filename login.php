<?php include 'inc/header.php'; ?>
<?php
    $login = Session::get('customerLogin');
    if ($login == true) {
        header('Location: order.php');
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
            $customerLogin = $cmr->customerLogin($_POST);
        }
?>
<style>
    .form-control {
        width:100% !important;
    }
</style>
 <div class="main">
    <div class="content">
    	 <div class="login_panel">
             <?php
                 if (isset($customerLogin)) {
                     echo $customerLogin;
                 }
             ?>
        	<h3>Existing Customers</h3>
        	<p>Sign in with the form below.</p>
        	<form action="" method="post" >
                <input class="form-control" name="email" type="text" placeholder="Email">
                <input class="form-control" name="password" type="password" placeholder="Password">
                <div class="buttons"><div><button class="grey" name="login">Sign In</button></div></div>
             </form>
        </div>
        <?php
            $product = new Product();
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
                $customerRegister = $cmr->customerRegisteration($_POST);
            }
        ?>
    	<div class="register_account">
            <?php
                if (isset($customerRegister)) {
                    echo $customerRegister;
                }
            ?>
    		<h3>Register New Account</h3>
    		<form action="" method="post">
                <div class="form-group">
                <input type="text" name="name" placeholder="Name" class="form-control">
                </div>

                <div class="form-group">
                   <input type="text" name="city" placeholder="City" class="form-control">
                </div>

                <div class="form-group">
                    <input type="text" name="zip" placeholder="Zip-Code" class="form-control">
                </div>
                <div class="form-group">
                    <input type="text" name="email" placeholder="Email" class="form-control">
                </div>

            <div class="form-group">
                <input type="text" name="address" placeholder="Address" class="form-control">
            </div>

            <select style="outline: auto;margin-bottom: 20px" name="country" onchange="change_country(this.value)" class="form-control">
                <option value="null">Select a Country</option>
                <option value="AF">Afghanistan</option>
                <option value="AL">Albania</option>
                <option value="DZ">Algeria</option>
                <option value="AR">Argentina</option>
                <option value="AM">Armenia</option>
                <option value="AW">Aruba</option>
                <option value="AU">Australia</option>
                <option value="AT">Austria</option>
                <option value="AZ">Azerbaijan</option>
                <option value="BS">Bahamas</option>
                <option value="BH">Bahrain</option>
                <option value="BD">Bangladesh</option>
                <option value="NL">Netherlands</option>
                <option value="SY">Syria</option>
            </select>
            <div class="form-group">
              <input type="text" name="phone" placeholder="Phone" class="form-control">
            </div>

            <div class="form-group">
                <input type="text" name="password" placeholder="Password" class="form-control">
            </div>
		   <div class="search"><div><button class="btn btn-grey mb-3" name="register">Create Account</button></div></div>
		    <div class="clear"></div>
		    </form>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
</div>
  <?php include 'inc/footer.php'; ?>