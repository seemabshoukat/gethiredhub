<?php include("includes/head.php"); ?>

  	<?php include("includes/navigation.php"); ?>
		
		<div class="dez-bnr-inr overlay-black-middle" style="background-image:url(images/banner/bnr1.jpg);">

            <div class="container">

                <div class="dez-bnr-inr-entry">

                    <h1 class="text-white">Browse Jobs</h1>
					
					<div class="breadcrumb-row">

						<ul class="list-inline">
							<li><a href="#">Home</a></li>
							<li>Browse Jobs</li>
						</ul>

					</div>
					
                </div>

            </div>

        </div>
        
        <div class="content-block">
			
			<div class="section-full bg-white browse-job content-inner-2">

				<div class="container">

					<div class="row">

						<div class="col-md-12">

							<h5 class="widget-title font-weight-700 text-uppercase">Recent Jobs</h5>

							<ul class="post-job-bx">

								<?php

									$today = date("Y-m-d");

									if (isset($_GET['submit'])) {
										
										$search_keyword = $_GET['search'];

										$search_type = $_GET['type'];

										$fetch_jobs = mysqli_query($connection, "SELECT * FROM jobs WHERE end_date >= '$today' AND job_title LIKE '%$search_keyword%' AND type = '$search_type' ORDER BY job_id DESC");

									} else {

										$fetch_jobs = mysqli_query($connection, "SELECT * FROM jobs WHERE end_date >= '$today' ORDER BY job_id DESC");
									}

									$count_jobs = mysqli_num_rows($fetch_jobs);
									
									if ($count_jobs > 0) {
										
									
										while ($row = mysqli_fetch_array($fetch_jobs)) {
											?>
											

											<li>
												<a href="job-single.php?jobid=<?php echo $row['job_id']; ?>">
													<div class="d-flex m-b30">
														<div class="job-post-company">
															<?php

																$fetch_company_logo = mysqli_query($connection, "SELECT * FROM companies WHERE company_id = '" . $row['company_id'] . "'");
																$company = mysqli_fetch_array($fetch_company_logo);


															?>
															<span><img src="img/company_logos/<?php echo $company['logo']; ?>"/></span>
														</div>
														<div class="job-post-info">
															<h4><?php echo $row['job_title']; ?></h4>
															<ul>
																<li><i class="fa fa-map-marker"></i> 
																	<?php
																		$fetch_city = mysqli_query($connection, "SELECT * FROM cities WHERE city_id = '" . $row['city_id'] . "'");
																		$city = mysqli_fetch_array($fetch_city);
																		echo $city['city_name'];
																	?>
																</li>
																<li><i class="fa fa-bookmark-o"></i> <?php echo $row['type']; ?></li>
																<li><i class="fa fa-clock-o"></i> 
																	<?php 
																		$start = strtotime($row['created_at']);
																		$end = strtotime(date("y-m-d"));

																		$days_between = ceil(abs($end - $start) / 86400);

																			if ($days_between == 0) {
																				echo " Posted Today";
																			} else {
																				echo $days_between . " Days Ago";
																			}

																	?> 
																</li>
															</ul>
														</div>
													</div>
													<div class="d-flex">
														<div class="job-time mr-auto">
															<span><?php echo $row['type']; ?></span>
														</div>
														<div class="salary-bx">
															<?php
																if (isset($_SESSION['js_id'])) {
																	
																	$check_apply = mysqli_query($connection, "SELECT * FROM jobs_applied WHERE job_id = '" . $row['job_id'] . "' AND seeker_id = '" . $_SESSION['js_id'] . "'");
																	$count_apply = mysqli_num_rows($check_apply);
																	if ($count_apply > 0) {
																		?>
																		<p class="btn bg-light text-black-50 border">Already Applied</p>
																		<?php
																	} else {
																		?>
																		<p class="site-button">Apply</p>
																		<?php
																	}
																} else {
																	echo "<span class='label label-success'>Login to Apply.</span>";
																}
															?>
														</div>
													</div>
												</a>
											</li>
											<?php
										}
									} else {
										echo "<h3 class='text-center'>No Results Found.</h3>";
									}

								?>

							</ul>
							
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


				$_SESSION['msg'] = "<div class='alert alert-success'>Job Applied Successfully!</div>";

				header("Location: jobs.php");

			}

		?>
<?php include("includes/footer.php"); ?>