<?php include("includes/head.php"); ?>

  	<?php include("includes/navigation.php"); ?>

	<div class="dez-bnr-inr dez-bnr-inr-md" style="background-image:url(images/main-slider/slide2.jpg);">

        <div class="container">

            <div class="dez-bnr-inr-entry align-m ">

				<div class="find-job-bx">

					<p class="site-button button-sm">Find Jobs, Employment & Career Opportunities</p>
					<h2>Search for your desired job, <br/> <span class="text-primary">Apply</span> and Get Hired.</h2>

					<form class="dezPlaceAni" action="jobs.php" method="GET">

						<div class="row">

							<div class="col-md-5">
								<div class="form-group">
									<label>Job Title, Keywords, or Phrase</label>
									<div class="input-group">
										<input type="text" name="search" class="form-control" placeholder="">
										<div class="input-group-append">
										  <span class="input-group-text"><i class="fa fa-search"></i></span>
										</div>
									</div>
								</div>
							</div>

							<div class="col-md-5">
								<div class="form-group">
									<select name="type" class="form-control" style="height: 50px;" required>
										<option value="">Select Type</option>
										<option value="Part Time">Part Time</option>
										<option value="Full Time">Full Time</option>
									</select>
								</div>
							</div>

							<div class="col-md-2">
								<button type="submit" name="submit" class="site-button btn-block">Search</button>
							</div>

						</div>

					</form>

				</div>

			</div>

        </div>

    </div>
	
	<div class="section-full bg-white content-inner-2">
		<div class="container">
			<div class="d-flex job-title-bx section-head">
				<div class="mr-auto">
					<h2 class="m-b5">Recent Jobs</h2>
					<h6 class="fw4 m-b0">Recently Added Jobs</h5>
				</div>
				<div class="align-self-end">
					<a href="jobs.php" class="site-button button-sm">Browse All Jobs <i class="fa fa-long-arrow-right"></i></a>
				</div>
			</div>
			<div class="row">

				<div class="col-lg-9">

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

				<div class="col-lg-3">

					<div class="sticky-top">

						<div class="quote-bx">
							<div class="quote-info">
								<h4>Make a Difference with Your Online Resume!</h4>
								<p>Your resume in minutes with Get Hired Hub resume assistant is ready!</p>
								<a href="register.php" class="site-button">Create an Account</a>
							</div>
						</div>

					</div>

				</div>

			</div>

		</div>

	</div>
	
	
<?php include("includes/footer.php"); ?>