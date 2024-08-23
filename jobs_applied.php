<?php include("includes/head.php"); ?>

  	<?php include("includes/navigation.php"); ?>
  	
		<div class="dez-bnr-inr overlay-black-middle" style="background-image:url(images/banner/bnr1.jpg);">

            <div class="container">

                <div class="dez-bnr-inr-entry">

                    <h1 class="text-white">Jobs Applied</h1>
					
					<div class="breadcrumb-row">
						<ul class="list-inline">
							<li><a href="#">Home</a></li>
							<li>Jobs Applied</li>
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
                                <div class="col-md-12">
                                        
                                    <h4 class="mb-0"><strong>APPLIED JOBS</strong></h4>

                                </div>
                            </div>

                            <div class="table-responsive">
                                
                                <table class="table table-hover table-striped">
                                    
                                    <tr>
                                        <thead>
                                            <th>#</th>
                                            <th width="200">Job Title</th>
                                            <th>Job Type</th>
                                            <th>Applied Date</th>
                                            <th>Chat</th>
                                        </thead>
                                    </tr>

                                    <tbody>
                                        <?php
                                        $k = 1;
                                        $js_id = $_SESSION['js_id'];
                                            $fetch_posted_jobs = mysqli_query($connection, "SELECT * FROM jobs_applied WHERE seeker_id = '$js_id'");
                                            while ($row = mysqli_fetch_array($fetch_posted_jobs)) {
                                            
                                            $fetch_job_details = mysqli_query($connection, "SELECT * FROM jobs WHERE job_id = '" . $row['job_id'] . "'");
                                            $job = mysqli_fetch_array($fetch_job_details);
                                        ?>
                                        

                                            <td><?php echo $k; ?></td>
                                            <td><a href="job-single.php?jobid=<?php echo $row['job_id']; ?>"><strong><?php echo $job['job_title']; ?></strong></a></td>
                                            <td><?php echo $job['type']; ?></td>
                                            <td><?php echo $row['applied_at']; ?></td>
                                            <td>
                                                <a href="messenger.php?company_id=<?php echo $job['company_id']; ?>">Chat</a>
                                            </td>
                                        </tr>
                                        <?php
                                        $k++;
                                            }

                                        ?>
                                    </tbody>

                                </table>
                                
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>

<?php include("includes/footer.php"); ?>