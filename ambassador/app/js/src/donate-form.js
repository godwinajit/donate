jQuery(function($) {
    var $form = $('#donate-form');

    var validator = $form.validate({
        errorPlacement: (function() {
            var timer;
            return function(error, element) {
                clearTimeout(timer);
                timer = setTimeout(function() {
                    $(element).closest('.donate-form-step').find('.form-note').show();
                }, 50);
            };
        }()),
        errorClass: 'error',
        validClass: 'valid',
        ignore: function(i, field) {
            return $(field).is(':disabled,:hidden') ||
                !$(field).closest('.donate-form-step').is(stepper.getCurrentStep()) ||
                !!$(field).closest('.js-slide-hidden').length;
        }
    });

    $form.on('submit', function(e) {
        e.preventDefault();
        if ($form.valid()) {
            $form.addClass('sending');

            $.post($form.attr('action'), $form.serialize()).done(function() {
            	console.log("aaaaaaaaaaa"+$form.attr('action'));
                stepper.nextStep();
                e.currentTarget.reset();
                validator.resetForm();
                $form.find('.form-note').hide();
            }).fail(function(error) {
                console.error(error);
            }).always(function() {
                $form.removeClass('sending');
            });
        }
    });

    $form.on('click', '.donate-sum-box', function(e) {
        e.preventDefault();
        $form.find('[name^="donate-sum-"]').val(this.dataset.donateSum);
        stepper.nextStep();
    });

    $form.on('change', '[name^="donate-sum-"]', function(e) {
        var value = e.currentTarget.value;
        $form.find('[name^="donate-sum-"]').not(e.currentTarget).val(value);
    });

    $(document).on('click', '.donate-form-nav > li', function(e) {
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
    var stepper = new Steps('#donate-form', {
        steps: '.donate-form-step',
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
            var $lis = $('.donate-form-nav > li'),
                $li = $lis.eq(currentStepIndex);

            $li.prevAll().removeClass('step-active').addClass('step-passed');
            $li.nextAll().removeClass('step-active').removeClass('step-passed');
            $li.addClass('step-active');
        }
    });
});
