$(document).ready(function() {
    $(document).on('click','.slider_nav_dot',
        function(e){
            let page = {slider:$(this).index()+1};
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
            $(res).html(response);
        },
        error: function(response){
            $(res).html(response);
        }
    });
}

function sendAjaxForm(result_form, ajax_form, url) {
    $.ajax({
        url: url, //url страницы (action_ajax_form.php)
        type: "POST", //метод отправки
        data: $("#"+ajax_form).serialize(),  // Сеарилизуем объект
        dataType: "text", //формат данных
        success: function(response) { //Данные отправлены успешно
            $('#result').html(response);
            let page = {slider:1};
            getHeroes('.header_slider', page, 'get_heroes.php');
        },
        error: function(response) { // Данные не отправлены
            $('#result').html('Ошибка. Данные не отправлены.');
        }
    });
}