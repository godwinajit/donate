/**
 * Create an anonymous function to avoid library conflicts
 */
(function($) {
    /**
     * Add our plugin to the jQuery.fn object
     */
    $.fn.responsiveMenu = function(options) {
        /**
         * Define some default settings
         */

        $.fn.responsiveMenu.defaultOptions = {
            "menuIcon_text": '',
			"menuslide_overlap":false,
            "menuslide_push":false,
            "menuslide_direction":''
        };
        /**
         * Merge the runtime options with the default settings
         */
        var options = $.extend({}, $.fn.responsiveMenu.defaultOptions, options);
        /**
         * Iterate through the collection of elements and
         * return the object to preserve method chaining
         */
        return this.each(function(i) {
            var menuobj = $(this);
            var mobileSubMenu;
            var subMenuArrows;
            var mobFlag = false;
            var deskFlag = false;
            var defaultMenu = false;
            createMobileStructure(menuobj);
            mobileMenuInit(menuobj);

            function removeDesktopMenu(menuobj) {
                menuobj.removeClass('desk');
                mobileSubMenu.next().stop(true, true).slideUp();
                subMenuArrows.removeClass('up');
                if(defaultMenu){
                    menuobj.slideUp();
                }
                menuobj.find(".menu-icon").removeClass('active');
            }

            function createMobileStructure(menuobj) {
                if (menuobj.prev('.menu-icon').length == 0) {
                    menuobj.wrapAll('<div class="enumenu_container"></div>');
                    //$('<div class="menu-icon">' + options.menuIcon_text + '</div>').insertBefore(menuobj);
                    $('<div class="menu-icon"> <div class="menu-box"><span></span><span></span><span></span> </div>' + options.menuIcon_text + '</div>').insertBefore(menuobj);
                    //menuobj.find('ul').prev('a').addClass('menubelow');
                    $("> li > a", menuobj).addClass("firstLevel");
                    
                    menuobj.find("li").each(function() {
                        if ($(this).children("ul").length || $(this).children("div").length) {
                            $(this).children().prev('a').addClass('menubelow');
                        }
                    });
                    $(".firstLevel").next("ul").children("li").each(function(){
                       if ($(this).children("ul").length || $(this).children("div").length) {
                           $(this).addClass("secondLevel");
                       }
                    });
                }
                mobileSubMenu = menuobj.find('a.menubelow');
                if (menuobj.find('.arrow').length == 0) {
                    mobileSubMenu.each(function() {
                        $(this).closest('li').prepend('<span class="arrow"></span>');
                        $(this).next().addClass("sb-menu");
                    });
                    subMenuArrows = menuobj.find('.arrow');
                }
                
                
                if(options.menuslide_overlap){
                    $('body').addClass('menuOverlap');
                   
                } else if(options.menuslide_push){
                    $('body').addClass('menuslide_push');
                    
                }
                //console.log(options.menuslide_direction);
                if((options.menuslide_overlap || options.menuslide_push) && options.menuslide_direction==""){
                    //console.log("IF");
                    $('body').addClass('slidemenuRight');
                }
                if(options.menuslide_direction=="left"){
                    $('body').addClass('slidemenuLeft');
                    
                }else if(options.menuslide_direction=="right"){
                    $('body').addClass('slidemenuRight');
                    
                }
            }

            function bindClickonMobilemenu(menuobj) {
                menuobj.find('.arrow').on('touchstart click', function(e) {
                    e.stopImmediatePropagation();
                    e.preventDefault();
                    var submenu = $(this).closest('li').children('.sb-menu');
                    var sibilingsOfCurrent_obj = $(this).closest('li').siblings();
                    var this_parentLi = $(this).closest('li');
                    if ($(".menu-icon").is(":visible")) {
                        if (submenu.length > 0) {
                            sibilingsOfCurrent_obj.find('.sb-menu').stop(true, true).slideUp(); // comment to close
                            sibilingsOfCurrent_obj.find('.sb-menu').each(function() {
                                $(this).closest('li').find('>span').removeClass('up'); // 
                            });
                        }
                        if (!submenu.is(':visible')) {
                            submenu.find('.sb-menu').each(function() {
                                $(this).stop().slideUp();
                                $(this).closest('li').find('span').removeClass('up')
                            });
                            submenu.stop().slideDown();
                            this_parentLi.find('>span').addClass('up');
                        } else {
                            submenu.slideUp();
                            this_parentLi.find('>span').removeClass('up');
                        }
                    }
                });
            }

            function removeMobileMenu(menuobj) {
                menuobj.find('.menubelow').each(function() {
                    $(this).removeAttr('style');
                    $(this).next().removeAttr('style');
                });
                menuobj.find('.arrow').remove();
                menuobj.prev(".menu-icon").removeClass('active');
                menuobj.addClass('desk').removeAttr("style");
                menuobj.removeAttr("style");
                $("body").removeClass("menu-open");
                deskFlag = false;
            }

            $(window).resize(function(e) {
                mobileMenuInit(menuobj);
                //$(".sub-menu").css("padding-left","0px");
            });

            function mobileMenuInit(menuobj) {
                if((options.menuslide_overlap == false && options.menuslide_push == false) || (options.menuslide_overlap == true && options.menuslide_push == true)){
                   defaultMenu = true; 
                }
                if ($(".menu-icon").is(":visible")) {
                    if (!mobFlag) {
                        removeDesktopMenu(menuobj);
                        createMobileStructure(menuobj);
                        bindClickonMobilemenu(menuobj);
                        mobFlag = true;
                        deskFlag = false;
                        menuobj.removeClass('desk');
                        $('body').removeClass('desk');
                        menuobj.addClass('mob');
                        $('body').addClass('mob');
                    }
                } else {
                    if (!deskFlag) {
                        removeMobileMenu(menuobj);
                        mobFlag = false;
                        deskFlag = true;
                        menuobj.removeClass('mob');
                        $('body').removeClass('mob');
                        menuobj.addClass('desk');
                        $('body').addClass('desk');

                    }
                }
            }
            // Toggle menu
            menuobj.prev(".menu-icon").on('click', function(e){
            //$(document).on('click', ".menu-icon", function(e) {
                //e.stopPropagation();
                //e.preventDefault();
                if ($(this).hasClass('active')) {
                    closeMobileMenu(menuobj);
                } else {
                    if(defaultMenu){
                        $(this).next().slideDown();
                    }
                    $(this).addClass("active");
                    $("body").addClass("menu-open");
                }
            });
            $('body').on('click touchstart', function(e) {
                if ($(".menu-icon").is(":visible")) {
                    if ($(e.target).closest(".enumenu_container").length == 0 && !$(e.target).hasClass('active')) {
                        closeMobileMenu(menuobj);
                    }
                }
            });

            function closeMobileMenu(menuobj) {
                $("body").removeClass("menu-open");
                if(defaultMenu){
                    menuobj.stop().slideUp();
                }
                menuobj.prev(".menu-icon").removeClass('active');
                menuobj.find('.arrow').removeClass('up');
                menuobj.find('.sb-menu').stop(true, true).slideUp();
            }

                if ( 'ontouchstart' in window ) {

                    //$(".enumenu_ul > li > a, .enumenu_ul.desk li > ul > li > a").click(function(e) {
                    menuobj.find("a").click(function(e) {
                            if (!$(this).hasClass("link") && !$("body").hasClass("mob") && $(this).next().length > 0) {
                                e.preventDefault();
                                if ($(this).hasClass("firstLevel")) {
                                    menuobj.find("a").removeClass("link");
                                    menuobj.find("a").parent().removeClass("hover");
                                }
                                $(this).addClass("link");
                                $(this).parent().addClass('hover');
                            }
                    });
                    $(".enumenu_ul").children("li").click(function(){                        
                        if (!$(".menu-icon").is(":visible")) {
                            //$(this).children("ul").css("padding-left", $(this).offset().left);
                        }
                    });
                    $('body').on('click touchstart', function(e) {
                        if ($(e.target).closest(".enumenu_container").length == 0) {
                            menuobj.find("a").each(function(){
                                $(this).removeClass("link");
                                $(this).parent().removeClass("hover");
                            });
                        }
                    });
                    /*$("body > div").on('click', function(e) {
                        if ($(e.target).closest(".enumenu_container").length == 0) {
                            menuobj.find("a").each(function(){
                                $(this).removeClass("link");
                                $(this).parent().removeClass("hover");
                            });
                            
                        }
                    });*/
                } else {
                    $(".enumenu_ul").children("li").mouseenter(function(){
                        if (!$(".menu-icon").is(":visible")) {
                            //$(this).children("ul").css("padding-left", $(this).offset().left);
                        }
                    });
                }
            
        });
    };
})(jQuery);