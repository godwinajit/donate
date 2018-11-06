var $ = jQuery.noConflict(),
    $window = $(window);
! function(a) {
    function b() {
        a(".expandable_hidden").hide(), a(".more").click(function(b) {
            b.preventDefault();
            var c = a("." + a(this).attr("id"));
            a(this).hasClass("expanded") ? (a(c).slideUp("slow"), a(this).text("More"), a(this).attr("title", "Read More"), a(this).removeClass("expanded")) : (a(".expandable_hidden").slideUp("slow"), a(".more").text("More"), a(".more").attr("title", "Read More"), a(".more").removeClass("expanded"), a(c).slideDown("slow"), a(this).addClass("expanded"), a(this).text("Less"), a(this).attr("title", "Less"))
        })
    }

    function c() {
        a(".rprogress-wrap").length && a(".rprogress-wrap").each(function(b, c) {
            var d = a(c).data("progress-percent") / 100,
                e = a(c).width(),
                f = d * e,
                g = a(c).data("speed");
            a(c).find(".rprogress-bar").stop().animate({
                left: f
            }, g)
        })
    }

    function d() {
        a(".wppb-progress").length && a(".wppb-progress.fixed > span").each(function() {
            a(this).stop().animate({
                width: a(this).data("width")
            }, 800)
        })
    }
    a(document).ready(function() {
        if (a("ul").each(function() {
                a(this).find("li").first().addClass("first"), a(this).find("li").last().addClass("last")
            }), a(".enumenu_ul").responsiveMenu({
                menuslide_overlap: !0,
                menuslide_direction: "left"
            }), a("#loginform").length && a("#loginform p").each(function() {
                var b = a(this).find("label").text();
                a(this).find("input").attr("placeholder", b)
            }), a("input").length > 0 && a("input").placeholder(), a("textarea").length > 0 && a("textarea").placeholder(), a(".gfield_select").length && a(".gfield_select").selectbox({
                hide_duplicate_option: !0
            }), a('li[class*="sb"] > a').addClass("accordion-opener"), a("body.home").length > 0 || a(window).scroll(function() {
                var b = a(window).scrollTop();
                b > 100 ? a("#site-header").addClass("header-collapsed") : a("#site-header").removeClass("header-collapsed")
            }), a(window).width() < 767 && a(".accordion-active").removeClass("accordion-active"), a(document).bind("gform_post_render", function() {
                if (a(".gfield_select").selectbox({
                        hide_duplicate_option: !0
                    }), a(".bottom-event-address").length) {
                    var b = a(".bottom-event-address").html();
                    a(".content-form .gform_footer").length && a(".content-form .gform_footer").prepend('<div class="bottom-event-address bottom-event-address-clone">' + b + '<p class="required-text">*Required fields.</p></div>')
                }
                var c = a(".content-form").offset().top,
                    d = 219,
                    e = c - d;
                a("body,html").stop().animate({
                    scrollTop: e
                }, 1e3)
            }), a(".bottom-event-address").length) {
            var e = a(".bottom-event-address").html();
            a(".content-form .gform_footer").length && a(".content-form .gform_footer").prepend('<div class="bottom-event-address bottom-event-address-clone">' + e + '<p class="required-text">*Required fields.</p></div>')
        }
        if (a(".notification-email-address").length) {
            var f = a("#notification_email_address").val();
            a(".notification-email-address input").val(f)
        }
        a(".owl-topbanner .item").each(function() {
            a(this).find("img").addClass("bannerimage");
            var b = a(this).find(".bannerimage").attr("src");
            b = "url(" + b + ")", a(this).css("background-image", b)
        });
        var g = a(".owl-topbanner");
        g.owlCarousel({
            items: 1,
            margin: 0,
            autoplay: !0,
            autoplayHoverPause: !1,
            autoplayTimeout: 7e3,
            mouseDrag: !1,
            loop: a(".owl-topbanner .item").length > 1,
            dots: a(".owl-topbanner .item").length > 1,
            nav: !1
        });
        var h = a(".owl-ico-slider");
        h.owlCarousel({
                items: 3,
                margin: 0,
                autoplay: !1,
                autoplayHoverPause: !1,
                autoplayTimeout: 7e3,
                loop: a(".owl-ico-slider .item").length > 3,
                dots: !1,
                nav: a(".owl-ico-slider .item").length > 3,
                navText: ["", ""]
            }), a(".content-section-height").length && a(".content-section-height").equalHeight(), a(".sub-committee-members .hidden-description").length && a(".sub-committee-members .hidden-description").equalHeight(), a(".financial-committee-members .hidden-description").length && a(".financial-committee-members .hidden-description").equalHeight(),
            function() {
                function c() {
                    var c = 0;
                    b.css("height", ""), b.each(function() {
                        var b = a(this).outerHeight();
                        c < b && (c = b)
                    }), b.css("height", c)
                }
                var b = a(".three-block-bottom .committee-members-name");
                b.length && (a(window).on("resize", c), c())
            }(), a(".three-block-bottom .hidden-description-inner").length && a(".three-block-bottom .hidden-description-inner").equalHeight(), a(".equal_height ").length && a(".equal_height ").equalHeight(), a(".disease-rate").length && a(".disease-rate").css("width", "100%").css("width", "-=155px"), b(), a(function() {
                function b() {
                    return "undefined" != typeof window.ontouchstart
                }
                0 == b() ? a(".advisory-board .committee-members-data").mouseenter(function() {
                    a(".advisory-board .committee-members-data").removeClass("hover"), a(this).addClass("hover"), a(".advisory-board .committee-members-data .hidden-description").slideUp(), a(this).find(".hidden-description").slideDown()
                }).mouseleave(function() {
                    a(".advisory-board .committee-members-data").removeClass("hover"), a(this).removeClass("hover"), a(".advisory-board .committee-members-data .hidden-description").slideUp()
                }) : (a(".advisory-board .committee-members-data").on("click", function(b) {
                    b.preventDefault(), a(".advisory-board .committee-members-data").removeClass("hover"), a(this).addClass("hover"), a(".advisory-board .committee-members-data .hidden-description").slideUp(), a(this).find(".hidden-description").slideDown()
                }), a("#page").on("click", function(b) {
                    0 == a(b.target).closest(".committee-members-data").length && (a(".advisory-board .committee-members-data").removeClass("hover"), a(".advisory-board .committee-members-data .hidden-description").hide())
                }))
            }), a(window).on("scroll", function() {
                a(".research-funding").length && a(window).scrollTop() > a(".research-funding").offset().top - a(window).height() + a("#masthead").height() && c(), a(".diagnosis-dilemma").length && a(window).scrollTop() > a(".diagnosis-dilemma").offset().top - a(window).height() + a("#masthead").height() && d()
            }), a(".donate-content-pages .box .expandable_hidden").each(function() {
                a(this).closest(".box").find(".expandable_hidden").prev("p").css("display", "inline"), a(this).closest(".box").addClass("pad-bottom")
            }), a(".other-way-give ul li a").click(function(b) {
                if (b.preventDefault(), location.pathname.replace(/^\//, "") == this.pathname.replace(/^\//, "") && location.hostname == this.hostname) {
                    var d, c = a(this.hash),
                        e = a(".site-header").outerHeight() + 30;
                    if (c = c.length ? c : a("[name=" + this.hash.slice(1) + "]"), d = c.offset().top, c.length) return a("html,body").animate({
                        scrollTop: d - e
                    }, 800), !1
                }
            }), a(".search-field").keyup(function(b) {
                a(".dhemy-ajax-search").empty();
                a(this).attr("autocomplete", "off");
                var c = a(this).val();
                var currentRequest = null;
                if( c.length > 2 ) {
                    currentRequest = jQuery.ajax({
                        url: BASE + "/wp-admin/admin-ajax.php",
                        type: "POST",
                        data: {
                            action: "dhemy_ajax_search",
                            term: c
                        },
                        beforeSend : function()    {
                            if(currentRequest != null) {
                                currentRequest.abort();
                            }
                        },
                        success: function (b) {
                            a(".dhemy-ajax-search").fadeIn().html(b)
                        }
                    })
                }
            })
    }), a(window).load(function() {
        a("#site-loader").delay(100).fadeOut("slow"), a(".research-funding").length && a(window).scrollTop() > a(".research-funding").offset().top - a(window).height() + a("#masthead").height() && c(), a(".wppb-progress.fixed > span").width(0), a(".diagnosis-dilemma").length && a(window).scrollTop() > a(".diagnosis-dilemma").offset().top - a(window).height() + a("#masthead").height() && d(), a(".sub-committee-members .committee-members-name").length && a(".sub-committee-members .committee-members-name").equalHeight(), a(".financial-committee-members .committee-members-name").length && a(".financial-committee-members .committee-members-name").equalHeight()
    }), a(window).resize(function() {
        a(".research-funding").length && a(window).scrollTop() > a(".research-funding").offset().top - a(window).height() + a("#masthead").height() && c(), a(".diagnosis-dilemma").length && a(window).scrollTop() > a(".diagnosis-dilemma").offset().top - a(window).height() + a("#masthead").height() && d(), a(".disease-rate").length && a(".disease-rate").css("width", "100%").css("width", "-=155px")
    })
}(jQuery),


function(a) {
    function f() {
        var a, e, f = "";
        window.innerWidth > 768 && (a = d.height() + 40, e = c.length ? c.children(".inner")[0].scrollHeight + c.outerHeight() - c.height() : 0, f = a > e ? a : e), b.css({
            height: f
        })
    }

    function g() {
        var a = "";
        window.innerWidth > 768 && (a = Math.max(d.height() - 60, c.children(".inner")[0].scrollHeight + 60)), c.css("height", a)
    }
    var b = a(".videoimage-pullout-section"),
        c = b.find(".right-content"),
        d = b.find(".left-content");
    b.is(".type-image") ? (g(), a(window).on("resize orientationchange load", g)) : b.is(".type-video") && (f(), a(window).on("resize orientationchange load", f))
}(jQuery), 

$(function() {
    $(".resources-list .resources-item-title").click(function() {
        $(this).closest(".resources-item").find(".resources-item-text").slideToggle()
    })
});

$(function() {
     var pgurl = window.location.href.substr(1);
     var loc = window.location.href; 
      
     $("#ActiveYearMenu ul ul li a").each(function(){
          if($(this).attr("href") == pgurl || $(this).attr("href") == '' )
          $(this).parent().parent().addClass("current_page_item");
     })

      $("#menu-blog-menu li a").each(function(){
          if($(this).attr("href") == pgurl || $(this).attr("href") == '' )
          $(this).parent().addClass("active");
     })

     function setActive() {
      aObj = document.getElementById('ActiveYearMenu').getElementsByTagName('a');
      for(i=0;i<aObj.length;i++) { 
        if(document.location.href.indexOf(aObj[i].href)>=0) {
          aObj[i].className='current_page_item';
        }
      }
    }

    function setTopActive() {
      aObj = document.getElementById('menu-blog-menu').getElementsByTagName('a');
      for(i=0;i<aObj.length;i++) { 
        if(document.location.href.indexOf(aObj[i].href)>=0) {
          aObj[i].className='active';
        }
      }
    }
    // If blog is year url
    if ((/2017/.test(loc)) || (/2016/.test(loc)) || (/2015/.test(loc)) || (/2014/.test(loc)) || (/2013/.test(loc))) {
            $('#menu-blog-menu li a:contains("Blog")').parent().addClass('active');
            $('#menu-top-menu li a:contains("Our Impact")').parent().addClass('active');
        }
    // If News is active remove active link from newletter 
    if ($('li.active.menu-news.active')) {
        $('li.menu-newsletters.active.last').removeClass('active');
    }
    // if newsletter is active remove blog active
    if (window.location.href.indexOf("newsletters") > -1) {
        $('li.menu-newsletters.last').addClass('active');
        $('li.menu-blog.first.active').removeClass('active');
    }
        // if videos is active remove blog active
    if (window.location.href.indexOf("videos") > -1) {
        $('li.menu-blog.first.active').removeClass('active');
    }
        // if news is active remove blog active
    if (window.location.href.indexOf("news") > -1) {
        $('li.menu-blog.first.active').removeClass('active');
    }
        // if press-releases is active remove blog active
      if (window.location.href.indexOf("press-releases") > -1) {
        $('li.menu-blog.first.active').removeClass('active');
    }
  
    $('li.active.drp.menu-get-help.active').removeClass('active').removeClass('active');
    
       ///equalize divs
    function fixHeight(elem){
            var minHeight = 20;
            $(elem).css('min-height','400px');
            $(elem).each(function(){
               if ($(this).height() > minHeight) { minHeight = $(this).height(); }
            });
            $(elem).css('min-height', (minHeight + 20));
        }

        /*$(window).resize(function () {
            fixHeight('.blog-list-container article');
        });
        $(document).ready(function(e) {
            fixHeight('.blog-list-container article');
     });*/

    if ($('body').hasClass('archive')) {
    window.onload = setActive, setTopActive, fixHeight;
    }

 
});

// page init
jQuery(function(){
    jQuery('.page').sameHeight({
        elements: '.blog-list-container.masonary article',
        flexible: true,
        multiLine: true
    });
});

/*
 * jQuery SameHeight plugin
 */
;(function($){
    $.fn.sameHeight = function(opt) {
        var options = $.extend({
            skipClass: 'same-height-ignore',
            leftEdgeClass: 'same-height-left',
            rightEdgeClass: 'same-height-right',
            elements: '>*',
            flexible: false,
            multiLine: false,
            useMinHeight: false,
            biggestHeight: false
        },opt);
        return this.each(function(){
            var holder = $(this), postResizeTimer, ignoreResize;
            var elements = holder.find(options.elements).not('.' + options.skipClass);
            if(!elements.length) return;

            // resize handler
            function doResize() {
                elements.css(options.useMinHeight && supportMinHeight ? 'minHeight' : 'height', '');
                if(options.multiLine) {
                    // resize elements row by row
                    resizeElementsByRows(elements, options);
                } else {
                    // resize elements by holder
                    resizeElements(elements, holder, options);
                }
            }
            doResize();

            // handle flexible layout / font resize
            var delayedResizeHandler = function() {
                if(!ignoreResize) {
                    ignoreResize = true;
                    doResize();
                    clearTimeout(postResizeTimer);
                    postResizeTimer = setTimeout(function() {
                        doResize();
                        setTimeout(function(){
                            ignoreResize = false;
                        }, 10);
                    }, 100);
                }
            };

            // handle flexible/responsive layout
            if(options.flexible) {
                $(window).bind('resize orientationchange fontresize', delayedResizeHandler);
            }

            // handle complete page load including images and fonts
            $(window).bind('load', delayedResizeHandler);
        });
    };

    // detect css min-height support
    var supportMinHeight = typeof document.documentElement.style.maxHeight !== 'undefined';

    // get elements by rows
    function resizeElementsByRows(boxes, options) {
        var currentRow = $(), maxHeight, maxCalcHeight = 0, firstOffset = boxes.eq(0).offset().top;
        boxes.each(function(ind){
            var curItem = $(this);
            if(curItem.offset().top === firstOffset) {
                currentRow = currentRow.add(this);
            } else {
                maxHeight = getMaxHeight(currentRow);
                maxCalcHeight = Math.max(maxCalcHeight, resizeElements(currentRow, maxHeight, options));
                currentRow = curItem;
                firstOffset = curItem.offset().top;
            }
        });
        if(currentRow.length) {
            maxHeight = getMaxHeight(currentRow);
            maxCalcHeight = Math.max(maxCalcHeight, resizeElements(currentRow, maxHeight, options));
        }
        if(options.biggestHeight) {
            boxes.css(options.useMinHeight && supportMinHeight ? 'minHeight' : 'height', maxCalcHeight);
        }
    }

    // calculate max element height
    function getMaxHeight(boxes) {
        var maxHeight = 0;
        boxes.each(function(){
            maxHeight = Math.max(maxHeight, $(this).outerHeight());
        });
        return maxHeight;
    }

    // resize helper function
    function resizeElements(boxes, parent, options) {
        var calcHeight;
        var parentHeight = typeof parent === 'number' ? parent : parent.height();
        boxes.removeClass(options.leftEdgeClass).removeClass(options.rightEdgeClass).each(function(i){
            var element = $(this);
            var depthDiffHeight = 0;
            var isBorderBox = element.css('boxSizing') === 'border-box' || element.css('-moz-box-sizing') === 'border-box' || element.css('-webkit-box-sizing') === 'border-box';

            if(typeof parent !== 'number') {
                element.parents().each(function(){
                    var tmpParent = $(this);
                    if(parent.is(this)) {
                        return false;
                    } else {
                        depthDiffHeight += tmpParent.outerHeight() - tmpParent.height();
                    }
                });
            }
            calcHeight = parentHeight - depthDiffHeight;
            calcHeight -= isBorderBox ? 0 : element.outerHeight() - element.height();

            if(calcHeight > 0) {
                element.css(options.useMinHeight && supportMinHeight ? 'minHeight' : 'height', calcHeight);
            }
        });
        boxes.filter(':first').addClass(options.leftEdgeClass);
        boxes.filter(':last').addClass(options.rightEdgeClass);
        return calcHeight;
    }
}(jQuery));

/*
 * jQuery FontResize Event
 */
jQuery.onFontResize = (function($) {
    $(function() {
        var randomID = 'font-resize-frame-' + Math.floor(Math.random() * 1000);
        var resizeFrame = $('<iframe>').attr('id', randomID).addClass('font-resize-helper');

        // required styles
        resizeFrame.css({
            width: '100em',
            height: '10px',
            position: 'absolute',
            borderWidth: 0,
            top: '-9999px',
            left: '-9999px'
        }).appendTo('body');

        // use native IE resize event if possible
        if (window.attachEvent && !window.addEventListener) {
            resizeFrame.bind('resize', function () {
                $.onFontResize.trigger(resizeFrame[0].offsetWidth / 100);
            });
        }
        // use script inside the iframe to detect resize for other browsers
        else {
            var doc = resizeFrame[0].contentWindow.document;
            doc.open();
            doc.write('<scri' + 'pt>window.onload = function(){var em = parent.jQuery("#' + randomID + '")[0];window.onresize = function(){if(parent.jQuery.onFontResize){parent.jQuery.onFontResize.trigger(em.offsetWidth / 100);}}};</scri' + 'pt>');
            doc.close();
        }
        jQuery.onFontResize.initialSize = resizeFrame[0].offsetWidth / 100;
    });
    return {
        // public method, so it can be called from within the iframe
        trigger: function (em) {
            $(window).trigger("fontresize", [em]);
        }
    };
}(jQuery));