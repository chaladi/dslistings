<?php


/*----------------------------------All Frontend LIst coding----------------------------------------*/

//products list Front end output
function dscategory_output(){

	$args = array(
			'type'                       => 'listing',
			'child_of'                 => 0,
			'parent'                   => '',
			'orderby'                 => 'name',
			'order'                     => 'ASC',
			'hide_empty'          => 0,
			'hierarchical'          => 1,
			'exclude'                 => '',
			'include'                  => '',
			'number'                 => '',
			'taxonomy'             => 'product',
			'pad_counts'         => false 

	); 
	$categories = get_categories( $args );
	/*echo"<pre>";
	print_r($categories);
	echo"</pre>";*/
	//$allcats=array();
	$html ="";
	$html.="<div class=\"ds_productstitle\"><h3>Search by Product</h3></div>";
	$html.="<div class=\"ds_home_categories\">";
	foreach($categories as $catname){
			$html .= "<ul class=\"ds_home_catlist\">";	
					$imgurl = get_option( 'product_'.$catname->cat_ID );
					$imgurl=$imgurl['img'];
					if($imgurl){
						$html.= "<li class=\"ds_cat_image\">
											<a href=\"".get_site_url()."/$catname->taxonomy/$catname->slug\">
											<img src=".$imgurl." alt=".$catname->name." /></a>
										</li>"; 		
					}else{
						$html.= "<li class=\"ds_cat_image\">
										<img src=\"".get_stylesheet_directory_uri()."/images/userimage.PNG\" alt=".$catname->name." /></li>"; 
					}
					$html .= "<li class=\"ds_cat_name\">
									<a href=\"".get_site_url()."/$catname->taxonomy/$catname->slug\">".$catname->name ."</a></li>";
			$html .= "</ul>";
		
			}
			$html .= "<div class=\"clear\"></div>";
			$html.="</div>";

	return $html;	
}
add_shortcode('dscategory_output', 'dscategory_output');


//categorylist frontend output

function ds_list_categories(){
    $args = array(
            'type'                     	=> 'listing',
            'child_of'                 =>'',
            'parent'                   => '',
            'orderby'                 => 'name',
            'order'                    	=> 'ASC',
            'hide_empty'          =>0,
            'hierarchical'          => 1,
            'exclude'                 => '',
            'include'                  => '',
            'number'                 => '',
             'title_li'                   =>__( 'Categories' ),
            'taxonomy'             => 'listing-category',
            'pad_counts'         => false
    );

    //$allcats=array();
    $html ="<div class=\"ds_catlist_title\"><h2>Categories</h2></div>";
    $html.="<div class=\"ds_categories_list\"><div class=\"uk-grid\">";
    
    				$categories = get_categories($args);
				   /*  echo"<pre>";
					print_r($categories);
					echo"</pre>";*/
   					$ds_catval = 1;
    foreach($categories as $catname){

        if($catname->category_parent==0){
			$html .= "<div class=\"ds_categorylist uk-width-medium-1-2\">";  
					$imgurl = get_option( 'listing-category_'.$catname->cat_ID );
					$imgurl =$imgurl['img'];
					$html.="<div class=\"uk-width-medium-1-1\"><div class=\"uk-grid\">";
					if($imgurl){
						$html.= "<div class=\"uk-width-medium-1-3\">
											<img src=".$imgurl." alt=".$catname->name." /></div>";  
			  	 	}else{
					$html.= "<div class=\"uk-width-medium-1-3\">
									<img src=\"".get_stylesheet_directory_uri()."/images/userimage.PNG\" alt=".$catname->name." /></div>";
				   }
        $html .= "<div class=\"uk-width-medium-2-3\">
							<a href=\"".get_site_url()."/$catname->taxonomy/$catname->slug\">".$catname->name ."</a>
							<span>(".$catname->category_count.")</span>
						</div>
						</div>
						</div>";
						
           $html.="<div class=\"uk-width-medium-1-1 ds_subcategory_$catname->cat_ID\">";
				$args = array(
							'type' => 'listing',
							'parent' => $catname->cat_ID,
							'hide_empty' => 0,
							'taxonomy' => 'listing-category',
					);
				$cate = get_categories($args);
			 /*  echo"<pre>";
			   print_r($cate);*/
				/*$cate=get_categories(array( 'parent' => $catname->term_id, 'hide_empty' =>0, ));
				var_dump($cate);*/
			if($cate){
            $i = 1;
            $html.="<ul>";
                    foreach($cate as $c){
                      if($i < 6){
                            $html.= "<li>
											<a href=\"".get_site_url()."/$c->taxonomy/$c->slug\"><span  class=\"uk-icon-caret-right ds_subimg\">
											</span>".$c->name."</a><span>(".$c->category_count."</span>)
										</li>";
                        }else{
							if($i==6){
								$html.="<div class=\"subcatlist subcatlist_$catname->cat_ID\">";
							}
							 $html.= "<li>
											 <span  class=\"uk-icon-caret-right ds_subimg\"></span>
											 <a  href=\"".get_site_url()."/$c->taxonomy/$c->slug\">".$c->name."</a>
											 <span>(".$c->category_count."</span>)
										 </li>";
					}
                       $i++;
                    }
					$html.="</div>";
                   $html.="<a  onclick=\"subcatshow($catname->cat_ID)\" class=\"small-button smallblack ds_more\">More...</a>";
                    $html.="";
          $html.="</ul>";
			}
            $html.="</div>";
            $ds_catval++;
         $html .= "</div>";
        }
    }
    $html .= "<div class=\"clear\"></div>";
    $html.="</div></div>";
    return $html;  
}

