// JavaScript Document
jQuery("document").ready(function(){
	var tgm_media_frame;
	var ffield;
        jQuery('#Cat_metaimg_button').click(function() {
            ffield=jQuery(this).attr('id');
            ffield=ffield.slice(0,-7);
          	if ( tgm_media_frame ) {
            tgm_media_frame.open();
            return;
          }
          tgm_media_frame = wp.media.frames.tgm_media_frame = wp.media({
            multiple: true,
            library: {
              type: 'image'
            },
          });
          tgm_media_frame.on('select', function(){
            var selection = tgm_media_frame.state().get('selection');
            selection.map( function( attachment ) {
                attachment = attachment.toJSON();
                jQuery("#"+ffield).val(attachment.url);
                //$("#something").after("<img src=" +attachment.url+">");
            });
          });
          tgm_media_frame.open();

        });
	
  	

//listing code	
				jQuery("div.ds_gridlist2-3").addClass("uk-text-center");
				jQuery("div.ds_rmvgrid").removeClass("uk-grid");
				jQuery("div.ds_items_desc").hide();
								
				jQuery("#ds_grid").click(function(){
									
						//alert("hai grid");	
						//jQuery("div.ds_gridlist").removeClass("uk-width-1-1").addClass("uk-width-1-4");		
						jQuery("div.ds_main_list").removeClass("uk-width-medium-1-1").addClass("uk-width-medium-1-3");
						jQuery("div.ds_rmvgrid").removeClass("uk-grid");
						jQuery("div.ds_gridlist1-3").removeClass("uk-width-medium-1-3").addClass("uk-width-medium-1-1");
						jQuery("div.ds_gridlist2-3").removeClass("uk-width-medium-2-3").addClass("uk-width-medium-1-1 uk-text-center");
						jQuery("div.ds_items_desc").hide();
				});
				jQuery("#ds_full").click(function(){
							
					//alert("hai full");	
					//jQuery("div.ds_gridlist").removeClass("uk-width-1-4").addClass("uk-width-1-1");		
					jQuery("div.ds_main_list").removeClass("uk-width-medium-1-3").addClass("uk-width-medium-1-1");
					jQuery("div.ds_rmvgrid").addClass("uk-grid");
					jQuery("div.ds_gridlist1-3").removeClass("uk-width-medium-1-1").addClass("uk-width-medium-1-3");
					jQuery("div.ds_gridlist2-3").removeClass("uk-width-medium-1-1 uk-text-center").addClass("uk-width-medium-2-3");
					jQuery("div.ds_items_desc").show();
				});
		

			//themes jquery
			
			/*jQuery(".ds_single_listing .uk-width-medium-2-3").addClass("siderbarleft");
			jQuery(".ds_single_listing .uk-width-medium-1-3").addClass("siderbarright");
		*/
		
});


function subcatshow(num){
	jQuery(".subcatlist_"+num).toggle(2000);
}