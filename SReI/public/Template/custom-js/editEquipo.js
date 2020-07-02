/**
 * @autor obelmonte
 * @date 26/05/2020
 * @updatedBy obelmonte
 * @update 21/05/2020
 * @version 2.0
 */

var equipo;

$(document).ready(deshabilitarModales())

function deshabilitarModales() {
    $("#edit_nombre_equipo").attr('disabled', 'disabled');
    $("#edit_laboratorio_equipo").attr('disabled', 'disabled');
    $("#edit_fabricante_equipo").attr('disabled', 'disabled');
    $("#edit_modelo_equipo").attr('disabled', 'disabled');
    $("#edit_serie_equipo").attr('disabled', 'disabled');
    $("#edit_descripcion_equipo").attr('disabled', 'disabled');

    $("#btn_editar_equipo").show();
    $("#btn_enviar_equipo").hide();

    $("#btn_cerrar_equipo").show();
    $("#btn_cancelar_equipo").hide();
}

function abrirModal(eq) {
    equipo = eq;
    deshabilitarModales();
    setInfoModal();
}

function setInfoModal() {
    $("#_id_equipo").val(equipo._id);
    $("#edit_nombre_equipo").val(equipo.nombre);
    $("#edit_laboratorio_equipo").val(equipo.laboratorio);
    $("#edit_fabricante_equipo").val(equipo.caracteristicas[0]);
    $("#edit_modelo_equipo").val(equipo.caracteristicas[1]);
    $("#edit_serie_equipo").val(equipo.caracteristicas[2]);
    $("#edit_descripcion_equipo").val(equipo.caracteristicas[3]);
}

function habilitarEdicion() {
    $("#edit_nombre_equipo").removeAttr('disabled');
    $("#edit_laboratorio_equipo").removeAttr('disabled');
    $("#edit_fabricante_equipo").removeAttr('disabled');
    $("#edit_modelo_equipo").removeAttr('disabled');
    $("#edit_serie_equipo").removeAttr('disabled');
    $("#edit_descripcion_equipo").removeAttr('disabled');

    $("#btn_editar_equipo").hide();
    $("#btn_enviar_equipo").show();

    $("#btn_cerrar_equipo").hide();
    $("#btn_cancelar_equipo").show();
}

function cancelarEdicion() {
    setInfoModal();
    deshabilitarModales();
}
