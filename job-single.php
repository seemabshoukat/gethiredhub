<?php include("includes/head.php"); ?>

  	<?php include("includes/navigation.php"); ?>
		<?php

			if (isset($_GET['jobid'])) {
				$jobid = $_GET['jobid'];

				$row = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM jobs WHERE job_id = '$jobid'"));

				// Education
				$edu = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM educations WHERE edu_id = '" . $row['education_id'] . "'"));

				// Location
				$city = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM cities WHERE city_id = '" . $row['city_id'] . "'"));

				// Company
				$company = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM companies WHERE company_id = '" . $row['company_id'] . "'"));

			}

		?>
		<div class="dez-bnr-inr overlay-black-middle" style="background-image:url(images/banner/bnr1.jpg);">

            <div class="container">
            	
                <div class="dez-bnr-inr-entry">

                    <h1 class="text-white"><?php echo $row['job_title']; ?></h1>
					
					<div class="breadcrumb-row">

						<ul class="list-inline">
							<li><a href="#">Home</a></li>
							<li><?php echo $row['job_title']; ?></li>
						</ul>

					</div>
					
                </div>

            </div>

        </div>
        
        <div class="content-block">
			
			<div class="section-full bg-white browse-job content-inner-2">

				<div class="container">
					<?php
	            		if (isset($_SESSION['msg'])) {
	            			echo $_SESSION['msg'];
	            			unset($_SESSION['msg']);
	            		}
	            	?>
					<div class="row">
						<div class="col-lg-4">
							<div class="sticky-top">
								<div class="row">
									<div class="col-lg-12 col-md-6">
										<div class="m-b30">
											<img src="img/company_logos/<?php echo $company['logo']; ?>" alt="" class="img-thumbnail">
										</div>
									</div>
									<div class="col-lg-12 col-md-6">
										<div class="widget bg-white p-lr20 p-t20  widget_getintuch radius-sm">
											<h5 class="text-black font-weight-700 p-t10 m-b15">Job Details</h5>
											<ul>

												<li>
													<i class="fa-solid fa-city"></i>
													<strong class="font-weight-700 text-black">City</strong>
													<span class="text-black-light">
													 <?php echo $city['city_name']; ?>
													</span>
												</li>

												<li>
													<i class="fa-solid fa-briefcase"></i>
													<strong class="font-weight-700 text-black">Job Type</strong>
													<span class="text-black-light">
													 	<?php echo $row['type']; ?>
													</span>
												</li>

												<li>
													<i class="fa-solid fa-clock"></i>
													<strong class="font-weight-700 text-black">Posted On</strong>
													<span class="text-black-light">
													 	<?php echo $row['created_at']; ?>
													</span>
												</li>

												<li>
													<i class="fa-solid fa-clock-rotate-left"></i>
													<strong class="font-weight-700 text-black">Deadline</strong>
													<span class="text-black-light">
													 	<?php echo $row['end_date']; ?>
													</span>
												</li>

											</ul>
										</div>
										<div class="widget bg-white p-lr20 p-t20  widget_getintuch radius-sm">

											<h5 class="text-black font-weight-700 p-t10 m-b15">Company Details</h5>
											<ul>

												<li>
													<i class="fa-solid fa-building"></i>
													<strong class="font-weight-700 text-black">Company Name</strong>
													<span class="text-black-light">
													 	<?php echo $company['company_name']; ?>
													</span>
												</li>

												<li>
													<i class="fa-solid fa-envelope"></i>
													<strong class="font-weight-700 text-black">Company Email</strong>
													<span class="text-black-light">
													 	<?php echo $company['email']; ?>
													</span>
												</li>

												<li>
													<i class="fa-solid fa-address-book"></i>
													<strong class="font-weight-700 text-black">Company Contact</strong>
													<span class="text-black-light">
													 	<?php echo $company['office_contact']; ?>
													</span>
												</li>

												<li>
													<i class="fa-solid fa-arrow-up-right-from-square"></i>
													<strong class="font-weight-700 text-black">Company Website</strong>
													<span class="text-black-light">
													 	<a href="<?php echo $company['web_address']; ?>" target="_blank">
													 		<?php echo $company['web_address']; ?>
													 	</a>
													</span>
												</li>

												<li>
													<i class="fa-solid fa-location-dot"></i>
													<strong class="font-weight-700 text-black">Company Address</strong>
													<span class="text-black-light">
													 <?php echo $company['address']; ?>
													</span>
												</li>

											</ul>
										</div>
									</div>
								</div>
                            </div>
						</div>
						<div class="col-lg-8">
							<div class="job-info-box">
								<h3 class="m-t0 m-b10 font-weight-700 title-head">
									<a href="#" class="text-secondry m-r30"><?php echo $row['job_title']; ?></a>
								</h3>
								<ul class="job-info">
									<li><strong>Education</strong> <?php echo $edu['education_title']; ?></li>
									<li><strong>Deadline:</strong> <?php echo $row['end_date']; ?></li>
									<li><i class="ti-location-pin text-black m-r5"></i> <?php echo $city['city_name']; ?> </li>
								</ul>
								<h5 class="font-weight-600 mt-5">Job Description</h5>
								<div class="dez-divider divider-2px bg-gray-dark mb-4 mt-0"></div>
								<p><?php echo $row['description']; ?></p>

								<h5 class="font-weight-600 mt-5 mb-3">Job Education</h5>
								<div class="dez-divider divider-2px bg-gray-dark mb-4 mt-0"></div>
								<p><?php echo $edu['education_title']; ?></p>

								<h5 class="font-weight-600">How to Apply</h5>
								<div class="dez-divider divider-2px bg-gray-dark mb-4 mt-0"></div>
								<p>Simply Click on Apply to apply this job using our new feature Easy Apply!</p>
								<h5 class="font-weight-600">Job Skills Required</h5>
								<div class="dez-divider divider-2px bg-gray-dark mb-4 mt-0"></div>
								<ul class="list-num-count no-round">
									<?php
										$fetch_skills = mysqli_query($connection, "SELECT * FROM job_skills WHERE job_id = '$jobid'");
										while ($skills = mysqli_fetch_array($fetch_skills)) {
											
										
										?>
										<li><?php
										$fetch_skill_name = mysqli_query($connection, "SELECT * FROM skills WHERE skill_id = '" . $skills['skill_id'] . "'");
										$skillname = mysqli_fetch_array($fetch_skill_name);
										echo $skillname['skill_name'];
										?></li>
										<?php } ?>

								</ul>
								<?php
									if (isset($_SESSION['js_id'])) {
										
										$check_apply = mysqli_query($connection, "SELECT * FROM jobs_applied WHERE job_id = '" . $row['job_id'] . "' AND seeker_id = '" . $_SESSION['js_id'] . "'");
										$count_apply = mysqli_num_rows($check_apply);
										if ($count_apply > 0) {
											?>
											<h4><a class="btn btn-danger btn-xs disabled">You Have Already Applied this Job.</a></h4>
											<?php
										} else {
											?>
											<a href="job-single.php?jobid=<?php echo $row['job_id']; ?>&jobapply=<?php echo $row['job_id']; ?>" class="site-button">Apply This Job</a>
											<?php
										}
									} else {
										echo "<span class='label label-success'>Login to Apply This Job.</span>";
									}
								?>
								<!-- <a href="#" class="site-button">Apply This Job</a> -->
							</div>
						</div>
					</div>

				</div>

			</div>
            
		</div>
<?php

	if (isset($_GET['jobapply'])) {

		$job_id = $_GET['jobapply'];
		$user_id = $_SESSION['js_id'];

		$date = date("Y-m-d");

		$insert_apply = mysqli_query($connection, "INSERT INTO jobs_applied(job_id, seeker_id, applied_at) VALUES('$job_id', '$user_id', '$date')");





		$fetch_job_details = mysqli_query($connection, "SELECT * FROM jobs WHERE job_id = '$job_id'");
		$job = mysqli_fetch_array($fetch_job_details);

		$company_id = $job['company_id'];

		$fetch_company = mysqli_query($connection, "SELECT * FROM companies WHERE company_id = '$company_id'");
		$company = mysqli_fetch_array($fetch_company);

		$fetch_job_user = mysqli_query($connection, "SELECT * FROM jobseekers WHERE js_id = '$user_id'");
		$user = mysqli_fetch_array($fetch_job_user);

		$_SESSION['msg'] = "<div class='alert alert-success'>Job Application Submitted Successfully!</div>";

		header("Location: job-single.php?jobid=".$_GET['jobid']);

	}

?>
<?php include("includes/footer.php"); ?>