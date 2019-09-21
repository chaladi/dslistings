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
	
	
	
	jQuery("form#post").addClass("uk-form");
	
	
//Maps coding

function initialize() {
	var lat=document.getElementById('ds_latitude').value ;
	var long=document.getElementById('ds_longitude').value 
	var zoomlevel=parseInt(document.getElementById('ds_zoom').value);
	//alert(zoomlevel);
	
  var mapOptions = {
				zoom:zoomlevel,
				center: new google.maps.LatLng(lat,long),
				mapTypeId: google.maps.MapTypeId.ROADMAP,
				mapTypeControl: false,
				streetViewControl: false,
				panControl: true,
				zoomControl: true,
				scaleControl: true,
				zoomControlOptions: {
				position: google.maps.ControlPosition.LEFT_BOTTOM
		}
  };

  var map = new google.maps.Map(document.getElementById('map-canvas'),
      mapOptions);
	  
	  var marker = new google.maps.Marker({
      position: new google.maps.LatLng(lat,long),
      map: map,
     });
	  map.setOptions({draggableCursor:'move'});
	  map.setOptions({ draggable : true });	
		  google.maps.event.addListener(map,'click',function(event) 
			  { 
				document.getElementById('ds_latitude').value = event.latLng.lat();
				document.getElementById('ds_longitude').value = event.latLng.lng();
			  });		
	}

function loadScript() {
  var script = document.createElement('script');
  script.type = 'text/javascript';
  script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp' +
      '&signed_in=true&callback=initialize';
  document.body.appendChild(script);
}

window.onload = loadScript;

//location selection code

	var ds_latitude;
	var ds_longtitude;

function locationChange(val) {
	var ds_city_text=document.getElementById('ds_area').value;
	var ds_addr1=document.getElementById('ds_addrone').value;
	var ds_addr2=document.getElementById('ds_addrtwo').value;
	var ds_pincode=document.getElementById('ds_pincode').value;
	var ds_title=document.getElementById('ds_title').value;
	//alert(ds_city_text);
	var address=ds_city_text+' '+val;
	//alert(address);
	//alert(val);
    geocoder = new google.maps.Geocoder();
	/*var ds_city_text=document.getElementById('ds_city').value;
	alert(ds_city_text);
	var address=ds_city_text+' '+val;
	alert(address);*/
    //var address = val;
    geocoder.geocode( { 'address': address}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {

      //alert("Latitude: "+results[0].geometry.location.lat());
      //alert("Longitude: "+results[0].geometry.location.lng());
	  ds_latitude=results[0].geometry.location.lat();
	  ds_longtitude=results[0].geometry.location.lng();
	 
	 document.getElementById('ds_latitude').value =ds_latitude;
	 document.getElementById('ds_longitude').value = ds_longtitude;
	  
	  var myLatlng = new google.maps.LatLng(ds_latitude, ds_longtitude);
	  var mapOptions = {
				zoom: 8,
				center: myLatlng,
				mapTypeId: google.maps.MapTypeId.ROADMAP,
				mapTypeControl: false,
				streetViewControl: false,
				panControl: true,
				zoomControl: true,
				scaleControl: true,
				zoomControlOptions: {
				position: google.maps.ControlPosition.LEFT_BOTTOM
		}
  }
  var map = new google.maps.Map(document.getElementById('map-canvas'),
      mapOptions);
	   var marker = new google.maps.Marker({
      position: myLatlng,
      map: map,
	  title:ds_title
      
  });
	   var contentString='<div id="ds_infoaddress">'+
	   		'<div class="ds_addr1">'+ds_addr1+' , '+ds_addr2+'</div>'+
			'<div class="ds_area">'+ds_city_text+'</div>'+
			'<div class="ds_area">'+val+' - '+ds_pincode+'</div>'+
	   '</div>';
	  var infowindow = new google.maps.InfoWindow({
      content: contentString
  });

	  
	 
   google.maps.event.addListener(marker, 'mouseover', function() {
    infowindow.open(map,marker);
  });
   google.maps.event.addListener(marker, 'mouseout', function() {
    infowindow.close();
  });


		google.maps.event.addListener(map,'click',function(event) 
			  { 
				document.getElementById('ds_latitude').value = event.latLng.lat();
				document.getElementById('ds_longitude').value = event.latLng.lng();
			  });		
      } 

      else {
        alert("Geocode was not successful for the following reason: " + status);
      }
    });
	
	
}


google.maps.event.addDomListener(window, 'load', initialize);
    
   

