jQuery(function(){
    initLanguageSwitcher();
    initMapField();
    initWooCommercePriceRange();
    initMagicToolboxFix();
    initContactForm7();
});

function openNav() {
    document.getElementById("mySidenav").style.right = "0";
    document.body.classList.add("sidebar-offer-open");
}

function closeNav() {
    document.getElementById("mySidenav").style.right = "-300px";
    document.body.classList.remove("sidebar-offer-open");
}

function initContactForm7() {
    jQuery(window).on('invalid.wpcf7', function(e){
        jQuery(e.target)
            .find('.form-group')
            .removeClass('has-error');
            
        jQuery(e.target)
            .find('.wpcf7-not-valid-tip')
            .addClass('alert alert-danger')
            .parents('.form-group')
            .addClass('has-error');
            
        jQuery(e.target)
            .find('.wpcf7-validation-errors')
            .addClass('alert alert-warning');
    });
    
    jQuery(window).on('mailsent.wpcf7', function(e){
        jQuery(e.target)
            .find('.wpcf7-mail-sent-ok')
            .addClass('alert alert-success');
    });
}

function initMagicToolboxFix() {
    var thumbs = jQuery('.MagicToolboxSelectorsContainer a');
    thumbs.removeAttr('title');
}

function initLanguageSwitcher() {
    
    jQuery('.language-form select.language').each(function(){
        var lang = jQuery(this).val().split('|')[1];
        
        jQuery('body')
            .removeClass('lang-en')
            .removeClass('lang-es')
            .removeClass('lang-fr')
            .removeClass('lang-it')
            .removeClass('lang-pt')
            .removeClass('lang-de');
            
        jQuery('body').addClass('lang-' + lang);
    });
    
    
    jQuery('.language-form select.language').change(function(){
        var lang = jQuery(this).val().split('|')[1];
        
        jQuery('body')
            .removeClass('lang-en')
            .removeClass('lang-es')
            .removeClass('lang-fr')
            .removeClass('lang-it')
            .removeClass('lang-pt')
            .removeClass('lang-de');
            
        jQuery('body').addClass('lang-' + lang);
        
        doGTranslate(jQuery(this).val());
        return false;
    });
}


function initMapField() {
    if(!window.google) {
        return;
    }

    jQuery('.google-map-field').each(function(){
        var map_holder = this;
        var lat = jQuery(map_holder).data('lat');
        var lng = jQuery(map_holder).data('lng');

        if (lat && lng) {
            var myLatlng = new google.maps.LatLng(lat, lng);
            var myOptions = {
                zoom: 13,
                center: myLatlng,
                disableDefaultUI: false,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            }

            var popup = jQuery(map_holder).find('.google-map-field-popup').first().clone();
            var map = new google.maps.Map(map_holder, myOptions);

            if (popup.length) {
                var contentString = '<div id="address-block">' + popup.html() + '</div>';
                var infowindow = new google.maps.InfoWindow({
                    content: contentString,
                    maxWidth: 227
                });
                var marker = new google.maps.Marker({
                    position: myLatlng,
                    map: map,
                    title: ''
                });
                var flag = false;
                google.maps.event.addListener(marker, 'click', function() {
                    if(flag){
                        flag = false;
                        infowindow.close(map, marker);
                    } else{
                        flag = true;
                        infowindow.open(map, marker);
                    }


                    jQuery('.gm-style-iw').parent().addClass('gm-holder');
                });
            }
        }
    });
}

function initWooCommercePriceRange() {
    jQuery('body').on('price_slider_create', function(event, min, max){
        jQuery('.slider-wrap .ui-slider-handle').eq(0).html('<strong class="first-value">' + woocommerce_price_slider_params.currency_format_symbol + '<span class="v1">' + min + '</span></strong>');
        jQuery('.slider-wrap .ui-slider-handle').eq(1).html('<strong class="last-value">' + woocommerce_price_slider_params.currency_format_symbol + '<span class="v2">' + max + '</span></strong>');
    });

    jQuery('body').on('price_slider_slide', function(event, min, max){
        jQuery('.slider-wrap .ui-slider-handle .first-value .v1').html(min);
        jQuery('.slider-wrap .ui-slider-handle .last-value .v2').html(max);
    });

    jQuery('body').on('price_slider_change', function(event, min, max){
        jQuery('.slider-wrap .ui-slider-handle .first-value .v1').html(min);
        jQuery('.slider-wrap .ui-slider-handle .last-value .v2').html(max);

        jQuery('.slider-wrap').parents('form').submit();
    });

}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) != -1) return c.substring(name.length,c.length);
    }
    return "";
} 

jQuery(document).ready(function( $ ) {
$(function() {
  $(".search-icon-section").on("click", function(e) {
    $(".search-icon-section form").addClass("wide-form");
    $(".header-social").removeClass("open-social-icon");
    e.stopPropagation()
  });
  $(document).on("click", function(e) {
    if ($(e.target).is(".search-icon-section") === false) {
      $(".search-icon-section form").removeClass("wide-form");
    }
  });
});


});


jQuery(document).ready(function( $ ) {
$(function() {
  $(".social-sharing img").on("click", function(e) {
    $(".header-social").toggleClass("open-social-icon");
    $(".search-icon-section form").removeClass("wide-form");
    e.stopPropagation()
  });
  $(document).on("click", function(e) {
    if ($(e.target).is(".social-sharing img") === false) {
      $(".header-social").removeClass("open-social-icon");
    }
  });
});

window.onscroll = function() {myFunction()};

var header = document.getElementById("myHeader");
var sticky = header.offsetTop;

function myFunction() {
  if (window.pageYOffset >= sticky) {
    document.body.classList.add("sticky-head");
    header.classList.add("sticky");

  } else {
    header.classList.remove("sticky");
    document.body.classList.remove("sticky-head");
  }
}




});





jQuery(document).ready(function($){
if ($(window).width() < 767) {
    $('body').addClass('f-nav');
} else {
    $('body').removeClass('f-nav');
}
});



jQuery(document).ready(function($){
$(function() {                       //run when the DOM is ready
  $(" .search-icon-section img").click(function() {  //use a class, since your ID gets mangled
    $(".open-search-form-mobile").addClass("open-mob-search");      //add the class to the clicked element
  });

  $(".open-search-form-mobile .form-mob-close").click(function() {  //use a class, since your ID gets mangled
    $(".open-search-form-mobile").removeClass("open-mob-search");      //add the class to the clicked element
  });


});
});


jQuery(document).ready(function($){
$("body.sidebar-offer-open .sticky-menu ul li:first-child").click(function() {
   document.getElementById("mySidenav").style.right = "-300px";
    document.body.classList.remove("sidebar-offer-open");
});
});