<!-- PHP INCLUDES -->


<?php
session_start();
    //Set page title
    $pageTitle = 'Order Food';

    include "connect.php";
    include 'Includes/functions/functions.php';
    include "Includes/templates/header.php";


?>

    <!-- ORDER FOOD PAGE STYLE -->

	<style type="text/css">
        body
        {
            background: #f7f7f7;
        }

		.text_header
		{
			margin-bottom: 5px;
    		font-size: 18px;
    		font-weight: bold;
    		line-height: 1.5;
    		margin-top: 22px;
    		text-transform: capitalize;
		}

        .items_tab
        {
            border-radius: 4px;
            background-color: white;
            overflow: hidden;
            box-shadow: 0 0 5px 0 rgba(60, 66, 87, 0.04), 0 0 10px 0 rgba(0, 0, 0, 0.04);
        }

        .itemListElement
        {
            font-size: 14px;
            line-height: 1.29;
            text-align:center;
            border-bottom: solid 1px #e5e5e5;
            padding: 16px 12px 18px 12px;
        }

        .item_details
        {
            width: auto;
            display: -webkit-box;
            display: -moz-box;
            display: -ms-flexbox;
            display: -webkit-flex;
            display: block;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            -webkit-box-orient: horizontal;
            -webkit-box-direction: normal;
            -webkit-flex-direction: row;
            -webkit-box-pack: justify;
            -webkit-justify-content: space-between;
            -webkit-box-align: center;
            -webkit-align-items: center;
        }

        .item_label
        {
        	color: #9e8a78;
            border-color: #9e8a78;
            background: white;
            font-size: 12px;
            font-weight: 700;
        }

        .btn-secondary:not(:disabled):not(.disabled).active, .btn-secondary:not(:disabled):not(.disabled):active 
        {
            color: #fff;
            background-color: #9e8a78;
            border-color: #9e8a78;
        }

        .item_select_part
        {
            display: block;
            -webkit-box-pack: justify;
            justify-content: space-between;
            -webkit-box-align: center;
            align-items: center;
            flex-shrink: 0;
        }

        .select_item_bttn
        {
            width: 55px;
            display: flex;
            margin-left: 30px;
            -webkit-box-pack: end;
            justify-content: flex-end;
        }
        .p1 {
            font-family: "Times New Roman", Times, serif;
            font-size: 30px;
            text-align:center;
            margin:auto;
            width: fit-content;     }       

        .menu_price_field
        {
        	width: auto;
            display:  center;
            margin-left: 30px;
            -webkit-box-align: baseline;
            align-items: baseline;
        }

        .order_food_section
        {
            max-width: 720px;
            margin: 50px auto;
            padding: 0px 15px;
        }

        .item_label.focus,
        .item_label:focus
        {
            outline: none;
            background:initial;
            box-shadow: none;
            color: #9e8a78;
            border-color: #9e8a78;
        }

        .item_label:hover
        {
            color: #fff;
            background-color: #9e8a78;
            border-color: #9e8a78;
        }

        /* Make circles that indicate the steps of the form: */
        .step 
        {
            height: 15px;
            width: 15px;
            margin: 0 2px;
            background-color: #bbbbbb;
            border: none;  
            border-radius: 50%;
            display: inline-block;
            opacity: 0.5;
        }

        .step.active 
        {
            opacity: 1;
        }

        /* Mark the steps that are finished and valid: */
        .step.finish 
        {
            background-color: #4CAF50;
        }


        .order_food_tab
        {
            display: none;
        }

        .next_prev_buttons
        {
            background-color: #4CAF50;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            font-size: 17px;
            cursor: pointer;
        }

        .client_details_tab  .form-control
        {
            background-color: #fff;
            border-radius: 0;
            padding: 25px 10px;
            box-shadow: none;
            border: 2px solid #eee;
        }

        .client_details_tab  .form-control:focus 
        {
            border-color: #ffc851;
            box-shadow: none;
            outline: none;
        }
        /* -- quantity box -- */

.quantity {
 display: inline-block; }

.quantity .input-text.qty {
 width: 35px;
 height: 39px;
 padding: 0 5px;
 text-align: center;
 background-color: transparent;
 border: 1px solid #efefef;
}

