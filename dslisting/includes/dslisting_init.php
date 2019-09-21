<?php

add_action('init', 'Category_register');	

function Category_register() {

	$labels = array(
		'name' 							=> _x('C3 Listings', 'post type general name'),
		'singular_name' 			=> _x('Listing', 'post type singular name'),
		'add_new' 						=> _x('Add Listing', 'Listings'),
		'add_new_item' 			=> __('Add New Listing'),
		'edit_item' 						=> __('Edit Listing'),
		'new_item'						=> __('New Listing'),
		'view_item' 					=> __('View Listing'),
		'search_items' 				=> __('Search Listing'),
		'not_found' 						=>  __('Nothing found'),
		'not_found_in_trash' 		=> __('Nothing found in Trash'),
		'parent_item_colon' 		=> ''
	);
	$capabilities = array(
					"read_post"		 				=> "read_listing",
					"publish_posts"		 			=> "publish_listings",
					"read_private_posts"		=> "read_private_listings",

					
					"edit_post"		 				=> "edit_listing",
					"edit_posts"		 				=> "edit_listings",
					"edit_others_posts"	 		=> "edit_others_listings",
					"edit_private_posts"     	=> "edit_private_listings",
					"edit_published_posts"   => "edit_published_listings",
					

					"delete_post"				 => "delete_listing",
					"delete_posts"           		=> "delete_listings",
					"delete_private_posts"   		=> "delete_private_listings",
					"delete_published_posts" 	  => "delete_published_listings",
					"delete_others_posts"    	 => "delete_others_listings"
    );

 	$args = array(
		'labels' 							=> $labels,
		'public' 							=> true,
		'publicly_queryable' 		=> true,
		'show_ui'							=> true,
		'query_var' 						=> true,
		'menu_icon' 					=> plugins_url() . '/dslisting/images/category-logo.png',
		'rewrite' 							=> true,
		'capability_type' 			=> 'post',
		'capabilities' 					=>$capabilities,
		'hierarchical' 					=> false,
		'menu_position' 			=> null,
		'map_meta_cap'			=>true,
		'supports' 						=> array('title','editor','thumbnail'),
		'taxonomies'          => array( 'listing-category','location', 'product' ),
	  ); 

	register_post_type( 'listing' , $args );
	flush_rewrite_rules();
}

//add capabilites code



function add_listing_caps() {
    // gets the administrator role

    $admins = get_role( 'administrator' );
    $admins->add_cap( 'read_listing' ); 
    $admins->add_cap( 'publish_listings' ); 
    $admins->add_cap( 'read_private_listings' );
    $admins->add_cap( 'edit_listings' ); 
    $admins->add_cap( 'edit_others_listings' );
    $admins->add_cap( 'edit_private_listings' );
	$admins->add_cap( 'edit_published_listings' ); 
	$admins->add_cap( 'delete_listing' ); 
	$admins->add_cap( 'delete_listings' ); 
	$admins->add_cap( 'delete_private_listings' ); 
	$admins->add_cap( 'delete_published_listings' ); 
	$admins->add_cap( 'delete_others_listings' ); 

}

add_action( 'admin_init', 'add_listing_caps');


add_action( 'init', 'create_category_taxonomies', 0 );



