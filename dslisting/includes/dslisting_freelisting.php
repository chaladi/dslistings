<?php

//Free listing

function ds_freelisting(){
	if(isset($_POST['listsubmit'])){
		$ds_companyname = $_POST['ds_companyname'];
		$ds_contactperson = $_POST['ds_contactperson'];
		$ds_city = $_POST['ds_city'];
		$ds_pincode = $_POST['ds_pincode'];
		$ds_femail = $_POST['ds_femail'];
		$ds_landline = $_POST['ds_landline'];
		$ds_mobile = $_POST['ds_mobile'];
		//$ds_status = $_POST['ds_status'];
		$ds_adate = date('y-m-d h:i:s');
		$ds_cdate = date('y-m-d h:i:s');
//print_r($_POST);
global $wpdb;

 $table_name =  $wpdb->prefix. 'freelistings';
$wpdb->insert($table_name, array('companyname' => $ds_companyname,'contactperson' => $ds_contactperson,'city' => $ds_city,'pincode' => $ds_pincode,'emailid' => $ds_femail,'landlineno' => $ds_landline,'mobileno' => $ds_mobile,'adate' =>$ds_adate,'cdate' => $ds_cdate ),array('%s','%s','%s','%d','%s','%s','%s','%s','%s') ); 
	}
	ob_start();
?>

<div class="ds_freelisting">
	<h6>Enter  your  details below</h6>
        <form name="ds_listing" method="post" action="">
        <dl>
            <dt>Company Name:</dt>
            <dd><input type="text" name="ds_companyname" required="required"  placeholder="CompanyName"/></dd>
        </dl>
        <dl>
            <dt>Contact person:</dt>
            <dd><input type="text" name="ds_contactperson"   placeholder="Contact  Person"/></dd>
        </dl>
        <dl>
            <dt>City:</dt>
            <dd><input type="text" name="ds_city" required="required"  placeholder="City" /></dd>
        </dl>
        <dl>
            <dt>Pincode:</dt>
            <dd><input type="number" name="ds_pincode" required="required"  placeholder="Pincode" /></dd>
        </dl>
        <dl>
            <dt>Email ID:</dt>
            <dd><input type="email" name="ds_femail"  placeholder="Email ID" /></dd>
        </dl>
        <dl>
            <dt>Landline:</dt>
            <dd><input type="number" name="ds_landline"   placeholder="Landline"/></dd>
        </dl>
        <dl>
            <dt>Mobile Number:</dt>
            <dd><input type="number" name="ds_mobile"  placeholder="Mobile Number" /></dd>
        </dl>
         <dl>
            <!--<dt>Status:</dt>-->
            <dd><input type="hidden" name="ds_status"  placeholder="Status" /></dd>
        </dl>
                <dd>
                    <div class="g-recaptcha" data-sitekey="6Le4gQITAAAAAKlQdkxMfXT3dlVyLlPdCk5yDogr"></div>
            </dd>
        </dl>
        <dl>
            <dd>
            <input type="submit" value="submit" name="listsubmit" id="ds_message"/>
           </dd>
        </dl>
        </form>
</div>
<div class="clear"></div>

<?php

	$html=ob_get_contents();
	ob_end_clean();
	return $html;
}

add_shortcode('ds_freelisting','ds_freelisting');

//freelisting page List Table
add_action( 'admin_menu', 'register_free_listing_menu_page' );

function register_free_listing_menu_page(){

	add_menu_page( 'free listing', 'Free Listing', 'manage_options', 'freelisting', 'my_free_listing_menu_page', plugins_url( 'dslisting/images/freelisting.png' ), 6 ); 

}

function my_free_listing_menu_page(){
	echo "<h3>Welcome to Free Listing</h3>";?>
    
    	<div class="ds_freelistingtable">
                <dl class="ds_free_caption">
                    <dt>Company Name</dt>
                    <dt>Contact Person</dt>
                    <dt>City</dt>
                     <dt>Pincode</dt>
                     <dt>Email ID</dt>
                 	 <dt>Landline</dt>
                     <dt>Mobile Number</dt>
                     <dt>Status</dt>
                </dl>

                <div id="dgpro_mark_list">
						<?php
                           global $wpdb;
                            $table_name =  $wpdb->prefix. 'freelistings';
                            $listingdata = $wpdb->get_results( "SELECT * FROM $table_name where status=0" );
                    // print_r($listingdata); 
								foreach($listingdata as $k => $v){
										?>
											<dl id="dsfreelisting<?php echo $v->fid;?>" class="dsfreelisting">
												<dt class="ds_fname" ><?php echo $v->companyname; ?></dt>
												<dt class="ds_fperson"><?php  echo $v->contactperson; ?></dt>
												<dt class="ds_fcity"><?php   echo $v->city;?></dt>
												<dt class="ds_fpin"><?php  echo $v->pincode;?></dt>
												<dt class="ds_femail"><?php echo $v->emailid;?></dt>
												<dt class="ds_fland"><?php  echo $v->landlineno;?></dt>
												<dt class="ds_fmobile"><?php  echo $v->mobileno;?></dt>
												<dt class="ds_fstatus">
										<button class="uk-button uk-button-success" onclick="approvelist(<?php echo $v->fid;?>)">Approve</button>
											</dt>
								 </dl>
						<?php  }?>
				</div>
      </div>


<?php } 



//function listingfunction_approve() starts.................
 add_action('wp_ajax_listing_approved',"listing_approved");
 function listing_approved(){
	global $wpdb;
	$freelisting =  $wpdb->prefix.'freelistings';
	$id=$_POST['listingnum'];
	$wpdb->update( $freelisting, array( 'status' => 1 ),array('fid'=>$id), array( '%d' ),array('%d') );
	die();
 } //function listingfunction_approve() ends...............

?>