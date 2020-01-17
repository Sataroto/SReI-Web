clase
function send(id) {
//se crea una variable con un arreglo que contiene los datos del formulario
    var aux= [
        //el simbólo '$' accede a jquery
        //lo que hay entre parentesis busca una etiqueta en especifico según el simbólo
        //si el simbólo es '#' busca un id (que esta concatenado dentro del parentesis)
        //si el simbolo es '.' busca una clase
        //el metodo "find" busca un elemento o tipo de elemento especificado
        //"td:eq(x) busca el x td dentro del elemento con el id especificado"
        //el metodo val obtiene el valor de la etiqueta encontrada
        $('#'+id).find('td:eq(0)').find('input').val(),
        $('#'+id).find('td:eq(1)').find('input').val(),
        $('#'+id).find('td:eq(2)').find('input').val(),
        $('#'+id).find('td:eq(3)').find('select').val(),
        $('#'+id).find('td:eq(4)').find('select').val()
    ];

    //ajax genera y envia consultas al controlador para acceder a la base de datos o cambiar una vista
    //inicio del ajax
    $.ajax(
        //inicio del json
        {
        url : '/tarjetas-programables/edit/'+id,
        //es el mismo moetodo con el que se especifica la ruta
        method : 'patch',
        data : {
            // se asignan los valores obtenidos en el arreglo anterior a las variables
            nombre: aux[0],
            fabricante: aux[1],
            modelo: aux[2],
            estado: aux[3],
            laboratorio: aux[4]
        },
        //espera un exito
        success : function(response){
            //console.log imprime la variable response
            console.log(response);
            location.reload();
        },
        //espera un error
        error : function(jqXHR, textStatus, errorThrown){
            console.log(jqXHR);
            console.log(textStatus);
            console.log(errorThrown);
        }
    }//fin del Json
    );
    //fin del ajax
}
