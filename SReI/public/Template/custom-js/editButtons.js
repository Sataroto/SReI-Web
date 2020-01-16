function edit(id) {

    $("#"+id).find('td').each(function() {
        $(this).find('p').hide();
        $(this).find(".form-group").show();
    }) ;

    $("#"+id).find('#action_buttons').hide();
    $("#"+id).find('#edit_buttons').show();
}

function cancel(id) {
    $("#"+id).find('td').each(function() {
        var text = $(this).find('p').text();
        $(this).find('input').val(text);

        $(this).find('select').val($(this).find('b').text());
        $(this).find('select').change();

        $(this).find('p').show();
        $(this).find(".form-group").hide();
    });

    $("#"+id).find('#action_buttons').show();
    $("#"+id).find('#edit_buttons').hide();
}

function destroy(id) {
    $.ajax({
        url : '/maquinaria/eliminar/'+id,
        method : 'delete',
        success : function(response) {
            console.log(response);
            $("#"+id).remove();
        },
        /*'error':function(x,xs,xt){
            //nos dara el error si es que hay alguno
            window.open(JSON.stringify(x));
            //alert('error: ' + JSON.stringify(x) +"\n error string: "+ xs + "\n error throwed: " + xt);
        }*/
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(jqXHR);
            console.log(textStatus);
            console.log(errorThrown);
        }
    });
}
