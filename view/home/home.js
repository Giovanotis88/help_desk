function init(){

}
    
    

$(document).ready(function(){
    var id_usuario= $('#id_usuario').val();
    var id_usuario= $('#id_usuario').val();

    if($('#id_rol').val() == 1){

        $.post("../../controller/usuario.php?op=total", {id_usuario:id_usuario}, function (data) {
            data = JSON.parse(data);
            $('#lbltotal').html(data.TOTAL);
        });
        $.post("../../controller/usuario.php?op=total_abierto", {id_usuario:id_usuario}, function (data) {
            data = JSON.parse(data);
            $('#lblabiertos').html(data.TOTAL);
        });
        $.post("../../controller/usuario.php?op=total_cerrado", {id_usuario:id_usuario}, function (data) {
            data = JSON.parse(data);
            $('#lblcerrados').html(data.TOTAL);
        });
        $.post("../../controller/usuario.php?op=grafico",{id_usuario:id_usuario}, function (data) {
            data = JSON.parse(data);
            
            new Morris.Bar({
                element: 'divgrafico',
                data: data,
                xkey: 'nom',
                ykeys: ['total'],
                labels: ['Value']
            });
        });
        

    }else if($('#id_rol').val() == 2){
        $.post("../../controller/usuario.php?op=total", {id_usuario:id_usuario}, function (data) {
            data = JSON.parse(data);
            $('#lbltotal').html(data.TOTAL);
        });
        $.post("../../controller/usuario.php?op=total_abierto", {id_usuario:id_usuario}, function (data) {
            data = JSON.parse(data);
            $('#lblabiertos').html(data.TOTAL);
        });
        $.post("../../controller/usuario.php?op=total_cerrado", {id_usuario:id_usuario}, function (data) {
            data = JSON.parse(data);
            $('#lblcerrados').html(data.TOTAL);
        });
        $.post("../../controller/usuario.php?op=grafico",{id_usuario:id_usuario}, function (data) {
            data = JSON.parse(data);
            
            new Morris.Bar({
                element: 'divgrafico',
                data: data,
                xkey: 'nom',
                ykeys: ['total'],
                labels: ['Value']
            });
        });
        $(document).ready(function(){
    
            tabla=$('#casos_sopo').dataTable({
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
                    url: '../../controller/caso.php?op=consultar_casosopo',
                    type : "post",
                    dataType : "json",
                    data:{ id_usuario : id_usuario},
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
                    "sEmptyTable":     "No tiene casos registrados aun",
                    "sInfo":           "Usted tiene total de _TOTAL_ caso(s) Abiertos",
                    "sInfoEmpty":      "Usted tiene un total de 0 registros",
                    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix":    "",
                    "sSearch":         "Buscar casos:",
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
        }).dataTable();
        $(document).ready(function(){
    
            tabla=$('#casos_sopoc').dataTable({
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
                    url: '../../controller/caso.php?op=consultar_casosopoc',
                    type : "post",
                    dataType : "json",
                    data:{ id_usuario : id_usuario},
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
                    "sEmptyTable":     "No tiene casos registrados aun",
                    "sInfo":           "Usted tiene total de _TOTAL_ caso(s) Abiertos",
                    "sInfoEmpty":      "Usted tiene un total de 0 registros",
                    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix":    "",
                    "sSearch":         "Buscar casos:",
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
        }).dataTable();
    });
});
    }else{
        $.post("../../controller/caso.php?op=total", function (data) {
            data = JSON.parse(data);
            $('#lbltotal').html(data.TOTAL);
        });
        $.post("../../controller/caso.php?op=total_abierto", function (data) {
            data = JSON.parse(data);
            $('#lblabiertos').html(data.TOTAL);
        });
        $.post("../../controller/caso.php?op=total_cerrado", function (data) {
            data = JSON.parse(data);
            $('#lblcerrados').html(data.TOTAL);
        });
        
         
        $.post("../../controller/caso.php?op=grafico",function (data) {
            data = JSON.parse(data);
            
            new Morris.Bar({
                element: 'divgrafico',
                data: data,
                xkey: 'nom',
                ykeys: ['total'],
                labels: ['Total Casos']
            }); 
        }); 
            
            $.post("../../controller/caso.php?op=graficoestacion", function(data) {
                data = JSON.parse(data);
                
               
                
                    new Morris.Bar({
                        element: 'divestacion',
                        data: data,
                        xkey: 'nom',
                        ykeys: ['total'], 
                        labels: ['Total Casos'],
                        barColors: ["#F1948A"]
                    });
                

            });
            $.post("../../controller/caso.php?op=graficogrupo",function (data) {
                data = JSON.parse(data);
            
                    new Morris.Bar({
                        element: 'divgrupo',
                        data: data,
                        xkey: 'nom',
                        ykeys: ['total'],
                        labels: ['Total Casos'],
                        barColors: ["#34495E"]
            });  
            
            
        }); 
        
        tabla=$('#casos_data').dataTable({
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
                url: '../../controller/caso.php?op=consultarhome',
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
                "sEmptyTable":     "No tiene casos registrados aun",
                "sInfo":           "Actualmente hay  _TOTAL_ caso(s) Abiertos pendientes por gestión.",
                "sInfoEmpty":      "Usted tiene un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar casos:",
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
    }).dataTable();
         
   }
    

});


    



init();