function edit(id) {

    $("#"+id).find('td').each(function() {
        var aux = $(this).text();
        var html = '<div class="form-group">';
        html += '<div class="form-line">';
        html += '<input type="text" class="form-control" value='+aux+'>';
        html += '</div></div>';
        $(this).html(html);
    }) ;

    $("#"+id).find('#action_buttons').hide();
    $("#"+id).find('#edit_buttons').show();
}

function cancel(id) {
    $("#"+id).find('td').each(function() {
        var aux = $(this).find('input').val();
        $(this).html(aux);
    });

    $("#"+id).find('#action_buttons').show();
    $("#"+id).find('#edit_buttons').hide();
}
