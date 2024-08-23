<?php include("includes/head.php"); ?>

  	<?php include("includes/navigation.php"); ?>
  	
		<div class="dez-bnr-inr overlay-black-middle" style="background-image:url(images/banner/bnr1.jpg);">
            <div class="container">
                <div class="dez-bnr-inr-entry">
                    <h1 class="text-white">Profile</h1>
					<!-- Breadcrumb row -->
					<div class="breadcrumb-row">
						<ul class="list-inline">
							<li><a href="#">Home</a></li>
							<li>Profile</li>
						</ul>
					</div>
					<!-- Breadcrumb row END -->
                </div>
            </div>
        </div>
        
    <style>
        body {
            background: white !important;
        }
        .list-group-item {
            background-color: transparent !important; 
            border: none !important; 
        }
        .list-group-item a {
            color: white !important;
        }
        .list-group-item a:hover {
            color: #2e55fa;
        }
        footer.footer {
            display: none !important;
        }
    </style>
    <section style="padding: 80px 0px;background: #fff;">
        
        <div class="container-fluid">
            
            <div class="row">
                
                <div class="col-md-2" style="background: #2e55fa;height: 100%;">
                    
                    <div class="pt-5 pb-5" style="">
                        
                        <div>

                            <?php

                                if (isset($_SESSION['company_id'])) {

                                    include("includes/company_nav.php");

                                } else {

                                    include("includes/seeker_nav.php");

                                }
                            ?>

                        </div>

                    </div>

                </div>

                <div class="col-md-10">
                    
                    <div class="pt-5 pl-5 pr-5 pb-5" style="padding: 15px 20px;box-shadow: 0 0 27px 0 rgba(48,48,48,.09);">
                           
                        <div class="row">
                            <div class="col-md-6">
                                    
                                <h3><strong>Update Profile</strong></h3>

                            </div>
                        </div>
                        <?php
                            $company_id = $_SESSION['company_id'];
                            $fetch_profile = mysqli_query($connection, "SELECT * FROM companies WHERE company_id = '$company_id'");
                            $row = mysqli_fetch_array($fetch_profile);
                        ?>
                        <form action="profile.php" method="POST" enctype="multipart/form-data">
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

                                $errors = [];


                                if (preg_match('~[0-9]~', $company_name)) {
                                  
                                  $errors[] = "First Name Should not Have Numbers.";

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

                                if (!empty($logo)) {

                                    if ($logo_type == "image/jpeg" OR $logo_type == "image/jpg" OR $logo_type == "image/png") {
                                  
                                    } else {

                                      $errors[] = "Please Upload an Image of Format JPG, PNG, JPEG For Company's Logo.";

                                    }

                                } else {

                                    $logo             = $row['logo'];

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

                                  $create_account = mysqli_query($connection, "UPDATE companies SET username = '$username', password = '$password', company_name = '$company_name', owner_name = '$owner_name', office_contact = '$office_contact', owner_contact = '$owner_contact', email = '$email', web_address = '$web_address', address = '$address', logo = '$logo' WHERE company_id = '$company_id'");
                                  ?>
                              
                                    <div class="alert alert-success" role="alert">

                                      <strong>Alert! </strong> Profile Updated Successfully!

                                    </div>

                                    <?php
                                }

                              }


                            ?>
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label>Company Name</label>
                                  <input type="text" name="company_name" value="<?php echo $row['company_name']; ?>" class="form-control" placeholder="Company Name" required="">
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label>Owner Name</label>
                                  <input type="text" name="owner_name" value="<?php echo $row['owner_name']; ?>" class="form-control" placeholder="Owner Name" required="">
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label>Office Contact</label>
                                  <input type="number" name="office_contact" value="<?php echo $row['office_contact']; ?>" class="form-control" placeholder="Office Contact" required="">
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label>Owner Contact</label>
                                  <input type="number" name="owner_contact" value="<?php echo $row['owner_contact']; ?>" class="form-control" placeholder="Owner Contact" required="">
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label>Username</label>
                                  <input type="text" name="username" value="<?php echo $row['username']; ?>" class="form-control" placeholder="Your Username" required="" readonly="">
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label>Password</label>
                                  <input type="password" name="password" value="<?php echo $row['password']; ?>" class="form-control" placeholder="Your Password" required="">
                                </div>
                              </div>
                            </div>
                            <div class="form-group">
                              <label>Email</label>
                              <input type="email" name="email" value="<?php echo $row['email']; ?>" placeholder="Enter Company Email" class="form-control">
                            </div>
                            <div class="form-group">
                              <label>Company Website Address</label>
                              <input type="url" name="web_address" value="<?php echo $row['web_address']; ?>" placeholder="Enter Company Web Address" class="form-control">
                            </div>
                            <div class="form-group">
                              <label>Company Logo</label><br>
                              <img src="img/company_logos/<?php echo $row['logo']; ?>" style="width: 100px;height: 100px;margin-bottom: 20px;"><br>
                              <input type="file" name="logo" class="form-control">
                            </div>
                            <div class="form-group">
                              <label>Address</label>
                              <textarea name="address" class="form-control" placeholder="Enter Address" required=""><?php echo $row['address']; ?></textarea>
                            </div>
                            <div class="form-group">
                              <input type="submit" name="company" class="site-button" value="Register an account">
                            </div>
                        </form>

                    </div>

                </div>

            </div>

        </div>

    </section>

<?php include("includes/footer.php"); ?>