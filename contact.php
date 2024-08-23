<?php include("includes/head.php"); ?>

  	<?php include("includes/navigation.php"); ?>
  	
		<div class="dez-bnr-inr overlay-black-middle" style="background-image:url(images/banner/bnr1.jpg);">
            <div class="container">
                <div class="dez-bnr-inr-entry">
                    <h1 class="text-white">Contact Us</h1>
					<!-- Breadcrumb row -->
					<div class="breadcrumb-row">
						<ul class="list-inline">
							<li><a href="#">Home</a></li>
							<li>Contact Us</li>
						</ul>
					</div>
					<!-- Breadcrumb row END -->
                </div>
            </div>
        </div>
        
        <div class="section-full content-inner bg-white contact-style-1">
			<div class="container">
                <div class="row">
					<!-- right part start -->
					<div class="col-lg-4 col-md-6 d-lg-flex d-md-flex">
                        <div class="p-a30 border m-b30 contact-area border-1 align-self-stretch radius-sm">
							<h4 class="m-b10">Quick Contact</h4>
							<p>If you have any questions simply use the following contact details.</p>
                            <ul class="no-margin">
                                <li class="icon-bx-wraper left m-b30">
                                    <div class="icon-bx-xs border-1"> <a href="#" class="icon-cell"><i class="ti-location-pin"></i></a> </div>
                                    <div class="icon-content">
                                        <h6 class="text-uppercase m-tb0 dez-tilte">Address:</h6>
                                        <p>Mirpur Azad Kashmir</p>
                                    </div>
                                </li>
                                <li class="icon-bx-wraper left  m-b30">
                                    <div class="icon-bx-xs border-1"> <a href="#" class="icon-cell"><i class="ti-email"></i></a> </div>
                                    <div class="icon-content">
                                        <h6 class="text-uppercase m-tb0 dez-tilte">Email:</h6>
                                        <p>get.hired.hub1@gmail.com</p>
                                    </div>
                                </li>
                                <li class="icon-bx-wraper left">
                                    <div class="icon-bx-xs border-1"> <a href="#" class="icon-cell"><i class="ti-mobile"></i></a> </div>
                                    <div class="icon-content">
                                        <h6 class="text-uppercase m-tb0 dez-tilte">PHONE</h6>
                                        <p>+92 3495956596</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- right part END -->
                    <!-- Left part start -->
					<div class="col-lg-4 col-md-6">
                        <div class="p-a30 m-b30 radius-sm bg-gray clearfix">
							<h4>Send Message Us</h4>
							<form method="post" action="">
                                <?php
                                    if (isset($_POST['submit'])) {
                                        
                                        $name = $_POST['name'];
                                        $email = $_POST['email'];
                                        $phone = $_POST['phone'];
                                        $message = $_POST['message'];

                                        $insert = mysqli_query($connection, "INSERT INTO contact_messages(name, email, phone, message) VALUES('$name', '$email', '$phone', '$message')");

                                        if ($insert) {
                                            echo "<div class='alert alert-success'>Your message has been sent successfully! We will contact you shortly.</div>";
                                        } else {
                                            echo "<div class='alert alert-danger'>Problem submitting your query. Please try again later.</div>";
                                        }

                                    }
                                ?>
                                <div class="row">

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input name="name" type="text" required class="form-control" placeholder="Your Name">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <div class="input-group"> 
                                                <input name="email" type="email" class="form-control" required  placeholder="Your Email Id" >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <div class="input-group"> 
                                                <input name="phone" type="number" class="form-control" required  placeholder="Your Phone Number" >
                                            </div>
                                        </div>
                                    </div>

                                     <div class="col-lg-12">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <textarea name="message" rows="4" class="form-control" required placeholder="Your Message..."></textarea>
                                            </div>
                                        </div>
                                    </div>
									
                                    <div class="col-lg-12">
                                        <button name="submit" type="submit" value="Submit" class="site-button "> <span>Submit</span> </button>
                                    </div>

                                </div>

                            </form>

                        </div>

                    </div>
                    
					<div class="col-lg-4 col-md-12 d-lg-flex m-b30">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3340.4625523440577!2d73.74244347535002!3d33.14948146485888!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x391fec085ec688ef%3A0xd988766d3ccdd31c!2sMirpur%20University%20of%20Science%20and%20Technology%20(MUST)!5e0!3m2!1sen!2s!4v1687425489147!5m2!1sen!2s" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
					</div>
                </div>
            </div>
        </div>

<?php include("includes/footer.php"); ?>