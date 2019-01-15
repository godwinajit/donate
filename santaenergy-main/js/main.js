jQuery(function() {
  initMobileNav();
  initSlideShow();
  initFocusClass();
  initAccordion();
  initSlickGallery();
  initTyping();
  initScrolling();
});

// initialize slick gallery
function initSlickGallery() {
  jQuery('body .mobile-slider').slick({
    slidesToShow: 3,
    responsive: [
      {
        breakpoint: 9999,
        settings: "unslick"
      },
      {
        breakpoint: 767,
        settings: {
          dots: true,
          arrows :false,
          slidesToShow: 1
        }
      }
    ]
  });
}

// initialize adding class on scroll
function initScrolling() {
  var header = jQuery('body');
  var scrolledClass = 'scrolling';
  var flag = false;

  if (!header.length) return;

  function addingClass() {
    var top = jQuery(window).scrollTop();

    if (top > 0) {
      if (!flag) {
        header.addClass(scrolledClass);
        flag = true;
      }
    } else if (flag) {
      header.removeClass(scrolledClass);
      flag = false;
    }
  }

  addingClass();
  jQuery(window).scroll(addingClass);
}

// add class when element is in focus
function initFocusClass() {
  jQuery('.input-holder').addFocusClass({
    focusClass: 'input-focused',
    element: 'input[type="text"], input[type="email"], input[type="tel"]',
    stayFocusOnFilled: true
  });
}

// accordion menu init
function initAccordion() {
  ResponsiveHelper.addRange({
    '..991': {
      on: function() {
        jQuery('.main-dropdown .navbar-nav').slideAccordion({
          opener: '.nav-link',
          slider: '.nav-dropdown',
          animSpeed: 300
        });
      },
      off: function() {
        jQuery('.full-menu').slideAccordion('destroy');
      }
    }
  });
  ResponsiveHelper.addRange({
    '991..': {
      on: function() {
        jQuery('.full-menu .navbar-nav').slideAccordion({
          opener: '.nav-link',
          slider: '.nav-dropdown',
          animSpeed: 300
        });
      },
      off: function() {
        jQuery('.full-menu').slideAccordion('destroy');
      }
    }
  });
  jQuery('.faq-list').slideAccordion({
    opener: '.faq-item-opener',
    slider: '.faq-item-content',
    animSpeed: 300,
    addClassBeforeAnimation: true,
    scrollToActiveItem: {
      enable: true,
      extraOffset: 0
    }
  });
}


// mobile menu init
function initMobileNav() {
  jQuery('body').mobileNav({
    menuActiveClass: 'main-active',
    menuOpener: '.main-opener',
    hideOnClickOutside: true,
    menuDrop: '.main-dropdown, .full-menu'
  });
}


// fade gallery init
function initSlideShow() {
  jQuery('.testimonial_slider').fadeGallery({
    slides: '.slider-item',
    btnPrev: '.btn-prev',
    btnNext: '.btn-next',
    disableWhileAnimating: true,
    generatePagination: '.pagination-holder',
    circularRotation: true,
    // autoHeight: false
  });
}


/*
 * jQuery SlideShow plugin
 */
