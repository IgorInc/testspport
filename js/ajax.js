/* Article FructCode.com */
$( document ).ready(function() {
    $("#submit_btn").click(
        function(){
            console.log('Нажали кнопку ПРИНЯТЬ');
            sendAjaxForm('result_form', 'form_add_hero', 'add_new_hero.php');//action_ajax_form
            return false;
        }
    );
});

function sendAjaxForm(result_form, ajax_form, url) {
    $.ajax({
        url:     url, //url страницы (action_ajax_form.php)
        type:     "POST", //метод отправки
        data: $("#"+ajax_form).serialize(),  // Сеарилизуем объект
        dataType: "text", //формат данных
//        encode: true,
        success: function(response) { //Данные отправлены успешно
            //console.log('Успешно отправили');
            console.log(response);
            //result = JSON.parse(response);//$.parseJSON(response);
            //$('#result').html(result.otvet);
            $('#result').html(response);
        },
        error: function(response) { // Данные не отправлены
            //console.log('Данные не отправлены.');
            $('#result').html('Ошибка. Данные не отправлены.');
        }
    });
}