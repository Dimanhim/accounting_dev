const common = (function() {

    function init() {
        bind();
        initPlugins()
        //showResultModal('пасиба', 'наши специалисты свяжутся с вами')
    }
    function bind() {
        $(document).on('click', '.class', function(e) {
            e.preventDefault();

        }).on('change', '.class input', function() {
            e.preventDefault();
        })
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
        $('.chosen').chosen()
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