;(function($) {

  'use strict';
  // detect device type
  var isTouchDevice = /Windows Phone/.test(navigator.userAgent) || ('ontouchstart' in window) || window.DocumentTouch && document instanceof DocumentTouch;

  function FadeGallery(options) {
    this.options = $.extend({
      slides: 'ul.slideset > li',
      activeClass: 'active',
      disabledClass: 'disabled',
      btnPrev: 'a.btn-prev',
      btnNext: 'a.btn-next',
      generatePagination: false,
      pagerList: '<ul>',
      pagerListItem: '<li><a href="#"></a></li>',
      pagerListItemText: 'a',
      pagerLinks: '.pagination li',
      currentNumber: 'span.current-num',
      totalNumber: 'span.total-num',
      btnPlay: '.btn-play',
      btnPause: '.btn-pause',
      btnPlayPause: '.btn-play-pause',
      galleryReadyClass: 'gallery-js-ready',
      autorotationActiveClass: 'autorotation-active',
      autorotationDisabledClass: 'autorotation-disabled',
      autorotationStopAfterClick: false,
      circularRotation: true,
      switchSimultaneously: true,
      disableWhileAnimating: false,
      disableFadeIE: false,
      autoRotation: false,
      pauseOnHover: true,
      autoHeight: true,
      useSwipe: true,
      swipeThreshold: 15,
      switchTime: 4000,
      animSpeed: 600,
      event: 'click'
    }, options);
    this.init();
  }
  FadeGallery.prototype = {
    init: function() {
      if (this.options.holder) {
        this.findElements();
        this.attachEvents();
        this.refreshState(true);
        this.autoRotate();
        this.makeCallback('onInit', this);
      }
    },
    findElements: function() {
      // control elements
      this.gallery = $(this.options.holder).addClass(this.options.galleryReadyClass);
      this.slides = this.gallery.find(this.options.slides);
      this.slidesHolder = this.slides.eq(0).parent();
      this.stepsCount = this.slides.length;
      this.btnPrev = this.gallery.find(this.options.btnPrev);
      this.btnNext = this.gallery.find(this.options.btnNext);
      this.currentIndex = 0;

      // disable fade effect in old IE
      if (this.options.disableFadeIE && !$.support.opacity) {
        this.options.animSpeed = 0;
      }

      // create gallery pagination
      if (typeof this.options.generatePagination === 'string') {
        this.pagerHolder = this.gallery.find(this.options.generatePagination).empty();
        this.pagerList = $(this.options.pagerList).appendTo(this.pagerHolder);
        for (var i = 0; i < this.stepsCount; i++) {
          $(this.options.pagerListItem).appendTo(this.pagerList).find(this.options.pagerListItemText).text(i + 1);
        }
        this.pagerLinks = this.pagerList.children();
      } else {
        this.pagerLinks = this.gallery.find(this.options.pagerLinks);
      }

      // get start index
      var activeSlide = this.slides.filter('.' + this.options.activeClass);
      if (activeSlide.length) {
        this.currentIndex = this.slides.index(activeSlide);
      }
      this.prevIndex = this.currentIndex;

      // autorotation control buttons
      this.btnPlay = this.gallery.find(this.options.btnPlay);
      this.btnPause = this.gallery.find(this.options.btnPause);
      this.btnPlayPause = this.gallery.find(this.options.btnPlayPause);

      // misc elements
      this.curNum = this.gallery.find(this.options.currentNumber);
      this.allNum = this.gallery.find(this.options.totalNumber);

      // handle flexible layout
      this.slides.css({
        display: 'block',
        opacity: 0
      }).eq(this.currentIndex).css({
        opacity: ''
      });
      this.isInit = true;
    },
    attachEvents: function() {
      var self = this;

      // flexible layout handler
      this.resizeHandler = function() {
        if (!self.isInit) return;
        self.onWindowResize();
      };
      $(window).bind('load resize orientationchange', this.resizeHandler);

      if (this.btnPrev.length) {
        this.btnPrevHandler = function(e) {
          e.preventDefault();
          self.prevSlide();
          if (self.options.autorotationStopAfterClick) {
            self.stopRotation();
          }
        };
        this.btnPrev.bind(this.options.event, this.btnPrevHandler);
      }
      if (this.btnNext.length) {
        this.btnNextHandler = function(e) {
          e.preventDefault();
          self.nextSlide();
          if (self.options.autorotationStopAfterClick) {
            self.stopRotation();
          }
        };
        this.btnNext.bind(this.options.event, this.btnNextHandler);
      }
      if (this.pagerLinks.length) {
        this.pagerLinksHandler = function(e) {
          e.preventDefault();
          self.numSlide(self.pagerLinks.index(e.currentTarget));
          if (self.options.autorotationStopAfterClick) {
            self.stopRotation();
          }
        };
        this.pagerLinks.bind(self.options.event, this.pagerLinksHandler);
      }

      // autorotation buttons handler
      if (this.btnPlay.length) {
        this.btnPlayHandler = function(e) {
          e.preventDefault();
          self.startRotation();
        };
        this.btnPlay.bind(this.options.event, this.btnPlayHandler);
      }
      if (this.btnPause.length) {
        this.btnPauseHandler = function(e) {
          e.preventDefault();
          self.stopRotation();
        };
        this.btnPause.bind(this.options.event, this.btnPauseHandler);
      }
      if (this.btnPlayPause.length) {
        this.btnPlayPauseHandler = function(e) {
          e.preventDefault();
          if (!self.gallery.hasClass(self.options.autorotationActiveClass)) {
            self.startRotation();
          } else {
            self.stopRotation();
          }
        };
        this.btnPlayPause.bind(this.options.event, this.btnPlayPauseHandler);
      }

      // swipe gestures handler
      if (this.options.useSwipe && window.Hammer && isTouchDevice) {
        this.swipeHandler = new Hammer.Manager(this.gallery[0]);
        this.swipeHandler.add(new Hammer.Swipe({
          direction: Hammer.DIRECTION_HORIZONTAL,
          threshold: self.options.swipeThreshold
        }));
        this.swipeHandler.on('swipeleft', function() {
          self.nextSlide();
        }).on('swiperight', function() {
          self.prevSlide();
        });
      }

      // pause on hover handling
      if (this.options.pauseOnHover) {
        this.hoverHandler = function() {
          if (self.options.autoRotation) {
            self.galleryHover = true;
            self.pauseRotation();
          }
        };
        this.leaveHandler = function() {
          if (self.options.autoRotation) {
            self.galleryHover = false;
            self.resumeRotation();
          }
        };
        this.gallery.bind({
          mouseenter: this.hoverHandler,
          mouseleave: this.leaveHandler
        });
      }
    },
    onWindowResize: function() {
      if (this.options.autoHeight) {
        this.slidesHolder.css({
          height: this.slides.eq(this.currentIndex).outerHeight(true)
        });
      }
    },
    prevSlide: function() {
      if (!(this.options.disableWhileAnimating && this.galleryAnimating)) {
        this.prevIndex = this.currentIndex;
        if (this.currentIndex > 0) {
          this.currentIndex--;
          this.switchSlide();
        } else if (this.options.circularRotation) {
          this.currentIndex = this.stepsCount - 1;
          this.switchSlide();
        }
      }
    },
    nextSlide: function(fromAutoRotation) {
      if (!(this.options.disableWhileAnimating && this.galleryAnimating)) {
        this.prevIndex = this.currentIndex;
        if (this.currentIndex < this.stepsCount - 1) {
          this.currentIndex++;
          this.switchSlide();
        } else if (this.options.circularRotation || fromAutoRotation === true) {
          this.currentIndex = 0;
          this.switchSlide();
        }
      }
    },
    numSlide: function(c) {
      if (this.currentIndex != c) {
        this.prevIndex = this.currentIndex;
        this.currentIndex = c;
        this.switchSlide();
      }
    },
    switchSlide: function() {
      var self = this;
      if (this.slides.length > 1) {
        this.galleryAnimating = true;
        if (!this.options.animSpeed) {
          this.slides.eq(this.prevIndex).css({
            opacity: 0
          });
        } else {
          this.slides.eq(this.prevIndex).stop().animate({
            opacity: 0
          }, {
            duration: this.options.animSpeed
          });
        }

        this.switchNext = function() {
          if (!self.options.animSpeed) {
            self.slides.eq(self.currentIndex).css({
              opacity: ''
            });
          } else {
            self.slides.eq(self.currentIndex).stop().animate({
              opacity: 1
            }, {
              duration: self.options.animSpeed
            });
          }
          clearTimeout(this.nextTimer);
          this.nextTimer = setTimeout(function() {
            self.slides.eq(self.currentIndex).css({
              opacity: ''
            });
            self.galleryAnimating = false;
            self.autoRotate();

            // onchange callback
            self.makeCallback('onChange', self);
          }, self.options.animSpeed);
        };

        if (this.options.switchSimultaneously) {
          self.switchNext();
        } else {
          clearTimeout(this.switchTimer);
          this.switchTimer = setTimeout(function() {
            self.switchNext();
          }, this.options.animSpeed);
        }
        this.refreshState();

        // onchange callback
        this.makeCallback('onBeforeChange', this);
      }
    },
    refreshState: function(initial) {
      this.slides.removeClass(this.options.activeClass).eq(this.currentIndex).addClass(this.options.activeClass);
      this.pagerLinks.removeClass(this.options.activeClass).eq(this.currentIndex).addClass(this.options.activeClass);
      this.curNum.html(this.currentIndex + 1);
      this.allNum.html(this.stepsCount);

      // initial refresh
      if (this.options.autoHeight) {
        if (initial) {
          this.slidesHolder.css({
            height: this.slides.eq(this.currentIndex).outerHeight(true)
          });
        } else {
          this.slidesHolder.stop().animate({
            height: this.slides.eq(this.currentIndex).outerHeight(true)
          }, {
            duration: this.options.animSpeed
          });
        }
      }

      // disabled state
      if (!this.options.circularRotation) {
        this.btnPrev.add(this.btnNext).removeClass(this.options.disabledClass);
        if (this.currentIndex === 0) this.btnPrev.addClass(this.options.disabledClass);
        if (this.currentIndex === this.stepsCount - 1) this.btnNext.addClass(this.options.disabledClass);
      }

      // add class if not enough slides
      this.gallery.toggleClass('not-enough-slides', this.stepsCount === 1);
    },
    startRotation: function() {
      this.options.autoRotation = true;
      this.galleryHover = false;
      this.autoRotationStopped = false;
      this.resumeRotation();
    },
    stopRotation: function() {
      this.galleryHover = true;
      this.autoRotationStopped = true;
      this.pauseRotation();
    },
    pauseRotation: function() {
      this.gallery.addClass(this.options.autorotationDisabledClass);
      this.gallery.removeClass(this.options.autorotationActiveClass);
      clearTimeout(this.timer);
    },
    resumeRotation: function() {
      if (!this.autoRotationStopped) {
        this.gallery.addClass(this.options.autorotationActiveClass);
        this.gallery.removeClass(this.options.autorotationDisabledClass);
        this.autoRotate();
      }
    },
    autoRotate: function() {
      var self = this;
      clearTimeout(this.timer);
      if (this.options.autoRotation && !this.galleryHover && !this.autoRotationStopped) {
        this.gallery.addClass(this.options.autorotationActiveClass);
        this.timer = setTimeout(function() {
          self.nextSlide(true);
        }, this.options.switchTime);
      } else {
        this.pauseRotation();
      }
    },
    makeCallback: function(name) {
      if (typeof this.options[name] === 'function') {
        var args = Array.prototype.slice.call(arguments);
        args.shift();
        this.options[name].apply(this, args);
      }
    },
    destroy: function() {
      this.isInit = false;
      // navigation buttons handler
      this.btnPrev.unbind(this.options.event, this.btnPrevHandler);
      this.btnNext.unbind(this.options.event, this.btnNextHandler);
      this.pagerLinks.unbind(this.options.event, this.pagerLinksHandler);
      $(window).unbind('load resize orientationchange', this.resizeHandler);

      // remove autorotation handlers
      this.stopRotation();
      this.btnPlay.unbind(this.options.event, this.btnPlayHandler);
      this.btnPause.unbind(this.options.event, this.btnPauseHandler);
      this.btnPlayPause.unbind(this.options.event, this.btnPlayPauseHandler);
      this.gallery.unbind('mouseenter', this.hoverHandler);
      this.gallery.unbind('mouseleave', this.leaveHandler);

      // remove swipe handler if used
      if (this.swipeHandler) {
        this.swipeHandler.destroy();
      }
      if (typeof this.options.generatePagination === 'string') {
        this.pagerHolder.empty();
      }

      // remove unneeded classes and styles
      var unneededClasses = [this.options.galleryReadyClass, this.options.autorotationActiveClass, this.options.autorotationDisabledClass];
      this.gallery.removeClass(unneededClasses.join(' ')).removeData('FadeGallery');
      this.slidesHolder.add(this.slides).add(this.mask).removeAttr('style');
      this.slides.removeClass(this.options.activeClass);
    }
  };

  // jquery plugin
  $.fn.fadeGallery = function(opt) {
    var args = Array.prototype.slice.call(arguments);
    var method = args[0];

    return this.each(function() {
      var $holder = jQuery(this);
      var instance = $holder.data('FadeGallery');

      if (typeof opt === 'object' || typeof opt === 'undefined') {
        $holder.data('FadeGallery', new FadeGallery($.extend({
          holder: this
        }, opt)));
      } else if (typeof method === 'string' && instance) {
        if (typeof instance[method] === 'function') {
          args.shift();
          instance[method].apply(instance, args);
        }
      }
    });
  };
}(jQuery));

