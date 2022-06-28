<?php
session_start();           
    include "connect.php";
     include 'Includes/functions/functions.php';
    include "Includes/templates/header.php"; ?>
     <style type="text/css">
        body
        .items_tab
        {
            border-radius: 4px;
            background-color: white;
            overflow: hidden;
            box-shadow: 0 0 5px 0 rgba(60, 66, 87, 0.04), 0 0 10px 0 rgba(0, 0, 0, 0.04);
        }
         .p1 {
            font-family: "Times New Roman", Times, serif;
            font-size: 30px;
            text-align:center;
            margin:auto;
            width: fit-content;     }

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
        .sub {
            background-color: #4CAF50;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            font-size: 17px;
            cursor: pointer;
        }
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
    <?php 
                if(isset($_POST['submit_order_food_form']) && $_SERVER['REQUEST_METHOD'] === 'POST')
            {
                // Selected Menus

                $_SESSION['selected']= $_POST['selected_menus'];
                
                //Client Details

                $client_full_name = test_input($_POST['client_full_name']);
                $delivery_address = test_input($_POST['client_delivery_address']);
                $client_phone_number = test_input($_POST['client_phone_number']);
                $client_email = test_input($_POST['client_email']);
                
                
                    
                

                $con->beginTransaction();
                try
                {
                    $ref = $con->prepare("SET GLOBAL information_schema_stats_expiry=0;");
                    $ref->execute();


                    $stmtgetCurrentClientID = $con->prepare("SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'restaurant_website' AND TABLE_NAME = 'clients'");
            
                    $stmtgetCurrentClientID->execute();
                    $client_id = $stmtgetCurrentClientID->fetch();


        


                    $stmtClient = $con->prepare("insert into clients(client_name,client_phone,client_email) 
                                values(?,?,?)");
                    $stmtClient->execute(array($client_full_name,$client_phone_number,$client_email));

                    $stmtgetCurrentOrderID = $con->prepare("SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'restaurant_website' AND TABLE_NAME = 'placed_orders'");
            
                    $stmtgetCurrentOrderID->execute();
                    $order_id = $stmtgetCurrentOrderID->fetch();
                    
                    $stmt_order = $con->prepare("insert into placed_orders(order_time, client_id, delivery_address) values(?, ?, ?)");
                    $stmt_order->execute(array(Date("Y-m-d H:i"),$client_id[0],$delivery_address));

                    $stmtgetID = $con->prepare("SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'restaurant_website' AND TABLE_NAME = 'in_order'");
            
                    $stmtgetID->execute();
                    $id = $stmtgetID->fetch();
                    $_SESSION['id'] = $id[0];

                    foreach($_SESSION['selected'] as $menu)
                    {   
                        $stmt = $con->prepare("insert into in_order(order_id, menu_id) values(?, ?)");
                        $stmt->execute(array($order_id[0],$menu));
                        
                    }
                    
                    echo "<div class = 'alert alert-success'>";
                        echo "Great! Your order has been created successfully.";
                    echo "</div>";
                    $con->commit();
                }
                catch(Exception $e)
                {
                    $con->rollBack();
                    echo "<div class = 'alert alert-danger'>"; 
                        echo $e->getMessage();
                    echo "</div>";
                }
                
            } ?>

        <form action="order_quant.php" method="POST">
            <div class="items_tab">
            <?php 
            foreach($_SESSION['selected'] as $menu)
                    {   
                        $stmt = $con->prepare("SELECT * FROM menus where menu_id= ?");
                        
                        $stmt->execute(array($menu)); 
                        $rows = $stmt -> fetchAll();
                        foreach ($rows as $row ) {
                            // code...
                        }
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
                                                            echo "</div></div></div>";    






                        ?>
                        <div class="quantity buttons_added">
    <input type="button" value="-" class="minus"><input type="number" step="1" min="1" max="" name="quantity[]" value="1" title="Qty" class="input-text qty text" size="4" pattern="" inputmode=""><input type="button" value="+" class="plus">
</div><br> 
                        
          <?php          } ?><input type="submit" name = "sub" class ="sub"></form>


        






<script data-require="jquery@3.1.1" data-semver="3.1.1" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js">
    
</script>

<script type="text/javascript">
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