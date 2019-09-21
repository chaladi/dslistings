<?php
	function dslisting_search($atts){
				extract( shortcode_atts( array( 'url'=>site_url()), $atts ) );
				$html.="<div class=\"ds_searchblock\">";
						$html.="<div class=\"uk-grid\">";
						$html.="<div class=\"uk-width-1-4\">";
								$html.="<form class=\"uk-form myform_search\" method=\"get\" action=\"$url\">
												<select name=\"ds_location\">
												<option value=\"\">Select Location</option>";	
																$taxonomy='location';
																$locations=get_terms($taxonomy);						
																foreach( $locations as $locname){
																$html.=" <option value=".$locname->term_id."> " .$locname->name."</option>";
																 }
							
									$html.="</form></select>";
					$html.="</div>";
					$html.="<div class=\"uk-width-2-4\">";
								$html.="<input type=\"text\" name=\"ds_type\" placeholder=\"Enter your keyword\"/>";
					$html.="</div>";
					$html.="<div class=\"uk-width-1-4\">";
							$html.="<button class=\"uk-button uk-button-primary\">Search</button>";
							//$html.="<input type=\"submit\" class=\"uk-button uk-button-primary\" name=\"search\" value=\"Search\">";
					$html.="</div>";
		$html.="</div></div>";
		
		return $html;
	}
	add_shortcode("dslisting_search","dslisting_search");
?>