/*! Hammer.JS - v2.0.8 - 2016-04-23
 * http://hammerjs.github.io/
 *
 * Copyright (c) 2016 Jorik Tangelder;
 * Licensed under the MIT license */
!function(a,b,c,d){"use strict";function e(a,b,c){return setTimeout(j(a,c),b)}function f(a,b,c){return Array.isArray(a)?(g(a,c[b],c),!0):!1}function g(a,b,c){var e;if(a)if(a.forEach)a.forEach(b,c);else if(a.length!==d)for(e=0;e<a.length;)b.call(c,a[e],e,a),e++;else for(e in a)a.hasOwnProperty(e)&&b.call(c,a[e],e,a)}function h(b,c,d){var e="DEPRECATED METHOD: "+c+"\n"+d+" AT \n";return function(){var c=new Error("get-stack-trace"),d=c&&c.stack?c.stack.replace(/^[^\(]+?[\n$]/gm,"").replace(/^\s+at\s+/gm,"").replace(/^Object.<anonymous>\s*\(/gm,"{anonymous}()@"):"Unknown Stack Trace",f=a.console&&(a.console.warn||a.console.log);return f&&f.call(a.console,e,d),b.apply(this,arguments)}}function i(a,b,c){var d,e=b.prototype;d=a.prototype=Object.create(e),d.constructor=a,d._super=e,c&&la(d,c)}function j(a,b){return function(){return a.apply(b,arguments)}}function k(a,b){return typeof a==oa?a.apply(b?b[0]||d:d,b):a}function l(a,b){return a===d?b:a}function m(a,b,c){g(q(b),function(b){a.addEventListener(b,c,!1)})}function n(a,b,c){g(q(b),function(b){a.removeEventListener(b,c,!1)})}function o(a,b){for(;a;){if(a==b)return!0;a=a.parentNode}return!1}function p(a,b){return a.indexOf(b)>-1}function q(a){return a.trim().split(/\s+/g)}function r(a,b,c){if(a.indexOf&&!c)return a.indexOf(b);for(var d=0;d<a.length;){if(c&&a[d][c]==b||!c&&a[d]===b)return d;d++}return-1}function s(a){return Array.prototype.slice.call(a,0)}function t(a,b,c){for(var d=[],e=[],f=0;f<a.length;){var g=b?a[f][b]:a[f];r(e,g)<0&&d.push(a[f]),e[f]=g,f++}return c&&(d=b?d.sort(function(a,c){return a[b]>c[b]}):d.sort()),d}function u(a,b){for(var c,e,f=b[0].toUpperCase()+b.slice(1),g=0;g<ma.length;){if(c=ma[g],e=c?c+f:b,e in a)return e;g++}return d}function v(){return ua++}function w(b){var c=b.ownerDocument||b;return c.defaultView||c.parentWindow||a}function x(a,b){var c=this;this.manager=a,this.callback=b,this.element=a.element,this.target=a.options.inputTarget,this.domHandler=function(b){k(a.options.enable,[a])&&c.handler(b)},this.init()}function y(a){var b,c=a.options.inputClass;return new(b=c?c:xa?M:ya?P:wa?R:L)(a,z)}function z(a,b,c){var d=c.pointers.length,e=c.changedPointers.length,f=b&Ea&&d-e===0,g=b&(Ga|Ha)&&d-e===0;c.isFirst=!!f,c.isFinal=!!g,f&&(a.session={}),c.eventType=b,A(a,c),a.emit("hammer.input",c),a.recognize(c),a.session.prevInput=c}function A(a,b){var c=a.session,d=b.pointers,e=d.length;c.firstInput||(c.firstInput=D(b)),e>1&&!c.firstMultiple?c.firstMultiple=D(b):1===e&&(c.firstMultiple=!1);var f=c.firstInput,g=c.firstMultiple,h=g?g.center:f.center,i=b.center=E(d);b.timeStamp=ra(),b.deltaTime=b.timeStamp-f.timeStamp,b.angle=I(h,i),b.distance=H(h,i),B(c,b),b.offsetDirection=G(b.deltaX,b.deltaY);var j=F(b.deltaTime,b.deltaX,b.deltaY);b.overallVelocityX=j.x,b.overallVelocityY=j.y,b.overallVelocity=qa(j.x)>qa(j.y)?j.x:j.y,b.scale=g?K(g.pointers,d):1,b.rotation=g?J(g.pointers,d):0,b.maxPointers=c.prevInput?b.pointers.length>c.prevInput.maxPointers?b.pointers.length:c.prevInput.maxPointers:b.pointers.length,C(c,b);var k=a.element;o(b.srcEvent.target,k)&&(k=b.srcEvent.target),b.target=k}function B(a,b){var c=b.center,d=a.offsetDelta||{},e=a.prevDelta||{},f=a.prevInput||{};b.eventType!==Ea&&f.eventType!==Ga||(e=a.prevDelta={x:f.deltaX||0,y:f.deltaY||0},d=a.offsetDelta={x:c.x,y:c.y}),b.deltaX=e.x+(c.x-d.x),b.deltaY=e.y+(c.y-d.y)}function C(a,b){var c,e,f,g,h=a.lastInterval||b,i=b.timeStamp-h.timeStamp;if(b.eventType!=Ha&&(i>Da||h.velocity===d)){var j=b.deltaX-h.deltaX,k=b.deltaY-h.deltaY,l=F(i,j,k);e=l.x,f=l.y,c=qa(l.x)>qa(l.y)?l.x:l.y,g=G(j,k),a.lastInterval=b}else c=h.velocity,e=h.velocityX,f=h.velocityY,g=h.direction;b.velocity=c,b.velocityX=e,b.velocityY=f,b.direction=g}function D(a){for(var b=[],c=0;c<a.pointers.length;)b[c]={clientX:pa(a.pointers[c].clientX),clientY:pa(a.pointers[c].clientY)},c++;return{timeStamp:ra(),pointers:b,center:E(b),deltaX:a.deltaX,deltaY:a.deltaY}}function E(a){var b=a.length;if(1===b)return{x:pa(a[0].clientX),y:pa(a[0].clientY)};for(var c=0,d=0,e=0;b>e;)c+=a[e].clientX,d+=a[e].clientY,e++;return{x:pa(c/b),y:pa(d/b)}}function F(a,b,c){return{x:b/a||0,y:c/a||0}}function G(a,b){return a===b?Ia:qa(a)>=qa(b)?0>a?Ja:Ka:0>b?La:Ma}function H(a,b,c){c||(c=Qa);var d=b[c[0]]-a[c[0]],e=b[c[1]]-a[c[1]];return Math.sqrt(d*d+e*e)}function I(a,b,c){c||(c=Qa);var d=b[c[0]]-a[c[0]],e=b[c[1]]-a[c[1]];return 180*Math.atan2(e,d)/Math.PI}function J(a,b){return I(b[1],b[0],Ra)+I(a[1],a[0],Ra)}function K(a,b){return H(b[0],b[1],Ra)/H(a[0],a[1],Ra)}function L(){this.evEl=Ta,this.evWin=Ua,this.pressed=!1,x.apply(this,arguments)}function M(){this.evEl=Xa,this.evWin=Ya,x.apply(this,arguments),this.store=this.manager.session.pointerEvents=[]}function N(){this.evTarget=$a,this.evWin=_a,this.started=!1,x.apply(this,arguments)}function O(a,b){var c=s(a.touches),d=s(a.changedTouches);return b&(Ga|Ha)&&(c=t(c.concat(d),"identifier",!0)),[c,d]}function P(){this.evTarget=bb,this.targetIds={},x.apply(this,arguments)}function Q(a,b){var c=s(a.touches),d=this.targetIds;if(b&(Ea|Fa)&&1===c.length)return d[c[0].identifier]=!0,[c,c];var e,f,g=s(a.changedTouches),h=[],i=this.target;if(f=c.filter(function(a){return o(a.target,i)}),b===Ea)for(e=0;e<f.length;)d[f[e].identifier]=!0,e++;for(e=0;e<g.length;)d[g[e].identifier]&&h.push(g[e]),b&(Ga|Ha)&&delete d[g[e].identifier],e++;return h.length?[t(f.concat(h),"identifier",!0),h]:void 0}function R(){x.apply(this,arguments);var a=j(this.handler,this);this.touch=new P(this.manager,a),this.mouse=new L(this.manager,a),this.primaryTouch=null,this.lastTouches=[]}function S(a,b){a&Ea?(this.primaryTouch=b.changedPointers[0].identifier,T.call(this,b)):a&(Ga|Ha)&&T.call(this,b)}function T(a){var b=a.changedPointers[0];if(b.identifier===this.primaryTouch){var c={x:b.clientX,y:b.clientY};this.lastTouches.push(c);var d=this.lastTouches,e=function(){var a=d.indexOf(c);a>-1&&d.splice(a,1)};setTimeout(e,cb)}}function U(a){for(var b=a.srcEvent.clientX,c=a.srcEvent.clientY,d=0;d<this.lastTouches.length;d++){var e=this.lastTouches[d],f=Math.abs(b-e.x),g=Math.abs(c-e.y);if(db>=f&&db>=g)return!0}return!1}function V(a,b){this.manager=a,this.set(b)}function W(a){if(p(a,jb))return jb;var b=p(a,kb),c=p(a,lb);return b&&c?jb:b||c?b?kb:lb:p(a,ib)?ib:hb}function X(){if(!fb)return!1;var b={},c=a.CSS&&a.CSS.supports;return["auto","manipulation","pan-y","pan-x","pan-x pan-y","none"].forEach(function(d){b[d]=c?a.CSS.supports("touch-action",d):!0}),b}function Y(a){this.options=la({},this.defaults,a||{}),this.id=v(),this.manager=null,this.options.enable=l(this.options.enable,!0),this.state=nb,this.simultaneous={},this.requireFail=[]}function Z(a){return a&sb?"cancel":a&qb?"end":a&pb?"move":a&ob?"start":""}function $(a){return a==Ma?"down":a==La?"up":a==Ja?"left":a==Ka?"right":""}function _(a,b){var c=b.manager;return c?c.get(a):a}function aa(){Y.apply(this,arguments)}function ba(){aa.apply(this,arguments),this.pX=null,this.pY=null}function ca(){aa.apply(this,arguments)}function da(){Y.apply(this,arguments),this._timer=null,this._input=null}function ea(){aa.apply(this,arguments)}function fa(){aa.apply(this,arguments)}function ga(){Y.apply(this,arguments),this.pTime=!1,this.pCenter=!1,this._timer=null,this._input=null,this.count=0}function ha(a,b){return b=b||{},b.recognizers=l(b.recognizers,ha.defaults.preset),new ia(a,b)}function ia(a,b){this.options=la({},ha.defaults,b||{}),this.options.inputTarget=this.options.inputTarget||a,this.handlers={},this.session={},this.recognizers=[],this.oldCssProps={},this.element=a,this.input=y(this),this.touchAction=new V(this,this.options.touchAction),ja(this,!0),g(this.options.recognizers,function(a){var b=this.add(new a[0](a[1]));a[2]&&b.recognizeWith(a[2]),a[3]&&b.requireFailure(a[3])},this)}function ja(a,b){var c=a.element;if(c.style){var d;g(a.options.cssProps,function(e,f){d=u(c.style,f),b?(a.oldCssProps[d]=c.style[d],c.style[d]=e):c.style[d]=a.oldCssProps[d]||""}),b||(a.oldCssProps={})}}function ka(a,c){var d=b.createEvent("Event");d.initEvent(a,!0,!0),d.gesture=c,c.target.dispatchEvent(d)}var la,ma=["","webkit","Moz","MS","ms","o"],na=b.createElement("div"),oa="function",pa=Math.round,qa=Math.abs,ra=Date.now;la="function"!=typeof Object.assign?function(a){if(a===d||null===a)throw new TypeError("Cannot convert undefined or null to object");for(var b=Object(a),c=1;c<arguments.length;c++){var e=arguments[c];if(e!==d&&null!==e)for(var f in e)e.hasOwnProperty(f)&&(b[f]=e[f])}return b}:Object.assign;var sa=h(function(a,b,c){for(var e=Object.keys(b),f=0;f<e.length;)(!c||c&&a[e[f]]===d)&&(a[e[f]]=b[e[f]]),f++;return a},"extend","Use `assign`."),ta=h(function(a,b){return sa(a,b,!0)},"merge","Use `assign`."),ua=1,va=/mobile|tablet|ip(ad|hone|od)|android/i,wa="ontouchstart"in a,xa=u(a,"PointerEvent")!==d,ya=wa&&va.test(navigator.userAgent),za="touch",Aa="pen",Ba="mouse",Ca="kinect",Da=25,Ea=1,Fa=2,Ga=4,Ha=8,Ia=1,Ja=2,Ka=4,La=8,Ma=16,Na=Ja|Ka,Oa=La|Ma,Pa=Na|Oa,Qa=["x","y"],Ra=["clientX","clientY"];x.prototype={handler:function(){},init:function(){this.evEl&&m(this.element,this.evEl,this.domHandler),this.evTarget&&m(this.target,this.evTarget,this.domHandler),this.evWin&&m(w(this.element),this.evWin,this.domHandler)},destroy:function(){this.evEl&&n(this.element,this.evEl,this.domHandler),this.evTarget&&n(this.target,this.evTarget,this.domHandler),this.evWin&&n(w(this.element),this.evWin,this.domHandler)}};var Sa={mousedown:Ea,mousemove:Fa,mouseup:Ga},Ta="mousedown",Ua="mousemove mouseup";i(L,x,{handler:function(a){var b=Sa[a.type];b&Ea&&0===a.button&&(this.pressed=!0),b&Fa&&1!==a.which&&(b=Ga),this.pressed&&(b&Ga&&(this.pressed=!1),this.callback(this.manager,b,{pointers:[a],changedPointers:[a],pointerType:Ba,srcEvent:a}))}});var Va={pointerdown:Ea,pointermove:Fa,pointerup:Ga,pointercancel:Ha,pointerout:Ha},Wa={2:za,3:Aa,4:Ba,5:Ca},Xa="pointerdown",Ya="pointermove pointerup pointercancel";a.MSPointerEvent&&!a.PointerEvent&&(Xa="MSPointerDown",Ya="MSPointerMove MSPointerUp MSPointerCancel"),i(M,x,{handler:function(a){var b=this.store,c=!1,d=a.type.toLowerCase().replace("ms",""),e=Va[d],f=Wa[a.pointerType]||a.pointerType,g=f==za,h=r(b,a.pointerId,"pointerId");e&Ea&&(0===a.button||g)?0>h&&(b.push(a),h=b.length-1):e&(Ga|Ha)&&(c=!0),0>h||(b[h]=a,this.callback(this.manager,e,{pointers:b,changedPointers:[a],pointerType:f,srcEvent:a}),c&&b.splice(h,1))}});var Za={touchstart:Ea,touchmove:Fa,touchend:Ga,touchcancel:Ha},$a="touchstart",_a="touchstart touchmove touchend touchcancel";i(N,x,{handler:function(a){var b=Za[a.type];if(b===Ea&&(this.started=!0),this.started){var c=O.call(this,a,b);b&(Ga|Ha)&&c[0].length-c[1].length===0&&(this.started=!1),this.callback(this.manager,b,{pointers:c[0],changedPointers:c[1],pointerType:za,srcEvent:a})}}});var ab={touchstart:Ea,touchmove:Fa,touchend:Ga,touchcancel:Ha},bb="touchstart touchmove touchend touchcancel";i(P,x,{handler:function(a){var b=ab[a.type],c=Q.call(this,a,b);c&&this.callback(this.manager,b,{pointers:c[0],changedPointers:c[1],pointerType:za,srcEvent:a})}});var cb=2500,db=25;i(R,x,{handler:function(a,b,c){var d=c.pointerType==za,e=c.pointerType==Ba;if(!(e&&c.sourceCapabilities&&c.sourceCapabilities.firesTouchEvents)){if(d)S.call(this,b,c);else if(e&&U.call(this,c))return;this.callback(a,b,c)}},destroy:function(){this.touch.destroy(),this.mouse.destroy()}});var eb=u(na.style,"touchAction"),fb=eb!==d,gb="compute",hb="auto",ib="manipulation",jb="none",kb="pan-x",lb="pan-y",mb=X();V.prototype={set:function(a){a==gb&&(a=this.compute()),fb&&this.manager.element.style&&mb[a]&&(this.manager.element.style[eb]=a),this.actions=a.toLowerCase().trim()},update:function(){this.set(this.manager.options.touchAction)},compute:function(){var a=[];return g(this.manager.recognizers,function(b){k(b.options.enable,[b])&&(a=a.concat(b.getTouchAction()))}),W(a.join(" "))},preventDefaults:function(a){var b=a.srcEvent,c=a.offsetDirection;if(this.manager.session.prevented)return void b.preventDefault();var d=this.actions,e=p(d,jb)&&!mb[jb],f=p(d,lb)&&!mb[lb],g=p(d,kb)&&!mb[kb];if(e){var h=1===a.pointers.length,i=a.distance<2,j=a.deltaTime<250;if(h&&i&&j)return}return g&&f?void 0:e||f&&c&Na||g&&c&Oa?this.preventSrc(b):void 0},preventSrc:function(a){this.manager.session.prevented=!0,a.preventDefault()}};var nb=1,ob=2,pb=4,qb=8,rb=qb,sb=16,tb=32;Y.prototype={defaults:{},set:function(a){return la(this.options,a),this.manager&&this.manager.touchAction.update(),this},recognizeWith:function(a){if(f(a,"recognizeWith",this))return this;var b=this.simultaneous;return a=_(a,this),b[a.id]||(b[a.id]=a,a.recognizeWith(this)),this},dropRecognizeWith:function(a){return f(a,"dropRecognizeWith",this)?this:(a=_(a,this),delete this.simultaneous[a.id],this)},requireFailure:function(a){if(f(a,"requireFailure",this))return this;var b=this.requireFail;return a=_(a,this),-1===r(b,a)&&(b.push(a),a.requireFailure(this)),this},dropRequireFailure:function(a){if(f(a,"dropRequireFailure",this))return this;a=_(a,this);var b=r(this.requireFail,a);return b>-1&&this.requireFail.splice(b,1),this},hasRequireFailures:function(){return this.requireFail.length>0},canRecognizeWith:function(a){return!!this.simultaneous[a.id]},emit:function(a){function b(b){c.manager.emit(b,a)}var c=this,d=this.state;qb>d&&b(c.options.event+Z(d)),b(c.options.event),a.additionalEvent&&b(a.additionalEvent),d>=qb&&b(c.options.event+Z(d))},tryEmit:function(a){return this.canEmit()?this.emit(a):void(this.state=tb)},canEmit:function(){for(var a=0;a<this.requireFail.length;){if(!(this.requireFail[a].state&(tb|nb)))return!1;a++}return!0},recognize:function(a){var b=la({},a);return k(this.options.enable,[this,b])?(this.state&(rb|sb|tb)&&(this.state=nb),this.state=this.process(b),void(this.state&(ob|pb|qb|sb)&&this.tryEmit(b))):(this.reset(),void(this.state=tb))},process:function(a){},getTouchAction:function(){},reset:function(){}},i(aa,Y,{defaults:{pointers:1},attrTest:function(a){var b=this.options.pointers;return 0===b||a.pointers.length===b},process:function(a){var b=this.state,c=a.eventType,d=b&(ob|pb),e=this.attrTest(a);return d&&(c&Ha||!e)?b|sb:d||e?c&Ga?b|qb:b&ob?b|pb:ob:tb}}),i(ba,aa,{defaults:{event:"pan",threshold:10,pointers:1,direction:Pa},getTouchAction:function(){var a=this.options.direction,b=[];return a&Na&&b.push(lb),a&Oa&&b.push(kb),b},directionTest:function(a){var b=this.options,c=!0,d=a.distance,e=a.direction,f=a.deltaX,g=a.deltaY;return e&b.direction||(b.direction&Na?(e=0===f?Ia:0>f?Ja:Ka,c=f!=this.pX,d=Math.abs(a.deltaX)):(e=0===g?Ia:0>g?La:Ma,c=g!=this.pY,d=Math.abs(a.deltaY))),a.direction=e,c&&d>b.threshold&&e&b.direction},attrTest:function(a){return aa.prototype.attrTest.call(this,a)&&(this.state&ob||!(this.state&ob)&&this.directionTest(a))},emit:function(a){this.pX=a.deltaX,this.pY=a.deltaY;var b=$(a.direction);b&&(a.additionalEvent=this.options.event+b),this._super.emit.call(this,a)}}),i(ca,aa,{defaults:{event:"pinch",threshold:0,pointers:2},getTouchAction:function(){return[jb]},attrTest:function(a){return this._super.attrTest.call(this,a)&&(Math.abs(a.scale-1)>this.options.threshold||this.state&ob)},emit:function(a){if(1!==a.scale){var b=a.scale<1?"in":"out";a.additionalEvent=this.options.event+b}this._super.emit.call(this,a)}}),i(da,Y,{defaults:{event:"press",pointers:1,time:251,threshold:9},getTouchAction:function(){return[hb]},process:function(a){var b=this.options,c=a.pointers.length===b.pointers,d=a.distance<b.threshold,f=a.deltaTime>b.time;if(this._input=a,!d||!c||a.eventType&(Ga|Ha)&&!f)this.reset();else if(a.eventType&Ea)this.reset(),this._timer=e(function(){this.state=rb,this.tryEmit()},b.time,this);else if(a.eventType&Ga)return rb;return tb},reset:function(){clearTimeout(this._timer)},emit:function(a){this.state===rb&&(a&&a.eventType&Ga?this.manager.emit(this.options.event+"up",a):(this._input.timeStamp=ra(),this.manager.emit(this.options.event,this._input)))}}),i(ea,aa,{defaults:{event:"rotate",threshold:0,pointers:2},getTouchAction:function(){return[jb]},attrTest:function(a){return this._super.attrTest.call(this,a)&&(Math.abs(a.rotation)>this.options.threshold||this.state&ob)}}),i(fa,aa,{defaults:{event:"swipe",threshold:10,velocity:.3,direction:Na|Oa,pointers:1},getTouchAction:function(){return ba.prototype.getTouchAction.call(this)},attrTest:function(a){var b,c=this.options.direction;return c&(Na|Oa)?b=a.overallVelocity:c&Na?b=a.overallVelocityX:c&Oa&&(b=a.overallVelocityY),this._super.attrTest.call(this,a)&&c&a.offsetDirection&&a.distance>this.options.threshold&&a.maxPointers==this.options.pointers&&qa(b)>this.options.velocity&&a.eventType&Ga},emit:function(a){var b=$(a.offsetDirection);b&&this.manager.emit(this.options.event+b,a),this.manager.emit(this.options.event,a)}}),i(ga,Y,{defaults:{event:"tap",pointers:1,taps:1,interval:300,time:250,threshold:9,posThreshold:10},getTouchAction:function(){return[ib]},process:function(a){var b=this.options,c=a.pointers.length===b.pointers,d=a.distance<b.threshold,f=a.deltaTime<b.time;if(this.reset(),a.eventType&Ea&&0===this.count)return this.failTimeout();if(d&&f&&c){if(a.eventType!=Ga)return this.failTimeout();var g=this.pTime?a.timeStamp-this.pTime<b.interval:!0,h=!this.pCenter||H(this.pCenter,a.center)<b.posThreshold;this.pTime=a.timeStamp,this.pCenter=a.center,h&&g?this.count+=1:this.count=1,this._input=a;var i=this.count%b.taps;if(0===i)return this.hasRequireFailures()?(this._timer=e(function(){this.state=rb,this.tryEmit()},b.interval,this),ob):rb}return tb},failTimeout:function(){return this._timer=e(function(){this.state=tb},this.options.interval,this),tb},reset:function(){clearTimeout(this._timer)},emit:function(){this.state==rb&&(this._input.tapCount=this.count,this.manager.emit(this.options.event,this._input))}}),ha.VERSION="2.0.8",ha.defaults={domEvents:!1,touchAction:gb,enable:!0,inputTarget:null,inputClass:null,preset:[[ea,{enable:!1}],[ca,{enable:!1},["rotate"]],[fa,{direction:Na}],[ba,{direction:Na},["swipe"]],[ga],[ga,{event:"doubletap",taps:2},["tap"]],[da]],cssProps:{userSelect:"none",touchSelect:"none",touchCallout:"none",contentZooming:"none",userDrag:"none",tapHighlightColor:"rgba(0,0,0,0)"}};var ub=1,vb=2;ia.prototype={set:function(a){return la(this.options,a),a.touchAction&&this.touchAction.update(),a.inputTarget&&(this.input.destroy(),this.input.target=a.inputTarget,this.input.init()),this},stop:function(a){this.session.stopped=a?vb:ub},recognize:function(a){var b=this.session;if(!b.stopped){this.touchAction.preventDefaults(a);var c,d=this.recognizers,e=b.curRecognizer;(!e||e&&e.state&rb)&&(e=b.curRecognizer=null);for(var f=0;f<d.length;)c=d[f],b.stopped===vb||e&&c!=e&&!c.canRecognizeWith(e)?c.reset():c.recognize(a),!e&&c.state&(ob|pb|qb)&&(e=b.curRecognizer=c),f++}},get:function(a){if(a instanceof Y)return a;for(var b=this.recognizers,c=0;c<b.length;c++)if(b[c].options.event==a)return b[c];return null},add:function(a){if(f(a,"add",this))return this;var b=this.get(a.options.event);return b&&this.remove(b),this.recognizers.push(a),a.manager=this,this.touchAction.update(),a},remove:function(a){if(f(a,"remove",this))return this;if(a=this.get(a)){var b=this.recognizers,c=r(b,a);-1!==c&&(b.splice(c,1),this.touchAction.update())}return this},on:function(a,b){if(a!==d&&b!==d){var c=this.handlers;return g(q(a),function(a){c[a]=c[a]||[],c[a].push(b)}),this}},off:function(a,b){if(a!==d){var c=this.handlers;return g(q(a),function(a){b?c[a]&&c[a].splice(r(c[a],b),1):delete c[a]}),this}},emit:function(a,b){this.options.domEvents&&ka(a,b);var c=this.handlers[a]&&this.handlers[a].slice();if(c&&c.length){b.type=a,b.preventDefault=function(){b.srcEvent.preventDefault()};for(var d=0;d<c.length;)c[d](b),d++}},destroy:function(){this.element&&ja(this,!1),this.handlers={},this.session={},this.input.destroy(),this.element=null}},la(ha,{INPUT_START:Ea,INPUT_MOVE:Fa,INPUT_END:Ga,INPUT_CANCEL:Ha,STATE_POSSIBLE:nb,STATE_BEGAN:ob,STATE_CHANGED:pb,STATE_ENDED:qb,STATE_RECOGNIZED:rb,STATE_CANCELLED:sb,STATE_FAILED:tb,DIRECTION_NONE:Ia,DIRECTION_LEFT:Ja,DIRECTION_RIGHT:Ka,DIRECTION_UP:La,DIRECTION_DOWN:Ma,DIRECTION_HORIZONTAL:Na,DIRECTION_VERTICAL:Oa,DIRECTION_ALL:Pa,Manager:ia,Input:x,TouchAction:V,TouchInput:P,MouseInput:L,PointerEventInput:M,TouchMouseInput:R,SingleTouchInput:N,Recognizer:Y,AttrRecognizer:aa,Tap:ga,Pan:ba,Swipe:fa,Pinch:ca,Rotate:ea,Press:da,on:m,off:n,each:g,merge:ta,extend:sa,assign:la,inherit:i,bindFn:j,prefixed:u});var wb="undefined"!=typeof a?a:"undefined"!=typeof self?self:{};wb.Hammer=ha,"function"==typeof define&&define.amd?define(function(){return ha}):"undefined"!=typeof module&&module.exports?module.exports=ha:a[c]=ha}(window,document,"Hammer");

/*
 *   Mobile Navigation
 */
;(function($) {
  function MobileNav(options) {
    this.options = $.extend({
      container: null,
      hideOnClickOutside: false,
      menuActiveClass: 'nav-active',
      menuOpener: '.nav-opener',
      menuDrop: '.nav-drop',
      toggleEvent: 'click',
      outsideClickEvent: 'click touchstart pointerdown MSPointerDown'
    }, options);
    this.initStructure();
    this.attachEvents();
  }
  MobileNav.prototype = {
    initStructure: function() {
      this.page = $('html');
      this.container = $(this.options.container);
      this.opener = this.container.find(this.options.menuOpener);
      this.drop = this.container.find(this.options.menuDrop);
    },
    attachEvents: function() {
      var self = this;

      if(activateResizeHandler) {
        activateResizeHandler();
        activateResizeHandler = null;
      }

      this.outsideClickHandler = function(e) {
        if(self.isOpened()) {
          var target = $(e.target);
          if(!target.closest(self.opener).length && !target.closest(self.drop).length) {
            self.hide();
          }
        }
      };

      this.openerClickHandler = function(e) {
        e.preventDefault();
        self.toggle();
      };

      this.opener.on(this.options.toggleEvent, this.openerClickHandler);
    },
    isOpened: function() {
      return this.container.hasClass(this.options.menuActiveClass);
    },
    show: function() {
      this.container.addClass(this.options.menuActiveClass);
      if(this.options.hideOnClickOutside) {
        this.page.on(this.options.outsideClickEvent, this.outsideClickHandler);
      }
    },
    hide: function() {
      this.container.removeClass(this.options.menuActiveClass);
      if(this.options.hideOnClickOutside) {
        this.page.off(this.options.outsideClickEvent, this.outsideClickHandler);
      }
    },
    toggle: function() {
      if(this.isOpened()) {
        this.hide();
      } else {
        this.show();
      }
    },
    destroy: function() {
      this.container.removeClass(this.options.menuActiveClass);
      this.opener.off(this.options.toggleEvent, this.clickHandler);
      this.page.off(this.options.outsideClickEvent, this.outsideClickHandler);
    }
  };

  var activateResizeHandler = function() {
    var win = $(window),
      doc = $('html'),
      resizeClass = 'resize-active',
      flag, timer;
    var removeClassHandler = function() {
      flag = false;
      doc.removeClass(resizeClass);
    };
    var resizeHandler = function() {
      if(!flag) {
        flag = true;
        doc.addClass(resizeClass);
      }
      clearTimeout(timer);
      timer = setTimeout(removeClassHandler, 500);
    };
    win.on('resize orientationchange', resizeHandler);
  };

  $.fn.mobileNav = function(opt) {
    var args = Array.prototype.slice.call(arguments);
    var method = args[0];

    return this.each(function() {
      var $container = jQuery(this);
      var instance = $container.data('MobileNav');

      if (typeof opt === 'object' || typeof opt === 'undefined') {
        $container.data('MobileNav', new MobileNav($.extend({
          container: this
        }, opt)));
      } else if (typeof method === 'string' && instance) {
        if (typeof instance[method] === 'function') {
          args.shift();
          instance[method].apply(instance, args);
        }
      }
    });
  };
}(jQuery));

/*
 * Add Class on focus
 */
;(function($) {
  function AddFocusClass(options) {
    this.options = $.extend({
      container: null,
      element: ':input',
      focusClass: 'focus',
      stayFocusOnFilled: false
    }, options);
    this.initStructure();
    this.attachEvents();
  }
  AddFocusClass.prototype = {
    initStructure: function() {
      this.container = $(this.options.container);
      this.element = this.container.find(this.options.element);
    },
    attachEvents: function() {
      var self = this;
      this.focusHandler = function() {
        self.container.addClass(self.options.focusClass);
      };
      this.blurHandler = function() {
        if (self.options.stayFocusOnFilled) {
          self.container.toggleClass(self.options.focusClass, !!self.element.val().trim().length);
        } else {
          self.container.removeClass(self.options.focusClass);
        }
      };
      this.blurHandler();
      this.element.on({
        focus: this.focusHandler,
        blur: this.blurHandler
      });
    },
    destroy: function() {
      this.container.removeClass(this.options.focusClass);
      this.element.off({
        focus: this.focusHandler,
        blur: this.blurHandler
      });
    }
  };

  $.fn.addFocusClass = function(options) {
    return this.each(function() {
      var params = $.extend({}, options, {
          container: this
        }),
        instance = new AddFocusClass(params);
      $.data(this, 'AddFocusClass', instance);
    });
  };
}(jQuery));


/*
 * jQuery Accordion plugin new
 */
;(function(root, factory) {

  'use strict';
  if (typeof define === 'function' && define.amd) {
    define(['jquery'], factory);
  } else if (typeof exports === 'object') {
    module.exports = factory(require('jquery'));
  } else {
    root.SlideAccordion = factory(jQuery);
  }
}(this, function($) {

  'use strict';
  var accHiddenClass = 'js-acc-hidden';

  function SlideAccordion(options) {
    this.options = $.extend(true, {
      allowClickWhenExpanded: false,
      activeClass:'active',
      opener:'.opener',
      slider:'.slide',
      animSpeed: 300,
      collapsible:true,
      event: 'click',
      scrollToActiveItem: {
        enable: false,
        breakpoint: 767, // max-width
        animSpeed: 600,
        extraOffset: null
      }
    }, options);
    this.init();
  }

  SlideAccordion.prototype = {
    init: function() {
      if (this.options.holder) {
        this.findElements();
        this.setStateOnInit();
        this.attachEvents();
        this.makeCallback('onInit');
      }
    },

    findElements: function() {
      this.$holder = $(this.options.holder).data('SlideAccordion', this);
      this.$items = this.$holder.find(':has(' + this.options.slider + ')');
    },

    setStateOnInit: function() {
      var self = this;

      this.$items.each(function() {
        if (!$(this).hasClass(self.options.activeClass)) {
          $(this).find(self.options.slider).addClass(accHiddenClass);
        }
      });
    },

    attachEvents: function() {
      var self = this;

      this.accordionToggle = function(e) {
        var $item = jQuery(this).closest(self.$items);
        var $actiItem = self.getActiveItem($item);

        if (!self.options.allowClickWhenExpanded || !$item.hasClass(self.options.activeClass)) {
          e.preventDefault();
          self.toggle($item, $actiItem);
        }
      };

      this.$items.on(this.options.event, this.options.opener, this.accordionToggle);
    },

    toggle: function($item, $prevItem) {
      if (!$item.hasClass(this.options.activeClass)) {
        this.show($item);
      } else if (this.options.collapsible) {
        this.hide($item);
      }

      if (!$item.is($prevItem) && $prevItem.length) {
        this.hide($prevItem);
      }

      this.makeCallback('beforeToggle');
    },

    show: function($item) {
      var $slider = $item.find(this.options.slider);

      $item.addClass(this.options.activeClass);
      $slider.stop().hide().removeClass(accHiddenClass).slideDown({
        duration: this.options.animSpeed,
        complete: function() {
          $slider.removeAttr('style');
          if (
            this.options.scrollToActiveItem.enable &&
            window.innerWidth <= this.options.scrollToActiveItem.breakpoint
          ) {
            this.goToItem($item);
          }
          this.makeCallback('onShow', $item);
        }.bind(this)
      });

      this.makeCallback('beforeShow', $item);
    },

    hide: function($item) {
      var $slider = $item.find(this.options.slider);

      $item.removeClass(this.options.activeClass);
      $slider.stop().show().slideUp({
        duration: this.options.animSpeed,
        complete: function() {
          $slider.addClass(accHiddenClass);
          $slider.removeAttr('style');
          this.makeCallback('onHide', $item);
        }.bind(this)
      });

      this.makeCallback('beforeHide', $item);
    },

    goToItem: function($item) {
      var itemOffset = $item.offset().top;

      if (itemOffset < $(window).scrollTop()) {
        // handle extra offset
        if (typeof this.options.scrollToActiveItem.extraOffset === 'number') {
          itemOffset -= this.options.scrollToActiveItem.extraOffset;
        } else if (typeof this.options.scrollToActiveItem.extraOffset === 'function') {
          itemOffset -= this.options.scrollToActiveItem.extraOffset();
        }

        $('body, html').animate({
          scrollTop: itemOffset
        }, this.options.scrollToActiveItem.animSpeed);
      }
    },

    getActiveItem: function($item) {
      return $item.siblings().filter('.' + this.options.activeClass);
    },

    makeCallback: function(name) {
      if (typeof this.options[name] === 'function') {
        var args = Array.prototype.slice.call(arguments);
        args.shift();
        this.options[name].apply(this, args);
      }
    },

    destroy: function() {
      this.$holder.removeData('SlideAccordion');
      this.$items.off(this.options.event, this.options.opener, this.accordionToggle);
      this.$items.removeClass(this.options.activeClass).each(function(i, item) {
        $(item).find(this.options.slider).removeAttr('style').removeClass(accHiddenClass);
      }.bind(this));
      this.makeCallback('onDestroy');
    }
  };

  $.fn.slideAccordion = function(opt) {
    var args = Array.prototype.slice.call(arguments);
    var method = args[0];

    return this.each(function() {
      var $holder = jQuery(this);
      var instance = $holder.data('SlideAccordion');

      if (typeof opt === 'object' || typeof opt === 'undefined') {
        new SlideAccordion($.extend(true, {
          holder: this
        }, opt));
      } else if (typeof method === 'string' && instance) {
        if(typeof instance[method] === 'function') {
          args.shift();
          instance[method].apply(instance, args);
        }
      }
    });
  };

  (function() {
    var tabStyleSheet = $('<style type="text/css">')[0];
    var tabStyleRule = '.' + accHiddenClass;
    tabStyleRule += '{position:absolute !important;left:-9999px !important;top:-9999px !important;display:block !important; width: 100% !important;}';
    if (tabStyleSheet.styleSheet) {
      tabStyleSheet.styleSheet.cssText = tabStyleRule;
    } else {
      tabStyleSheet.appendChild(document.createTextNode(tabStyleRule));
    }
    $('head').append(tabStyleSheet);
  }());

  return SlideAccordion;
}));

// typing
function initTyping() {
  var TxtType = function(el, toRotate, period) {
    this.toRotate = toRotate;
    this.el = el;
    this.loopNum = 0;
    this.period = parseInt(period, 10) || 2000;
    this.txt = '';
    this.tick();
    this.isDeleting = false;
  };

  TxtType.prototype.tick = function() {
    var i = this.loopNum % this.toRotate.length;
    var fullTxt = this.toRotate[i];

    if (this.isDeleting) {
      this.txt = fullTxt.substring(0, this.txt.length - 1);
    } else {
      this.txt = fullTxt.substring(0, this.txt.length + 1);
    }

    this.el.innerHTML = '<span class="text-holder">' + this.txt + '</span>';

    var that = this;
    var delta = 200 - Math.random() * 100;

    if (this.isDeleting) { delta /= 2; }

    if (!this.isDeleting && this.txt === fullTxt) {
      delta = this.period;
      this.isDeleting = true;
    } else if (this.isDeleting && this.txt === '') {
      this.isDeleting = false;
      this.loopNum++;
      delta = 500;
    }

    setTimeout(function() {
      that.tick();
    }, delta);
  };

  window.onload = function() {
    var elements = document.getElementsByClassName('type-write');

    for (var i=0; i<elements.length; i++) {
      var toRotate = elements[i].getAttribute('data-type');
      var period = elements[i].getAttribute('data-period');
      if (toRotate) {
        new TxtType(elements[i], JSON.parse(toRotate), period);
      }
    }
  };
}

/*
 * Responsive Layout helper
 */
window.ResponsiveHelper = (function($){
  // init variables
  var handlers = [],
    prevWinWidth,
    win = $(window),
    nativeMatchMedia = false;

  // detect match media support
  if(window.matchMedia) {
    if(window.Window && window.matchMedia === Window.prototype.matchMedia) {
      nativeMatchMedia = true;
    } else if(window.matchMedia.toString().indexOf('native') > -1) {
      nativeMatchMedia = true;
    }
  }

  // prepare resize handler
  function resizeHandler() {
    var winWidth = win.width();
    if(winWidth !== prevWinWidth) {
      prevWinWidth = winWidth;

      // loop through range groups
      $.each(handlers, function(index, rangeObject){
        // disable current active area if needed
        $.each(rangeObject.data, function(property, item) {
          if(item.currentActive && !matchRange(item.range[0], item.range[1])) {
            item.currentActive = false;
            if(typeof item.disableCallback === 'function') {
              item.disableCallback();
            }
          }
        });

        // enable areas that match current width
        $.each(rangeObject.data, function(property, item) {
          if(!item.currentActive && matchRange(item.range[0], item.range[1])) {
            // make callback
            item.currentActive = true;
            if(typeof item.enableCallback === 'function') {
              item.enableCallback();
            }
          }
        });
      });
    }
  }
  win.bind('load resize orientationchange', resizeHandler);

  // test range
  function matchRange(r1, r2) {
    var mediaQueryString = '';
    if(r1 > 0) {
      mediaQueryString += '(min-width: ' + r1 + 'px)';
    }
    if(r2 < Infinity) {
      mediaQueryString += (mediaQueryString ? ' and ' : '') + '(max-width: ' + r2 + 'px)';
    }
    return matchQuery(mediaQueryString, r1, r2);
  }

  // media query function
  function matchQuery(query, r1, r2) {
    if(window.matchMedia && nativeMatchMedia) {
      return matchMedia(query).matches;
    } else if(window.styleMedia) {
      return styleMedia.matchMedium(query);
    } else if(window.media) {
      return media.matchMedium(query);
    } else {
      return prevWinWidth >= r1 && prevWinWidth <= r2;
    }
  }

  // range parser
  function parseRange(rangeStr) {
    var rangeData = rangeStr.split('..');
    var x1 = parseInt(rangeData[0], 10) || -Infinity;
    var x2 = parseInt(rangeData[1], 10) || Infinity;
    return [x1, x2].sort(function(a, b){
      return a - b;
    });
  }

  // export public functions
  return {
    addRange: function(ranges) {
      // parse data and add items to collection
      var result = {data:{}};
      $.each(ranges, function(property, data){
        result.data[property] = {
          range: parseRange(property),
          enableCallback: data.on,
          disableCallback: data.off
        };
      });
      handlers.push(result);

      // call resizeHandler to recalculate all events
      prevWinWidth = null;
      resizeHandler();
    }
  };
}(jQuery));