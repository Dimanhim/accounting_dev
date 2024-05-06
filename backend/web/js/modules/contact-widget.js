const widget = (function() {

    let modalId = 'contactWidgetForm';
    let templateId = 'contact_form_template';
    let modalObj = $('#' + modalId);
    let templateObj = $('#' + templateId);
    let contactFormId = 'contact_form';
    let contactForm = $('#' + contactFormId);



    function init() {
        bind();
        initPlugins()
        //modalFormToggle()
    }
    function bind() {
        $(document).on('keyup', '#' + modalId + ' input, ' + '#' + modalId + ' textarea', function(e) {
            e.preventDefault();
            validateContactForm();
        })
        $(document).on('click', '.contact-phone-create-field-o', function(e) {
            e.preventDefault();
            $.ajax({
                url: '/admin/contact-ajax/add-phone-field',
                type: 'POST',
                data: {},
                success: function (res) {
                    if(res.error == 0 && res.data.length) {
                        $('.contact-phone-list-o').append(res.data);
                        initPlugins()
                    }

                },
                error: function () {
                    console.log('Error!');
                }
            });
        }).on('click', '.contact-email-create-field-o', function(e) {
            e.preventDefault();
            $.ajax({
                url: '/admin/contact-ajax/add-email-field',
                type: 'POST',
                data: {},
                success: function (res) {
                    if(res.error == 0 && res.data.length) {
                        $('.contact-email-list-o').append(res.data);
                    }

                },
                error: function () {
                    console.log('Error!');
                }
            });
        }).on('click', '.contact-create-o', function(e) {
            e.preventDefault();
            let type = $(this).attr('data-type')
            let object_id = $(this).attr('data-object_id')
            $.ajax({
                url: '/admin/contact-ajax/create-contact',
                type: 'POST',
                data: {type: type, object_id: object_id},
                success: function (res) {
                    if(res.error == 0 && res.data.length) {
                        templateObj.html(res.data);
                        initPlugins();
                        modalFormToggle()
                    }
                },
                error: function () {
                    console.log('Error!');
                }
            });
        }).on('click', '#' + contactFormId + ' button[type="submit"]', function(e) {
            e.preventDefault();
            submitContactForm()
        }).on('click', '.contact-update-o', function(e) {
            e.preventDefault();
            let contact_id = $(this).attr('data-id')
            $.ajax({
                url: '/admin/contact-ajax/update-contact',
                type: 'POST',
                data: {contact_id: contact_id},
                success: function (res) {
                    if(res.error == 0 && res.data.length) {
                        templateObj.html(res.data);
                        initPlugins();
                        modalFormToggle()
                    }
                },
                error: function () {
                    console.log('Error!');
                }
            });
        }).on('click', '.contact-trash-o', function(e) {
            e.preventDefault();
            if(!confirm('Вы действительно хотите удалить контакт?')) return false;
            let contact_id = $(this).attr('data-id')
            console.log('delete')
            $.ajax({
                url: '/admin/contact-ajax/delete-contact',
                type: 'POST',
                data: {contact_id: contact_id},
                success: function (res) {
                    console.log('res delete', res)
                    if(res.error == 0) {
                        updateContactList(res.data.type, res.data.object_id)
                        displaySuccessMessage(res.message)
                    }
                },
                error: function () {
                    console.log('Error!');
                }
            });
        });
    }


    function modalFormToggle() {
        modalObj.modal('toggle')
    }

    function validateContactForm() {

        let form = $('#' + contactFormId);
        let data = form.serialize();

        $.ajax({
            url: '/admin/contact-ajax/validate-form',
            type: 'POST',
            data: data,
            success: function (res) {
                if(res.error == 1) {
                    disableFormBtn()
                }
                else {
                    enableFormBtn();
                }
            },
            error: function () {
                console.log('Error!');
            }
        });
        return true;
    }

    function updateContactList(type, object_id) {
        if(!type.length || !object_id.length) return false;
        console.log('upd')
        $.ajax({
            url: '/admin/contact-ajax/update-contact-list',
            type: 'POST',
            data: {type: type, object_id: object_id},
            success: function (res) {
                if(res.error == 0 && res.data.length) {
                    $('.contact-table-o').replaceWith(res.data)
                }
            },
            error: function () {
                console.log('Error!');
            }
        });
    }

    function submitContactForm() {
        let form = $('#' + contactFormId);
        let data = form.serialize();

        $.ajax({
            url: '/admin/contact-ajax/submit-form',
            type: 'POST',
            data: data,
            success: function (res) {
                console.log('res submit', res)
                if(res.error == 0 && res.message.length) {
                    displaySuccessMessage(res.message);
                    templateObj.html('');
                    modalFormToggle();
                    updateContactList(res.data.type, res.data.object_id)
                }
                else if(res.message.length) {
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
        let btn = $('#' + contactFormId).find('button[type="submit"]')
        btn.removeAttr('disabled').removeClass('btn-disabled');
    }

    function disableFormBtn() {
        let btn = $('#' + contactFormId).find('button[type="submit"]')
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








