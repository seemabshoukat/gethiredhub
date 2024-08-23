<?php include("includes/head.php"); ?>

  	<?php include("includes/navigation.php"); ?>
  	
		<div class="dez-bnr-inr overlay-black-middle" style="background-image:url(images/banner/bnr1.jpg);">
            <div class="container">
                <div class="dez-bnr-inr-entry">
                    <h1 class="text-white">Dashboard</h1>
					<!-- Breadcrumb row -->
					<div class="breadcrumb-row">
						<ul class="list-inline">
							<li><a href="#">Home</a></li>
							<li>Dashboard</li>
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
                            
                        <h2><strong>WELCOME TO GET HIRED HUB</strong></h2>

                    </div>

                </div>

            </div>

        </div>

    </section>

<?php include("includes/footer.php"); ?>