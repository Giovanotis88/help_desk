function init (){
    $("#caso_form").on("submit",function(e){
        guardaryeditar(e);
    });
}



$(document).ready(function() {
    $('#desc_solicitud').summernote({
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
        var totalfiles =$('#fileelement').val().length;
        for (var i = 0; i < totalfiles; i++){
            formData.append("files[]", $('#fileelement')[0].files[i]);
        }
    $.ajax({
        url: "../../controller/caso.php?op=guardar",
        type:"POST",
        data: formData,
        contentType: false,
        processData:false,
        success: function(data){
            data=JSON.parse(data);            
            console.log(data[0].id_caso);
            $.post("../../controller/correo.php?op=ticket_abierto", {id_caso : data[0].id_caso}, function (data) {
                console.log(data);
            });
            $.post("../../controller/correo.php?op=ticket_asignado", {id_caso : data[0].id_caso}, function (data) {
                console.log(data);
            });
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







        
 