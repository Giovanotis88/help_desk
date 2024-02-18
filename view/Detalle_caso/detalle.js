function init(){
    
}

$(document).ready(function(){
    var id_caso = getUrlParameter('ID');
    listardetalle(id_caso);
        
     $.post("../../controller/caso.php?op=mostrar", {id_caso : id_caso}, function (data){
        data =JSON.parse(data);
        

  

        $(document).ready(function() {
            $('#respuesta').summernote({
                placeholder: 'Describa su Solicitud',
                height: 200,
                lang:"es-ES",
                callbacks:{
                    onImageUpload:function(image){
                        console.log("Imagen Detectada...");
                        myimagetreat(image[0]);
                    },
                    onPaste:function(e){
                        console.log("Text Detectado...");
                    }
                },
        
                toolbar: [
                    
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']]
                  ]  

            });
                $.post("../../controller/estacion.php?op=combo", function(data, status) {
                    $('#id_estacion').html(data);            
                
                });
                $.post("../../controller/grupo.php?op=combo", function(data, status) {
                    $('#id_grupo').html(data);            
                
                });

               

            });
    
        

            $('#desc_solicitud').summernote({
                height: 400,
                lang:"es-ES",
                callbacks:{
                    onImageUpload:function(image){
                        console.log("Imagen Detectada...");
                        myimagetreat(image[0]);
                    },
                    onPaste:function(e){
                        console.log("Text Detectado...");
                    }
                },
        
                toolbar: [
                    
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']]
                  ]    
            });

            $('#desc_solicitud').summernote('disable');

            tabla=$('#documentos_data').dataTable({
                "aProcessing": true,
                "aServerSide": true,
                dom: 'Bfrtip',
                "searching": true,
                lengthChange: false,
                colReorder: true,
                buttons: [
                        'copyHtml5',
                        'excelHtml5',
                        'csvHtml5',
                        'pdfHtml5'
                        ],
                "ajax":{
                    url: '../../controller/documento.php?op=listar',
                    type : "post",
                    data : {id_caso:id_caso},
                    dataType : "json",
                    error: function(e){
                        console.log(e.responseText);
                    }
                },
                "bDestroy": true,
                "responsive": true,
                "bInfo":true,
                "iDisplayLength": 10,
                "autoWidth": false,
                "language": {
                    "sProcessing":     "Procesando...",
                    "sLengthMenu":     "Mostrar _MENU_ registros",
                    "sZeroRecords":    "No se encontraron resultados",
                    "sEmptyTable":     "Ningún dato disponible en esta tabla",
                    "sInfo":           "Mostrando un total de _TOTAL_ registros",
                    "sInfoEmpty":      "Mostrando un total de 0 registros",
                    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix":    "",
                    "sSearch":         "Buscar:",
                    "sUrl":            "",
                    "sInfoThousands":  ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst":    "Primero",
                        "sLast":     "Último",
                        "sNext":     "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                }
            }).DataTable();
        
        });

     

    });
          

    var getUrlParameter = function getUrlParameter(sParam){
    var sPageURL = decodeURIComponent ( window.location.search.substring(1)),
    sURLVariables =sPageURL.split('&'),
    sParameterName,
    i;

    for(i=0; i<sURLVariables.length; i++){
        sParameterName =sURLVariables[i].split('=');

        if(sParameterName[0] == sParam){
            return sParameterName[1] === undefined ? true : sParameterName[1];       
        }
    }
}

$(document).on("click", "#btnenviar", function() {
    id_caso= getUrlParameter('ID');
    id_usuario= $('#id_usuario').val();
    desc_detalle= $('#respuesta').val();
    if ($('#respuesta').summernote('isEmpty')){
        swal("No Es Posible Registrar!", "No Tiene Ninguna Descripción!!", "warning");
    }else{$.post("../../controller/caso.php?op=insertdetalle", {id_caso : id_caso,id_usuario:id_usuario,desc_detalle:desc_detalle}, function (data){
        listardetalle(id_caso);
        $('#respuesta').summernote('reset');
        swal("Correcto!","Se Registro Su Respuesta Correctamente !!","success");
        
});
    }
});
$(document).on("click", "#btncerrar", function() {
    swal({
        title: "Atención",
        text: "¿Está seguro de cerrar el ticket?",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-warning",
        confirmButtonText: "Sí",
        cancelButtonText: "No",
        closeOnConfirm: false
    },
    function(isConfirm) {
        if (isConfirm !== undefined && isConfirm) {
            var id_caso = getUrlParameter('ID');
            var id_usuario = $('#id_usuario').val();
            var desc_detalle = $('#respuesta').val();
            if ($('#respuesta').summernote('isEmpty')) {
                swal("No Es Posible Registrar!", "No Tiene Ninguna Descripción!!", "warning");
            } else {
                var formData = new FormData();
                formData.append('id_caso', id_caso);
                formData.append('id_usuario', id_usuario);
                formData.append('desc_detalle', desc_detalle);
                var totalfiles = $('#fileElem')[0].files.length;
                for (var i = 0; i < totalfiles; i++) {
                    formData.append("files[]", $('#fileElem')[0].files[i]);
                }    
                swal({
                    title: "¡Bien!",
                    text: "Ticket cerrado correctamente.",
                    type: "success",
                    confirmButtonClass: "btn-success"
                });
                $.ajax({
                    url: "../../controller/caso.php?op=actualizar",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        console.log(data);
                        listardetalle(id_caso);
                        $('#fileElem').val('');

                        $.post("../../controller/correo.php?op=ticket_cerrado", {id_caso : id_caso}, function (data){
                            
                        
                    });
                    }
                    
                });
            
            }
        }
    });
    
});


// $(document).on("click", "#btncerrar", function() {
//     console.log("Testcerrar");
  
// });

function listardetalle(id_caso){
   $.post("../../controller/caso.php?op=detalle", {id_caso : id_caso}, function (data){
       $('#contdetalle').html(data);

    });
    $.post("../../controller/caso.php?op=mostrar", {id_caso : id_caso}, function (data){
        data =JSON.parse(data);
        $('#estado').html(data.estado_caso);
        $('#numero_caso').html(data.id_caso);
        $('#fecha').html(data.fecha_creacion);


        $('#tick_titulo').val(data.titulo);
        $('#grupo').val(data.nombre_grupo);
        $('#tick_subcategoria').val(data.nombre_categoria);
        $('#desc_solicitud').summernote('code',data.desc_solicitud);

        console.log( data.estado_caso_texto);
        if (data.estado_caso_texto == "Cerrado"){
            $('#pndetalle').hide();
        }

    });
}

init();