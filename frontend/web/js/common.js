const common = (function() {

    let modalFormId = 'modalForm';
    let modalResultId = 'modalResult';
    let modalResultObj = $('#' + modalResultId);
    let modalForm = $('#' + modalFormId);
    //let modalForm = new bootstrap.Modal(document.getElementById(modalFormId));
    //let modalResult = new bootstrap.Modal(document.getElementById(modalResultId));
    let modalResult = $('#' + modalResultId);

    let modalResultTitleObj = modalResultObj.find('h5.modal-title-o')
    let modalResultTextObj = modalResultObj.find('.modal-text-o')

    function init() {
        bind();
        setPromoDate();
        initPlugins()
        //showResultModal('пасиба', 'наши специалисты свяжутся с вами')
    }
    function bind() {
        $(document).on('click', '.popup-form', function(e) {
        //$(document).on('click', 'body', function(e) {
            e.preventDefault();
            showModalForm();
        }).on('keyup', '.modalForm input', function() {
            let form = $(this).closest('form');
            validateForm(form)
        }).on('click', '.modalForm button[type="submit"]', function(e) {
            e.preventDefault();
            console.log('submit')
            let form = $(this).closest('form');
            submitForm(form)
        }).on('click', '.modal__cross', function(e) {
            e.preventDefault();
            $('.modal').modal('hide');
        })
    }

    function validateForm(form) {
        clearInfoMessages();
        let data = form.serialize();
        $.ajax({
            url: '/ajax/validate-form',
            type: 'POST',
            data: data,
            success: function (res) {
                console.log('result validate', res)
                if(res.error == 0) {
                    enableFormBtn(form)
                }
                else if(res.message != null) {
                    displayErrorMessage(res.message, form)
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

    function setPromoDate() {
        // Акция - замена даты
        var arr_month = new Array('января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря');
        var date = new Date();
        var month = date.getMonth();
        var day = date.getDate() + 1;
        if(month == 1 && day == 29) {
            day = 1;
            month = month + 1;
        }
        if(day == 31) {
            day = 1;
            month = month + 1;
        }
        month = arr_month[month];
        var text = 'до ' + day + ' ' + month;
        $('.promo').html(text);
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
        modalForm.modal('show');
    }

    function hideModalForm() {
        modalForm.modal('hide')
    }

    function showResultModal(messageTitle, messageText) {
        modalResultTitleObj.html(messageTitle)
        modalResultTextObj.html(messageText)
        modalResult.modal('show');
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

    function displaySuccessMessage(message, form) {
        form.find('.info-message').addClass('success').text(message);
        /*setTimeout(function() {
            $('.info-message').text('').removeClass('error').removeClass('success');
        }, 5000)*/
    }
    function clearInfoMessages() {
        $('.info-message').text('').removeClass('error').removeClass('success');
    }
    function displayErrorMessage(message, form) {
        form.find('.info-message').addClass('error').text(message);
        /*setTimeout(function() {
            $('.info-message').text('').removeClass('error').removeClass('success');
        }, 5000)*/
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








