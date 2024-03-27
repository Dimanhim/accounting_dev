const common = (function() {

    let modalFormId = 'modalForm';
    let modalResultId = 'modalResult';
    let modalFormObj = $('#' + modalFormId);
    let modalResultObj = $('#' + modalResultId);
    let modalForm = new bootstrap.Modal(document.getElementById(modalFormId));
    let modalResult = new bootstrap.Modal(document.getElementById(modalResultId));

    let modalResultTitleObj = modalResultObj.find('h5.modal-title-o')
    let modalResultTextObj = modalResultObj.find('.modal-text-o')

    function init() {
        bind();
        initPlugins()
        //showResultModal('пасиба', 'наши специалисты свяжутся с вами')
    }
    function bind() {
        $(document).on('click', '.popup-form', function(e) {
            e.preventDefault();
            showModalForm();
        }).on('change', '.modalForm input', function() {
            let form = $(this).closest('form');
            validateForm(form)
        }).on('click', '.modalForm button[type="submit"]', function(e) {
            e.preventDefault();
            console.log('submit')
            let form = $(this).closest('form');
            submitForm(form)
        })
    }

    function validateForm(form) {
        let data = form.serialize();
        $.ajax({
            url: '/ajax/validate-form',
            type: 'POST',
            data: data,
            success: function (res) {
                console.log('res validate', res);
                if(res.error == 0) {
                    enableFormBtn(form)
                }
                else if(res.message != null) {
                    displayErrorMessage(res.message)
                    disableFormBtn(form)
                }
                else {
                    disableFormBtn(form)
                }
            },
            error: function () {
                console.log('Error!');
            }
        });
    }

    function submitForm(form) {
        let data = form.serialize();
        $.ajax({
            url: '/ajax/submit-form',
            type: 'POST',
            data: data,
            success: function (res) {
                console.log('res submit', res);
                if(res.error == 0) {
                    hideModalForm()
                    showResultModal('Ваша заявка успешно отправлена', 'Наши специалисты свяжутся с Вами в ближайшее время')
                }
                else {
                    hideModalForm()
                    showResultModal('Ошибка отправки формы', 'Пожалуйста, попробуйте позднее')
                    disableFormBtn(form)
                }
            },
            error: function () {
                console.log('Error!');
            }
        });
    }

    function enableFormBtn(form) {
        let btn = form.find('button[type="submit"]')
        btn.removeAttr('disabled').removeClass('btn-disabled');
    }

    function disableFormBtn(form) {
        let btn = form.find('button[type="submit"]')
        btn.attr('disabled', true).addClass('btn-disabled');
    }

    function showModalForm() {
        modalForm.show();
    }

    function hideModalForm() {
        modalForm.hide()
    }

    function showResultModal(messageTitle, messageText) {
        modalResultTitleObj.html(messageTitle)
        modalResultTextObj.html(messageText)
        modalResult.show();
    }

    function addPreloader() {
        setTimeout(function() {
            $('.loader-block').addClass('loader');
        }, 500);
    }
    function removePreloader() {
        setTimeout(function() {
            $('.loader-block').removeClass('loader');
        }, 500)
    }

    function displaySuccessMessage(message) {
        $('.info-message').text(message).fadeIn();
        setTimeout(function() {
            $('.info-message').text('').fadeOut();
        }, 5000)
    }
    function displayErrorMessage(message) {
        $('.info-message').addClass('error').text(message).fadeIn();
        setTimeout(function() {
            $('.info-message').text('').fadeOut();
        }, 5000)
    }

    function initPlugins() {
        //$('.chosen').chosen()
        $(".select-time").inputmask({"mask": "99:99"});
        $(".phone-mask").inputmask({"mask": "+7 (999) 999-99-99"});
    }

    return {
        init: function() {
            init()
        }
    }

})()
common.init()








