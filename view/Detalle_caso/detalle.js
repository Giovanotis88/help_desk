function init(){
    
}

$(document).ready(function(){
    var id_caso = getUrlParameter('ID');
    listardetalle(id_caso);
    
    


    // $.post("../../controller/caso.php?op=detalle", {id_caso : id_caso}, function (data){
    //     $('#contdetalle').html(data);

    //  });
    

    // $.post("../../controller/caso.php?op=mostrar", {id_caso : id_caso}, function (data){
    //     data =JSON.parse(data);
    //     $('#estado').html(data.estado_caso);
    //     $('#numero_caso').html(data.id_caso);
    //     $('#fecha').html(data.fecha_creacion);


    //     $('#tick_titulo').val(data.titulo);
    //     $('#grupo').val(data.nombre_grupo);
    //     $('#tick_subcategoria').val(data.nombre_categoria);
    //     $('#desc_solicitud').summernote('code',data.desc_solicitud);

    //     console.log( data.estado_caso_texto);
    //     if (data.estado_caso_texto == "Cerrado"){
    //         $('#pndetalle').hide();
    //     }

    // });

    
           
     $.post("../../controller/caso.php?op=mostrar", {id_caso : id_caso}, function (data){
        data =JSON.parse(data);
        

     });

     

});

        $(document).ready(function() {
            $('#respuesta').summernote({
                placeholder: 'Describa su Solicitud',
                height: 200,
                lang:"es-ES", });
                                $.post("../../controller/estacion.php?op=combo", function(data, status) {
                    $('#id_estacion').html(data);            
                
                });
                $.post("../../controller/grupo.php?op=combo", function(data, status) {
                    $('#id_grupo').html(data);            
                
                });

               

    });
        

            $('#desc_solicitud').summernote({
                height: 400,
                lang:"es-ES", });

            $('#desc_solicitud').summernote('disable');


          

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
$(document).on("click","#btncerrar", function(){
    swal({
    title: "Atención",
    text: "Esta seguro de Cerrar el Ticket?",
    type: "warning",
    showCancelButton: true,
    confirmButtonClass: "btn-warning",
    confirmButtonText: "Si",
    cancelButtonText: "No",
    closeOnConfirm: false
    },
    function(isConfirm) {
    if (isConfirm) {
       var id_caso= getUrlParameter('ID');
       var id_usuario = $('#id_usuario').val();
       $.post("../../controller/caso.php?op=actualizar", { id_caso : id_caso,id_usuario:id_usuario }, function (data) {

       }); 
       listardetalle(id_caso);
       swal({
       title: "Bien!",
       text: "Ticket Cerrado correctamente.",
       type: "success",
       confirmButtonClass: "btn-success"
       });
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