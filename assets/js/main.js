/*
Авторизация клиента
 */

$('.login-btn').click(function (e) {

    //function(e) - действие события по умолчанию не будет выполнено (в данной случае - обновление страницы при нажатии кнопки)
    e.preventDefault();
    $("input").removeClass('error');

    //сбор данных с полей
    let number  = $('input[name="number"]').val(),
        pin  = $('input[name="pin"]').val();

    $.ajax({
        //адрес, на который будет отправлен ajax запрос
        url: 'includes/signin.php',
        //post - метод отправки данных
        type: 'POST',
        dataType: 'json',
        //данные, которые будут отправлены на сервер
        data: {
            number: number,
            pin: pin
        },
        //функция, которая будет вызвана в случае успешного завершения запроса
        success (data){

            if (data.status) {
                console.log("hello");
                document.location.href = 'profile.php'
            } else {
                if(data.type === 1) {
                    data.fields.forEach(function (field) {
                        if (field === 'pin') {
                            $("input[name='pin']").addClass('error');
                        }
                        if (field === 'number') {
                            $("input[name='number']").addClass('error');
                        }

                    })
                }
                $('.msg').removeClass('none').text(data.message);
            }
        }

    });
});
