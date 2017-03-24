'use strict';

angular.module('app.contratos').directive('cambioEquipoWizard', function () {
        return {
            restrict: 'A',
            scope: {
                'cambioEquipoWizardCallback': '&',
                'contratoCliente': '='
            },
            link: function (scope, element, attributes) {

                var stepsCount = $('[data-smart-wizard-tab]').length;
                
                var currentStep = 1;

                var validSteps = [];

                var $form = element.closest('form');

                var $prev = $('[data-smart-wizard-prev]', element);

                var $next = $('[data-smart-wizard-next]', element);
                $("#equipo").select2({width:'100%',containerCss:{'padding':'0px','display':'block'},dropdownCss:{'width':'60%'}});
                $("#equipo").select2('container').find('.select2-choice').css({'height':'100%','padding-top':'6px'});
                function setStep(step) {
                    currentStep = step;
                    $('[data-smart-wizard-pane=' + step + ']', element).addClass('active').siblings('[data-smart-wizard-pane]').removeClass('active');
                    $('[data-smart-wizard-tab=' + step + ']', element).addClass('active').siblings('[data-smart-wizard-tab]').removeClass('active');

                    $prev.toggleClass('disabled', step == 1)
                }


                element.on('click', '[data-smart-wizard-tab]', function (e) {
                    setStep(parseInt($(this).data('smartWizardTab')));
                    e.preventDefault();
                });
                
                $next.on('click', function (e) {
                    
                    if ($form.data('validator')) {
                        if (!$form.valid()) {
                            validSteps = _.without(validSteps, currentStep);
                            $form.data('validator').focusInvalid();
                            return false;
                        } else {
                            
                            
                             switch (currentStep) {
                              case 1:
                                console.log("Paso 1 Post Validacion");
                                break;
                              case 3:
                                console.log(currentStep);    
                                console.log("Paso 3 Intento de Validacion");
                                break;
                            }
                            
                            validSteps = _.without(validSteps, currentStep);
                            validSteps.push(currentStep);
                            element.find('[data-smart-wizard-tab=' + currentStep + ']')
                                .addClass('complete')
                                .find('.step')
                                .html('<i class="fa fa-check"></i>');
                        }
                    }
                    if (currentStep < stepsCount) {
                        setStep(currentStep + 1);
                    } else {
                        if (validSteps.length < stepsCount) {
                            var steps = _.range(1, stepsCount + 1)

                            _(steps).forEach(function (num) {
                                if (validSteps.indexOf(num) == -1) {
                                    console.log(num);
                                    setStep(num);
                                    return false;
                                }
                            })
                        } else {
                            var data = {};
                            _.each($form.serializeArray(), function(field){
                                data[field.name] = field.value
                            });
                            if(typeof  scope.contratoWizardCallback() === 'function'){
                                scope.contratoWizardCallback()(data)
                            }
                        }
                    }

                    e.preventDefault();
                });

                $prev.on('click', function (e) {
                    if (!$prev.hasClass('disabled') && currentStep > 0) {
                        setStep(currentStep - 1);
                    }
                    e.preventDefault();
                });


                setStep(currentStep);

            }
        }
    });