function create_category_taxonomies() {

	// Add new taxonomy, make it hierarchical (like categories)

	$labels = array(
		'name'              					=> _x( 'Categories', 'taxonomy general name' ),
		'singular_name'    				=> _x( 'Categories', 'taxonomy singular name' ),
		'search_items'     				=> __( 'Search Listing Categories' ),
		'all_items'         					=> __( 'All Listing Categories' ),
		'parent_item'       				=> __( 'Parent Listing Category' ),
		'parent_item_colon' 			=> __( 'Parent Listing Category:' ),
		'edit_item'         					=> __( 'Edit Listing Category' ),
		'update_item'       				=> __( 'Update Listing Category' ),
		'add_new_item'     			=> __( 'Add New Listing Category' ),
		'new_item_name'    			=> __( 'New Listing Category Name' ),
		'menu_name'         			=> __( 'Categories' ),
	);

	$args = array(
		'hierarchical'     		 			=> true,
		'labels'            						=> $labels,
		'show_ui'           					=> true,
		'show_admin_column' 		=> true,
		'show_in_nav_menus' 		=> true,
		'query_var'        					=> true,
		'rewrite'           					=> array( 'slug' => 'listing-category' ),

	);

	
	$loclabels = array(
		'name'              					=> _x( 'Locations', 'taxonomy general name' ),
		'singular_name'     			=> _x( 'Locations', 'taxonomy singular name' ),
		'search_items'     				=> __( 'Search Locations' ),
		'all_items'         					=> __( 'All Listing Locations' ),
		'parent_item'       				=> __( 'Parent Location' ),
		'parent_item_colon' 			=> __( 'Parent Location:' ),
		'edit_item'         					=> __( 'Edit Location' ),
		'update_item'       				=> __( 'Update Location' ),
		'add_new_item'      			=> __( 'Add NewLocation' ),
		'new_item_name'     			=> __( 'New Location Name' ),
		'menu_name'         			=> __( 'Locations' ),
	);


	$locargs = array(
		'hierarchical'     		 			=> true,
		'labels'            						=> $loclabels,
		'show_ui'          					=> true,
		'show_admin_column' 		=> true,
		'show_in_nav_menus' 		=> true,
		'query_var'         					=> true,
		'rewrite'           					=> array( 'slug' => 'location' ),
	);

	
	$prolabels = array(
		'name'              					=> _x( 'Products', 'taxonomy general name' ),
		'singular_name'    			 	=> _x( 'Products', 'taxonomy singular name' ),
		'search_items'      				=> __( 'Search Products' ),
		'all_items'         					=> __( 'All Listing Products' ),
		'parent_item'       				=> __( 'Parent Product' ),
		'parent_item_colon' 			=> __( 'Parent Product:' ),
		'edit_item'         					=> __( 'Edit Product' ),
		'update_item'       				=> __( 'Update Product' ),
		'add_new_item'     	 		=> __( 'Add NewProduct' ),
		'new_item_name'    			=> __( 'New Product Name' ),
		'menu_name'         			=> __( 'Products' ),
	);


	$proargs = array(
		'hierarchical'      						=> true,
		'labels'            							=> $prolabels,
		'show_ui'           						=> true,
		'show_admin_column' 			=> true,
		'show_in_nav_menus' 			=> true,
		'query_var'         						=> true,
		'rewrite'           						=> array( 'slug' => 'product' ),
	);

/*$arealables = array(
		'name'              					=> _x( 'Areas', 'taxonomy general name' ),
		'singular_name'     			=> _x( 'Areas', 'taxonomy singular name' ),
		'search_items'     				=> __( 'Search Areas' ),
		'all_items'         					=> __( 'All Listing Areas' ),
		'parent_item'       				=> __( 'Parent Area' ),
		'parent_item_colon' 			=> __( 'Parent Area:' ),
		'edit_item'         					=> __( 'Edit Area' ),
		'update_item'       				=> __( 'Update Area' ),
		'add_new_item'      			=> __( 'Add NewArea' ),
		'new_item_name'     			=> __( 'New Area Name' ),
		'menu_name'         			=> __( 'Areas' ),
	);


	$areaargs = array(
		'hierarchical'     		 			=> true,
		'labels'            						=> $arealables,
		'show_ui'          					=> true,
		'show_admin_column' 		=> true,
		'show_in_nav_menus' 		=> true,
		'query_var'         					=> true,
		'rewrite'           					=> array( 'slug' => 'area' ),
	);*/


//	

//	register_taxonomy("listing-location", array("listing"), array("hierarchical" => true, "label" => "Locations", "singular_label" => "Location", "rewrite" => true));

//	register_taxonomy("listing-products", array("listing"), array("hierarchical" => true, "label" => "Products", "singular_label" => "Product", "rewrite" => true));

	register_taxonomy('listing-category',  'listing' , $args );
	register_taxonomy( 'location',  'listing' , $locargs );
	register_taxonomy( 'product',  'listing' , $proargs );
	//register_taxonomy( 'area',  'listing' , $areaargs );
}


add_action('restrict_manage_posts','restrict_listings_by_listing_category');
function restrict_listings_by_listing_category() {
    global $typenow;
    global $wp_query;
    if ($typenow=='listing') {
        $taxonomy = 'listing-category';
        $business_taxonomy = get_taxonomy($taxonomy);
        wp_dropdown_categories(array(
            'show_option_all' =>  __("Show All {$business_taxonomy->label}"),
            'taxonomy'        =>  $taxonomy,
            'name'            =>  'category',
            'orderby'         =>  'name',
            'selected'        =>  $wp_query->query['term'],
            'hierarchical'    =>  true,
            'depth'           =>  3,
            'show_count'      =>  true, // Show # listings in parens
            'hide_empty'      =>  true, // Don't show businesses w/o listings
        ));
    }
}


add_action('listing-category_edit_form', 'merchant_edit_form', 10, 2);
add_action ('listing-categoy_edit_form_fields', 'extra_merchant_fields', 10, 2);
add_action('listing-category_add_form_fields','extra_merchant_fields', 10, 2);
add_action('listing-category_add_form','merchant_add_form', 10, 2);