.quantity.buttons_added {
 text-align: left;
 position: relative;
 white-space: nowrap;
 vertical-align: top; }

.quantity.buttons_added input {
 display: inline-block;
 margin: 0;
 vertical-align: top;
 box-shadow: none;
}

.quantity.buttons_added .minus,
.quantity.buttons_added .plus {
 padding: 7px 10px 8px;
 height: 41px;
 background-color: #ffffff;
 border: 1px solid #efefef;
 cursor:pointer;}

.quantity.buttons_added .minus {
 border-right: 0; }

.quantity.buttons_added .plus {
 border-left: 0; }

.quantity.buttons_added .minus:hover,
.quantity.buttons_added .plus:hover {
 background: #eeeeee; }

.quantity input::-webkit-outer-spin-button,
.quantity input::-webkit-inner-spin-button {
 -webkit-appearance: none;
 -moz-appearance: none;
 margin: 0; }
 
 .quantity.buttons_added .minus:focus,
.quantity.buttons_added .plus:focus {
 outline: none; }



	</style>

    <!-- START ORDER FOOD SECTION -->

	<section class="order_food_section">

        <?php
        
        



        ?>

        <!-- ORDER FOOD FORM -->

		<form method="post" id="order_food_form" action="order_food_ajax.php">
		
			<!-- SELECT MENUS -->

			<div class="select_menus_tab order_food_tab" id="menus_tab">

				<!-- ALERT MESSAGE -->

				<div class="alert alert-danger" role="alert" style="display: none">
					Please, select at least one item!
				</div>

                <div class="text_header">
                    <span>
                        1. Choice of Items
                    </span>
                </div>

				<div>
					<?php
						$stmt = $con->prepare("Select * from menu_categories");
                    	$stmt->execute();
                    	$menu_categories = $stmt->fetchAll();
                        $i=0;

                    	foreach($menu_categories as $category)
                    	{
                    		?>
                    			<div class="text_header">
									<span>
										<?php echo $category['category_name']; ?>
									</span>
								</div>
								<div class="items_tab">
				        			<?php
				        				$stmt = $con->prepare("Select * from menus where category_id = ?");
				                    	$stmt->execute(array($category['category_id']));
				                    	$rows = $stmt->fetchAll();
				                    	foreach($rows as $row)
				                    	{
                                            ?>
                                                        <?php
                                            echo "<div class='itemListElement'>";
                                                echo "<div class = 'item_details'>";
                                                    echo "<div class='p1'>";
                                                        echo $row['menu_name'];
                                                    echo "</div>";
                                                    $source = "admin/Uploads/images/".$row['menu_image']; ?>

                                                        <div class="menu-image">
                                                            <div class="image-preview">
                                                                <div style="background-image: url('<?php echo $source; ?>');"></div>
                                                            </div></div><?php
                                                    echo "<div class = 'item_select_part'>";
                                                        echo "<div class = 'menu_price_field'>";
                                                            echo "<span style = 'font-weight: bold;'>";
                                                                echo $row['menu_price']."$";
                                                            echo "</span>";
                                                        ?>
                                            
                                                        

				                                    
				                                    	
				                                    		<span class="btn-group-toggle" data-toggle="buttons">
																<label class="menu_label item_label btn btn-secondary">
																	<input type="checkbox" name="selected_menus[]" value="<?php echo $row['menu_id'] ?>" autocomplete="off">Select
																</label>
                                                            
                                                                
															</span>				                                   
                                                              <?php
				                                echo "</div></div></div></div>";	
				                    	}
				            		?>
				    			</div>
                    		<?php
                    	} 
                        
				?>
                </div>				
			</div>










            <!-- CLIENT DETAILS -->


            <div class="client_details_tab order_food_tab" id="clients_tab">

                            <div class="text_header">
                                <span>
                        2. Client Details
                    </span>
                                    </div> 

                    


                <div>
                    <div class="form-group colum-row row">
                        <div class="col-sm-12">
                            <input type="text" name="client_full_name" id="client_full_name" oninput="document.getElementById('required_fname').style.display = 'none'" onkeyup="this.value=this.value.replace(/[^\sa-zA-Z]/g,'');" class="form-control" placeholder="Full name">
                            <div class="invalid-feedback" id="required_fname">
                                Invalid Name!
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <input type="email" name="client_email" id="client_email" oninput="document.getElementById('required_email').style.display = 'none'" class="form-control" placeholder="E-mail">
                            <div class="invalid-feedback" id="required_email">
                                Invalid E-mail!
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <input type="text"  name="client_phone_number" id="client_phone_number" oninput="document.getElementById('required_phone').style.display = 'none'" class="form-control" onkeyup="this.value=this.value.replace(/[^0-9]/g,'');" placeholder="Phone number">
                            <div class="invalid-feedback" id="required_phone">
                                Invalid Phone number!
                            </div>
                        </div>
                    </div>
                    <div class="form-group colum-row row">
                        <div class="col-sm-12">
                            <input type="text" name="client_delivery_address" id="client_delivery_address" oninput="document.getElementById('required_delivery_address').style.display = 'none'" class="form-control" placeholder="Delivery Address">
                            <div class="invalid-feedback" id="required_delivery_address">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- NEXT AND PREVIOUS BUTTONS -->

            <div style="overflow:auto;padding: 30px;">
                <div style="float:right;">
                    <input type="hidden" name="submit_order_food_form">
                    <button type="button" class="next_prev_buttons" style="background-color: #bbbbbb;"  id="prevBtn"  onclick="nextPrev(-1)">Previous</button>
                    <button type="button" id="nextBtn" class="next_prev_buttons" onclick="nextPrev(1)">Next</button>
                </div>
            </div>

            <!-- Circles which indicates the steps of the form: -->

            <div style="text-align:center;margin-top:40px;">
                <span class="step"></span>
                <span class="step"></span>
            </div>

		</form>
	</section>





	<!-- WIDGET SECTION / FOOTER -->

    <section class="widget_section" style="background-color: #222227;padding: 100px 0;">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="footer_widget">
                        <img src="Design/images/restaurant-logo.png" alt="Restaurant Logo" style="width: 150px;margin-bottom: 20px;">
                        <p>
                            Our Restaurnt is one of the bests, provide tasty Menus and Dishes. You can reserve a table or Order food.
                        </p>
                        <ul class="widget_social">
                            <li><a href="#" data-toggle="tooltip" title="Facebook"><i class="fab fa-facebook-f fa-2x"></i></a></li>
                            <li><a href="#" data-toggle="tooltip" title="Twitter"><i class="fab fa-twitter fa-2x"></i></a></li>
                            <li><a href="#" data-toggle="tooltip" title="Instagram"><i class="fab fa-instagram fa-2x"></i></a></li>
                            <li><a href="#" data-toggle="tooltip" title="LinkedIn"><i class="fab fa-linkedin fa-2x"></i></a></li>
                            <li><a href="#" data-toggle="tooltip" title="Google+"><i class="fab fa-google-plus-g fa-2x"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                     <div class="footer_widget">
                        <h3>Headquarters</h3>
                        <p>
                            962 Fifth Avenue, 3rd Floor New York, NY10022
                        </p>
                        <p>
                            contact@restaurant.com
                            <br>
                            (+123) 456 789 101    
                        </p>
                     </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer_widget">
                        <h3>
                            Opening Hours
                        </h3>
                        <ul class="opening_time">
                            <li>Monday - Friday 11:30am - 2:008pm</li>
                            <li>Monday - Friday 11:30am - 2:008pm</li>
                            <li>Monday - Friday 11:30am - 2:008pm</li>
                            <li>Monday - Friday 11:30am - 2:008pm</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer_widget">
                        <h3>Subscribe to our contents</h3>
                        <div class="subscribe_form">
                            <form action="#" class="subscribe_form" novalidate="true">
                                <input type="email" name="EMAIL" id="subs-email" class="form_input" placeholder="Email Address...">
                                <button type="submit" class="submit">SUBSCRIBE</button>
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


    <!-- JS SCRIPTS -->

    <script type="text/javascript">

        /* TOGGLE MENU SELECT BUTTON */

        $('.menu_label').click(function() 
        {
            $(this).button('toggle');



            
        });

    </script>

    <!-- JS SCRIPT FOR NEXT AND BACK TABS -->

    <script type="text/javascript">
        
        var currentTab = 0;
        showTab(currentTab);

        //Show Tab Function

        function showTab(n) 
        {
            var x = document.getElementsByClassName("order_food_tab");
            x[n].style.display = "block";
            
            if (n == 0) 
            {
                document.getElementById("prevBtn").style.display = "none";
            } 
            else 
            {
                document.getElementById("prevBtn").style.display = "inline";
            }
            
            if (n == (x.length - 1)) 
            {
                document.getElementById("")
                document.getElementById("nextBtn").innerHTML = "Submit";
            } 
            else 
            {
                document.getElementById("nextBtn").innerHTML = "Next";

            }

            fixStepIndicator(n)
        }

        // Next Prev Function

        function nextPrev(n) 
        {
            var x = document.getElementsByClassName("order_food_tab");
            
            if (n == 1 && !validateForm()) return false;
            // Hide the current tab:
            x[currentTab].style.display = "none";
            // Increase or decrease the current tab by 1:
            currentTab = currentTab + n;
            // if you have reached the end of the form...
            if (currentTab >= x.length) 
            {
                // ... the form gets submitted:
                document.getElementById("order_food_form").submit();


                return false;
            }

            // Otherwise, display the correct tab:
            showTab(currentTab);

        }

        // Validate Form Function

        function validateForm()
        {
            var x, id_tab, valid = true;
            x = document.getElementsByClassName("order_food_tab");
            id_tab = x[currentTab].id;

            if(id_tab == "menus_tab")
            {
                if(x[currentTab].querySelectorAll('input[type="checkbox"]:checked').length == 0)
                {
                    x[currentTab].getElementsByClassName("alert")[0].style.display = "block";
                    valid = false;
                }
                else
                {
                    x[currentTab].getElementsByClassName("alert")[0].style.display = "none";
                }
            }
            if(id_tab == "clients_tab")
            {
                y = x[currentTab].getElementsByTagName("input");
                z = x[currentTab].getElementsByClassName("invalid-feedback");

                for (var i = 0; i < y.length; i++) 
                {
                    if(y[i].value == "")
                    {
                        z[i].style.display = "block";
                        valid = false;
                    }
                    if(y[i].type == "email" && !ValidateEmail(y[i].value))
                    {
                        z[i].style.display = "block";
                        valid = false;
                    }
                }
            }

            if (valid) 
            {
                document.getElementsByClassName("step")[currentTab].className += " finish";
            }

            return valid;
        }



        function fixStepIndicator(n) 
        {
            // This function removes the "active" class of all steps...
            var i, x = document.getElementsByClassName("step");
            
            for (i = 0; i < x.length; i++) 
            {
                x[i].className = x[i].className.replace(" active", "");
            }
            
            //... and adds the "active" class on the current step:
            x[n].className += " active";
        }
    
    </script>
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
<script >
    function wcqib_refresh_quantity_increments() {
    jQuery("div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)").each(function(a, b) {
        var c = jQuery(b);
        c.addClass("buttons_added"), c.children().first().before('<input type="button" value="-" class="minus" />'), c.children().last().after('<input type="button" value="+" class="plus" />')
    })
}
String.prototype.getDecimals || (String.prototype.getDecimals = function() {
    var a = this,
        b = ("" + a).match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);
    return b ? Math.max(0, (b[1] ? b[1].length : 0) - (b[2] ? +b[2] : 0)) : 0
}), jQuery(document).ready(function() {
    wcqib_refresh_quantity_increments()
}), jQuery(document).on("updated_wc_div", function() {
    wcqib_refresh_quantity_increments()
}), jQuery(document).on("click", ".plus, .minus", function() {
    var a = jQuery(this).closest(".quantity").find(".qty"),
        b = parseFloat(a.val()),
        c = parseFloat(a.attr("max")),
        d = parseFloat(a.attr("min")),
        e = a.attr("step");
    b && "" !== b && "NaN" !== b || (b = 0), "" !== c && "NaN" !== c || (c = ""), "" !== d && "NaN" !== d || (d = 0), "any" !== e && "" !== e && void 0 !== e && "NaN" !== parseFloat(e) || (e = 1), jQuery(this).is(".plus") ? c && b >= c ? a.val(c) : a.val((b + parseFloat(e)).toFixed(e.getDecimals())) : d && b <= d ? a.val(d) : b > 0 && a.val((b - parseFloat(e)).toFixed(e.getDecimals())), a.trigger("change")
});
</script>