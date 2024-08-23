<?php include("includes/head.php"); ?>

  	<?php include("includes/navigation.php"); ?>
  	
		<div class="dez-bnr-inr overlay-black-middle" style="background-image:url(images/banner/bnr1.jpg);">

            <div class="container">

                <div class="dez-bnr-inr-entry">

                    <h1 class="text-white">My Profile</h1>
					
					<div class="breadcrumb-row">
						<ul class="list-inline">
							<li><a href="#">Home</a></li>
							<li>My Profile</li>
						</ul>
					</div>
					
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

                        <div class="p-4" style="padding: 15px 20px;box-shadow: 0 0 27px 0 rgba(48,48,48,.09);">
                                    
                            <div class="row">
                                <div class="col-md-6">
                                        
                                    <h4 class="mb-4"><strong>Update Profile</strong></h4>

                                </div>
                            </div>
                            <?php
                                $js_id = $_SESSION['js_id'];
                                $fetch_profile = mysqli_query($connection, "SELECT * FROM jobseekers WHERE js_id = '$js_id'");
                                $row = mysqli_fetch_array($fetch_profile);
                            ?>
                            <form action="seeker_profile.php" method="POST" enctype="multipart/form-data">
                                <?php

                                if (isset($_POST['seeker'])) {
                                    
                                    $first_name         = $_POST['first_name'];
                                    $last_name          = $_POST['last_name'];
                                    $username           = $_POST['username'];
                                    $password           = $_POST['password'];
                                    $email              = $_POST['email'];
                                    $contact            = $_POST['contact'];
                                    $email              = $_POST['email'];
                                    $address            = $_POST['address'];

                                    $picture            = $_FILES['picture']['name'];
                                    $picture_tmp        = $_FILES['picture']['tmp_name'];
                                    $picture_type       = $_FILES['picture']['type'];

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

                                    if (!empty($picture)) {

                                        if ($picture_type == "image/jpeg" OR $picture_type == "image/jpg" OR $picture_type == "image/png") {
                                      
                                        } else {

                                          $errors[] = "Please Upload an Image of Format JPG, PNG, JPEG.";

                                        }

                                    } else {

                                        $picture             = $row['picture'];

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

                                      move_uploaded_file($picture_tmp, "img/jobseeker/$picture");

                                      $create_account = mysqli_query($connection, "UPDATE jobseekers SET username = '$username', password = '$password', first_name = '$first_name', last_name = '$last_name', email = '$email', contact = '$contact', email = '$email', address = '$address', picture = '$picture' WHERE js_id = '$js_id'");
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
                                      <label>First Name</label>
                                      <input type="text" name="first_name" value="<?php echo $row['first_name']; ?>" class="form-control" placeholder="Company Name" required="">
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label>Last Name</label>
                                      <input type="text" name="last_name" value="<?php echo $row['last_name']; ?>" class="form-control" placeholder="Owner Name" required="">
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
                                      <input type="text" name="password" value="<?php echo $row['password']; ?>" class="form-control" placeholder="Your Password" required="">
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label>Email</label>
                                      <input type="email" name="email" value="<?php echo $row['email']; ?>" class="form-control" placeholder="Your Username" required="">
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label>Contact</label>
                                      <input type="number" name="contact" min="0" value="<?php echo $row['contact']; ?>" class="form-control" placeholder="Your Password" required="">
                                    </div>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label>Company Logo</label><br>
                                  <img src="img/jobseeker/<?php echo $row['picture']; ?>" style="width: 100px;height: 100px;margin-bottom: 20px;"><br>
                                  <input type="file" name="picture" class="form-control">
                                </div>
                                <div class="form-group">
                                  <label>Address</label>
                                  <textarea name="address" class="form-control" placeholder="Enter Address" required=""><?php echo $row['address']; ?></textarea>
                                </div>
                                <div class="form-group">
                                  <input type="submit" name="seeker" class="site-button" value="Update Profile">
                                </div>
                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </section>

<?php include("includes/footer.php"); ?>