<?php


add_action("admin_init", "admin_init");
function admin_init(){

  add_meta_box("ds_listing_fields", "Contacts", "listing_fields", "listing", "normal", "low");
  add_meta_box("ds_other_details", "Other Details", "other_details", "listing", "normal", "low");
  add_meta_box("ds_social_fields", "Social Contacts", "social_fields", "listing", "normal", "low");

}

function listing_fields(){

  global $post;
  $custom = get_post_custom($post->ID);
  $ds_mobile=$custom['ds_mobile'][0];
  $ds_phone = $custom["ds_phone"][0];
  $ds_fax = $custom["ds_fax"][0];
  $ds_email=$custom['ds_email'][0];
  $ds_website = $custom["ds_website"][0];
  $ds_addrone = $custom["ds_addrone"][0];
  $ds_addrtwo=$custom['ds_addrtwo'][0];
  $ds_area = $custom["ds_area"][0];
  //$ds_location = $custom["ds_location"][0];
  $ds_city = $custom["ds_city"][0];
  $ds_state = $custom["ds_state"][0];
  $ds_pincode = $custom["ds_pincode"][0];
  $ds_featured = $custom["ds_featured"][0];
  $ds_popular = $custom["ds_popular"][0];
  $ds_template = $custom["ds_template"][0];
  ?>

<div id="ds_listingblock">
<div class="uk-grid">
	<div class="uk-width-small-1-2">
    <dl>
        <dt>Mobile:</dt>
        <dd>
          <input type="number" name="ds_mobile" value="<?php echo $ds_mobile;?>" />
          <input type="hidden" name="ds_title" id="ds_title" value="<?php echo get_the_title($post->ID);?>"/>
        </dd>
  </dl>
    </div>
    <div class="uk-width-small-1-2">
    <dl>
        <dt>Phone:</dt>
            <dd><input type="number" name="ds_phone" value="<?php echo $ds_phone;?>" /></dd>
  </dl>

    </div>

	<div class="uk-width-small-1-2">
    <dl>
        <dt >Website:</dt>
            <dd>
                 <input type="text" name="ds_website" class="ds_website" value="<?php echo $ds_website;?>" placeholder="http://"  onblur="addurl(this.value)"/>
            </dd>
  		</dl>
    </div>
    <div class="uk-width-small-1-2">
    <dl>
        <dt>Email:</dt>
        <dd>
        <input type="email" required="required" name="ds_email" value="<?php echo $ds_email;?>" />
        </dd>
        </dl>
    </div>

	<div class="uk-width-small-1-2">
    <dl>
        <dt>Address1:</dt>
        <dd><input type="text" name="ds_addrone"  id="ds_addrone" value="<?php echo $ds_addrone;?>"  /></dd>
  </dl>
    </div>
    <div class="uk-width-small-1-2">
    <dl>
  		<dt>Address2:</dt>
    		<dd><input type="text" name="ds_addrtwo"  id="ds_addrtwo" value="<?php echo $ds_addrtwo;?>"  /></dd>
  </dl>
    </div>
	 <div class="uk-width-small-1-2">
    	<dl>
  		<dt>Location:</dt>
   		<dd>
    	 <?php
		$locations=get_the_terms( $post->ID, 'location' );
		$ds_location=$locations[0]->term_id;
		// print_r($locations);
			wp_dropdown_categories('show_option_none=Select Location&show_count=0&orderby=name&echo=1&depth=1&taxonomy=location&hide_empty=0&hierarchical=1&id=taxinputlocation&name=tax_input[location][]&selected='.$ds_location);
			//wp_dropdown_categories('show_count=0&orderby=name&echo=1&taxonomy=location&hierarchical=1&depth=1&hide_empty=0&show_option_none=Select Location&name=tax_input[location][]&selected='.$ds_location);
			 ?>

             </dd>
  		</dl>
    </div>

	<div class="uk-width-small-1-2">
    <dl>
  		<dt>Area:</dt>
   		<dd id="ds_areablock">

      	<?php
	  		if(!empty($ds_area)){
				wp_dropdown_categories('show_count=0&orderby=name&echo=1&taxonomy=location&child_of='.$ds_location.'&hide_empty=0&show_option_none=Select Area&name=ds_area&selected='.$ds_area);
			}
		?>

        </dd>
  </dl>
    </div>


	<div class="uk-width-small-1-2">
    <dl>
      <dt>Pincode:</dt>
        <dd>
        <input type="number" name="ds_pincode"  id="ds_pincode" value="<?php echo $ds_pincode;?>"  />
        </dd>
  	</dl>
    </div>
    <div class="uk-width-small-1-2">
    <dl>
 	 <dt>Select Template:</dt>
   		<dd>
    	<select name="ds_template">
        	<option value="sidebarleft" <?php echo ($ds_template=="sidebarleft")?' selected="selected"':'';?>>Sidebar Left</option>
            <option value="sidebarright" <?php echo ($ds_template=="sidebarright")?' selected="selected"':'';?>>Sidebar Right</option>
        </select>
     </dd>
  </dl>
    </div>

	<div class="uk-width-small-1-2">
    <dl>
  	<dt>Featured:</dt>
   		 <dd>
    	<select name="ds_featured">
        	<option value="1" <?php echo ($ds_featured==1)?' selected="selected"':'';?>>Yes</option>
            <option value="0" <?php echo ($ds_featured==0)?' selected="selected"':'';?>>No</option>
        </select>
     </dd>
  </dl>

    </div>
    <div class="uk-width-small-1-2">
        <dl>
        <dt>Popular:</dt>
            <dd>
                <select name="ds_popular">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
         </dd>
      </dl>
    </div>
</div>
</div>
 <?php
 }

