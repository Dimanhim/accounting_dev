const widget = (function() {


    let formId = 'quiz-form';
    let resultFormId = 'quiz-form-result';

    let quiz_block_class = 'quiz-content';



    function init() {
        initPlugins();
        bind();
    }
    function bind() {
        $(document).on('change', '#' + formId + ' input', function(e) {
            e.preventDefault();
            validateForm();
        }).on('click', '#' + formId + ' button[type="submit"]', function(e) {
            e.preventDefault();
            submitQuestionForm()
        }).on('keyup', '#' + resultFormId + ' input', function(e) {
            e.preventDefault();
            validateResultForm()
        }).on('click', '#' + resultFormId + ' button[type="submit"]', function(e) {
            e.preventDefault();
            submitResultForm()
        })
    }

    function validateForm() {

        let inputs = $('#' + formId + ' input');
        let checked = false;

        inputs.each(function(index, element) {
            let el = $(element);
            if(el.is(':checked')) {
                checked = true;
            }
        })

        if(checked) {
            enableFormBtn();
        }
        else {
            disableFormBtn();
        }
    }

    function validateResultForm() {
        let form = $('#' + resultFormId);
        let data = form.serialize();

        $.ajax({
            url: '/ajax-quiz/validate-result-form',
            type: 'POST',
            data: data,
            success: function (res) {
                if(res.error == 0) {
                    enableFormBtn()
                }
            },
            error: function () {
                console.log('Error!');
            }
        });
    }

    function submitResultForm() {
        let form = $('#' + resultFormId);
        let data = form.serialize();

        $.ajax({
            url: '/ajax-quiz/submit-result-form',
            type: 'POST',
            data: data,
            success: function (res) {
                console.log('res submit', res);
                if(res.error == 0 && res.data != null) {
                    $('.' + quiz_block_class).html(res.data)
                }
            },
            error: function () {
                console.log('Error!');
            }
        });
    }

    function submitQuestionForm() {
        let form = $('#' + formId);
        let data = form.serialize();

        $.ajax({
            url: '/ajax-quiz/submit-form',
            type: 'POST',
            data: data,
            success: function (res) {
                if(res.error == 0 && res.message != null && res.data != null) {
                    $('.' + quiz_block_class).html(res.data)
                    displaySuccessMessage(res.message);
                    initPlugins()
                }
                else if(res.message != null) {
                    displayErrorMessage(res.message)
                }
                else {
                    displayErrorMessage('Произошла ошибка добавления контакта')
                }
            },
            error: function () {
                console.log('Error!');
            }
        });
        return true;
    }

    function enableFormBtn() {
        let btn = $('#' + formId + ' button[type="submit"]');
        if(btn.length) btn.removeAttr('disabled').removeClass('btn-disabled');

        btn = $('#' + resultFormId + ' button[type="submit"]');
        if(btn.length) btn.removeAttr('disabled').removeClass('btn-disabled');
    }

    function disableFormBtn() {
        let btn = $('#' + formId + ' button[type="submit"]');
        if(btn.length) btn.attr('disabled', true).addClass('btn-disabled');

        btn = $('#' + formId + ' button[type="submit"]');
        if(btn.length) btn.attr('disabled', true).addClass('btn-disabled');
    }

    function displaySuccessMessage(message) {
        toastr.success(message)
    }

    function displayErrorMessage(message) {
        toastr.error(message)
    }

    function initPlugins() {
        $(".phone-mask").inputmask({"mask": "+7 (999) 999-99-99"});
    }

    return {
        init: function() {
            init()
        }
    }

})()
widget.init()








