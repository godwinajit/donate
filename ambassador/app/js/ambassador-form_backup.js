jQuery(function($) {
    var $form = $('#ambassador-form');

    if(!$form.length) return;

    var validator = $form.validate({
        errorPlacement: (function() {
            var timer;
            return function(error, element) {
                clearTimeout(timer);
                timer = setTimeout(function() {
                    $(element).closest('.ambassador-form-step').find('.form-note').show();
                }, 50);
            };
        }()),
        errorClass: 'error',
        validClass: 'valid'
    });

    $form.on('submit', function(e) {
        //e.preventDefault();

        if ($form.valid()) {
            $form.addClass('sending');

/*
            $.post($form.attr('action'), $form.serialize()).done(function() {
                stepper.nextStep();
                e.currentTarget.reset();
                validator.resetForm();
                $form.find('.form-note').hide();
            }).fail(function(error) {
                console.error(error);
            }).always(function() {
                $form.removeClass('sending');
            });
			*/
        }
    });

    $(document).on('click', '.ambassador-form-nav > li', function(e) {
        e.preventDefault();
        var $li = $(this),
            liIndex = $li.index();

        if (liIndex < stepper._currentIndex) {
            stepper.toStep(liIndex);
        } else if (liIndex > stepper._currentIndex) {
            if (liIndex === stepper.stepsLength() - 1 && stepper._currentIndex === stepper.stepsLength() - 2) {
                $form.submit();
            } else {
                stepper.nextStep();
            }
        }
    });

    // stepper
    var stepper = new Steps('#ambassador-form', {
        steps: '.ambassador-form-step',
        btnNext: '.js-btn-step-next',
        activeClass: 'active',
        isCanChange: function(curentStepIndex, nextStepIndex) {
            if (curentStepIndex < nextStepIndex) {
                return $form.valid();
            } else {
                return true;
            }
        },
        onChange: function(currentStepIndex, oldStepIndex) {
            var $lis = $('.ambassador-form-nav > li'),
                $li = $lis.eq(currentStepIndex);

            $li.prevAll().removeClass('step-active').addClass('step-passed');
            $li.nextAll().removeClass('step-active').removeClass('step-passed');
            $li.addClass('step-active');
        }
    });
});