function other_details(){
	 global $post;
  	 $custom = get_post_custom($post->ID);
	 $ds_latitude = $custom["ds_latitude"][0];
	 $ds_longitude = $custom["ds_longitude"][0];
	 $ds_zoom = $custom["ds_zoom"][0];
	 $ds_cntperson = $custom["ds_cntperson"][0];
	 $ds_mode = $custom["ds_mode"][0];
	 $ds_year = $custom["ds_year"][0];
	 $ds_map = $custom["ds_map"][0];
	 $ds_week = $custom["ds_week"][0];
	 $ds_verified = $custom["ds_verified"][0];
  ?>
  <div id="ds_otherdetails">
  <div class="uk-grid">
  	<div class="uk-width-1-1">
    	<div id="map_canvas">

    	</div>
        <script type="text/javascript">
			jQuery(document).ready(function(e) {

			   <?php if(!empty($ds_latitude) and !empty($ds_longitude)):?>
			    mapLoad(<?php echo $ds_latitude;?>, <?php echo $ds_longitude;?>);
				<?php else: ?>
				 mapLoad();
				<?php endif;?>
					jQuery("#taxinputlocation").change(function(e){
						var $mainCat=jQuery(this).val();
                     	jQuery("#ds_areablock").empty();
							jQuery.ajax({
								url:"/wp-admin/admin-ajax.php",
								type:'POST',
								 data:'action=frontend_area_action&main_catid=' + $mainCat,
								 success:function(results){
											//jQuery("#sub_cat").removeAttr("disabled");
											//jQuery("#sub_cat").append(results);
											jQuery("#ds_areablock").html(results);
										}
							});
                	 });



            });

		</script>
    </div>

  	<div class="uk-width-small-1-2">
        <dl>
            <dt>Latitude:</dt>
                <dd><input type="text" name="ds_latitude" id="ds_latitude"  value="<?php echo $ds_latitude;?>"  /></dd>
      </dl>
    </div>
    <div class="uk-width-small-1-2">
        <dl>
            <dt>Longitude:</dt>
             <dd><input type="text" name="ds_longitude"  id="ds_longitude" value="<?php echo $ds_longitude;?>"  /></dd>
      </dl>
    </div>

  	<div class="uk-width-small-1-2">
        <dl>
             <dt>Zoom level:</dt>
                <dd><input type="number" name="ds_zoom"  id="ds_zoom" value="<?php echo $ds_zoom;?>"  /></dd>
      </dl>
    </div>
    <div class="uk-width-small-1-2">
        <dl>
            <dt>Contact Person:</dt>
                <dd><input type="text" name="ds_cntperson" value="<?php echo $ds_cntperson;?>"  /></dd>
      </dl>
    </div>

    <div class="uk-width-small-1-2">
    <dl>
   		 <dt>Modes of Payment:</dt>
   		 <dd>
              <select name="ds_mode" multiple="multiple">
                <option value="cash" <?php echo ($ds_mode=="cash")?' selected="selected"':'';?>>Cash</option>
                <option value="cheques" <?php echo ($ds_mode=="cheques")?' selected="selected"':'';?>>Cheques</option>
              </select>
    	</dd>
  </dl>
    </div>

    <div class="uk-width-small-1-2">
    <dl>
    	<dt>Weekdays:</dt>
        <dd>
        	<select  name="ds_week">
            <?php
            	for($i=1;$i<8;$i++){?>
					<option value="<?php echo $i;?>"><?php  echo $i;?>Day(s)</option>
				<?php }	?>
        	</select>
        </dd>
    </dl>

    </div>

    <div class="uk-width-small-1-2">
    	<dl>
        	<dt>Year Established:</dt>
            <dd><input type="text" name="ds_year" value="<?php echo $ds_year;?>"  /></dd>
      </dl>
    </div>

    <div class="uk-width-small-1-2">
        <dl>
        <dt>Verfied:</dt>
        <dd>
            <select name="ds_verified">
                <option value="1" <?php echo ($ds_verified==1)?' selected="selected"':'';?>>Yes</option>
                <option value="0" <?php echo ($ds_verified==0)?' selected="selected"':'';?>>No</option>
            </select>
        </dd>
      </dl>
    </div>


  </div>


 </div>
<?php
}

