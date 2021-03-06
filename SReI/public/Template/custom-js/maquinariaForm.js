// Contador de campos de checklist
var a = 0;

//Espera la carga del documeto para ejecutar la primer función
$(document).on('ready', mainFunction);

function mainFunction() {
    // Espera un evento de click en el botón con el id 'add' o 'rmv' pra ejecutar
    // una de esas funciones
    $("#add").on('click', addFunction);
    $("#rmv").on('click', rmvFunction);

    initiChecklist(); // función de inicialización
}

// Añade un nuevo campo de cheklist
function addFunction() {
    a = parseInt(a) + parseInt("1"); // Aumenta en uno el contdor de campos

    /*
        Dentro del cotenedor añade la siguiene estructura mediante los append:

        <tr id="rowa">
            <td>
                <div class="form-group">
                    <div class="form-line">
                        <input type="text" class="form-control" name="checklist[]" placeholder="Nombre del campo">
                    </div>
                </div>
            </td>
        </tr>

        Esta es la estructura para un input del arreglo de checklist
        Nota: dentro del id 'rowa' 'a' es un numero entero
    */
    $("#checklist_container").append(
        $('<tr>').attr('id', 'row'+a).append(
            $('<td>').append(
                $('<div>').addClass('form-group').append(
                    $('<div>').addClass('form-line').append(
                        $('<input>').attr('type', 'text')
                        .addClass('form-control').attr('name', 'checklist[]')
                        .attr('placeholder', 'Nombre del campo')
                    )
                )
            )
        )
    );
}

// Disminulle el ultimo campo de checklist que se añadió, dejado siepre al menos uno
function rmvFunction() {

    // Valida que siempre alla al menos un campo de checklist
    if(a > 1) {

        // busca un objeto con el id 'rowa' (donde a es un numero entero) y lo elimina
        $("#row"+a).remove();

        // dismminlle en uno el contador de campos
        a--;
    } else {
        window.alert("Debe de existir al menos un elemento");
    }

}

//Asignación de numero de campos maualmente
function updateCheklist() {

    // remueve todos los campos
    $("#checklist_container").remove();

    // Vuelve a crear la divicón donde se encuentran los campos
    $("#checkList_table").append(
        $('<div>').attr('id', 'checklist_container')
    );

    // Crea el numero de campos indicado
    initiChecklist();
}

function initiChecklist() {
    // Obtiene el numero de campos a crear
    a = document.getElementById('n_checklist').value;

    for(i=1; i<=a; i++) {

        /*
            Crea el numero de campos de checklist con la misma estructura
            mostrada arriba
        */
        $("#checklist_container").append(
            $('<tr>').attr('id','row'+i).append(
                $('<td>').append(
                    $('<div>').addClass('form-group').append(
                        $('<div>').addClass('form-line').append(
                            $('<input>').attr('type', 'text')
                            .addClass('form-control').attr('name', 'checklist[]')
                            .attr('placeholder', 'Nombre del campo')
                        )
                    )
                )
            )
        );
    }
}
