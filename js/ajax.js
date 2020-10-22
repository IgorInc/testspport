/* Article FructCode.com */
$(document).ready(function() {
    /*
    $("#submit_btn").click(
        function(){
            console.log('Нажали кнопку ПРИНЯТЬ');
            sendAjaxForm('result_form', 'form_add_hero', 'add_new_hero.php');//action_ajax_form
            return false;
        }
    );
     */
    //let i = $('.slider_nav').find('.slider_nav_dot').first().index()-1;

    $(document).on('click','.slider_nav_dot',
        function(e){
            //console.log($('.slider_nav').find('.slider_nav_dot').first().index());
            console.log('Клик');
            //console.log('Нажали переключение слайда № ' + $(this).index()-i);
           //alert('Нажали переключение слайда № ' + $(this).index()-i);
            //$('.slider_nav').
            let page = {slider:$(this).index()+1};
            console.log('Страница = ' + ($(this).index()+1));
            getHeroes('.header_slider', page, 'get_heroes.php');
        }
    );
});

function getHeroes(res, page, url){
    $.ajax({
        url: url,
        type: "POST",
        data: page,
        dataType: "html",
        success: function(response){
            console.log('Успешно получили профили.');
            $(res).html(response);
        },
        error: function(response){
            console.log('Ошибка: не смогли получить профили.');
            $(res).html(response);
        }
    });
}

function sendAjaxForm(result_form, ajax_form, url) {
    //console.log($(#myDropzone).files);
    $.ajax({
        url: url, //url страницы (action_ajax_form.php)
        type: "POST", //метод отправки
        data: $("#"+ajax_form).serialize(),  // Сеарилизуем объект
        dataType: "text", //формат данных
        success: function(response) { //Данные отправлены успешно
            //console.log('Успешно отправили');
            console.log(response);
            //result = JSON.parse(response);//$.parseJSON(response);
            //$('#result').html(result.otvet);
            $('#result').html(response);
            let page = {slider:1};
            getHeroes('.header_slider', page, 'get_heroes.php');
        },
        error: function(response) { // Данные не отправлены
            //console.log('Данные не отправлены.');
            $('#result').html('Ошибка. Данные не отправлены.');
        }
    });
}