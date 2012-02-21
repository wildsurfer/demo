var elements = form.find('[name]');
elements.blur(function(){
    var data = {};
    var id = $(this).parent().prev().find('label').attr('for');
    elements.each(function(){
        data[$(this).attr('name')] = $(this).val();
    });
    console.log(data);
    $.post(url,data,function(resp){
        $('#'+id).parent().find('.errors').remove();
        if (resp && resp[id]) {
            o = '<ul id="errors-' + id + '" class="errors">';
            for (errorKey in resp[id]) {
                o += '<li>' + resp[id][errorKey] + '</li>';
            }
            o += '</ul>';
            $('#'+id).parent().append(o);
        } 
    },'json');
});
