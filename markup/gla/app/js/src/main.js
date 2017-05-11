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
        scroll = scrollBarWidth();

    if (popup != "popup-nav") {
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
            body.toggleClass('nav-open');
        }
    });
}
function initEnquire(){
	var activeClass = 'drop-active';
    var doc = jQuery(document);
	var body = jQuery('body');
	var popup = jQuery('.popup-nav .accordion');
	var nav = jQuery('.nav-list');
	var mobileOpener = jQuery('.nav-opener');
	var items = nav.find('>li');

	popup.html(nav.html());

	items.each(function(){
		var item = jQuery(this);
		var link = item.find('> .accordion-opener');
		var drop = item.find('> .accordion-slide');
		var dlinkHolder = $('<strong>');
		var dlink = $('<a>');

		dlink.attr('href', link.attr('href'));
		dlink.text(link.text());

		dlinkHolder
			.addClass('title')
			.append(dlink)

		drop.prepend(dlinkHolder);
	});
	
	initAccordion();

	function desktopClickHandler(e){
        e.preventDefault();

		var item = jQuery(this);
		if (item.parent().hasClass(activeClass)) {
			item.parent().removeClass(activeClass);
		} else {
			items.removeClass(activeClass);
			item.parent().addClass(activeClass);
		}
	}
	function mobileClickHandler(e){
		e.preventDefault();
		body.toggleClass('nav-open');
	}

    function outsideClickHandler(e){
        var targetNode = jQuery((e.changedTouches ? e.changedTouches[0] : e).target);
        if(!targetNode.closest('.accordion-slide').length && !targetNode.closest('.accordion-opener').length) {
            items.removeClass(activeClass);
        }
    }

    enquire.register("screen and (max-width: 1023px)", {
        match : function() {
            mobileOpener.on('click', mobileClickHandler);
            nav.off('click', '>li>a', desktopClickHandler);
            doc.off('click touchstart', outsideClickHandler);
        }
    })
    .register("screen and (min-width: 1024px)", {
        match : function() {
            nav.on('click', '>li>a', desktopClickHandler);
            doc.on('click touchstart', outsideClickHandler);
            mobileOpener.off('click', mobileClickHandler);
            body.removeClass('nav-open');
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