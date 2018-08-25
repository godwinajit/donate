;(function($) {
    'use strict';

    var Steps = (function() {
        var defaults = {
            steps: '.step',
            btnNext: '.next',
            transition: 'none',
            activeClass: 'active-step',
            isCanChange: function(curentStepIndex, nextStepIndex) { return true; },
            onChange: function(currentIndex, oldIndex) {}
        };

        var transitionEffect = {
            none: function($curentStep, $nextStep) {
                $curentStep.hide();
                $nextStep.show();
            }
        };

        function Steps(holder, options) {
            var self = this;
            self.$holder = $(holder);
            self._options = $.extend({}, defaults, options);
            self._steps = $(self._options.steps);

            if (!self._steps.length) {
                console.error(new Error('Steps is not defined'));
                return;
            }

            self._currentIndex = 0;

            self._steps.eq(self._currentIndex).addClass(self._options.activeClass);

            self.$holder.on('click', self._options.btnNext, function(e) {
                e.preventDefault();
                self.nextStep();
            });
        }

        Steps.setTransition = function(transition) {
            if (!$.isPlainObject(transition)) {
                console.warn('Not valid data');
                return;
            }

            Object.keys(transition).forEach(function(transitionKey) {
                if (transitionEffect[transitionKey]) {
                    console.warn('Transition effect ' + transitionKey + ' already exist');
                    return;
                }

                if ($.isFunction(transition[transitionKey])) {
                    transitionEffect[transitionKey] = transition[transitionKey];
                } else {
                    console.warn(transitionKey + ' is not a function');
                }
            });
        };

        Steps.prototype.toStep = function(nextIndexStep) {
            var self = this;
            if (self.isCanChange || nextIndexStep < 0 || nextIndexStep > self._steps.length - 1) {
                return;
            }

            var oldIndexStep = self._currentIndex;
            var $curentStep = self._steps.eq(oldIndexStep);
            var $nextStep = self._steps.eq(nextIndexStep);
            var done = function() {
                transitionEffect[self._options.transition]($curentStep, $nextStep);
                $curentStep.removeClass(self._options.activeClass);
                $nextStep.addClass(self._options.activeClass);
                self._currentIndex = nextIndexStep;
                self._options.onChange.call(self, nextIndexStep, oldIndexStep);
                self.isCanChange = null;
            };

            self.isCanChange = self._options.isCanChange.call(self, oldIndexStep, nextIndexStep);

            if ($.isFunction(self.isCanChange.then)) {
                self.isCanChange.then(function() {
                    done();
                }).fail(function(error) {
                    if (error) {
                        console.error(error);
                    }
                    self.isCanChange = null;
                });
            } else if (self.isCanChange) {
                done();
            }
        };

        Steps.prototype.nextStep = function() {
            this.toStep(this._currentIndex + 1);
        };

        Steps.prototype.prevStep = function() {
            this.toStep(this._currentIndex - 1);
        };

        Steps.prototype.stepsLength = function() {
            return this._steps.length;
        };

        Steps.prototype.getCurrentStep = function() {
            return this._steps.eq(this._currentIndex);
        };

        return Steps;
    }());

    window.Steps = Steps;
}(jQuery));