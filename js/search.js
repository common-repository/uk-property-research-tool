var $j = jQuery.noConflict();
function initialize() {
    var lat = parseFloat($j('#longitude').val());
    var lng = parseFloat($j('#latitude').val());
    var myLatlng = new google.maps.LatLng(lat,lng);
    var mapOptions = {
        center: { lat:lat, lng: lng },
        zoom: 14
    };
    var map = new google.maps.Map(document.getElementById('map-canvas'),
        mapOptions);
    var marker = new google.maps.Marker({
        position: myLatlng,
        map: map,
        title: 'Hello World!'
    });
    var panoramaOptions = {
        position: myLatlng,
        pov: {
          heading: 165,
          pitch: 0
        }
    }; 
    var myPano = new google.maps.StreetViewPanorama(document.getElementById('map-canvas'), panoramaOptions);
    map.setStreetView(myPano);
    google.maps.event.addDomListener(window, 'load', initialize);
}

setInterval(function() { $j('.embedCodeContainer').toggleClass("pulsate",800,"easeOutCubic"); }, 1000);
setInterval(function() { $j('.triangle').toggleClass("pulsate",800,"easeOutCubic"); }, 1000);

$j(document).ready(function(){
    $j('#sliding_ctas').remove();
    $j('#more').click(function(e){
        e.preventDefault();
        $j('.moreContainer').addClass('hidden');
        $j('.ptool-sponsorsWrapper').removeClass('hidden');
        $j('.ptool-sponsorsWrapper').css('display','block');
        $j('.ptool-postcodeSearchContainer').css('border-bottom','none')
    });
    /*
    *   Not posting the form, because posting a form inside an iframe to itself doesn't play nice in IE
    */
    var postcode = "";
    $j('#ptool-postcodeSearchSubmit').click(function(e){
        if ($j('#ptool-postcodeSearch').val() == '') {
            e.preventDefault();
            $j('#latitude').val('');
            $j('#longitude').val('');
            $j('#cityText').val('');
            $j('#countyText').val('');
            $j('#location_id').val('');
            alert('Enter a postcode!');
        }else{
            e.preventDefault();
            postcode = $j('#ptool-postcodeSearch').val();
            var url = 'http://maps.googleapis.com/maps/api/geocode/json?address='+postcode+'&sensor=true';  
            $j('.ptool-postcodeResultContainer').addClass('hidden');
            //Get address details, only show the results panel if an address was found
            var geocoder = new google.maps.Geocoder();
            if (geocoder) {
                geocoder.geocode({ 'address': postcode }, function (results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        $j('#latitude').val(results[0].geometry.location.B);
                        $j('#longitude').val(results[0].geometry.location.k);
                        $j('#cityText').val(results[0].address_components[1].long_name);
                        $j('#countyText').val(results[0].address_components[2].long_name);

                        $j('span.postcode_title').text(postcode);
                        $j('span.city_label').text($j('#cityText').val());
                        $j('span.county_label').text($j('#countyText').val());
                        $j('.ptool-postcodeResultContainer').removeClass('hidden');
                        $j('.ptool-postcodeResultContainer').css('display','block');
                        $j('#more').click();
                    }else {
                        alert("Sorry, we couldn't find your address");
                    }
                });
            }    
            /*
            *   Get rightmove id by ajax request as cant use JS to get the content because of cross domain security issues
            */
            $j.ajax({
                url: wnm_custom.plugin_url+"/p118researchtool/embed/get_rightmove_code.php",
                type: 'POST',
                data: {
                    p: postcode
                },
                success: function(response) { 
                    $j('#location_id').val(response);
                },
                error: function(response) { 

                }
            });
        }
    });
     
    $j('.generatedLink').click(function(e){
        e.stopPropagation();
        e.preventDefault();
        var url = $j(this).data('src');
        url = url.replace('%postcode%', encodeURIComponent(postcode));
        url = url.replace('%city%', encodeURIComponent($j('#cityText').val()));
        url = url.replace('%lat%', encodeURIComponent($j('#longitude').val()));
        url = url.replace('%lng%', encodeURIComponent($j('#latitude').val()));
        url = url.replace('%location_id%',  encodeURIComponent($j('#location_id').val()));
        $j('#ptool-modal-link-iframe').attr('src', url);
        var modalBg = $j('#ptool-modal-background');
        $j('body').append(modalBg);
        $j("#ptool-modal-link-content,#ptool-modal-background").addClass("active");
        $j('#ptool-modal-link-iframe').css('opacity','0');           
        $j('#ptool-modal-link-iframe').load(function () {
            $j('#ptool-loadingMessage').css('display', 'none');
            $j('#ptool-modal-link-iframe').css('opacity','1');
        });
        $j('#ptool-modal-link-content').css('height',($j(window).height())*0.92);
        $j('html,body').scrollTop(0);    
    });
   
    $j('#ptool-close-modal,#ptool-modal-close').click(function(e){
        e.stopPropagation();
        e.preventDefault();
        $j("#ptool-modal-link-content,#ptool-modal-background").removeClass("active");
        $j('#ptool-modal-link-iframe').removeClass('hidden');
        $j('#map-canvas').addClass('hidden');
        $j('#ptool-modal-link-iframe').attr('src', '');           
        $j('#ptool-modal-link-iframe').load(function () {
            $j('#ptool-loadingMessage').css('display', 'block');
        });
    });        
     
    $j('#Gstreet').click(function(e){
        e.stopPropagation();
        e.preventDefault();
        $j('#ptool-modal-link-iframe').addClass('hidden');
        $j('#map-canvas').removeClass('hidden');
        $j('#map-canvas').css('display','block'); 
        $j('html,body').scrollTop(0);
        initialize();
    }); 
      
    $j('.ptool-embedCodeGenerator').click(function(e){
        $j("#ptool-embedCodeModal,#modal-background").addClass("active");     
        $j("#ptool-modal-background").css('z-index','1020');
        $j('html,body').scrollTop(0);
    });
        
    $j('#ptool-embed-modal-close').click(function(e){
        e.stopPropagation();
        e.preventDefault();
	   $j("#ptool-embedCodeModal").removeClass("active");
           if (!$j("#ptool-modal-link-content").hasClass("active")){
            $j("#ptool-modal-background").removeClass("active");
           } 
       $j("#ptool-modal-background").css('z-index','980');
     });
        
    $j('.embedSize').click(function(e){           
        if($j('input[name=embedSize]:checked').val()== 'portrait'){
            $j('#embedWidth').val('194');
            $j('#embedHeight').val('180');
            $j('#embedProportions').addClass('hidden');
            $j('#embedWidth').trigger('change');
        }
        else if ($j('input[name=embedSize]:checked').val()== 'landscape') { 
            $j('#embedWidth').val('468');
            $j('#embedHeight').val('68');
            $j('#embedProportions').addClass('hidden');
            $j('#embedWidth').trigger('change');
        }
        else if ($j('input[name=embedSize]:checked').val()== 'custom') {
            $j('#embedWidth').val('');
            $j('#embedHeight').val('');
            $j('#embedProportions').removeClass('hidden');
            $j('#embedProportions').css('display','block');
        }
    });
    
    $j('.embedSize').change(function(e){               
        if($j('input[name=embedSize]:checked').val()== 'portrait'){
            $j('#embedWidth').val('194');
            $j('#embedHeight').val('180');
            $j('#embedProportions').addClass('hidden');
            $j('#embedWidth').trigger('change');
        }
        else if ($j('input[name=embedSize]:checked').val()== 'landscape') { 
            $j('#embedWidth').val('468');
            $j('#embedHeight').val('68');
            $j('#embedProportions').addClass('hidden');
            $j('#embedWidth').trigger('change');
        }
        else if ($j('input[name=embedSize]:checked').val()== 'custom') {
            $j('#embedWidth').val('');
            $j('#embedHeight').val('');
            $j('#embedProportions').removeClass('hidden');
            $j('#embedProportions').css('display','block');
        }
    });
    
    $j('#embedWidth,#embedHeight').change(function(e){
        if($j('#embedHeight').val() < 180) {
            if ($j('#embedWidth').val() < 185) {
                var fs1 = 'style="font-size:15px;padding-bottom:2px;"';
                var fs2 = 'style="font-size:14px;padding-bottom:2px;"';
                $j('#property118-research-tool-header').css('font-size','15px');                    
                $j('#property118-research-tool-text').css('font-size','14px');
                $j('#property118-research-tool-header').css('padding-bottom','2px');
                $j('#property118-research-tool-text').css('padding-bottom','2px');
                if($j('#embedHeight').val() < 145){
                    var fs1 = 'style="font-size:15px;padding-bottom:12px;"';
                    var fs2 = 'style="display:none;"';
                    $j('#property118-research-tool-text').css('display','none');
                    $j('#property118-research-tool-header').css('padding-bottom','12px');
                } else {
                    var fs2 = 'style="font-size:14px;padding-bottom:2px;display:block;"';
                    $j('#property118-research-tool-text').css('display','block');
                }
            } else {
                var fs1 = '';
                var fs2 = 'style="display:block;"';
                $j('#property118-research-tool-header').css('font-size','23px');
                $j('#property118-research-tool-text').css('font-size','17px');
                
                $j('#property118-research-tool-header').css('padding-bottom','10px');
                $j('#property118-research-tool-text').css('padding-bottom','10px');
                $j('#property118-research-tool-text').css('display','block');    
            }
        } else {
            var fs1 = '';
            var fs2 = 'style="display:block;"';
            $j('#property118-research-tool-header').css('font-size','23px');
            $j('#property118-research-tool-text').css('font-size','17px');
            $j('#property118-research-tool-header').css('padding-bottom','10px');
            $j('#property118-research-tool-text').css('padding-bottom','10px');
            $j('#property118-research-tool-text').css('display','block');
        }
        
        $j('#property118-research-tool').css('width',$j('#embedWidth').val());
        $j('#property118-research-tool').css('height',$j('#embedHeight').val());        
        if ($j('#embedWidth').val() >= 416 || $j('#embedWidth').val() == '') {
            $j('#property118-research-tool-button').remove();
            $j('#property118-research-tool').prepend('<div id="property118-research-tool-button"> <input type="submit" id="property118-property-research-tool" name="submit" value="Click Here"> </div>');
            $j('#property118-research-tool-button').css('float','right');
        } else {
            $j('#property118-research-tool-button').remove();
            $j('#property118-research-tool').append('<div id="property118-research-tool-button"> <input type="submit" id="property118-property-research-tool" name="submit" value="Click Here"> </div>');          
            $j('#property118-research-tool-button').css('float','left');
        }
    });
        
    $j('#embedWidth,#embedHeight').blur(function(e){
        $j('#property118-research-tool').css('width',$j('#embedWidth').val());
        $j('#property118-research-tool').css('height',$j('#embedHeight').val());
        if($j('#embedHeight').val() < 180) {
            if ($j('#embedWidth').val() < 185) {
                var fs1 = 'style="font-size:15px;padding-bottom:2px;"';
                var fs2 = 'style="font-size:14px;padding-bottom:2px;"';
                $j('#property118-research-tool-header').css('font-size','15px');                    
                $j('#property118-research-tool-text').css('font-size','14px');
                $j('#property118-research-tool-header').css('padding-bottom','2px');
                $j('#property118-research-tool-text').css('padding-bottom','2px');
                if($j('#embedHeight').val() < 145){
                    var fs1 = 'style="font-size:15px;padding-bottom:12px;"';
                    var fs2 = 'style="display:none;"';
                    $j('#property118-research-tool-text').css('display','none');
                    $j('#property118-research-tool-header').css('padding-bottom','12px');
                } else {
                    var fs2 = 'style="font-size:14px;padding-bottom:2px;display:block;"';
                    $j('#property118-research-tool-text').css('display','block');
                }
            } else {
                var fs1 = '';
                var fs2 = 'style="display:block;"';
                $j('#property118-research-tool-header').css('font-size','23px');
                $j('#property118-research-tool-text').css('font-size','17px');
                
                $j('#property118-research-tool-header').css('padding-bottom','10px');
                $j('#property118-research-tool-text').css('padding-bottom','10px');
                $j('#property118-research-tool-text').css('display','block');    
            }
        } else {
            var fs1 = '';
            var fs2 = 'style="display:block;"';
            $j('#property118-research-tool-header').css('font-size','23px');
            $j('#property118-research-tool-text').css('font-size','17px');
            $j('#property118-research-tool-header').css('padding-bottom','10px');
            $j('#property118-research-tool-text').css('padding-bottom','10px');
            $j('#property118-research-tool-text').css('display','block');
        }

        if ($j('#embedWidth').val() >= 416 || $j('#embedWidth').val() == '') {
            $j('#property118-research-tool-button').remove();
            $j('#property118-research-tool').prepend('<div id="property118-research-tool-button"> <input type="submit" id="property118-property-research-tool" name="submit" value="Click Here"> </div>');
            $j('#property118-research-tool-button').css('float','right');
         } else {
            $j('#property118-research-tool-button').remove();
            $j('#property118-research-tool').append('<div id="property118-research-tool-button"> <input type="submit" id="property118-property-research-tool" name="submit" value="Click Here"> </div>');          
            $j('#property118-research-tool-button').css('float','left');
         }     
    });  
});