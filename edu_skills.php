<?php include("includes/head.php"); ?>

  	<?php include("includes/navigation.php"); ?>
  	
		<div class="dez-bnr-inr overlay-black-middle" style="background-image:url(images/banner/bnr1.jpg);">

            <div class="container">

                <div class="dez-bnr-inr-entry">

                    <h1 class="text-white">Education & Skills</h1>
					
					<div class="breadcrumb-row">
						<ul class="list-inline">
							<li><a href="#">Home</a></li>
							<li>Education & Skills</li>
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
                                        
                                    <h4 class="m-0"><strong>EDUCATION, SKILLS & EXPERIENCES</strong></h4>

                                </div>
                            </div>
                        </div>


                        <div class="mt-5" style="padding: 15px 20px;box-shadow: 0 0 27px 0 rgba(48,48,48,.09);">
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row p-4">
                                    
                                        <h4 class="pb-5">EDUCATION</h4>

                                        <div class="col-md-12">
                                            <?php
                                                $js_id = $_SESSION['js_id'];

                                                if (isset($_GET['seeker_edu'])) {

                                                    if (isset($_POST['add_edu'])) {

                                                        $skr_edu = $_POST['education'];
                                                        
                                                        $check_already_exist = mysqli_query($connection, "SELECT * FROM seeker_education WHERE seeker_id = '$js_id'");
                                                        $count_records = mysqli_num_rows($check_already_exist);

                                                        if ($count_records > 0) {
                                                            
                                                            $update_edu = mysqli_query($connection, "UPDATE seeker_education SET education = '$skr_edu' WHERE seeker_id = '$js_id'");

                                                            header("Location: edu_skills.php");

                                                        } else {

                                                            $insert_edu = mysqli_query($connection, "INSERT INTO seeker_education(seeker_id, education) VALUES('$js_id', '$skr_edu')");

                                                            header("Location: edu_skills.php");

                                                        }

                                                    }

                                                    ?>
                                                    <form action="" method="POST">
                                                        <div class="form-group">
                                                            <label>Select Skills You Have</label>
                                                            <select name="education" class="form-control">
                                                                <option>Select Skills</option>
                                                                <?php
                                                                $fetch_educations = mysqli_query($connection, "SELECT * FROM educations");
                                                                while ($edus = mysqli_fetch_array($fetch_educations)) {
                                                                    echo "<option value='" . $edus['education_title'] . "'>" . $edus['education_title'] . "</option>";
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="submit" name="add_edu" class="site-button">
                                                        </div>
                                                    </form>
                                                    <?php
                                                } else {

                                                    $check_education = mysqli_query($connection, "SELECT * FROM seeker_education WHERE seeker_id = '$js_id'");
                                                    $seeker_edu = mysqli_fetch_array($check_education);
                                                    $count_exist = mysqli_num_rows($check_education);
                                                    if ($count_exist > 0 ) {
                                                        ?>
                                                            <p><strong class="fw8">Your Last Degree : </strong> <?php  echo $seeker_edu['education']; ?><span style="font-size: 12px;margin-left: 10px;"><a href="edu_skills.php?seeker_edu=<?php echo $js_id; ?>">change</a></span></p>

                                                        <?php
                                                    } else {
                                                        ?>
                                                
                                                        <h4>Pleas Add Your Education<a href="edu_skills.php?seeker_edu=<?php echo $js_id; ?>"> here.</a></h4>
                                                        
                                                    
                                                        <?php
                                                    }
                                                }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="mt-5 p-4" style="padding: 15px 20px;box-shadow: 0 0 27px 0 rgba(48,48,48,.09);">
                            <div class="row">
                                <div class="col-md-12">

                                    <h4 class="mb-5">SKILLS</h4>

                                    <?php
                                        $js_id = $_SESSION['js_id'];

                                            if (isset($_GET['seeker_skills'])) {
                                                
                                                $sk_id = $_GET['seeker_skills'];

                                                if (isset($_POST['add_skills'])) {
                                                    
                                                    $skills = $_POST['skills'];

                                                    foreach ($skills as $skill) {

                                                            $insert_skill = mysqli_query($connection, "INSERT INTO seeker_skills(seeker_id, skill_id) VALUES('$js_id', '$skill')");
                                                            // echo "done";
                                                            header("Location: edu_skills.php");

                                                    }

                                                }

                                            ?>
                                            <form action="" method="POST">
                                                <div class="form-group">
                                                    <label>Select Skills You Have</label>
                                                    <select name="skills[]" class="skills form-control" multiple="multiple" required="">
                                                        <option>Select Skills</option>
                                                        <?php
                                                        $fetch_skills = mysqli_query($connection, "SELECT * FROM skills");
                                                        while ($skills = mysqli_fetch_array($fetch_skills)) {
                                                            echo "<option value='" . $skills['skill_id'] . "'>" . $skills['skill_name'] . "</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <input type="submit" name="add_skills" class="site-button">
                                                </div>
                                            </form>
                                            <?php
                                            } else {

                                                $check_skills = mysqli_query($connection, "SELECT * FROM seeker_skills WHERE seeker_id = '$js_id'");
                                                $count_exist = mysqli_num_rows($check_skills);
                                                if ($count_exist > 0 ) {
                                                    ?>

                                                        <h4><strong>Your Skills : </strong></h4>
                                                        <p>
                                                            <?php

                                                            while ($sk_skills = mysqli_fetch_array($check_skills)) {
                                                                $skill_id = $sk_skills['skill_id'];
                                                            
                                                            ?>
                                                                
                                                                    <?php
                                                                    $select_skils = mysqli_query($connection, "SELECT * FROM skills WHERE skill_id = '$skill_id'");
                                                                    while ($skill = mysqli_fetch_array($select_skils)) {
                                                                    ?>
                                                                    <a onClick="javascript: return confirm('Are you sure you want to Delete <?php echo $skill['skill_name']; ?> Skill?'); " href="edu_skills.php?delete_skill=<?php echo $sk_skills['ss_id'];?>"><?php echo $skill['skill_name']; ?></a>, 
                                                                    <?php
                                                                    }
                                                                    ?>

                                                            <?php
                                                            }
                                                            ?>

                                                            <span style="font-size: 12px;margin-left: 10px;"><a href="edu_skills.php?seeker_skills=<?php echo $js_id; ?>">change</a></span>
                                                        </p>

                                                    <?php
                                                } else {
                                                        ?>
                                                
                                                        <h4>Add Skills You Have<a href="edu_skills.php?seeker_skills=<?php echo $js_id; ?>"> here.</a></h4>
                                                        
                                                    
                                                        <?php
                                                }
                                    
                                            }

                                    ?>
                                </div>
                            </div>
                        </div>

                        <div class="mt-5 p-4" style="padding: 15px 20px;box-shadow: 0 0 27px 0 rgba(48,48,48,.09);">
                                
                            <div class="row">
                                
                                <div class="col-md-12">
                                    
                                    <h4 class="mb-5">

                                        EXPERIENCES
                                    <?php
                                        if (!isset($_GET['add_exp'])) {
                                            echo "<a href='edu_skills.php?add_exp' style='font-size: 14px;'>Add new</a>";
                                        }
                                    ?>
                                    </h4>
                                    

                                </div>

                            </div>

                            <?php
                            if (isset($_GET['add_exp'])) {
                                
                                ?>
                                <div class="row">
                            
                                    <div class="col-md-12">
                                        <form action="" method="POST">
                                            <?php

                                                if (isset($_POST['add_exp'])) {
                                                    
                                                    $job_title = $_POST['job_title'];
                                                    $company_name = $_POST['company_name'];
                                                    $city_id = $_POST['city_id'];
                                                    $frommonth = $_POST['frommonth'];
                                                    $fromyear = $_POST['fromyear'];
                                                    $tomonth = $_POST['tomonth'];
                                                    $toyear = $_POST['toyear'];
                                                    $description = $_POST['description'];

                                                    $dto = $tomonth . " " . $toyear;
                                                    
                                                    $dfrom  = $frommonth . " " . $fromyear;
                                                    

                                                    $insert_exp = mysqli_query($connection, "INSERT INTO seeker_experiences(seeker_id, city_id, job_title, company_name, dfrom, dto, description) VALUES('$js_id', '$city_id', '$job_title', '$company_name', '$dfrom', '$dto', '$description')");

                                                    header("Location: edu_skills.php");

                                                }

                                            ?>
                                            <div class="form-group">
                                                <label>Job Title</label>
                                                <input type="text" name="job_title" placeholder="Enter Job Title" class="form-control" required="">
                                            </div>
                                            <div class="form-group">
                                                <label>Company Name</label>
                                                <input type="text" name="company_name" placeholder="Enter Company Name" class="form-control" required="">
                                            </div>
                                            <div class="form-group">
                                                <label>Select City</label>
                                                <select name="city_id" class="form-control">
                                                    <option value="">Select City</option>
                                                    <?php
                                                    $fetch_cities = mysqli_query($connection, "SELECT * FROM cities");
                                                    while ($cities = mysqli_fetch_array($fetch_cities)) {
                                                        ?>
                                                        <option value="<?php echo $cities['city_id']; ?>"><?php echo $cities['city_name']; ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Time Period</label><br>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-1">
                                                    <div id="current"><strong>Present</strong></div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <select name="frommonth" class="form-control" required="">
                                                            <option value="">Month:</option>
                                                            <option value="January">January</option>
                                                            <option value="February">February</option>
                                                            <option value="March">March</option>
                                                            <option value="April">April</option>
                                                            <option value="May">May</option>
                                                            <option value="June">June</option>
                                                            <option value="July">July</option>
                                                            <option value="August">August</option>
                                                            <option value="September">September</option>
                                                            <option value="October">October</option>
                                                            <option value="November">November</option>
                                                            <option value="December">December</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <select name="fromyear" class="form-control" required="">
                                                            <option value="">Year:</option>
                                                            <option value="2023">2023</option>
                                                            <option value="2022">2022</option>
                                                            <option value="2021">2021</option>
                                                            <option value="2020">2020</option>
                                                            <option value="2019">2019</option>
                                                            <option value="2018">2018</option>
                                                            <option value="2017">2017</option>
                                                            <option value="2016">2016</option>
                                                            <option value="2015">2015</option>
                                                            <option value="2014">2014</option>
                                                            <option value="2013">2013</option>
                                                            <option value="2012">2012</option>
                                                            <option value="2011">2011</option>
                                                            <option value="2010">2010</option>
                                                            <option value="2009">2009</option>
                                                            <option value="2008">2008</option>
                                                            <option value="2007">2007</option>
                                                            <option value="2006">2006</option>
                                                            <option value="2005">2005</option>
                                                            <option value="2004">2004</option>
                                                            <option value="2003">2003</option>
                                                            <option value="2002">2002</option>
                                                            <option value="2001">2001</option>
                                                            <option value="2000">2000</option>
                                                            <option value="1999">1999</option>
                                                            <option value="1998">1998</option>
                                                            <option value="1997">1997</option>
                                                            <option value="1996">1996</option>
                                                            <option value="1995">1995</option>
                                                            <option value="1994">1994</option>
                                                            <option value="1993">1993</option>
                                                            <option value="1992">1992</option>
                                                            <option value="1991">1991</option>
                                                            <option value="1990">1990</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                    <span>To: </span>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <select name="tomonth" class="form-control" required="">
                                                            <option value="">Month:</option>
                                                            <option value="January">January</option>
                                                            <option value="February">February</option>
                                                            <option value="March">March</option>
                                                            <option value="April">April</option>
                                                            <option value="May">May</option>
                                                            <option value="June">June</option>
                                                            <option value="July">July</option>
                                                            <option value="August">August</option>
                                                            <option value="September">September</option>
                                                            <option value="October">October</option>
                                                            <option value="November">November</option>
                                                            <option value="December">December</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <select name="toyear" class="form-control" required="">
                                                            <option value="">Year:</option>
                                                            <option value="2023">2023</option>
                                                            <option value="2022">2022</option>
                                                            <option value="2021">2021</option>
                                                            <option value="2020">2020</option>
                                                            <option value="2019">2019</option>
                                                            <option value="2018">2018</option>
                                                            <option value="2017">2017</option>
                                                            <option value="2016">2016</option>
                                                            <option value="2015">2015</option>
                                                            <option value="2014">2014</option>
                                                            <option value="2013">2013</option>
                                                            <option value="2012">2012</option>
                                                            <option value="2011">2011</option>
                                                            <option value="2010">2010</option>
                                                            <option value="2009">2009</option>
                                                            <option value="2008">2008</option>
                                                            <option value="2007">2007</option>
                                                            <option value="2006">2006</option>
                                                            <option value="2005">2005</option>
                                                            <option value="2004">2004</option>
                                                            <option value="2003">2003</option>
                                                            <option value="2002">2002</option>
                                                            <option value="2001">2001</option>
                                                            <option value="2000">2000</option>
                                                            <option value="1999">1999</option>
                                                            <option value="1998">1998</option>
                                                            <option value="1997">1997</option>
                                                            <option value="1996">1996</option>
                                                            <option value="1995">1995</option>
                                                            <option value="1994">1994</option>
                                                            <option value="1993">1993</option>
                                                            <option value="1992">1992</option>
                                                            <option value="1991">1991</option>
                                                            <option value="1990">1990</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Description</label>
                                                <textarea name="description" class="form-control" placeholder="Enter Details" rows="5" cols="5" required=""></textarea>
                                            </div>
                                            <div class="form-group">
                                                <input type="submit" name="add_exp" class="site-button" value="Add">
                                            </div>
                                        </form>
                                    </div>
                                
                                </div>
                            </div>
                            <?php

                            } else {


                                $fetch_experiences = mysqli_query($connection, "SELECT * FROM seeker_experiences WHERE seeker_id = '$js_id'");
                                $count_experiences = mysqli_num_rows($fetch_experiences);

                                if ($count_experiences > 0) {
                                

                                    while ($exps = mysqli_fetch_array($fetch_experiences)) {
                                    
                                        ?>
                                        <div class="row">
                                            <div class="col-md-6" style="border-bottom: 1px solid silver;">
                                    
                                                <h4 class="mt-4"><?php echo $exps['job_title']; ?></h4>
                                        
                                                <h4 class="text-muted" style="font-weight: 100;"><?php echo $exps['company_name']; ?></h4>
                                                <h6><?php echo $exps['dfrom'] . " to " . $exps['dto']; ?></h6>
                                                <p><?php echo $exps['description']; ?></p>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                } else {

                                    echo "
                                        <div class='row'>
                                            <div class='col-md-6'>
                                                <h4>Add Your Experience<span><a href='edu_skills.php?add_exp'> Here</a></span></h4>
                                            </div>
                                        </div>
                                    ";

                                }
                            }
                            ?>
                        </div>
                
                    </div>

                </div>

            </div>

        </section>
<?php

    if (isset($_GET['delete_skill'])) {
        $delete = $_GET['delete_skill'];
        $query = mysqli_query($connection, "DELETE FROM seeker_skills WHERE seeker_id = '$js_id' AND ss_id = '$delete'");
        header("Location: edu_skills.php");
    }

    if (isset($_GET['remove'])) {
        
        $remove = $_GET['remove'];

        $remove_exp = mysqli_query($connection, "DELETE FROM seeker_experiences WHERE seid = '$remove'");

        header("Location: edu_skills.php");

    }

?>
<?php include("includes/footer.php"); ?>