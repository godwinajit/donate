(function($) {

	"use strict";

	var options = {
		events_source: (eventsCalendarSettings.json || 'events.json.php'),
		view: 'month',
		tmpl_path: (eventsCalendarSettings.base || '') + 'tmpls/',
		tmpl_cache: false,
		first_day: 1,
		onAfterEventsLoad: function(events) {
			if(!events) {
				return;
			}
			var list = $('#eventlist');
			list.html('');

			$.each(events, function(key, val) {
				$(document.createElement('li'))
					.html('<a href="' + val.url + '">' + val.title + '</a>')
					.appendTo(list);
			});
		},
		onAfterViewLoad: function(view) {
			$('.calendar-heading h3').text(this.getTitle());
			$('.calendar-heading button').removeClass('active');
			$('button[data-calendar-view="' + view + '"]').addClass('active');
			
			var lammCurrentDate = new Date();
			var lammMinDate = new Date( lammCurrentDate.getFullYear(), lammCurrentDate.getMonth(), 1, 0, 0, 0, 0);
			if (this.getStartDate() <= lammMinDate){
				$('.calendar-heading .btn-prev').css('display','none');
			} else {
				$('.calendar-heading .btn-prev').css('display','block');
			}

			setTimeout(function(){
				jQuery('#calendar .event-item').contentPopup({
					mode: 'hover',
					popup: '.event-popup',
					btnOpen: '.event-opener',
					onShow: function(self){
						setTimeout(function(){
							var cellAttr = self.holder.closest('.cal-cell').attr('data-cal-row');
							if(cellAttr == '-day7' || cellAttr == '-day6' || cellAttr == '-day5'){
								self.holder.closest('.cal-cell').addClass('active-day-right');
							}
							else{
								self.holder.closest('.cal-cell').addClass('active-day');
							}
						})
					},
					onHide: function(){
						this.holder.closest('.cal-cell').removeClass('active-day');
						this.holder.closest('.cal-cell').removeClass('active-day-right');
					}
				});
			}, 400)
		},
		classes: {
			months: {
				general: 'label'
			}
		}
	};

	var calendar = $('#calendar').calendar(options);

	$('.calendar-heading button[data-calendar-nav]').each(function() {
		var $this = $(this);
		$this.click(function() {
			calendar.navigate($this.data('calendar-nav'));
		});
	});

	$('.calendar-heading button[data-calendar-view]').each(function() {
		var $this = $(this);
		$this.click(function() {
			calendar.view($this.data('calendar-view'));
		});
	});
	
	
	function setMonthCalendar(mdate){
		var options = {	day: mdate };
		calendar(options);
	}
	setMonthCalendar('2015-10-03');

}(jQuery));


/*
 * Popups plugin
 */
;(function($) {
	function ContentPopup(opt) {
		this.options = $.extend({
			holder: null,
			popup: '.popup',
			btnOpen: '.open',
			btnClose: '.close',
			openClass: 'popup-active',
			clickEvent: 'click',
			mode: 'click',
			hideOnClickLink: true,
			hideOnClickOutside: true,
			delay: 50
		}, opt);
		if(this.options.holder) {
			this.holder = $(this.options.holder);
			this.init();
		}
	}
	ContentPopup.prototype = {
		init: function() {
			this.findElements();
			this.attachEvents();
		},
		findElements: function() {
			this.popup = this.holder.find(this.options.popup);
			this.btnOpen = this.holder.find(this.options.btnOpen);
			this.btnClose = this.holder.find(this.options.btnClose);
		},
		attachEvents: function() {
			// handle popup openers
			var self = this;
			this.clickMode = isTouchDevice || (self.options.mode === self.options.clickEvent);

			if(this.clickMode) {
				// handle click mode
				this.btnOpen.bind(self.options.clickEvent, function(e) {
					if(self.holder.hasClass(self.options.openClass)) {
						if(self.options.hideOnClickLink) {
							self.hidePopup();
						}
					} else {
						self.showPopup();
					}
					e.preventDefault();
				});

				// prepare outside click handler
				this.outsideClickHandler = this.bind(this.outsideClickHandler, this);
			} else {
				// handle hover mode
				var timer, delayedFunc = function(func) {
					clearTimeout(timer);
					timer = setTimeout(function() {
						func.call(self);
					}, self.options.delay);
				};
				this.btnOpen.bind('mouseover', function() {
					delayedFunc(self.showPopup);
				}).bind('mouseout', function() {
					delayedFunc(self.hidePopup);
				});
				this.popup.bind('mouseover', function() {
					delayedFunc(self.showPopup);
				}).bind('mouseout', function() {
					delayedFunc(self.hidePopup);
				});
			}

			// handle close buttons
			this.btnClose.bind(self.options.clickEvent, function(e) {
				self.hidePopup();
				e.preventDefault();
			});
		},
		outsideClickHandler: function(e) {
			// hide popup if clicked outside
			var targetNode = $((e.changedTouches ? e.changedTouches[0] : e).target);
			if(!targetNode.closest(this.popup).length && !targetNode.closest(this.btnOpen).length) {
				this.hidePopup();
			}
		},
		showPopup: function() {
			// reveal popup
			this.holder.addClass(this.options.openClass);
			this.popup.css({display:'block'});

			// outside click handler
			if(this.clickMode && this.options.hideOnClickOutside && !this.outsideHandlerActive) {
				this.outsideHandlerActive = true;
				$(document).bind('click touchstart', this.outsideClickHandler);
			}
			this.makeCallback('onShow', this);
		},
		hidePopup: function() {
			// hide popup
			this.holder.removeClass(this.options.openClass);
			this.popup.css({display:'none'});

			// outside click handler
			if(this.clickMode && this.options.hideOnClickOutside && this.outsideHandlerActive) {
				this.outsideHandlerActive = false;
				$(document).unbind('click touchstart', this.outsideClickHandler);
			}
			this.makeCallback('onHide', this);
		},
		bind: function(f, scope, forceArgs){
			return function() {return f.apply(scope, forceArgs ? [forceArgs] : arguments);};
		},
		makeCallback: function(name) {
			if(typeof this.options[name] === 'function') {
				var args = Array.prototype.slice.call(arguments);
				args.shift();
				this.options[name].apply(this, args);
			}
		}
	};

	// detect touch devices
	var isTouchDevice = /Windows Phone/.test(navigator.userAgent) || ('ontouchstart' in window) || window.DocumentTouch && document instanceof DocumentTouch;

	// jQuery plugin interface
	$.fn.contentPopup = function(opt) {
		return this.each(function() {
			new ContentPopup($.extend(opt, {holder: this}));
		});
	};
}(jQuery));