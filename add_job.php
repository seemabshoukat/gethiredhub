<?php include("includes/head.php"); ?>

  	<?php include("includes/navigation.php"); ?>
  	
		<div class="dez-bnr-inr overlay-black-middle" style="background-image:url(images/banner/bnr1.jpg);">
            <div class="container">
                <div class="dez-bnr-inr-entry">
                    <h1 class="text-white">Add Jobs</h1>
					<!-- Breadcrumb row -->
					<div class="breadcrumb-row">
						<ul class="list-inline">
							<li><a href="#">Home</a></li>
							<li>Add Jobs</li>
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
                                    
                                <h3><strong>ADD JOB</strong></h3>

                            </div>
                            <div class="col-md-6 text-right">
                                <a href="posted_jobs.php" class="site-button">View Job</a>
                            </div>
                        </div>

                        <form action="add_job.php" method="POST">
                            <?php

                                require "vendor/autoload.php";
                               
                                use PHPMailer\PHPMailer\PHPMailer;
                                use PHPMailer\PHPMailer\SMTP;
                                use PHPMailer\PHPMailer\Exception;

                                if (isset($_POST['add_job'])) {
                                    
                                    $job_title      = $_POST['job_title'];
                                    $city_id        = $_POST['city_id'];
                                    $edu_id         = $_POST['edu_id'];

                                    $type           = $_POST['type'];
                                    $end_date       = $_POST['end_date'];
                                    $description    = $_POST['description'];

                                    $today_date = date("Y-m-d");

                                    if ($end_date < $today_date) {
                                        ?>
                                        <div class="alert alert-danger" role="alert">
                                            <strong>Alert!</strong> Job End Date Can not Be in Past.
                                        </div>
                                        <?php
                                    } else {

                                        $company_id = $_SESSION['company_id'];

                                        $add_job = mysqli_query($connection, "INSERT INTO jobs(company_id, city_id, education_id, job_title, description, type, end_date, created_at) VALUES('$company_id', '$city_id', '$edu_id', '$job_title', '$description', '$type', '$end_date', '$today_date')");


                                        $education = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM educations WHERE edu_id = '$edu_id'"));

                                        $education_title = $education['education_title'];

                                        $getSeekerEducation = mysqli_query($connection, "SELECT * FROM seeker_education WHERE education = '$education_title'");

                                        // echo mysqli_num_rows($getSeekerEducation);
                                        // exit;

                                        if (mysqli_num_rows($getSeekerEducation) > 0) {
                                            
                                            $getSeekerId = mysqli_fetch_array($getSeekerEducation);

                                            $seeker_id = $getSeekerId['seeker_id'];

                                            $seeker = mysqli_fetch_array(mysqli_query($connection, "SELECT email, first_name FROM jobseekers WHERE js_id = '$seeker_id'"));

                                            $first_name = $seeker['first_name'];

                                            $email = $seeker['email'];

                                            // <!-- Send Email -->

                                            ///////////////////////////////////////////////////////////////////////

                                                $mail = new PHPMailer(true);

                                                try {

                                                    //Server settings
                                                    $mail->isSMTP();
                                                    $mail->Host       = 'smtp.gmail.com';
                                                    $mail->SMTPAuth   = true;
                                                    $mail->Username   = 'get.hired.hub1@gmail.com';
                                                    $mail->Password   = 'nhqhtwohefjtuxei';
                                                    $mail->Port       = 587;

                                                    //Recipients
                                                    $mail->setFrom('get.hired.hub1@gmail.com', 'Get Hired Hub');
                                                    $mail->addAddress($email, $first_name);     //Add a recipient

                                                    //Content
                                                    $mail->isHTML(true);
                                                    $mail->Subject = 'Jobs Alert';
                                                    $mail->Body    = $job_title . ' - job is posted. Visit website to apply on this job.';
                                                    $mail->AltBody = 'Jobs Alert';

                                                    $mail->send();

                                                } catch (Exception $e) {
                                                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                                                }

                                            ///////////////////////////////////////////////////////////////////////

                                        }

                                        ?>

                                        <div class="alert alert-success" role="alert">
                                            <strong>Alert!</strong> Job Added Successfully!
                                        </div>

                                        <?php

                                    }

                                }

                            ?>
                            <div class="form-group">
                                <label>Job Title</label>
                                <input type="text" name="job_title" value="<?php if(!empty($_POST['job_title'])) { echo $_POST['job_title']; } ?>" placeholder="Enter Job Title" class="form-control" required="">
                            </div>

                            <div class="form-group">
                                <label>City</label>
                                <select name="city_id" class="form-control">
                                    <option value="">Select City</option>
                                    <?php
                                    $fetch_cities = mysqli_query($connection, "SELECT * FROM cities");
                                    while ($cities = mysqli_fetch_array($fetch_cities)) {
                                    ?>
                                    <option value="<?php echo $cities['city_id']; ?>"><?php echo $cities['city_name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Education</label>
                                <select name="edu_id" class="form-control">
                                    <option value="">Select Education</option>
                                    <?php
                                    $fetch_educations = mysqli_query($connection, "SELECT * FROM educations");
                                    while ($educations = mysqli_fetch_array($fetch_educations)) {
                                    ?>
                                    <option value="<?php echo $educations['edu_id']; ?>"><?php echo $educations['education_title']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Job Type</label>
                                <select name="type" class="form-control" required="">
                                    <option value="">Select Type</option>
                                    <option value="Part Time">Part Time</option>
                                    <option value="Full Time">Full Time</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>End Date</label>
                                <input type="date" name="end_date" value="<?php if(!empty($_POST['end_date'])) { echo $_POST['end_date']; } ?>" class="form-control" required="">
                            </div>

                            <div class="form-group">
                                <label>Job Description</label>
                                <textarea name="description" placeholder="Enter Job Description" rows="5" cols="5" class="form-control"><?php if(!empty($_POST['description'])) { echo $_POST['description']; } ?></textarea>
                            </div>

                            <div class="form-group">
                                <input type="submit" name="add_job" class="site-button">
                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </section>

<?php include("includes/footer.php"); ?>