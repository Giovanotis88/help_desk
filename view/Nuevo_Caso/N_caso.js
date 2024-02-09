function init (){
    $("#caso_form").on("submit",function(e){
        guardaryeditar(e);
    });
}

// var grupoSelect = document.getElementById('grupoSelect');
// var categoriaSelect = document.getElementById('categoriaSelect');

// var categoriasPorGrupo = {
//     equipoMenor: ['(EQ) EQUIPOS TRANSVERSALES', '(RES) RESPIRACION AUTONOMA', '(CI) CILINDROS','(EX) EXTINTORES','(EE) EQUIPOS ESPECIALES','(RV) RESCATE VEHICULAR','(EN) NEUMATICOS','CONSULTAS'],
//     parqueAutomotor: ['Categoría4', 'Categoría5', 'Categoría6'],
//     combustible: ['Categoría7', 'Categoría8', 'Categoría9'],
//     log: ['Categoría10', 'Categoría11', 'Categoría12'],
//     consulta: ['Categoría13', 'Categoría14', 'Categoría15'],
//     alimentacion: ['Categoría16', 'Categoría17', 'Categoría18'],
//     transporte: ['Categoría19', 'Categoría20', 'Categoría21'],
//     gestion: ['Categoría22', 'Categoría23', 'Categoría24']
// };

// function actualizarCategorias() {
   
//     categoriaSelect.innerHTML = '';

 
//     var grupoSeleccionado = grupoSelect.value;

   
//     var categorias = categoriasPorGrupo[grupoSeleccionado];

    
//     if (categorias && categorias.length > 0) {
        
//         categorias.forEach(function(categoria) {
//             var opcion = document.createElement('option');
//             opcion.textContent = categoria;
//             categoriaSelect.appendChild(opcion);
//         });
//     } else {
//         console.error('No se encontraron categorías para el grupo seleccionado');
//     }
// }


// grupoSelect.addEventListener('change', actualizarCategorias);


// actualizarCategorias();

$(document).ready(function() {
    $('#desc_solicitud').summernote({
        placeholder: 'Describa su Solicitud',
        height: 200,
        lang:"es-ES", });
        $.post("../../controller/estacion.php?op=combo", function(data, status) {
            $('#id_estacion').html(data);            
        
        });
        $.post("../../controller/grupo.php?op=combo", function(data, status) {
            $('#id_grupo').html(data);            
        
        });
        $("#id_grupo").change(function(){
            id_grupo = $(this).val();
                $.post("../../controller/categoria.php?op=combo",{id_grupo : id_grupo},function(data, status){
                 $('#id_categoria').html(data);
            });
        });          
        
        });

 

function guardaryeditar(e){
    e.preventDefault();
    var formData = new FormData($("#caso_form")[0]);
    
    if ($('#desc_solicitud').summernote('isEmpty')||$('#titulo').val()==''||$('#nombre_solicitante').val()==''||$('#id_estacion').val()==''){
        
        swal("No Es Posible Registrar!", "Campos Incompletos, Por Favor validar !!", "warning");
    }else{
    $.ajax({
        url: "../../controller/caso.php?op=guardar",
        type:"POST",
        data: formData,
        contentType: false,
        processData:false,
        success: function(datos){
            console.log(datos);
            $('#id_categoria').val('');
            $('#id_grupo').val('');
            $('#id_estacion').val('');
            $('#nombre_solicitante').val('');
            $('#titulo').val('');
            $('#desc_solicitud').summernote('reset');
            swal("Correcto!","Caso Registrado Correctamente !!","success");
        }
    });

    }


}

init();







        
 