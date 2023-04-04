(() => {
    const forms = document.querySelectorAll('.needs-validation')
    const element = document.getElementById('spinner');

    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {

            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            } else {
                event.preventDefault()
                event.stopPropagation()
                getLoader();
                $.ajax({
                    url: 'result.php', type: 'POST', data: $('#form').serialize(), before: function () {
                        element.classList.remove('spinner-active');
                    }, success: function (response) {
                        element.classList.add('spinner-active');
                        let res = JSON.parse(response);
                        console.log(res)
                        if (res.answer == 'ok') {
                            $('#form').removeClass('was-validated').trigger('reset');
                            $('#label-captcha').text(res.captcha);
                            $('#answer').html(`<div class="alert alert-success text-center" role="alert">Все получилось!</div>`)

                        } else {
                            $('#answer').html(`<div class="alert alert-danger" role="alert">${res.errors}</div>`)
                        }
                    }, error: function () {
                        $('#answer').html(`<div class="alert alert-danger" role="alert">Что-то пошло не так!</div>`)
                    }
                })
            }
            form.classList.add('was-validated')
        }, false)
    })

    function getLoader() {
        const element = document.getElementById('spinner');
        element.classList.remove('spinner-active');
    }
})()