//categories extra field
function merchant_edit_form() {
?>
<script type="text/javascript">
jQuery(document).ready(function(){
	
jQuery('#edittag').attr( "enctype", "multipart/form-data" ).attr( "encoding", "multipart/form-data" );
        });
</script>
<?php 
}

function merchant_add_form() {
?>
<script type="text/javascript">

jQuery(document).ready(function(){

jQuery('#addtag').attr( "enctype", "multipart/form-data" ).attr( "encoding", "multipart/form-data" );

        });
</script>
<?php 
}

function save_extra_merchant_fileds( $term_id ) {
		//print_r($_POST);
   		 if ( isset( $_POST['Cat_meta'] ) ) {
        $t_id = $term_id;
        $cat_meta = get_option( "listing-category_$t_id");
        $cat_keys = array_keys($_POST['Cat_meta']);
            foreach ($cat_keys as $key){
            if (isset($_POST['Cat_meta'][$key])){
                $cat_meta[$key] = $_POST['Cat_meta'][$key];
            }

			}
		//echo $_POST['Cat_meta']['img'] ;
		$image = wp_get_image_editor($_POST['Cat_meta']['img']  );
		if ( ! is_wp_error( $image ) ) {
			$image->resize( 320, 180, true );
			$image->save(  $_POST['Cat_meta']['img'] );
		}
        //save the option array
		if(get_option("listing-category_$t_id")!==false){
			  update_option( "listing-category_$t_id", $cat_meta );
		}
		else{
			update_option( "listing-category_$t_id", $cat_meta );
		}

    }
}

function extra_merchant_fields( $tag ) {    //check for existing featured ID
     $t_id = $tag->term_id;
     $cat_meta = get_option("listing-category_$t_id");
?>

<div class="form-field">
<?php //echo $t_id;?>
<label for="cat_Image_url">
<?php //echo $cat_meta['img']; ?>
      <?php _e('Category  Image Url'); ?>
    </label>
    <input type="text" name="Cat_meta[img]" id="Cat_metaimg" size="3" style="width:60%;" value="<?php echo $cat_meta['img']; ?>">   <input id="Cat_metaimg_button"  type="button" value="Upload Image" />
    <br />
    </div>
    <?php

}
add_action('created_listing-category','extra_merchant_fields', 10, 2);
add_action ( 'edited_listing-category', 'save_extra_merchant_fileds', 10, 2);

// Edit term page

function ds_listing_taxonomy_edit_meta_field($tag) {
  $t_id = $tag->term_id;
    $term_meta = get_option( "listing-category_$t_id" ); ?>
    <?php _e('Category  Image Url'); ?>
     <input type="text" name="Cat_meta[img]" id="Cat_metaimg" size="3" style="width:60%;" value="<?php echo $term_meta['img']; ?>">
      <input id="Cat_metaimg_button"  type="button" value="Upload Image" />

<?php
}
add_action( 'listing-category_edit_form_fields', 'ds_listing_taxonomy_edit_meta_field', 10, 2 );

//product image field

	add_action('product_edit_form', 'product_edit_form', 10, 2);
	add_action ('product_edit_form_fields', 'extra_product_fields', 10, 2);
	add_action('product_add_form_fields','extra_product_fields', 10, 2);
	add_action('product_add_form','product_add_form', 10, 2);


//categories extra field
function product_edit_form() {
?>
<script type="text/javascript">
jQuery(document).ready(function(){
	
jQuery('#edittag').attr( "enctype", "multipart/form-data" ).attr( "encoding", "multipart/form-data" );
        });
</script>
<?php 
}

function product_add_form() {
?>
<script type="text/javascript">

jQuery(document).ready(function(){

jQuery('#addtag').attr( "enctype", "multipart/form-data" ).attr( "encoding", "multipart/form-data" );

        });
</script>
<?php 
}

function save_extra_product_fileds( $term_id ) {
		//print_r($_POST);
   		 if ( isset( $_POST['Cat_meta'] ) ) {
        $t_id = $term_id;
        $cat_meta = get_option( "Cat_$t_id");
        $cat_keys = array_keys($_POST['Cat_meta']);
            foreach ($cat_keys as $key){
            if (isset($_POST['Cat_meta'][$key])){
                $cat_meta[$key] = $_POST['Cat_meta'][$key];
            }

			}
		//echo $_POST['Cat_meta']['img'] ;
		$image = wp_get_image_editor($_POST['Cat_meta']['img']  );
		if ( ! is_wp_error( $image ) ) {
			$image->resize( 320, 180, true );
			$image->save(  $_POST['Cat_meta']['img'] );
		}
        //save the option array
		if(get_option("product_$t_id")!==false){
			  update_option( "product_$t_id", $cat_meta );
		}
		else{
			update_option( "product_$t_id", $cat_meta );
		}

    }
}

