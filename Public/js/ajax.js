$('body').on('click','a',function (e) {
    if($(this).hasClass('wg')){
        e.preventDefault();
        var href = $(this).attr('href');
        $.post(href,'',function (re) {
            if(re.status == 'success'){
                $("#main-content").html(re.data);
            }

        })
    }
})

//custom select box

$(function(){
    $("select.styled").customSelect();
})
