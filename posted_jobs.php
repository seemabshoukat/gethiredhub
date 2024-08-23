<?php include("includes/head.php"); ?>

  	<?php include("includes/navigation.php"); ?>
  	
		<div class="dez-bnr-inr overlay-black-middle" style="background-image:url(images/banner/bnr1.jpg);">
            <div class="container">
                <div class="dez-bnr-inr-entry">
                    <h1 class="text-white">Posted Jobs</h1>
					<!-- Breadcrumb row -->
					<div class="breadcrumb-row">
						<ul class="list-inline">
							<li><a href="#">Home</a></li>
							<li>Posted Jobs</li>
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
                                    
                                <h3 class=""><strong>POSTED JOBS</strong></h3>

                            </div>
                            <div class="col-md-6 text-right">
                                <?php
                                if (isset($_GET['jobid'])) {
                                    ?>
                                    <a href="posted_jobs.php" class="site-button">Go Back</a>
                                    <?php
                                } else {
                                ?>
                                <a href="add_job.php" class="site-button">Add New Job</a>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <?php

                                if (isset($_GET['jobid'])) {
                                    $jobid = $_GET['jobid'];
                                    $k = 1;
                                    $fetch_applied_jobs = mysqli_query($connection, "SELECT * FROM jobs_applied WHERE job_id = '$jobid'");
                                    $count_jobs = mysqli_num_rows($fetch_applied_jobs);
                                    ?>
                                    <table class="table table-hover table-striped">
                                        <tr>
                                            <thead>
                                                <th>#</th>
                                                <th>Seeker Name</th>
                                                <th>Applied Date</th>
                                            </thead>
                                        </tr>
                                        <tbody>
                                            <?php
                                            if ($count_jobs > 0) {
                                                
                                            
                                                while ($row = mysqli_fetch_array($fetch_applied_jobs)) {
                                                
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $k; ?></td>
                                                        <td>
                                                            <?php
                                                                $fetch_seeker = mysqli_query($connection, "SELECT * FROM jobseekers WHERE js_id ='" . $row['seeker_id'] . "'");
                                                                $seeker = mysqli_fetch_array($fetch_seeker);
                                                                echo "<a href='seeker_cv.php?seeker_id=" . $row['seeker_id'] . "'>" . $seeker['first_name'] . " " .  $seeker['last_name'] . "</a>";
                                                            ?>
                                                            
                                                        </td>
                                                        <td><?php echo $row['applied_at']; ?></td>
                                                    </tr>
                                                    <?php
                                                    $k++;
                                                }
                                            } else {

                                                echo "<tr class='text-center'><td colspan='3'>No Applicants Yet.</td></tr>";

                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                    <?php
                                } elseif (isset($_GET['jobid_skill'])) {
                                    
                                    $jobid = $_GET['jobid_skill'];
                                    ?>

                                    <form action="" method="POST">
                                        <?php
                                        if (isset($_POST['add_skills'])) {
                                            
                                            $job_id = $_POST['jobid'];
                                            $skills = $_POST['skill_id'];

                                            foreach ($skills as $skill) {
                                                
                                                $insert_skills = mysqli_query($connection, "INSERT INTO job_skills(job_id, skill_id) VALUES('$job_id', '$skill')");

                                            }

                                            header("Location: posted_jobs.php");

                                        }
                                        ?>
                                        <input type="hidden" name="jobid" value="<?php echo $jobid; ?>">
                                        <div class="form-group">
                                            <label>Job Skills</label>
                                            <select class="skills form-control" name="skill_id[]" multiple="multiple" required="">
                                                <?php
                                                $fetch_skills = mysqli_query($connection, "SELECT * FROM skills");
                                                while ($skills = mysqli_fetch_array($fetch_skills)) {
                                                ?>
                                                <option value="<?php echo $skills['skill_id']; ?>"><?php echo $skills['skill_name']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" name="add_skills" class="site-button">
                                        </div>
                                    </form>

                                    <?php
                                } else {

                            ?>
                            <table class="table table-hover table-striped">
                                
                                <tr>
                                    <thead>
                                        <th>#</th>
                                        <th width="200">Job Title</th>
                                        <th width="600">Description</th>
                                        <th>Location</th>
                                        <th>Type</th>
                                        <th>Created Date</th>
                                        <th>Last Date</th>
                                        <th>Skills</th>
                                        <th>Delete</th>
                                    </thead>
                                </tr>

                                <tbody>
                                    <?php
                                    $k = 1;
                                    $company_id = $_SESSION['company_id'];
                                        $fetch_posted_jobs = mysqli_query($connection, "SELECT * FROM jobs WHERE company_id = '$company_id'");
                                        while ($row = mysqli_fetch_array($fetch_posted_jobs)) {
                                        
                                        if ($row['end_date'] < date("Y-m-d")) {
                                            echo "<tr style='background:#454545;color:white;'>";
                                        } else {
                                            echo "<tr>";
                                        }
                                    ?>
                                    

                                        <td><?php echo $k; ?></td>
                                        <td><a href="posted_jobs.php?jobid=<?php echo $row['job_id']; ?>"><strong><?php echo $row['job_title']; ?></strong></a></td>
                                        <td><?php echo substr($row['description'], 0, 200); ?></td>
                                        <td>

                                            <?php
                                            $fetch_city = mysqli_query($connection, "SELECT * FROM cities WHERE city_id = '" . $row['city_id'] . "'");
                                            $city = mysqli_fetch_array($fetch_city);
                                            echo $city['city_name'];
                                            ?>
                                            
                                        </td>
                                        <td><?php echo $row['type']; ?></td>
                                        <td><?php echo $row['created_at']; ?></td>
                                        <td><?php echo $row['end_date']; ?></td>
                                        <td>
                                            <?php

                                            $fetch_skills = mysqli_query($connection, "SELECT * FROM job_skills WHERE job_id = '" . $row['job_id'] . "'");
                                            $count_skills = mysqli_num_rows($fetch_skills);
                                            if ($count_skills > 0) {
                                                
                                                while ($skills = mysqli_fetch_array($fetch_skills)) {

                                                    $fetch_skill_name = mysqli_query($connection, "SELECT * FROM skills WHERE skill_id = '" . $skills['skill_id'] . "'");
                                                    $skill_name = mysqli_fetch_array($fetch_skill_name);
                                                    echo $skill_name['skill_name'] . ", ";

                                                }

                                            } else {

                                            ?>
                                            <a href="posted_jobs.php?jobid_skill=<?php echo $row['job_id']; ?>" class="btn btn-info btn-xs">Add Skills</a>
                                            <?php } ?>
                                        </td>
                                        <td><a onClick="javascript: return confirm('Are you sure you want to Delete This Job?'); " href="posted_jobs.php?delete=<?php echo $row['job_id']; ?>" class="btn btn-danger btn-xs">Delete</a></td>
                                    </tr>
                                    <?php
                                    $k++;
                                        }

                                    ?>
                                </tbody>

                            </table>
                            <?php } ?>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <?php

        if (isset($_GET['delete'])) {
            
            $delete = $_GET['delete'];

            $delete = mysqli_query($connection, "DELETE FROM jobs WHERE job_id = '$delete'");

            header("Location: posted_jobs.php");

        }

    ?>

<?php include("includes/footer.php"); ?>