function extra_product_fields( $tag ) {    //check for existing featured ID

     $t_id = $tag->term_id;
     $cat_meta = get_option("product_$t_id");
?>

<div class="form-field">
<?php //echo $t_id;?>
<label for="cat_Image_url">
<?php //echo $cat_meta['img']; ?>
      <?php _e('Product  Image Url'); ?>
    </label>
    
    <input type="text" name="Cat_meta[img]" id="Cat_metaimg" size="3" style="width:60%;" value="<?php echo $cat_meta['img']; ?>">
      <input id="Cat_metaimg_button"  type="button" value="Upload Image" />
   
    <br />
    </div>
    <?php

}
add_action('created_product','extra_product_fields', 10, 2);
add_action ( 'edited_product', 'save_extra_product_fileds', 10, 2);


function location_edit_form() {
?>
<script type="text/javascript">
jQuery(document).ready(function(){
	
jQuery('#edittag').attr( "enctype", "multipart/form-data" ).attr( "encoding", "multipart/form-data" );
        });
</script>
<?php 
}

function location_add_form() {
?>
<script type="text/javascript">

jQuery(document).ready(function(){

jQuery('#addtag').attr( "enctype", "multipart/form-data" ).attr( "encoding", "multipart/form-data" );

        });
</script>
<?php 
}

function save_extra_location_fileds( $term_id ) {
		//print_r($_POST);
   		 if ( isset( $_POST['Cat_meta'] ) ) {
        $t_id = $term_id;
        $cat_meta = get_option( "Cat_$t_id");
        $cat_keys = array_keys($_POST['Cat_meta']);
        foreach ($cat_keys as $key){
            if (isset($_POST['Cat_meta'][$key])) $cat_meta[$key] = $_POST['Cat_meta'][$key];
        }
		
        //save the option array
		update_option( "location_$t_id", $cat_meta );
		
    }
}

function extra_location_fields( $tag ) {    //check for existing featured ID
     $t_id = $tag->term_id;
     $cat_meta = get_option("location_$t_id");
?>

<div class="form-field">
	<label for="cat_loc_state">State</label>
    <select name="Cat_meta[state]" id="Cat_metastate" required>
        <option value="">--Select state--</option>
        <?php
            global $wpdb;
            $table_name =  $wpdb->prefix. 'dslistings_state_list';
            $listingdata = $wpdb->get_results( "SELECT * FROM $table_name" );
            foreach($listingdata as $k => $v){
			$selected=($v->id==$cat_meta['state'])?'selected="selected"':"";
        ?>
            <option value="<?php echo $v->id;?>" <?php echo $selected;?>>
            <?php echo $v->state;?>
            </option>              
        <?php }?>
    </select>
</div>
    <?php

}
add_action ('location_edit_form_fields', 'extra_location_fields', 10, 2);
add_action('location_add_form_fields','extra_location_fields', 10, 2);
add_action('created_location','extra_location_fields', 10, 2);
add_action ( 'edited_location', 'save_extra_location_fileds', 10, 2);

add_action('location_edit_form', 'location_edit_form', 10, 2);
add_action('location_add_form','location_add_form', 10, 2);


//Area location field
/*function save_extra_area_fileds( $term_id ) {
		//print_r($_POST);
   		 if ( isset( $_POST['Cat_meta'] ) ) {
        $t_id = $term_id;
        $cat_meta = get_option( "Cat_$t_id");
        $cat_keys = array_keys($_POST['Cat_meta']);
        foreach ($cat_keys as $key){
            if (isset($_POST['Cat_meta'][$key])) $cat_meta[$key] = $_POST['Cat_meta'][$key];
        }
		
        //save the option array
		update_option( "area_$t_id", $cat_meta );
		
    }
}

function extra_area_fields( $tag ) {    //check for existing featured ID
     $t_id = $tag->term_id;
     $cat_meta = get_option("area_$t_id");
?>

<div class="form-field">
	<label for="cat_loc_location">Location</label>
  <?php $locations=get_the_terms( $post->ID, 'location' );
		// print_r($locations);
			wp_dropdown_categories('show_option_none=Select Location&show_count=0&orderby=name&echo=1&taxonomy=location&hide_empty=0&id=taxinputarea&name=Cat_meta[area]&selected='.$cat_meta['area']);?>
</div>
    <?php

}
add_action ('area_edit_form_fields', 'extra_area_fields', 10, 2);
add_action('area_add_form_fields','extra_area_fields', 10, 2);
add_action('created_area','extra_area_fields', 10, 2);
add_action ( 'edited_area', 'save_extra_area_fileds', 10, 2);*/

?>