<?php include("includes/head.php"); ?>

  	<?php include("includes/navigation.php"); ?>

  		<div class="dez-bnr-inr overlay-black-middle bg-pt" style="background-image:url(images/banner/bnr2.jpg);">

            <div class="container">

                <div class="dez-bnr-inr-entry">

                    <h1 class="text-white">Register</h1>
					
					<div class="breadcrumb-row">

						<ul class="list-inline">
							<li><a href="#">Home</a></li>
							<li>Register</li>
						</ul>

					</div>
					
                </div>

            </div>

        </div>
        
        <div class="section-full content-inner shop-account bg-white">
            
            <div class="container">

                <div class="row mb-5">

					<div class="col-md-12 text-center">
						<h3 class="font-weight-700 m-t0 m-b20">Create An Account</h3>
					</div>

				</div>

                <div class="row">

					<div class="col-md-6 m-b30">

						<div class="p-a30 border-1  max-w500 m-auto">

							<form id="login" method="post" action="register.php" enctype="multipart/form-data">
								<?php

						            if (isset($_POST['company'])) {
						                
						                $username         = $_POST['username'];
						                $password         = $_POST['password'];
						                $company_name     = $_POST['company_name'];
						                $owner_name       = $_POST['owner_name'];
						                $office_contact   = $_POST['office_contact'];
						                $owner_contact    = $_POST['owner_contact'];
						                $email            = $_POST['email'];
						                $web_address      = $_POST['web_address'];
						                $address          = $_POST['address'];

						                $logo             = $_FILES['logo']['name'];
						                $logo_tmp         = $_FILES['logo']['tmp_name'];
						                $logo_type        = $_FILES['logo']['type'];

						                $status           = "draft";

						                $errors = [];

						                $check_company_username = mysqli_query($connection, "SELECT * FROM companies WHERE username = '$username'");
						                $count_company_username = mysqli_num_rows($check_company_username);

						                if ($count_company_username > 0) {
						                  
						                  $errors[] = "Account with this username Already Exists.";

						                }

						                $check_company_name = mysqli_query($connection, "SELECT * FROM companies WHERE company_name = '$company_name'");
						                $count_company_name = mysqli_num_rows($check_company_name);

						                if ($count_company_name > 0) {
						                  
						                  $errors[] = "This Company Already Exists.";

						                }

						                $check_company_office_contact = mysqli_query($connection, "SELECT * FROM companies WHERE office_contact = '$office_contact'");
						                $count_company_office_contact = mysqli_num_rows($check_company_office_contact);

						                if ($count_company_office_contact > 0) {
						                  
						                  $errors[] = "Account with this Office Contact Already Exists.";

						                }

						                $check_company_owner_contact = mysqli_query($connection, "SELECT * FROM companies WHERE owner_contact = '$owner_contact'");
						                $count_company_owner_contact = mysqli_num_rows($check_company_owner_contact);

						                if ($count_company_owner_contact > 0) {
						                  
						                  $errors[] = "Account with this Owner Contact Already Exists.";

						                }

						                $check_company_email = mysqli_query($connection, "SELECT * FROM companies WHERE email = '$email'");
						                $count_company_email = mysqli_num_rows($check_company_email);

						                if ($count_company_email > 0) {
						                  
						                  $errors[] = "Account with this Email Already Exists.";

						                }

						                $check_company_web_address = mysqli_query($connection, "SELECT * FROM companies WHERE web_address = '$web_address'");
						                $count_company_web_address = mysqli_num_rows($check_company_web_address);

						                if ($count_company_web_address > 0) {
						                  
						                  $errors[] = "This Web Address Already Exists.";

						                }


						                if (preg_match('~[0-9]~', $company_name)) {
						                  
						                  $errors[] = "Company Name Should not Have Numbers.";

						                }

						                if (preg_match('~[0-9]~', $owner_name)) {
						                  
						                  $errors[] = "Last Name Should not Have Numbers.";

						                }


						                $total_digits = mb_strlen($office_contact);

						                if ($total_digits < 11) {

						                  $errors[] = "Office Contact Number Should Not be Less than 11.";

						                } elseif ($total_digits > 11) {
						                  
						                  $errors[] = "Office Contact Number Should Not be Greater than 11.";

						                }
						                
						                $total_digits = mb_strlen($owner_contact);

						                if ($total_digits < 11) {

						                  $errors[] = "Owner Contact Number Should Not be Less than 11.";

						                } elseif ($total_digits > 11) {
						                  
						                  $errors[] = "Owner Contact Number Should Not be Greater than 11.";

						                }
						                
						                // Email Validation
						                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
						                  
						                  $errors[] = "Please Enter a Valid Email Address.";

						                }

						                if ($logo_type == "image/jpeg" OR $logo_type == "image/jpg" OR $logo_type == "image/png") {
						                  
						                } else {

						                  $errors[] = "Please Upload an Image of Format JPG, PNG, JPEG For Company's Logo.";

						                }

						                if (!empty($errors)) {
						                  
						                  foreach ($errors as $error) {
						                    
						                    ?>
						              
						                    <div class="alert alert-danger" role="alert">

						                      <strong>Alert! </strong> <?php echo $error; ?> 

						                    </div>

						                    <?php
						                  }

						                } else {

						                  move_uploaded_file($logo_tmp, "img/company_logos/$logo");

						                  $create_account = mysqli_query($connection, "INSERT INTO companies(username, password, company_name, owner_name, office_contact, owner_contact, email, web_address, address, logo, status) VALUES('$username', '$password', '$company_name', '$owner_name', '$office_contact', '$owner_contact', '$email', '$web_address', '$address', '$logo', '$status')");
						                  ?>
						              
						                    <div class="alert alert-success" role="alert">

						                      <strong>Alert! </strong> Account Created Successfully! Please Wait For Admin's Approval to Login.

						                    </div>

						                    <?php
						                }

						            }

					            ?>

								<h4 class="font-weight-700">Register as Company</h4>
								<p class="font-weight-600">If you have an account with us, please log in.</p>

					            <div class="row">
					              <div class="col-md-6">
					                <div class="form-group">
					                  <label>Company Name</label>
					                  <input type="text" name="company_name" value="<?php if(!empty($_POST['company_name'])) { echo $_POST['company_name']; } ?>" class="form-control" placeholder="Company Name" required="">
					                </div>
					              </div>
					              <div class="col-md-6">
					                <div class="form-group">
					                  <label>Owner Name</label>
					                  <input type="text" name="owner_name" value="<?php if(!empty($_POST['owner_name'])) { echo $_POST['owner_name']; } ?>" class="form-control" placeholder="Owner Name" required="">
					                </div>
					              </div>
					            </div>
					            <div class="row">
					              <div class="col-md-6">
					                <div class="form-group">
					                  <label>Office Contact</label>
					                  <input type="number" name="office_contact" value="<?php if(!empty($_POST['office_contact'])) { echo $_POST['office_contact']; } ?>" class="form-control" placeholder="Office Contact" required="">
					                </div>
					              </div>
					              <div class="col-md-6">
					                <div class="form-group">
					                  <label>Owner Contact</label>
					                  <input type="number" name="owner_contact" value="<?php if(!empty($_POST['owner_contact'])) { echo $_POST['owner_contact']; } ?>" class="form-control" placeholder="Owner Contact" required="">
					                </div>
					              </div>
					            </div>
					            <div class="row">
					              <div class="col-md-6">
					                <div class="form-group">
					                  <label>Username</label>
					                  <input type="text" name="username" value="<?php if(!empty($_POST['username'])) { echo $_POST['username']; } ?>" class="form-control" placeholder="Your Username" required="">
					                </div>
					              </div>
					              <div class="col-md-6">
					                <div class="form-group">
					                  <label>Password</label>
					                  <input type="password" name="password" value="<?php if(!empty($_POST['password'])) { echo $_POST['password']; } ?>" class="form-control" placeholder="Your Password" required="">
					                </div>
					              </div>
					            </div>
					            <div class="form-group">
					              <label>Email</label>
					              <input type="email" name="email" value="<?php if(!empty($_POST['email'])) { echo $_POST['email']; } ?>" placeholder="Enter Company Email" class="form-control">
					            </div>
					            <div class="form-group">
					              <label>Company Website Address</label>
					              <input type="url" name="web_address" value="<?php if(!empty($_POST['web_address'])) { echo $_POST['web_address']; } ?>" placeholder="Enter Company Web Address" class="form-control">
					            </div>
					            <div class="form-group">
					              <label>Company Logo</label>
					              <input type="file" name="logo" class="form-control">
					            </div>
					            <div class="form-group">
					              <label>Address</label>
					              <textarea name="address" class="form-control" placeholder="Enter Address" required=""><?php if(!empty($_POST['address'])) { echo $_POST['address']; } ?></textarea>
					            </div>
					            <div class="form-group">
					              <input type="submit" name="company" class="site-button button-lg outline outline-2" value="Register an account">
					            </div>
							</form>
							<div class="row">
								<div class="col-md-12 text-center">
									<a href="login.php" class="text-dark">Already have an account? Login</a>
								</div>
							</div>
						</div>

					</div>

					<div class="col-md-6 m-b30">

						<div class="p-a30 border-1">

							<form id="login" method="post" action="register.php" enctype="multipart/form-data">
								<?php

						            if (isset($_POST['jobseeker'])) {
						                
						                $username     = $_POST['username'];
						                $password     = $_POST['password'];
						                $email        = $_POST['email'];
						                $first_name   = $_POST['first_name'];
						                $last_name    = $_POST['last_name'];
						                $contact      = $_POST['contact'];
						                $picture      = $_FILES['picture']['name'];
						                $picture_tmp      = $_FILES['picture']['tmp_name'];
						                $picture_type      = $_FILES['picture']['type'];
						                $address      = $_POST['address'];

						                $errors = [];


						                if (preg_match('~[0-9]~', $first_name)) {
						                  
						                  $errors[] = "First Name Should not Have Numbers.";

						                }

						                if (preg_match('~[0-9]~', $last_name)) {
						                  
						                  $errors[] = "Last Name Should not Have Numbers.";

						                }


						                $total_digits = mb_strlen($contact);

						                if ($total_digits < 11) {

						                  $errors[] = "Contact Number Should Not be Less than 11.";

						                } elseif ($total_digits > 11) {
						                  
						                  $errors[] = "Contact Number Should Not be Greater than 11.";

						                }
						                
						                // Email Validation
						                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
						                  
						                  $errors[] = "Please Enter a Valid Email Address.";

						                }

						                if ($picture_type == "image/jpeg" OR $picture_type == "image/jpg" OR $picture_type == "image/png") {
						                  
						                } else {

						                  $errors[] = "Please Upload an Image of Format JPG, PNG, JPEG.";

						                }

						                if (!empty($errors)) {
						                  
						                  foreach ($errors as $error) {
						                    
						                    ?>
						              
						                    <div class="alert alert-danger" role="alert">

						                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>

						                      <strong>Alert! </strong> <?php echo $error; ?> 

						                    </div>

						                    <?php
						                  }

						                } else {

						                  move_uploaded_file($picture_tmp, "img/jobseeker/$picture");

						                  $create_account = mysqli_query($connection, "INSERT INTO jobseekers(username, password, email, first_name, last_name, contact, picture, address) VALUES('$username', '$password', '$email', '$first_name', '$last_name', '$contact', '$picture', '$address')");
						                  ?>
						              
						                    <div class="alert alert-success" role="alert">

						                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>

						                      <strong>Alert! </strong> Account Created Successfully!

						                    </div>

						                    <?php
						                }

						            }


            					?>
								<h4 class="font-weight-700">Register as Job Seeker</h4>
								<p class="font-weight-600">If you have an account with us, please log in.</p>
								
								
					            <div class="row">
					              <div class="col-md-6">
					                <div class="form-group">
					                  <label>First Name</label>
					                  <input type="text" name="first_name" value="<?php if(!empty($_POST['first_name'])) { echo $_POST['first_name']; }?>" class="form-control" placeholder="First name" required="">
					                </div>
					              </div>
					              <div class="col-md-6">
					                <div class="form-group">
					                  <label>Last Name</label>
					                  <input type="text" name="last_name" value="<?php if(!empty($_POST['last_name'])) { echo $_POST['last_name']; }?>" class="form-control" placeholder="Last name" required="">
					                </div>
					              </div>
					            </div>
					            <div class="row">
					              <div class="col-md-6">
					                <div class="form-group">
					                  <label>Email</label>
					                  <input type="email" name="email" value="<?php if(!empty($_POST['email'])) { echo $_POST['email']; }?>" class="form-control" placeholder="Your Email" required="">
					                </div>
					              </div>
					              <div class="col-md-6">
					                <div class="form-group">
					                  <label>Contact</label>
					                  <input type="number" name="contact" value="<?php if(!empty($_POST['contact'])) { echo $_POST['contact']; }?>" class="form-control" placeholder="Your Contact" required="">
					                </div>
					              </div>
					            </div>
					            <div class="row">
					              <div class="col-md-6">
					                <div class="form-group">
					                  <label>Username</label>
					                  <input type="text" name="username" value="<?php if(!empty($_POST['username'])) { echo $_POST['username']; }?>" class="form-control" placeholder="Your Username" required="">
					                </div>
					              </div>
					              <div class="col-md-6">
					                <div class="form-group">
					                  <label>Password</label>
					                  <input type="password" name="password" value="<?php if(!empty($_POST['password'])) { echo $_POST['password']; }?>" class="form-control" placeholder="Your Password" required="">
					                </div>
					              </div>
					            </div>
					            <div class="form-group">
					              <label>Your Picture</label>
					              <input type="file" name="picture" class="form-control">
					            </div>
					            <div class="form-group">
					              <label>Address</label>
					              <textarea name="address" class="form-control" placeholder="Enter Address" required=""><?php if(!empty($_POST['address'])) { echo $_POST['address']; }?></textarea>
					            </div>
					            <div class="form-group">
					              <input type="submit" name="jobseeker" class="site-button button-lg outline outline-2" value="Register an account">
					            </div>
							</form>
							<div class="row">
								<div class="col-md-12 text-center">
									<a href="login.php" class="text-dark">Already have an account? Login</a>
								</div>
							</div>
						</div>

					</div>

				</div>

			</div>
            
		</div>

<?php include("includes/footer.php"); ?>