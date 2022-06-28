<!-- PHP INCLUDES -->
<head>
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Indie+Flower&family=Lato&display=swap" rel="stylesheet">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

</head>
<?php

    include "connect.php";
    include 'Includes/functions/functions.php';
    include "Includes/templates/header.php";
    //include "Includes/templates/navbar.php";



    //Getting website settings
   
    $stmt_web_settings = $con->prepare("SELECT * FROM website_settings");
    $stmt_web_settings->execute();
    $web_settings = $stmt_web_settings->fetchAll();

    $restaurant_name = "";
    $restaurant_email = "";
    $restaurant_address = "";
    $restaurant_phonenumber = "";

    foreach ($web_settings as $option)
    {
        if($option['option_name'] == 'restaurant_name')
        {
            $restaurant_name = $option['option_value'];
        }

        elseif($option['option_name'] == 'restaurant_email')
        {
            $restaurant_email = $option['option_value'];
        }

        elseif($option['option_name'] == 'restaurant_phonenumber')
        {
            $restaurant_phonenumber = $option['option_value'];
        }
        elseif($option['option_name'] == 'restaurant_address')
        {
            $restaurant_address = $option['option_value'];
        }
    }

?>

	<!-- HOME SECTION -->
	<section class="home-section" id="home">
		<div class="opacity">
			
		</div>
		<?php
		include "Includes/templates/navbar.php";
		?>
		<div data-aos="fade-left">
		<div class="container">
			<div class="row" style="flex-wrap: nowrap;">
				<div class="col-md-6 home-left-section">
					<div style="padding: 100px 0px; ">
						<h1 data-aos="fade-up">
							Halli food
						</h1>
						<h2 data-aos="fade-up">
							MAKING PEOPLE HAPPY
						</h2>
						
						<div style="display: flex;">
							<a href="order_food.php" target="_blank" class="bttn_style_1" style="margin-right: 10px; display: flex;justify-content: center;align-items: center;">
								Order Now
								<i class="fas fa-angle-right"></i>
							</a>
							<a href="#menus" class="bttn_style_2" style="display: flex;justify-content: center;align-items: center;">
								VIEW MENU
								<i class="fas fa-angle-right"></i>
							</a>
						</div>
					</div>
				</div>	
			</div>
		</div>

		
	</section>

	<!-- OUR QUALITIES SECTION -->
		

	<section class="our_qualities" style="padding:100px 0px;">
