
var tabla;


function init(){
    $("#form_usuario").on("submit",function(e){
        crear_usuario(e);

    });
    function crear_usuario(e){
        e.preventDefault();
        var formData = new FormData($("#form_usuario")[0]);
        $.ajax({
            url: "../../controller/usuario.php?op=guardar",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(datos){    
                console.log(datos);
                $('#form_usuario')[0].reset();
                $("#modalusunuevo").modal('hide');
                $('#usuario_data').DataTable().ajax.reload();
    
                swal({
                    title: "HelpDesk!",
                    text: "Registro Guardado Correctamente.",
                    type: "success",
                    confirmButtonClass: "btn-success"
                });
            }
        }); 
    }
}

$(document).ready(function(){
    tabla=$('#usuario_data').dataTable({
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
            url: '../../controller/usuario.php?op=listar',
            type : "post",
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

function editar(id_usuario){
    $("#mdtitulo").html('Editar Registro');

    $.post("../../controller/usuario.php?op=mostrar", {id_usuario : id_usuario}, function (data) {
        
        
        data = JSON.parse(data);
         $('#idusuario').val(data.id_usuario);
         $('#nombre_usuario').val(data.nombre_usuario);
         $('#apellido_usuario').val(data.apellido_usuario);
         $('#usuario_correo').val(data.usuario_correo);
         $('#usuario_password').val(data.usuario_password);
         $('#rol_usuario').val(data.id_rol).trigger('change');
       
        
        
         
    });
    $("#modalusunuevo").modal('show');
}

function eliminar(id_usuario){
    swal({
        title: "HelpDesk",
        text: "Esta seguro de Eliminar el Usuario?",
        type: "error",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Si",
        cancelButtonText: "No",
        closeOnConfirm: false
    },
    function(isConfirm) {
        if (isConfirm) {
            $.post("../../controller/usuario.php?op=eliminar", {id_usuario : id_usuario}, function (data) {

            }); 

            $('#usuario_data').DataTable().ajax.reload();	

            swal({
                title: "HelpDesk!",
                text: "Usuario Eliminado.",
                type: "success",
                confirmButtonClass: "btn-success"
            });
        }
        
    });

    
}

$(document).on("click","#crearusuario",function(){
    $("#mdtitulo").html('Nuevo Usuario');
    $("#form_usuario")[0].reset();
    $("#modalusunuevo").modal('show');

});



init();