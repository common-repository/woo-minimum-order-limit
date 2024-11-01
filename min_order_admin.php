<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$minOrder = "minOrder";

//set show price variable for show price checkbox
$minOrderOn = "minOrderOn";

 //if the form is submitted
if(isset($_POST["submit"])){ 

    if (!isset($_POST['min_order_update_setting'])) die('<div id="message" class="updated fade"><p>Not allowed</p></div>');

    if (!wp_verify_nonce($_POST['min_order_update_setting'],'min-order-update-setting')) die( '<div id="message" class="updated fade"><p>Not allowed</p></div>');



    //GRAB ALL THE INPUTS//////////////////

    //Grab min order and sanitize
    $minOrderShow = sanitize_text_field( $_POST[$minOrder] );

     //Grab theon option
    $minOrderOnShow =  isset($_POST[$minOrderOn]);
 



    ///////VALIDATE ALL INPUTS///////////////////////////


 
    
    //check min order amount is a number
    $number = is_numeric($minOrderShow);

   

    //check not empty
    if($minOrderShow == "") 
    {

    $errorMsg=  "error : You did not enter a min Order.";
    
    }


    // if not a number , tell user
    elseif ($number != 'true')

     
    {

      

    
    $errorMsg=  "error : Numbers to two decimal points please";
    $minOrderShow = "";

    echo '<div id="message" class="error fade"><p>Numbers to two decimal points please</p></div>';

    } else {


    


     
    update_option($minOrder, $minOrderShow);
    update_option($minOrderOn, $minOrderOnShow);
   
     //Success message
    echo '<div id="message" class="updated fade"><p>Options Updated</p></div>';
}
}

else{
    //If post not submitted, echo out the current status
    $minOrderShow  = get_option($minOrder);
  
    $minOrderOnShow = get_option($minOrderOn);


}
?>
<div class="wrap">
    
    <h2>Welcome to Min Order Page</h2>
    <br />
    <br />
   <?php if (isset($errorMsg)) { echo "<div id='message' class='error fade'>" .$errorMsg. "</div>" ;} ?>
    <div class="">
        <fieldset>
            <legend>Min Order Settings</legend>
            <form method="post" action=""> 
             <input name="min_order_update_setting" type="hidden" value="<?php echo wp_create_nonce('min-order-update-setting'); ?>" />

             <table class="form-table" width="100%" cellpadding="10">
                <tbody>
                    <tr>
                        <td scope="row" align="left">

                            <label>Add Min Order Amount</label>
                            <input type="number" step="0.01" name="<?php echo $minOrder; ?>" value="<?php echo esc_attr ($minOrderShow) ?>" /></input>
                        </td>
                    </tr>
                   
                    
                   
                    <tr>
                        <td scope="row" align="left">

                            <label>Do you want to turn on minimum order limit?</label>
                            <input type="checkbox" name="<?php echo $minOrderOn; ?>" 
                            <?php echo $minOrderOnShow?"checked='checked'":""; ?> />
                        </td>
                    </tr>
                   
                    <tr>
                        <td>
                            <input type="submit" value="Save" class="button button-primary" name="submit" />
                        </br >

                    </td>
                </tr>
                <tr>
                    <td>
                        <h3>Please Double check all data saved</h3>
                    </td>
                </tr>
            </tbody>
        </table>                
    </form>
</fieldset>        
</div>  

<?php


?>