<div class="container">
<h1><center>We are not the First but we are THE BEST</h1></center>
			<div class="row">
				<div class="col-md-4">
				</div>
				<div class="col-md-4">
					<div class="our_qualities_column">
	                    <img src="Design/images/restaurant-mockup1.png" >
	                    <div class="caption">
	                        <h3>
	                            Fast Delivery
	                        </h3>
	                        <p>
	                        	
	                        </p>
	                    </div>
	                </div>
				</div>
			

			</div>
		</div>
	</section>

	<!-- OUR MENUS SECTION -->

	<section class="our_menus" id="menus" >
		<div class="container">
			<h2 style="text-align: center;margin-bottom: 30px">DISCOVER OUR MENUS</h2>
			<div class="menus_tabs" data-aos="flip-left"
     data-aos-easing="ease-out-cubic"
     data-aos-duration="2000">
				<div class="menus_tabs_picker">
					<ul style="text-align: center;margin-bottom: 70px">
						<?php

	                        $stmt = $con->prepare("Select * from menu_categories");
	                        $stmt->execute();
	                        $rows = $stmt->fetchAll();
	                        $count = $stmt->rowCount();

	                        $x = 0;

	                        foreach($rows as $row)
	                        {
	                        	if($x == 0)
	                        	{
	                        		echo "<li class = 'menu_category_name tab_category_links active_category' onclick=showCategoryMenus(event,'".str_replace(' ', '', $row['category_name'])."')>";
	                        			echo $row['category_name'];
	                        		echo "</li>";

	                        	}
	                        	else
	                        	{
	                        		echo "<li class = 'menu_category_name tab_category_links' onclick=showCategoryMenus(event,'".str_replace(' ', '', $row['category_name'])."')>";
	                        			echo $row['category_name'];
	                        		echo "</li>";
	                        	}

	                        	$x++;
	                     		
	                        }
						?>
					</ul>
				</div>

				<div class="menus_tab" >
					<?php
                
                        $stmt = $con->prepare("Select * from menu_categories");
                        $stmt->execute();
                        $rows = $stmt->fetchAll();
                        $count = $stmt->rowCount();

                        $i = 0;

                        foreach($rows as $row) 
                        {

                            if($i == 0)
                            {

                                echo '<div class="menu_item  tab_category_content" id="'.str_replace(' ', '', $row['category_name']).'" style=display:block>';

                                    $stmt_menus = $con->prepare("Select * from menus where category_id = ?");
                                    $stmt_menus->execute(array($row['category_id']));
                                    $rows_menus = $stmt_menus->fetchAll();
                                    if($stmt_menus->rowCount() == 0)
                                    {
                                        echo "<div class='no_menus_div'>No Available Menus for this category!</div>";
                                    }

                                    echo "<div class='row'>";
	                                    foreach($rows_menus as $menu)
	                                    {
	                                        ?>

	                                            <div class="col-md-4 col-lg-3 menu-column">
	                                                <div class="thumbnail" style="cursor:pointer">
	                                                    <?php $source = "admin/Uploads/images/".$menu['menu_image']; ?>

	                                                    <div class="menu-image">
													        <div class="image-preview">
													            <div style="background-image: url('<?php echo $source; ?>');"></div>
													        </div>
													    </div>
														                                                    
	                                                    <div class="caption">
	                                                        <h5>
	                                                            <?php echo $menu['menu_name'];?>
	                                                        </h5>
	                                                        <p>
	                                                            <?php echo $menu['menu_description']; ?>
	                                                        </p>
	                                                        <span class="menu_price">
	                                                        	<?php echo "$".$menu['menu_price']; ?>
	                                                        </span>
	                                                    </div>
	                                                </div>
	                                            </div>

	                                        <?php
	                                    }
	                                echo "</div>";

                                echo '</div>';

                            }

                            else
                            {

                                echo '<div class="menus_categories  tab_category_content" id="'.str_replace(' ', '', $row['category_name']).'">';

                                    $stmt_menus = $con->prepare("Select * from menus where category_id = ?");
                                    $stmt_menus->execute(array($row['category_id']));
                                    $rows_menus = $stmt_menus->fetchAll();

                                    if($stmt_menus->rowCount() == 0)
                                    {
                                        echo "<div class = 'no_menus_div'>No Available Menus for this category!</div>";
                                    }

                                    echo "<div class='row'>";
	                                    foreach($rows_menus as $menu)
	                                    {
	                                        ?>

	                                            <div class="col-md-4 col-lg-3 menu-column">
	                                                <div class="thumbnail" style="cursor:pointer">
	                                                	<?php $source = "admin/Uploads/images/".$menu['menu_image']; ?>
	                                                    <div class="menu-image" >
													        <div class="image-preview">
													            <div style="background-image: url('<?php echo $source; ?>');"></div>
													        </div>
													    </div>
	                                                    <div class="caption">
	                                                        <h5>
	                                                            <?php echo $menu['menu_name'];?>
	                                                        </h5>
	                                                        <p>
	                                                            <?php echo $menu['menu_description']; ?>
	                                                        </p>
	                                                        <span class="menu_price">
	                                                        	<?php echo "$".$menu['menu_price']; ?>
	                                                        </span>
	                                                    </div>
	                                                </div>
	                                            </div>

	                                        <?php
	                                    }
	                               	echo "</div>";

                                echo '</div>';

                            }

                            $i++;
                            
                        }
                    
                        echo "</div>";
                
                    ?>
				</div>
			</div>
		</div>
	</section>

	<!-- IMAGE GALLERY -->

	

	<!-- CONTACT US SECTION -->

	<section class="contact-section" id="contact" >
		<div class="container">
            <div class="row">
                <div class="col-lg-6 sm-padding">
                    <div class="contact-info">
                        <h2>
                            Get in touch with us & 
                            <br>send us message today!
                        </h2>
                       
                        
                       
                    </div>
                </div>
                <div class="col-lg-6 sm-padding">
                    <div class="contact-form" data-aos="flip-left"
     data-aos-easing="ease-out-cubic"
     data-aos-duration="2000">
                    	 <form action="" method = "POST" v-on:submit = "checkForm">
                        <div id="contact_ajax_form" class="contactForm">
                            <div class="form-group colum-row row">
                                <div class="col-sm-6">
                                    <input type="text" id="contact_name" name="name" oninput="document.getElementById('invalid-name').innerHTML = ''" onkeyup="this.value=this.value.replace(/[^\sa-zA-Z]/g,'');" class="form-control" placeholder="Name">
                                    <div class="invalid-feedback" id="invalid-name" style="display: block">
                                    	
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <input type="email" id="contact_email" name="email" oninput="document.getElementById('invalid-email').innerHTML = ''" class="form-control" placeholder="Email">
                                    <div class="invalid-feedback" id="invalid-email" style="display: block">
                                    	
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <input type="text" id="contact_subject" name="subject" oninput="document.getElementById('invalid-subject').innerHTML = ''" onkeyup="this.value=this.value.replace(/[^\sa-zA-Z]/g,'');" class="form-control" placeholder="Subject">
                                    <div class="invalid-feedback" id="invalid-subject" style="display: block">
                                    	
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <textarea id="contact_message" name="message" oninput="document.getElementById('invalid-message').innerHTML = ''" cols="30" rows="5" class="form-control message" placeholder="Message"></textarea>
                                    <div class="invalid-feedback" id="invalid-message" style="display: block">
                                    	
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <button id="contact_send" name="contact_send_btn" class="bttn_style_2"> <i class="fas fa-paper-plane"></i>Send Message</button>
                                </div>
                            </div>
                            <div id="sending_load" style="display: none;">Sending...</div>
                            <div id="contact_status_message"></div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        </div>
    </section>

	<!-- OUR QUALITIES SECTION -->
	
	<section class="our_qualities_v2" >
		<div class="container">
			<div class="row">
				<div class="col-md-4" style="padding: 10px;">
					<div class="quality quality_1">
						<div class="text_inside_quality">
							<h5>Quality Foods</h5>
						</div>
					</div>
				</div>
				<div class="col-md-4" style="padding: 10px;">
					<div class="quality quality_2">
						<div class="text_inside_quality">
							<h5>Fastest Delivery</h5>
						</div>
					</div>
				</div>
				<div class="col-md-4" style="padding: 10px;">
					<div class="quality quality_3">
						<div class="text_inside_quality">
							<h5>Original Recipes</h5>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- WIDGET SECTION / FOOTER -->

    <section class="widget_section" style="background-color: #222227;padding: 100px 0;">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="footer_widget">
                        <img src="Design/images/foodhalli.png" alt="Restaurant_logo" style="width: 150px;margin-bottom: 20px;">
                        <p>
                            Our Restaurnt is one of the bests, provide tasty Menus and Dishes. You can reserve a table or Order food.
                        </p>
                        <ul class="widget_social"><center>
                            <li><a href="https://www.facebook.com/profile.php?id=100006092804779" data-toggle="tooltip" title="Facebook"><i class="fab fa-facebook-f fa-2x"></i></a></li>
                            <li><a href="https://twitter.com/souhaib76294655" data-toggle="tooltip" title="Twitter"><i class="fab fa-twitter fa-2x"></i></a></li>
                            <li><a href="https://www.instagram.com/_212.souhaib/" data-toggle="tooltip" title="Instagram"><i class="fab fa-instagram fa-2x"></i></a></li>
                            <li><a href="https://www.linkedin.com/in/souhaib-halli-1925071ab/" data-toggle="tooltip" title="LinkedIn"><i class="fab fa-linkedin fa-2x"></i></a></li>
                           
                        </ul></center>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                     <div class="footer_widget">
                        <h3>Headquarters</h3>
                        <p>
                          Cité Suisse
                          Agadir 80000
                          30.425760, -9.605643
                        </p>
                        <p>
                            hallisouhaibbuisness@gmail.com
                            <br>
                            +212624583391 
                        </p>
                     </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer_widget">
                        <h3>
                            <left>Opening Hours</left>
                        </h3>
                        <ul class="opening_time">
                   <left> <li>Monday    11:30am - 2:00pm</li>
                            <li>Tuesday    11:30am - 2:00pm</li>
                            <li>Wednesday  11:30am - 2:00pm</li>
                            <li>Thursday   11:30am - 2:00pm</li>
                            <li>Friday     11:30am - 2:00pm</li>
                            <li>Saturday   11:30am - 2:00pm</li>
                            <li>Sunday     closed</li>
                        </ul></left>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footFer_widget">
                        <h3>Subscribe to our contents</h3>
                        <div class="subscribe_form">
                            <form action="#" class="subscribe_form" novalidate="true">
                                <input type="email" name="EMAIL" id="subs-email" class="form_input" placeholder="Email Address...">
                                <button type="submit" class="submit"><i class="fas fa-bullhorn"></i> SUBSCRIBE</button>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER BOTTOM  -->

    <?php include "Includes/templates/footer.php"; ?>

    
	<?php

	if (isset($_POST['contact_send_btn']))
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];
    
    try
    {
      $stmt = $con->prepare("insert into contact(name,email,subject,message) values(?,?,?,?) ");
                        $stmt->execute(array($name,$email,$subject,$message));
                        echo "<div class = 'alert alert-sucess'>";
                            echo 'message has been inserted successfully';
                        echo "</div>";
                    }
                    catch(Exception $e)
                    {
                        echo "<div class = 'alert alert-danger'>";
                            echo 'Error occurred: ' .$e->getMessage();
                        echo "</div>";
                    }}
?>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();
</script>