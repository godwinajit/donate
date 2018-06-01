function initCustomForms() {
    jcf.setOptions("Select", {
        wrapNative: !1
    }), jcf.replaceAll('form.donate-form, form#tribe-bar-form .tribe-bar-filters, .resources-cat-container, .support-groups-cat-container, .published-research-select-page')
}

function initHeaderCollapsed() {
    var e = ".header-extended",
        t = "header-collapsed",
        s = "header-expanded",
        i = $(".header"),
        n = i.outerHeight();
    $(document).find(e).length > 0 && $(window).on("scroll.header", function() {
        $(document).scrollTop() > n ? i.addClass(t).removeClass(s) : i.hasClass(t) && i.addClass(s).removeClass(t)
    }).trigger("scroll")
}

function initToggleContent() {
    jQuery("div.toggle-content").openClose({
        hideOnClickOutside: !1,
        activeClass: "expanded",
        opener: "a.toggle-content-opener",
        slider: "div.toggle-content-slide",
        animSpeed: 500,
        effect: "slide"
    })
}

function initRetinaCover() {
    jQuery(".bg-stretch").retinaCover()
}

function scrollBarWidth() {
    var e = document.createElement("div");
    $(e).css({
        width: "100",
        height: "100",
        overflow: "scroll",
        position: "absolute",
        top: "-9999"
    }), document.body.appendChild(e);
    var t = e.offsetWidth - e.clientWidth;
    return document.body.removeChild(e), t
}

function initAccordion() {
    jQuery(".accordion").slideAccordion({
        allowClickWhenExpanded: !0,
        activeClass: "accordion-active",
        opener: "> a.accordion-opener",
        slider: "> div.accordion-slide",
        collapsible: !0,
        animSpeed: 300
    })
}

function initPopup(e, t, s) {
    var i = ".popup-close",
        n = $("body"),
        o = $(".header"),
        a = scrollBarWidth();
    "popup-nav" != e && $(t).on("click", function(e) {
        e.preventDefault(), n.toggleClass("search-open").css("padding-right", a + "px"), o.css("padding-right", a + "px")
    }), n.on("click", i, function(e) {
        e.preventDefault(), n.hasClass("search-open") && (n.toggleClass("search-open").css("padding-right", "0px"), o.css("padding-right", "0px")), n.hasClass("nav-open") && n.toggleClass("nav-open")
    })
}

function initEnquire() {
    function e(e) {
        e.preventDefault();
        var t = jQuery(this);
        t.parent().hasClass(o) ? t.parent().removeClass(o) : (d.removeClass(o), t.parent().addClass(o))
    }

    function t(e) {
        e.preventDefault(), r.toggleClass("nav-open")
    }

    function s(e) {
        var t = jQuery((e.changedTouches ? e.changedTouches[0] : e).target);
        t.closest(".accordion-slide").length || t.closest(".accordion-opener").length || d.removeClass(o)
    }

    function i() {
        $(document).scrollTop() >= m && (initPieChart(129, 9), $(window).off("scroll.chart"))
    }

    function n() {
        $(document).scrollTop() >= m && (initPieChart(166, 10), $(window).off("scroll.chart"))
    }
    var o = "drop-active",
        a = jQuery(document),
        r = jQuery("body"),
        l = jQuery(".popup-nav .accordion"),
        h = jQuery(".header .nav-list"),
        c = jQuery(".nav-opener"),
        d = h.find(">li");
    if (l.html(h.html()), d.each(function() {
            var e = jQuery(this),
                t = e.find("> .accordion-opener"),
                s = e.find("> .accordion-slide"),
                i = $("<strong>"),
                n = $("<a>");
            n.attr("href", t.attr("href")), n.text(t.text()), i.addClass("title").append(n), s.prepend(i)
        }), initAccordion(), enquire.register("screen and (max-width: 1023px)", {
            match: function() {
                c.on("click", t), h.off("click", ">li>a", e), a.off("click touchstart", s)
            }
        }).register("screen and (min-width: 1024px)", {
            match: function() {
                h.on("click", ">li>a", e), a.on("click touchstart", s), c.off("click", t), r.removeClass("nav-open")
            }
        }), $(document).find(".chart").length > 0) {
        var u = $(".chart"),
            p = u.offset().top,
            f = u.height(),
            m = p + f - $(window).height();
        enquire.register("screen and (max-width: 767px)", {
            match: function() {
                $(window).on("scroll.chart", i).trigger("scroll")
            }
        }).register("screen and (min-width: 768px)", {
            match: function() {
                $(window).on("scroll.chart", n).trigger("scroll")
            }
        }).register("screen and (min-width: 1024px)", {
            match: function() {
                initHeaderCollapsed()
            },
            unmatch: function() {
                $(window).off("scroll.header")
            }
        })
    }
}

function initPieChart(e, t) {
    var s = $(".chart .chart-box").map(function(e, t) {
        return $(t).data("pieChart")
    });
    return s.length && s[0] ? void s.each(function(s, i) {
        i.redraw({
            size: e,
            lineWidth: t
        })
    }) : ($(".chart .chart-box").pieChart({
        colorStart: "#429321",
        colorFinish: "#b4ec51",
        trackColor: "#e9e9e9",
        lineCap: "round",
        size: e,
        lineWidth: t,
        onStep: function(e, t, s) {
            $(this.element).find(".chart-value").text(Math.round(s) + "%")
        }
    }), void $(".chart").addClass("chart-activated"))
}

// fancybox modal popup init
function initLightbox() {
    jQuery('a.open-lightbox, a[rel*="open-lightbox"]').fancybox({
        helpers: {
            overlay: {
                css: {
                    background: 'rgba(0, 0, 0, 0.80)'
                }
            }
        },
        afterLoad: function(current, previous) {
            // handle custom close button in inline modal
            if(current.href.indexOf('#') === 0) {
                jQuery(current.href).find('a.close').off('click.fb').on('click.fb', function(e){
                    e.preventDefault();
                    jQuery.fancybox.close();
                });
            }
        },
        padding: 0
    });
}

// align blocks height
function initSameHeight() {
    jQuery('.resources-cat-list-container').sameHeight({
        elements: '.resources-cat-content',
        flexible: true,
        multiLine: true
    });
}

jQuery(function() {
    initSameHeight(), initToggleContent(), initCustomForms(), initRetinaCover(), initEnquire(), initLightbox(), initPopup("search-nav", ".search-opener")
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