$.ajaxSetup({
     headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     }
 });

function send(id) {

    var aux = [
        $('#'+id).find('td:eq(0)').find('input').val(),
        $('#'+id).find('td:eq(1)').find('input').val(),
        $('#'+id).find('td:eq(2)').find('input').val(),
        $('#'+id).find('td:eq(3)').find('select').val(),
        $('#'+id).find('td:eq(4)').find('select').val()
    ];

    $.ajax({
        url : '/maquinaria/edit/'+id,
        method : 'patch',
        data : {
            nombre : aux[0],
            fabricante : aux [1],
            modelo : aux[2],
            estado : aux[3],
            laboratorio : aux[4]
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
