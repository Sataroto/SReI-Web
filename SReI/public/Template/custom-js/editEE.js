$.ajaxSetup({
     headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     }
 });

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

function send(id) {

    var aux = [
        $('#'+id).find('td:eq(0)').find('input').val(),
        $('#'+id).find('td:eq(1)').find('input').val(),
        $('#'+id).find('td:eq(2)').find('input').val(),
        $('#'+id).find('td:eq(3)').find('select').val(),
        $('#'+id).find('td:eq(4)').find('select').val(),
        $('#'+id).find('td:eq(5)').find('textarea').val(),
        $('#'+id).find('td:eq(6)').find('input').val(),
        $('#'+id).find('td:eq(7)').find('input').val(),
    ];

    $.ajax({
        url : '/equipoElectronica/edit/'+id,
        method : 'patch',
        data : {
            nombre : aux[0],
            fabricante : aux [1],
            modelo : aux[2],
            estado : aux[3],
            laboratorio : aux[4],
            descripcion : aux[5],
            numeroSerie : aux[6],
            procedencia : aux[7]
        },
        cache : false,
        success : function(response) {
            console.log(response);
            location.reload();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(jqXHR);
            console.log(textStatus);
            console.log(errorThrown);
        }
    });
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
