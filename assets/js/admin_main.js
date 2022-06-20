/*
Авторизация админа
 */

$('.admin-btn').click(function (e) {

    //function(e) - действие события по умолчанию не будет выполнено (в данной случае - обновление страницы при нажатии кнопки)
    e.preventDefault();
    $("input").removeClass('error');

    //сбор данных с полей
    let atm_number  = $('input[name="atm_number"]').val(),
        atm_password  = $('input[name="atm_password"]').val();

    $.ajax({
        //адрес, на который будет отправлен ajax запрос
        url: 'includes/admin_signin.php',
        //post - метод отправки данных
        type: 'POST',
        dataType: 'json',
        //данные, которые будут отправлены на сервер
        data: {
            atm_number: atm_number,
            atm_password: atm_password
        },
        //функция, которая будет вызвана в случае успешного завершения запроса
        success (data){

            if (data.status) {
                console.log("hello");
                document.location.href = 'admin_profile.php'
            } else {
                if(data.type === 1) {
                    data.fields.forEach(function (field) {
                        if (field === 'atm_password') {
                            $("input[name='atm_password']").addClass('error');
                        }
                        if (field === 'atm_number') {
                            $("input[name='atm_number']").addClass('error');
                        }

                    })
                }
                $('.msg').removeClass('none').text(data.message);
            }
        }

    });
});