add_shortcode('ds_list_categories', 'ds_list_categories');

//pagination

function dsmusic_pagination($paged){
	$range = 2;
	$showitems = ($range * 2)+1;  
	if($pages == '')
	{
		global $wp_query;
		$pages = $wp_query->max_num_pages;
			if(!$pages)
			{
				$pages = 1;
			}
	} 
		$content="";
	if(1 != $pages)
	{
	$content.= "<div class=\"uk-margin-top\"><ul class='uk-pagination'>";
	if($paged > 2 && $paged > $range+1 && $showitems < $pages) $content.= "<li><a href='".get_pagenum_link(1)."'>&laquo;</a></li>";
	if($paged > 1 && $showitems < $pages) $content.= "<li><a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a></li>";
	for ($i=1; $i <= $pages; $i++)
	{
		if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
		{
			$content.= ($paged == $i)? "<li class='uk-active'><span>".$i."</span></li>":"<li><a href='".get_pagenum_link($i)."' >".$i."</a></li>";
		}
	}
	if ($paged < $pages && $showitems < $pages) $content.= "<li><a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a></li>"; 
	if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) $content.= "<li><a href='".get_pagenum_link($pages)."'>&raquo;</a></li>";
		$content.= "</ul></div>\n";
	}
	return $content;
}


//contactform

function ds_contactform(){
	global $post,$wpdb;
	if($_POST['ds_cntemail']){
		$ds_cntname = $_POST['ds_cntname'];
		$ds_cntemail = $_POST['ds_cntemail'];
		$ds_cntmsg = $_POST['ds_cntmsg'];
		
$table_name = $wpdb->prefix . "contactform";
$wpdb->insert($table_name, array('name' => $ds_cntname,'email' => $ds_cntemail,'cmsg' => $ds_cntmsg),array('%s','%s','%s') ); 
	if($ds_val){
		$from = get_option('admin_email');
		$headers = 'From: '.$from . "\r\n";
		$subject="Welcome to C3DIAL: ";
		$msg="Hi $ds_cntname \n
                            Welcome to C3DIAL.\n
                           Your Email Address $ds_cntemail. \n\n";
		 wp_mail($ds_cntemail, $subject, $msg, $headers );
	}else{
	}
	}
  $html.="<div class=\"ds_contactform\">";
	$html.="
		  <h3>contact</h3>
		 <div class=\"ds_seperator\"></div>
			 <div class=\"cntform\">
				<form name=\"ds_contactform\">
					<dl>
						<dd><input type=\"text\" name=\"ds_cntname\" placeholder=\"Enter your name\"/></dd>
					</dl>
					<dl>
						<dd><input type=\"text\" name=\"ds_cntemail\"  required=\"required\"placeholder=\"Enter Email\"/></dd>
					</dl>
					<dl>
						<dd>
						<textarea rows=\"10\" cols=\"41\" name=\"ds_cntmsg\"  placeholder=\"Enter your message\"></textarea></dd>
					</dl>
					<dl>
					<dd><div class=\"g-recaptcha\" data-sitekey=\"6Le4gQITAAAAAKlQdkxMfXT3dlVyLlPdCk5yDogr\"></div></dd>
				   </dl>
					<dl>
						<dd><input type=\"submit\" value=\"Send Message\"/></dd>
					</dl>
				</div>
				</form>";		
$html.=" </div>";
	return $html;
}

add_shortcode('ds_contactform', 'ds_contactform');

function old_style_name_like_wpse_123298($clauses) {
  	remove_filter('term_clauses','old_style_name_like_wpse_123298');
  		$pattern = '|(name LIKE )\'%(.+%)\'|';
		//	$pattern = '|(name LIKE )\'(.+%)\'|';
  		$clauses['where'] = preg_replace($pattern,'$1 \'$2\'',$clauses['where']);

  	return $clauses;
}

add_filter('terms_clauses','old_style_name_like_wpse_123298');

//searchform
function ds_searchform(){
	$taxonomy='location';
	$args = array(
		'orderby'           	=> 'name', 
		'order'             		=> 'ASC',
		'hide_empty'      => false
	); 
	$locations=get_terms($taxonomy, $args);	
	//print_r($locations);
	ob_start();
?>

		<div class="lcf_form">
                    <form action="">
                    <dl>
                        <dd>
                            <select name="loc">
                            <option value="all">--Select Location--</option>
                            <?php 
                                foreach( $locations as $locname){ 
            
                                    echo  "<option value=\"$locname->term_id\"> $locname->name</option>";
            
                                 }	?>
                            </select>
                        </dd>
                    	<dd><input  value="" name="s" id="lcf-s" placeholder="Enter Keyword"></dd>
                        <dd>
                             <input type="hidden" name="post_type" value="listing" />
                             <input type="submit"  value="Search">
                        </dd>
                    <dt class="clear"></dt>
                    </dl>
                    </form>
    	</div>
<?php

	$html=ob_get_contents();
	ob_end_clean();
	return $html;
}

add_shortcode('ds_searchform','ds_searchform');

?>