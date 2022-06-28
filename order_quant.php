        <?php
        session_start();
        $pageTitle = 'Votre Commande';
        include "connect.php";
     include 'Includes/functions/functions.php';
    include "Includes/templates/header.php";
            if (isset($_POST['sub'])){
                


                $quantity=$_POST['quantity'];
                $id =  $_SESSION['id'];
                $con->beginTransaction();
                try{
                    $i=0;

            foreach($_SESSION['selected'] as $menu)
                    {   
                        $stmt = $con->prepare("UPDATE in_order SET quantity = ? where id = ?");
                        $stmt->execute(array($quantity[$i],$id));
                        $i++;
                        $id++;
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

}



        ?> 
       