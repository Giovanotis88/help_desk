function init(){

}
$(document).ready(function() {

              
        
});

 $(document).on("click", "#soporte", function () {
     var idRol = $('#id_rol').val();

     if (idRol == '1') {
         $('#titulo').html("Ingreso Soporte");
         $('#soporte').html("Ingreso Usuario");
         $('#imgacceso').attr("src","public/img/2.png");
         $('#id_rol').val(2);
     } else {
         $('#titulo').html("Ingreso Usuario");
         $('#soporte').html("Ingreso Soporte");
         $('#imgacceso').attr("src","public/img/1.png");
         $('#id_rol').val(1);
     }
 });

 $(document).on("click", "#admin", function () {
     var idRol = $('#id_rol').val();
    if (idRol == '3') {
        $('#titulo').html("Ingreso Usuario");
        $('#admin').html("Ingreso Administrador");
        $('#id_rol').val(1);
        }else{
        $('#titulo').html("Ingreso Administrador");
        $('#admin').html("Ingreso Usuario");
        $('#id_rol').val(3);



    }
        
});






 init();