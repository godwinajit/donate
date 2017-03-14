// page init
jQuery(function(){
    initToggleContent();
    initCustomForms();
    initRetinaCover();
    initEnquire();
    initPopup('search-nav','.search-opener');
});

function initCustomForms() {
    jcf.setOptions('Select', {
        wrapNative: false
    });
    jcf.replaceAll();
}

function initHeaderCollapsed() {
    var extendedClass = '.header-extended',
        collapsedClass = 'header-collapsed',
        expandedClass = 'header-expanded',
        header = $('.header'),
        headerHeight = header.outerHeight();

    if ($(document).find(extendedClass).length > 0) {
        $(window).on('scroll.header', function(){
            if ($(document).scrollTop() > headerHeight) {
                header.addClass(collapsedClass).removeClass(expandedClass);
            } else{
                if ( header.hasClass(collapsedClass)) {
                    header.addClass(expandedClass).removeClass(collapsedClass);
                }
            }
        }).trigger('scroll');
    }
}

function initToggleContent() {
    jQuery('div.toggle-content').openClose({
        hideOnClickOutside: false,
        activeClass: 'expanded',
        opener: 'a.toggle-content-opener',
        slider: 'div.toggle-content-slide',
        animSpeed: 500,
        effect: 'slide'
    });
}

function initRetinaCover() {
    jQuery('.bg-stretch').retinaCover();
}

function scrollBarWidth() {
    var scrollDiv = document.createElement("div");
    $(scrollDiv).css({
        'width': '100',
        'height': '100',
        'overflow': 'scroll',
        'position': 'absolute',
        'top': '-9999'
    });
    document.body.appendChild(scrollDiv);

    var scrollWidth = scrollDiv.offsetWidth - scrollDiv.clientWidth;
    document.body.removeChild(scrollDiv);

    return scrollWidth;
}

function initAccordion() {
    jQuery('.accordion').slideAccordion({
        allowClickWhenExpanded: true,
        activeClass:'accordion-active',
        opener:'> a.accordion-opener',
        slider:'> div.accordion-slide',
        collapsible: true,
        animSpeed: 300
    });
}

function initPopup(popup, open, desktop){
    var close = '.popup-close',
        body = $('body'),
        header = $('.header'),
        scroll = scrollBarWidth(),
        holder = $('.popup-nav .accordion');

    if (popup == "popup-nav") {
        var source = $('.header .nav .nav-list'),
            content;

        $(open).on('click', function(e) {
            e.preventDefault();
            holder.empty();

            if (desktop){
                var parent = $(this).parents('li');
                content = $(parent).html();
            } else  content = $(source).html();

            holder.append(content);
            initAccordion();
            body.toggleClass('nav-open').css('padding-right', scroll + 'px');
            header.css('padding-right', scroll + 'px');
        });
    } else {
        $(open).on('click', function(e) {
            e.preventDefault();
            body.toggleClass('search-open').css('padding-right', scroll + 'px');
            header.css('padding-right', scroll + 'px');
        });
    }

    body.on('click', close, function(e){
        e.preventDefault();

        if (body.hasClass('search-open')){
            body.toggleClass('search-open').css('padding-right', '0px');
            header.css('padding-right', '0px');
        }

        if (body.hasClass('nav-open')){
            holder.empty();
            body.toggleClass('nav-open').css('padding-right', '0px');
            header.css('padding-right', '0px');
        }
    });
}
function initEnquire(){
    var mobileOpener = '.header .nav .nav-list .accordion-opener',
        desktopOpener = '.nav-opener';

    enquire.register("screen and (max-width: 1023px)", {
        match : function() {
            initPopup('popup-nav',desktopOpener, false);
            $(mobileOpener).unbind('click');
        }
    })
    .register("screen and (min-width: 1024px)", {
        match : function() {
            initPopup('popup-nav',mobileOpener, true);
            $(desktopOpener).unbind('click');
        }
    });

    if ($(document).find('.chart').length > 0) {
        var chart = $('.chart'),
            chartOffset = chart.offset().top,
            chartHeight = chart.height(),
            initChartPoint = chartOffset + chartHeight - $(window).height();

        function chartScrollHandlerMobile() {
            if ($(document).scrollTop() >= initChartPoint) {
                initPieChart(129, 9);
                $(window).off('scroll.chart');
            }
        }

        function chartScrollHandlerDesktop() {
            if ($(document).scrollTop() >= initChartPoint) {
                initPieChart(166, 10);
                $(window).off('scroll.chart');
            }
        }

        enquire.register("screen and (max-width: 767px)", {
            match: function () {
                $(window).on('scroll.chart', chartScrollHandlerMobile).trigger('scroll');
            }
        })
        .register("screen and (min-width: 768px)", {
            match: function () {
                $(window).on('scroll.chart', chartScrollHandlerDesktop).trigger('scroll');
            }
        })
        .register("screen and (min-width: 1024px)", {
            match: function () {
                initHeaderCollapsed();
            },
            unmatch: function() {
                $(window).off('scroll.header');
            }
        })
    }
}

function initPieChart(chartSize, chartLineWidth) {
    var pieCharts = $('.chart .chart-box').map(function(index, box){
        return $(box).data('pieChart')
    });

    if(pieCharts.length && pieCharts[0]) {

        pieCharts.each(function(index, pie){
            pie.redraw({size: chartSize, lineWidth: chartLineWidth});
        });

        return;
    }

    $('.chart .chart-box').pieChart({
        colorStart: '#429321',
        colorFinish: '#b4ec51',
        trackColor: '#e9e9e9',
        lineCap: 'round',
        size: chartSize,
        lineWidth: chartLineWidth,
        onStep: function (from, to, percent) {
            $(this.element).find('.chart-value').text(Math.round(percent) + '%');
        }
    });

    $('.chart').addClass('chart-activated');
}