/**
 * @autor obelmonte
 * @date 26/05/2020
 * @updatedBy obelmonte
 * @update 21/05/2020
 * @version 2.0
 */

var equipo;

$(document).ready(deshabilitarModales())

function deshabilitarModales(tipo) {
    $("#edit_nombre_"+tipo).attr('disabled', 'disabled');
    $("#edit_laboratorio_"+tipo).attr('disabled', 'disabled');
    $("#edit_fabricante_"+tipo).attr('disabled', 'disabled');
    $("#edit_modelo_"+tipo).attr('disabled', 'disabled');
    $("#edit_serie_"+tipo).attr('disabled', 'disabled');
    $("#edit_descripcion_"+tipo).attr('disabled', 'disabled');

    $("#btn_editar_"+tipo).show();
    $("#btn_enviar_"+tipo).hide();

    $("#btn_cerrar_"+tipo).show();
    $("#btn_cancelar_"+tipo).hide();
}

function abrirModal(eq) {
    equipo = eq;
    var s = equipo.tipo.split(" ")[0];
    var tipo = s.toLowerCase();
    console.log(equipo.caracteristicas);
    deshabilitarModales(tipo);
    setInfoModal(tipo);
}

function setInfoModal(tipo) {

    $("#_id_"+tipo).val(equipo._id);
    $("#edit_nombre_"+tipo).val(equipo.nombre);
    $('#edit_laboratorio_'+tipo).val(equipo.laboratorio).change();
    $("#edit_fabricante_"+tipo).val(equipo.caracteristicas.fabricante);
    $("#edit_modelo_"+tipo).val(equipo.caracteristicas.modelo);
    $("#edit_serie_"+tipo).val(equipo.caracteristicas.serie);
    $("#edit_descripcion_"+tipo).val(equipo.caracteristicas.descripcion);

}

function habilitarEdicion(tipo) {
    $("#edit_nombre_"+tipo).removeAttr('disabled');
    $("#edit_laboratorio_"+tipo).removeAttr('disabled');
    $("#edit_fabricante_"+tipo).removeAttr('disabled');
    $("#edit_modelo_"+tipo).removeAttr('disabled');
    $("#edit_serie_"+tipo).removeAttr('disabled');
    $("#edit_descripcion_"+tipo).removeAttr('disabled');

    $("#btn_editar_"+tipo).hide();
    $("#btn_enviar_"+tipo).show();

    $("#btn_cerrar_"+tipo).hide();
    $("#btn_cancelar_"+tipo).show();
}

function cancelarEdicion(tipo) {
    setInfoModal(tipo);
    deshabilitarModales(tipo);
}
