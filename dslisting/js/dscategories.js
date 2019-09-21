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


	
});
	
	
	
	
