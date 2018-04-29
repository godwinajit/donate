//Anonymous sely-executing function
(function (root, factory) {
  factory(root.jQuery);
}(this, function ($) {

  var CanvasRenderer = function (element, options) {
    var cachedBackground;
    var canvas = document.createElement('canvas');
    var opts;

    element.appendChild(canvas);

    var _ = {};

    init(options);

    Date.now = Date.now || function () {

          //convert to milliseconds
          return +(new Date());
        };

    var drawCircle = function (colorStart, colorFinish, lineWidth, percent) {
      percent = Math.min(Math.max(-1, percent || 0), 1);
      var isNegative = percent <= 0 ? true : false;

      var grad= _.ctx.createLinearGradient( _.radius, _.radius, 0, _.radius);
      grad.addColorStop(0, colorStart);
      grad.addColorStop(1, colorFinish);

      _.ctx.beginPath();
      _.ctx.arc(0, 0, _.radius, 0, Math.PI * 2 * percent, isNegative);

      _.ctx.strokeStyle = grad;
      _.ctx.lineWidth = lineWidth;

      _.ctx.stroke();
    };

    function init(options) {
        opts = options;

        canvas.width = canvas.height = opts.size;

        _.ctx = canvas.getContext('2d');
        _.radius = (opts.size - opts.lineWidth) / 2;

        // move 0,0 coordinates to the center
        _.ctx.translate(opts.size / 2, opts.size / 2);

        // rotate canvas -90deg
        _.ctx.rotate((-1 / 2 + opts.rotate / 180) * Math.PI);
    }

    /**
     * Return function request animation frame method or timeout fallback
     */
    var reqAnimationFrame = (function () {
      return window.requestAnimationFrame ||
          window.webkitRequestAnimationFrame ||
          window.mozRequestAnimationFrame ||
          function (callback) {
            window.setTimeout(callback, 1000 / 60);
          };
    }());

    this.init = function(options) {
        init(options);
    }

    /**
     * Draw the background of the plugin track
     */
    var drawBackground = function () {
      if (opts.trackColor) drawCircle(opts.trackColor, opts.trackColor, opts.lineWidth, 1);
    };

    /**
     * Clear the complete canvas
     */
    this.clear = function () {
      _.ctx.clearRect(opts.size / -2, opts.size / -2, opts.size, opts.size);
      cachedBackground = null;
    };

    /**
     * Draw the complete chart
     * param percent Percent shown by the chart between -100 and 100
     */
    this.draw = function (percent) {
      if (!!opts.trackColor) {
        // getImageData and putImageData are supported
        if (_.ctx.getImageData && _.ctx.putImageData) {
          if (!cachedBackground) {
            drawBackground();
            cachedBackground = _.ctx.getImageData(0, 0, opts.size, opts.size);
          } else {
            _.ctx.putImageData(cachedBackground, 0, 0);
          }
        } else {
          this.clear();
          drawBackground();
        }
      } else {
        this.clear();
      }

      _.ctx.lineCap = opts.lineCap;

      // draw bar
      drawCircle(opts.colorStart, opts.colorFinish, opts.lineWidth, percent / 100);
    }.bind(this);

    this.animate = function (from, to) {
      var startTime = Date.now();

      var animation = function () {
        var process = Math.min(Date.now() - startTime, opts.animate.duration);
        var currentValue = opts.easing(this, process, from, to - from, opts.animate.duration);
        this.draw(currentValue);

        //Show the number at the center of the circle
        opts.onStep(from, to, currentValue);

        if(process != opts.animate.duration) {
            reqAnimationFrame(animation);
        }
      }.bind(this);

      reqAnimationFrame(animation);
    }.bind(this);
  };

  var pieChart = function (element, userOptions) {
    var defaultOptions = {
      colorStart: '#000',
      colorFinish: '#fff',
      trackColor: '#fff000',
      lineCap: 'round',
      lineWidth: 3,
      size: 150,
      rotate: 0,
      animate: {
        duration: 1000,
        enabled: true
      },
      easing: function (x, t, b, c, d) {//copy from jQuery easing animate
        t = t / (d / 2);
        if (t < 1) {
          return c / 2 * t * t + b;
        }
        return -c / 2 * ((--t) * (t - 2) - 1) + b;
      },
      onStep: function (from, to, currentValue) {
        return;
      },
      renderer: CanvasRenderer//Maybe SVGRenderer more later
    };

    var options = {};

    var init = function () {
      this.element = element;
      this.options = options;

      // merge user options into default options
      for (var i in defaultOptions) {
        if (defaultOptions.hasOwnProperty(i)) {
          options[i] = userOptions && typeof(userOptions[i]) !== 'undefined' ? userOptions[i] : defaultOptions[i];
          if (typeof(options[i]) === 'function') {
            options[i] = options[i].bind(this);
          }
        }
      }

      // check for jQuery easing, use jQuery easing first
      if (typeof(options.easing) === 'string' && typeof(jQuery) !== 'undefined' && jQuery.isFunction(jQuery.easing[options.easing])) {
        options.easing = jQuery.easing[options.easing];
      } else {
        options.easing = defaultOptions.easing;
      }

      // create renderer
      this.renderer = new options.renderer(element, options);

      draw(this.renderer, options);
    }.bind(this)();

    function draw(renderer, options) {
        var currentValue = 0;
        // initial draw
        renderer.draw(currentValue);

        if (element.getAttribute && element.getAttribute('data-percent')) {
            var newValue = parseFloat(element.getAttribute('data-percent'));

            if (options.animate.enabled) {
                renderer.animate(currentValue, newValue);
            } else {
                renderer.draw(newValue);
            }

            currentValue = newValue;
        }
    }

    this.redraw = function(options) {
        var options = $.extend({}, this.options, options);

        this.renderer.clear();
        this.renderer.init(options);
        draw(this.renderer, options);
    }
  };

  $.fn.pieChart = function (options) {
    //Iterate all the dom to draw the pie-charts
    return this.each(function () {
      if (!$.data(this, 'pieChart')) {
        var userOptions = $.extend({}, options, $(this).data());
        $.data(this, 'pieChart', new pieChart(this, userOptions));
      }
    });
  };

}));