function  social_fields(){
	 global $post;
	  $custom = get_post_custom($post->ID);
	  $ds_whatsapp=$custom['ds_whatsapp'][0];
	  $ds_facebook = $custom["ds_facebook"][0];
	  $ds_twitter = $custom["ds_twitter"][0];
	  $ds_linkedin=$custom['ds_linkedin'][0];
	  $ds_skype = $custom["ds_skype"][0];
	 ?>
<div id="ds_socialblock">
	<div class="uk-grid">
        <div class="uk-width-small-1-2">
        <dl>
        	<dt>What's app Number:</dt>
            	<dd><input type="number" name="ds_whatsapp" value="<?php echo $ds_whatsapp;?>"/></dd>
        </dl>
        </div>

    <div class="uk-width-small-1-2">
    	<dl>
        	<dt>Facebook:</dt>
            	<dd><input type="text" name="ds_facebook" value="<?php echo $ds_facebook;?>"/></dd>
        </dl>
    </div>

    <div class="uk-width-small-1-2">
   		<dl>
        	<dt>Twitter:</dt>
            	<dd><input type="text" name="ds_twitter" value="<?php echo $ds_twitter;?>"/></dd>
        </dl>
    </div>

    <div class="uk-width-small-1-2">
    	<dl>
        	<dt>Linkedin:</dt>
            	<dd><input type="text" name="ds_linkedin" value="<?php echo $ds_linkedin;?>"/></dd>
        </dl>
    </div>
    <div class="uk-width-small-1-2">
    	<dl>
        	<dt>Skype ID:</dt>
            	<dd><input type="text" name="ds_skype" value="<?php echo $ds_skype;?>"/></dd>
        </dl>
    </div>

    </div>

</div>


<?php
}

add_action('save_post', 'save_details');


function save_details(){
	/*echo "<pre>";
	 print_r($_POST);
	 echo "</pre>";*/

		  global $post;
		  update_post_meta($post->ID, "ds_mobile", $_POST["ds_mobile"]);
		  update_post_meta($post->ID, "ds_phone", $_POST["ds_phone"]);
		  update_post_meta($post->ID, "ds_fax", $_POST["ds_fax"]);
		  update_post_meta($post->ID, "ds_email", $_POST["ds_email"]);
		  update_post_meta($post->ID, "ds_website", $_POST["ds_website"]);
		  update_post_meta($post->ID, "ds_addrone", $_POST["ds_addrone"]);
		  update_post_meta($post->ID, "ds_verified", $_POST["ds_verified"]);


		  update_post_meta($post->ID, "ds_addrtwo", $_POST["ds_addrtwo"]);
		  update_post_meta($post->ID, "ds_location", $_POST["ds_location"]);
		  update_post_meta($post->ID, "ds_area", $_POST["ds_area"]);
		  update_post_meta($post->ID, "ds_city", $_POST["ds_city"]);
		  update_post_meta($post->ID, "ds_state", $_POST["ds_state"]);
		  update_post_meta($post->ID, "ds_pincode", $_POST["ds_pincode"]);
		  update_post_meta($post->ID, "ds_latitude", $_POST["ds_latitude"]);
		  update_post_meta($post->ID, "ds_longitude", $_POST["ds_longitude"]);
		  update_post_meta($post->ID, "ds_zoom", $_POST["ds_zoom"]);
		  update_post_meta($post->ID, "ds_cntperson", $_POST["ds_cntperson"]);
		  update_post_meta($post->ID, "ds_mode", $_POST["ds_mode"]);
		  update_post_meta($post->ID, "ds_year", $_POST["ds_year"]);
		  update_post_meta($post->ID, "ds_featured", $_POST["ds_featured"]);
		  update_post_meta($post->ID, "ds_popular", $_POST["ds_popular"]);
		  update_post_meta($post->ID, "ds_map", $_POST["ds_map"]);
		  update_post_meta($post->ID, "ds_week", $_POST["ds_week"]);
		  update_post_meta($post->ID, "ds_template", $_POST["ds_template"]);





		  //social contacts
		  update_post_meta($post->ID, "ds_whatsapp", $_POST["ds_whatsapp"]);
		  update_post_meta($post->ID, "ds_facebook", $_POST["ds_facebook"]);
		  update_post_meta($post->ID, "ds_twitter", $_POST["ds_twitter"]);
		  update_post_meta($post->ID, "ds_linkedin", $_POST["ds_linkedin"]);
		  update_post_meta($post->ID, "ds_skype", $_POST["ds_skype"]);

}
