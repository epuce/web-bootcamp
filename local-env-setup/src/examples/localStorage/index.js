
$(function () {
    // document.getElementById('save-btn').addEventListener
    $('#save-btn').on('click', function () {
        const $form = $('#user-form');
        const formData = $form.serializeArray();

        if (isFormValid(form)) {
            let userList = localStorage.userList;

            if (userList) {
                userList = JSON.parse(userList);
            } else {
                userList = [];
            }

            formData.find(function (row) { return row.name === 'username' }).value,
                user = formArrayToObject(formData);

            user.username
            const user = {
                username: formData.find(function (row) { return row.name === 'username' }).value,
                email: formData.find((row) => row.name === 'email').value,
            };

            const userId = formData.find((row) => row.name === 'user-id').value;
            if (userId) {
                userList[userId] = JSON.stringify(user);
            } else {
                userList.push(JSON.stringify(user));
            }

            localStorage.userList = JSON.stringify(userList);
            renderTable();
        } else {
        }
    });

    function isFormValid(form) {
        let isFormValid = true;
        const errorMsgBlocks = document.getElementsByClassName('error-msg');

        Object.values(errorMsgBlocks).forEach(function (block) {
            block.innerHTML = '';
        })

        const username = form.namedItem('username').value;
        if (username.length < 6) {
            const errorMsg = document.getElementsByClassName('error-msg username')[0];
            errorMsg.innerHTML = "Min 6 characters for username"
            isFormValid = false;
        }

        const email = form.namedItem('email').value;
        const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

        if (!re.test(email)) {
            const errorMsg = document.getElementsByClassName('error-msg email')[0];
            errorMsg.innerHTML = "Not a valid email"
            isFormValid = false;
        }

        return isFormValid;
    }

    function renderTable() {
        console.log($('.edit-btn'));

        const $tBody = $('#users-table').find('tbody');
        const usersList = localStorage.userList ? JSON.parse(localStorage.userList) : [];

        const $trExample = $('.tr-example');
        $tBody.html('');

        usersList.forEach(function (user, index) {
            const $newTr = $trExample.clone().show();
            user = JSON.parse(user)

            $newTr.find('.username').text(user.username);
            $newTr.find('.email').text(user.email);
            $newTr.find('.edit-btn').attr('user-id', index);
            $newTr.find('.delete-btn').attr('user-id', index);

            $tBody.append($newTr);
        })

        console.log($('.edit-btn'));

        $('.edit-btn').on('click', function () {
            const userId = $(this).attr('user-id');
            const userList = JSON.parse(localStorage.userList);

            let user = userList[userId];
            user = JSON.parse(user);

            const form = document.getElementById('user-form').elements;

            form.namedItem('username').value = user.username
            form.namedItem('email').value = user.email
            form.namedItem('user-id').value = userId
        })

        $('.delete-btn').on('click', function () {
            const userId = $(this).attr('user-id');
            const userList = JSON.parse(localStorage.userList);

            userList.splice(userId, 1);

            localStorage.userList = JSON.stringify(userList);
            renderTable();
        })
    }

    renderTable()
})
