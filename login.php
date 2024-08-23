<?php include("includes/head.php"); ?>

  	<?php include("includes/navigation.php"); ?>

  		<div class="dez-bnr-inr overlay-black-middle bg-pt" style="background-image:url(images/banner/bnr2.jpg);">

            <div class="container">

                <div class="dez-bnr-inr-entry">

                    <h1 class="text-white">Login</h1>
					
					<div class="breadcrumb-row">

						<ul class="list-inline">
							<li><a href="#">Home</a></li>
							<li>Login</li>
						</ul>

					</div>
					
                </div>

            </div>

        </div>
        
        <div class="section-full content-inner-2 shop-account bg-white">
            
            <div class="container">

                <div class="row mb-5">

					<div class="col-md-12 text-center">

						<h3 class="font-weight-700 m-t0 m-b20">Login Your Account</h3>

					</div>

				</div>

                <div class="row">

                	<div class="col-md-6">

                		<div class="m-b30">

							<div class="p-a30 border-1 seth">

								<form id="login" class="col-12 p-a0" method="post" action="login.php">

									<h4 class="font-weight-700 text-center">Company Login Form</h4>
									<p class="font-weight-600 text-center">If you have an account with us, please log in.</p>

									<?php

							            if (isset($_POST['company'])) {
							              
							              $username = trim($_POST['username']);

							              $password = trim($_POST['password']);



							              $query = mysqli_query($connection, "SELECT * FROM companies WHERE username = '$username'");

							              $count_exists = mysqli_num_rows($query);

							              if ($count_exists > 0) {
							                
							                $row = mysqli_fetch_array($query);

							                $company_id     = $row['company_id'];
							                $db_username    = $row['username'];
							                $db_password    = $row['password'];
							                $db_status      = $row['status'];

							                if ($db_password == $password) {
							                  
							                  if ($db_status == "active") {
							                    
							                    $_SESSION['company_id'] = $company_id;

							                    header("Location: dashboard.php");

							                  } else {

							                  ?>

							                    <div class="alert alert-danger" role="alert">
							                    	<strong>Alert!</strong>  Your Account is Inactive. Please Contact Admin for more details. 
							                    </div>

							                <?php

							                  }

							                } else {

							                  ?>

							                    <div class="alert alert-danger" role="alert">
							                    	<strong>Alert!</strong> Password Does Not Match.
							                    </div>
							                <?php

							                }

							              } else {

							                ?>

							                    <div class="alert alert-danger" role="alert">
							                    	<strong>Alert!</strong> Account Does Not Exist.
							                    </div>

							                <?php

							              }

							            }

						            ?>
									<div class="form-group">
										<label class="font-weight-700">Username *</label>
										<input name="username" required="" class="form-control" placeholder="Your Username" type="text">
									</div>

									<div class="form-group">
										<label class="font-weight-700">PASSWORD *</label>
										<input name="password" required="" class="form-control " placeholder="Type Password" type="password">
									</div>

						            <div class="form-group">
						              <button type="submit" name="company" class="site-button m-r5 button-lg">Login</button>
						            </div>

								</form>

							</div>

						</div>
                	</div>
						
                	<div class="col-md-6">

                		<div class="m-b30">

							<div class="p-a30 border-1 seth">

								<form id="login" class="col-12 p-a0 " method="post" action="login.php">
									<?php

							            if (isset($_POST['seeker'])) {
							              
							              $username = trim($_POST['username']);

							              $password = trim($_POST['password']);



							              $query = mysqli_query($connection, "SELECT * FROM jobseekers WHERE username = '$username'");

							              $count_exists = mysqli_num_rows($query);

							              if ($count_exists > 0) {
							                
							                $row = mysqli_fetch_array($query);

							                $js_id     = $row['js_id'];
							                $db_username    = $row['username'];
							                $db_password    = $row['password'];
							                $db_status      = $row['status'];

							                if ($db_password == $password) {
							                  
							                  if ($db_status == "active") {
							                    
							                    $_SESSION['js_id'] = $js_id;

							                    header("Location: dashboard.php");

							                  } else {

							                  ?>

							                    <div class="alert alert-danger" role="alert">
							                    	<strong>Alert!</strong>  Your Account is Inactive. Please Contact Admin for more details.
							                    </div>

							                <?php

							                  }

							                } else {

							                  ?>

							                    <div class="alert alert-danger" role="alert">
							                    	<strong>Alert!</strong> Password Does Not Match.
							                    </div>
							                <?php

							                }

							              } else {

							                ?>

							                    <div class="alert alert-danger" role="alert">
							                    	<strong>Alert!</strong> Account Does Not Exist.
							                    </div>
							                    
							                <?php

							              }

							            }

						            ?>
									<h4 class="font-weight-700 text-center">JobSeeker Login Form</h4>
									<p class="font-weight-600 text-center">If you have an account with us, please log in.</p>

									<div class="form-group">
										<label class="font-weight-700">Username *</label>
										<input name="username" required="" class="form-control" placeholder="Your Username" type="text">
									</div>

									<div class="form-group">
										<label class="font-weight-700">PASSWORD *</label>
										<input name="password" required="" class="form-control " placeholder="Type Password" type="password">
									</div>

									<div class="text-left">
										<button type="submit" name="seeker" class="site-button m-r5 button-lg">login</button>
									</div>

								</form>

							</div>

						</div>
                	</div>
						
				</div>

			</div>
            <!-- Product END -->
		</div>

<?php include("includes/footer.php"); ?>