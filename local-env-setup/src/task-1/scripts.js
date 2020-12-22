$(function () {
    var $asideBackdrop = $('.aside-backdrop');
    var $aside = $('#aside');
    var $subscribeBtn = $('#subscribe-btn');
    var $subscribeForm = $aside.find('form');
    var $specialDeals = $aside.find('.special-deals');
    var $extraFields = $aside.find('.extra-fields');
    var $toggleSidebar = $aside.find('.toggle-sidebar');

    var $listTable = $('.list-table');

    var $popupWrapper = $('.popup-wrapper');
    var $popup = $('#popup');
    var $popupClose = $popup.find('button');
    var $popupContent = $popup.find('.content');

    $subscribeBtn.on('click', function () {
        if (!isFormValid()) {
            return;
        }

        var data = localStorage.data ? JSON.parse(localStorage.data) : [];
        var form = $subscribeForm.serializeArray();
        var obj = formArrayToObject(form);

        data.push(JSON.stringify(obj));

        localStorage.data = JSON.stringify(data);

        openPopup(obj.username);
    });

    $toggleSidebar.on('click', function () {
        toggleForm();
    });

    $specialDeals.on('click', function () {
        $extraFields.toggle($(this).find('input').is(':checked'))
    });

    $popupClose.on('click', closePopup);

    function closePopup() {
        $popupWrapper.fadeOut();

        toggleForm();
        clearForm();
        renderFormValues();
    }

    $subscribeForm.find('input').on('focus', function () {
        var $this = $(this);
        $this.removeClass('error');
        $this.siblings('.error-box').text('');
    });

    function addDeleteBtnListener() {
        $listTable.find('.delete').on('click', function () {
            var $this = $(this);
            var index = $this.data('index') || $this.closest('td').data('index');
            var data = JSON.parse(localStorage.data);

            data.splice(index, 1);

            localStorage.data = JSON.stringify(data);
            renderFormValues();
        })
    }

    function toggleForm() {
        if ($aside.hasClass('close')) {
            $asideBackdrop.add($aside).removeClass('close').addClass('open');
        } else {
            $asideBackdrop.add($aside).removeClass('open').addClass('close');
        }
    }

    function clearForm() {
        $subscribeForm.trigger('reset');
        $extraFields.toggle($(this).find('input').is(':checked'))
    }

    document.addEventListener('keyup', function (event) {
        if ($('.popup-wrapper').is(':visible') && event.keyCode === 27) {
            closePopup();
        }
    })

    function renderFormValues() {
        var data = localStorage.data ? JSON.parse(localStorage.data) : [];
        $listTable.find('tbody').html('');

        if (data.length) {
            $listTable.show()
        } else {
            $listTable.hide()
        }

        data.forEach(function (row, index) {
            const user = JSON.parse(row)
            var html = '<tr>'
                +
                '<td>' + index + '</td>'
                +
                '<td>' + (user.username || '') + '</td>'
                +
                '<td>' + (user.email || '') + '</td>'
                +
                '<td>' + (user.areSpecialDeals || '') + '</td>'
                +
                '<td>' + (user.areSpecialDeals ? user.specialDealsTimeCircle : '') + '</td>'
                +
                '<td data-index="' + index + '" class="actions"><i class="delete fa fa-times"></i></td>'
                +
                '</tr>';

            $listTable.find('tbody').append(html);
        });

        addDeleteBtnListener();
    }

    function isFormValid() {
        var isFormValid = true;
        var form = $subscribeForm.serializeArray();
        var obj = formArrayToObject(form);
        var $usernameInput = $subscribeForm.find('[name=username]');
        var $emailInput = $subscribeForm.find('[name=email]');

        if (!obj.username) {
            $usernameInput.addClass('error');
            $usernameInput.siblings('.error-box').text('Required');

            isFormValid = false;
        } else if (obj.username.length < 4) {
            $usernameInput.addClass('error');
            $usernameInput.siblings('.error-box').text('Minimum 4 characters');

            isFormValid = false;
        }

        if (!obj.email) {
            $emailInput.addClass('error');
            $emailInput.siblings('.error-box').text('Required');

            isFormValid = false;
        } else if (!validateEmail(obj.email)) {
            $emailInput.addClass('error');
            $emailInput.siblings('.error-box').text('Not a valid email');

            isFormValid = false;
        }


        return isFormValid;
    }

    function openPopup(username) {
        $popupContent.text('Thank you for Subscribing, ' + username + '!');

        $popupWrapper.fadeIn();
    }

    function formArrayToObject(form) {
        var obj = {};

        Object.keys(form).forEach(function (key) {
            obj[form[key].name] = form[key].value
        });

        return obj;
    }

    function validateEmail(email) {
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    }

    renderFormValues();
});