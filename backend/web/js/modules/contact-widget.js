const widget = (function() {

    let modalFormId = 'contactWidgetForm';
    let modalFormObj = $('#' + modalFormId);

    function init() {
        bind();
        initPlugins()
        modalFormToggle()
    }
    function bind() {
        $(document).on('keyup', '#' + modalFormId + ' input, ' + '#' + modalFormId + ' textarea', function(e) {
            e.preventDefault();
            displaySuccessMessage('что то там')
        })
    }



    function modalFormToggle() {
        modalFormObj.modal('toggle')
    }

    function enableFormBtn(form) {
        let btn = form.find('button[type="submit"]')
        btn.removeAttr('disabled').removeClass('btn-disabled');
    }

    function disableFormBtn(form) {
        let btn = form.find('button[type="submit"]')
        btn.attr('disabled', true).addClass('btn-disabled');
    }

    function displaySuccessMessage(message) {
        toastr.success(message)
    }

    function displayErrorMessage(message) {
        toastr.error(message)
    }


    function initPlugins() {
        $(".select-time").inputmask({"mask": "99:99"});
        $(".phone-mask").inputmask({"mask": "+7 (999) 999-99-99"});
    }

    return {
        init: function() {
            init()
        }
    }

})()
widget.init()








