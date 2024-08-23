<?php include("includes/head.php"); ?>

    <?php include("includes/navigation.php"); ?>
    
        <div class="dez-bnr-inr overlay-black-middle" style="background-image:url(images/banner/bnr1.jpg);">

            <div class="container">

                <div class="dez-bnr-inr-entry">

                    <h1 class="text-white">Messenger</h1>
                    
                    <div class="breadcrumb-row">
                        <ul class="list-inline">
                            <li><a href="#">Home</a></li>
                            <li>Messenger</li>
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
                                        
                                    <h4 class="m-0"><strong>Messenger</strong></h4>

                                </div>
                            </div>
                        </div>


                        <div class="mt-5" style="padding: 15px 20px;box-shadow: 0 0 27px 0 rgba(48,48,48,.09);">
                            
                            <div class="row">
                                <div class="col-md-3" style="height: 500px;overflow-y: scroll;">
                                    <?php

                                        $current_user_id = $_SESSION['company_id'];

                                        $messages = mysqli_query($connection, "SELECT * FROM messages WHERE company_id = '$current_user_id' GROUP BY js_id");
                                        $countMessages = mysqli_num_rows($messages);

                                        while ($sender = mysqli_fetch_array($messages)) {

                                            $seeker = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM jobseekers WHERE js_id = '" . $sender['js_id'] . "'"));

                                            ?>

                                            <a href="seller-messenger.php?js_id=<?php echo $seeker['js_id']; ?>">
                                                <div class="row pt-3 pb-3" style="border-right: 1px solid #efefef;border-bottom: 1px solid #efefef;">
                                               
                                                    <div class="col-md-4">
                                                        <img src="img/jobseeker/<?php echo $seeker['picture']; ?>" style="width: 100px;border-radius: 50%;height: 50px;width: 50px;">
                                                    </div>
                                                    <div class="col-md-8">
                                                        <p><?php echo $seeker['first_name']; ?></p>
                                                    </div>
                                               
                                                </div>
                                            </a>

                                            <?php

                                        }

                                    ?>
                                </div>
                                <div class="col-md-9">
                                    <?php

                                        if (isset($_GET['js_id'])) {
                                            $_SESSION['js_id'] = $_GET['js_id'];
                                            ?>

                                            <div id="scroll_messages" class="col-md-9" style="padding: 50px;height: 500px;overflow-y: scroll;">

                                                <div id="show_chat"></div>

                                            </div>

                                            <?php
                                        } else {
                                            ?>
                                            <div class="col-md-10 pt-5 mt-5 text-center">
                                                <h2 class="pt-5 mt-5">Select a Conversation</h2>
                                                <p style="font-size: 20px;font-weight: 400;">Try selecting a conversation.</p>
                                            </div>
                                            <?php
                                        }

                                    ?>
                                </div>
                            </div>
                            <div class="row pt-3">
                                <div class="col-md-3 text-right">
                                    
                                </div>
                                <div class="col-md-9 messengerBubbles">
                                    
                                    <div class="d-flex">
                                        <input id="reciever" type="hidden" name="company_id" value="<?php echo $_SESSION['company_id']; ?>">
                                        <input id="sender" type="hidden" name="js_id" value="<?php if(isset($_GET['js_id'])) { echo $_GET['js_id']; } ?>">
                                        <input id="message" type="text" name="message" placeholder="Write Something..." class="form-control" style="width: 92%;" required="">
                                        <input id="btn_messenger" type="submit" name="btn_messenger" class="btn btn-primary" >
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </section>

<?php include("includes/footer.php"); ?>
<script>
    
    function Get_chat() {

        $.ajax({

            url: 'includes/requests/fetch_company_chat.php',
            type: 'GET',
            success: function(data, status){

                $("#show_chat").html(data);
               
                var element = document.getElementById("scroll_messages");
                element.scrollTop = element.scrollHeight;

            },

        });
    }

      
    $(document).ready(function(){
        setInterval(function () {
            Get_chat();
        }, 1000);
      
    }); // Document ready function end

    // Message sending code starts here
    $("#btn_messenger").click(function(){

        var reciever = $("#reciever").val();
        var sender = $("#sender").val();
        var chat_message = $("#message").val();
        console.log(reciever);
        console.log(sender);
        console.log(chat_message);
        $.ajax({

            url: "includes/requests/send_company_message.php",
            type: "POST",
            data: {
                reciever:reciever,
                sender:sender,
                chat_message:chat_message,
            },

            success: function(data, status) {
                $("#message").val('');
                Get_chat();
            },

        });
    });
</script>