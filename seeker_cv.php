<?php include("includes/head.php"); ?>

  	<?php include("includes/navigation.php"); ?>
  	
		<div class="dez-bnr-inr overlay-black-middle" style="background-image:url(images/banner/bnr1.jpg);">
            <div class="container">
                <div class="dez-bnr-inr-entry">
                    <h1 class="text-white">Seeker CV</h1>
					<!-- Breadcrumb row -->
					<div class="breadcrumb-row">
						<ul class="list-inline">
							<li><a href="#">Home</a></li>
							<li>Seeker CV</li>
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
               
            <div class="row justify-content-center">
                
                <div class="col-md-8">
                    
                    <div class="mb-5 pl-5 pr-5" style="padding: 15px 20px;box-shadow: 0 0 27px 0 rgba(48,48,48,.09);">
                            
                        <h4><strong>CV</strong></h4>

                    </div>

                    <div class="mb-5 pt-5 pl-5 pr-5 pb-5" style="padding: 15px 20px;box-shadow: 0 0 27px 0 rgba(48,48,48,.09);">
                            
                        <h4><strong>PROFILE</strong></h4>
                            <?php
                                $js_id = $_GET['seeker_id'];
                                $fetch_seeker_details = mysqli_query($connection, "SELECT * FROM jobseekers WHERE js_id = '$js_id'");
                                $row = mysqli_fetch_array($fetch_seeker_details);

                            ?>
                        <div class="row mt-5">
                            
                            <div class="col-md-3">
                                
                                <div>
                                    <img src="img/jobseeker/<?php echo $row['picture']; ?>" class="img-thumbnail" style="width: 100%;height: 200px;">
                                </div>

                            </div>

                            <div class="col-md-9"><br>
                                <h6><strong>Name : </strong><?php echo $row['first_name'] . " " . $row['last_name']; ?></h6>
                                <h6><strong>Email : </strong><?php echo $row['email']; ?></h6>
                                <h6><strong>Contact : </strong><?php echo $row['contact']; ?></h6>
                                <h6><strong>Address : </strong><?php echo $row['address']; ?></h6>
                            </div>

                        </div>

                    </div>
                    <?php

                    $fetch_education = mysqli_query($connection, "SELECT * FROM seeker_education WHERE seeker_id = '$js_id'");
                    $check_edu = mysqli_num_rows($fetch_education);
                    $edu = mysqli_fetch_array($fetch_education);

                    ?>
                    <div class="mb-5 p-5" style="padding: 15px 20px;box-shadow: 0 0 27px 0 rgba(48,48,48,.09);">
                            
                        <h4><strong>EDUCATION & SKILLS</strong></h4>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <?php
                                    if ($check_edu > 0) {
                                        
                                    
                                ?>
                                <h6><strong>Last Degree : </strong><?php echo $edu['education']; ?></h6>
                                <?php
                                    } else {
                                        echo "<p>Education Not Added Yet!</p>";
                                    }
                                ?>
                            </div>  
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <h4><strong>Skills : </strong></h4>

                                    <?php

                                        $fetch_skills = mysqli_query($connection, "SELECT * FROM seeker_skills WHERE seeker_id = '$js_id'");
                                        $count_skills = mysqli_num_rows($fetch_skills);

                                        if ($count_skills > 0) {
                                            echo "<p>";
                                                while ($skillid = mysqli_fetch_array($fetch_skills)) {
                                                    
                                                        $fetch_skillname = mysqli_query($connection, "SELECT * FROM skills WHERE skill_id = '" . $skillid['skill_id'] . "'");
                                                        $skillname = mysqli_fetch_array($fetch_skillname);
                                                        echo $skillname['skill_name'] . ", ";

                                                }
                                            echo "</p>";
                                        } else {
                                            echo "<p>Skills Not Added Yet!</p>";
                                        }

                                    ?>

                                
                            </div>
                        </div>

                    </div>

                    <div class="mb-5 p-5" style="padding: 15px 20px;box-shadow: 0 0 27px 0 rgba(48,48,48,.09);">
                            
                        <h4><strong>EXPERIENCES</strong></h4>

                        <?php

                            $fetch_exps = mysqli_query($connection, "SELECT * FROM seeker_experiences WHERE seeker_id = '$js_id'");
                            $count_exps = mysqli_num_rows($fetch_exps);

                            if ($count_exps > 0) {
                                while ($exps = mysqli_fetch_array($fetch_exps)) {
                                
                        ?>

                        <div class="row">
                            <div class="col-md-6" style="border-bottom: 1px solid silver;">
                    
                                <h6 class="text-muted"><?php echo $exps['job_title']; ?></h6>
                        
                                <h6 class="text-muted" style="font-weight: 100;"><?php echo $exps['company_name']; ?></h6>
                                <h6><?php echo $exps['dfrom'] . " to " . $exps['dto']; ?></h6>
                                <p><?php echo $exps['description']; ?></p>
                            </div>
                        </div>
                        <?php

                                }

                            } else {
                                echo "<p>Experiences Not Added Yet!</p>";
                            }

                        ?>
                    </div>

                </div>

            </div>

        </div>

    </section>

<?php include("includes/footer.php"); ?>