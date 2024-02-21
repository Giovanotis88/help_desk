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
        
        $.post("../../controller/suministro.php?op=combo", function(data, status) {
            $('#id_sumi').html(data);    
            // console.log(data);       
        
        });
        
                
        
        });

 

function guardaryeditar(e){
    e.preventDefault();
    var formData = new FormData($("#caso_form")[0]);
    
    if ($('#desc_solicitud').summernote('isEmpty')||$('#id_area').val()==''||$('#c_solicitante').val()==''||$('#id_evento').val()==''){
        
        swal("No Es Posible Registrar!", "Campos Incompletos, Por Favor validar !!", "warning");
    }else{
        var totalfiles =$('#fileelement').val().length;
        for (var i = 0; i < totalfiles; i++){
            formData.append("files[]", $('#fileelement')[0].files[i]);
        }
    $.ajax({
        url: "../../controller/caso.php?op=guardaralimentos",
        type:"POST",
        data: formData,
        contentType: false,
        processData:false,
        success: function(data){
            data=JSON.parse(data);            
            console.log(data[0].id_caso);
            $.post("../../controller/correo.php?op=ticket_abiertoalim", {id_caso : data[0].id_caso}, function (data) {
                console.log(data);
            });
            // $.post("../../controller/correo.php?op=ticket_asignado", {id_caso : data[0].id_caso}, function (data) {
            //     console.log(data);
            // });
            $('#id_area').val('');
            $('#c_solicitante').val('');
            $('#id_evento').val('');
            $('#id_sumi').val('');
            $('#cantidad').val('');
            $('#desc_solicitud').summernote('reset');
            swal("Correcto!","Caso Registrado Correctamente !!","success");
        }
    });

    }


}

init();

