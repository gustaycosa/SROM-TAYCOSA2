<?php include("../../funciones.php");

try{ 
    
    if ($_POST){
        
        
        $Empresa = $_POST["CmbEmpresa"];
        $De = $_POST["Fini"];
        $A =  $_POST["Ffin"]; 
        $user =  $_POST["CmbATT_USERINFO"]; 

        $dDe = strtotime($De);
        $newformat1 = date('Y-m-d',$dDe);
        
        $dA = strtotime($A);
        $newformat2 = date('Y-m-d',$dA);
        
        
        //parametros de la llamada
        $parametros = array();
        $parametros['sId_Empresa'] = $Empresa;
        $parametros['De'] = $newformat1;
        $parametros['A'] = $newformat2;
        $parametros['iUserID'] = $user;

        //ini_set("soap.wsdl_cache_enabled", "0");
        //Invocación al web service
        $WS = new SoapClient($WebService, $parametros);
        //recibimos la respuesta dentro de un objeto
        $result = $WS->ReporteAsistencias($parametros);
        $xml = $result->ReporteAsistenciasResult->any;

        $obj = simplexml_load_string($xml);
        $Datos = $obj->NewDataSet->Table;
//echo $xml;
    }
    else{}
} catch(SoapFault $e){
  var_dump($e);
}

    echo "<div class='table-responsive'>
        <table id='grid' class='table table-striped table-bordered table-condensed table-hover display compact' cellspacing='0' width='100%' ></table></div>";

	$arreglo = [];
	for($i=0; $i<count($Datos); $i++){
		$arreglo[$i]=$Datos[$i];
	}

?>

     <script type="text/javascript"> 
        var datos = 
        <?php 
            echo json_encode($arreglo);
        ?>
		;
		<?php
/*
			$sGridNomb = '#gridfact';
			$sWsNomb = 'vtas_netasfact';
			$aColumnas = array("Fecha","Id_Sucursal","Serie","Folio","Id_cliente","Nombre","Concepto","Total");
			$aTitulos =  array("Fecha","Id_Sucursal","Serie","Folio","Id_cliente","Nombre","Concepto","Total");
			echo GrdRptShort($sGridNomb,$sWsNomb,$aColumnas,$aTitulos);
            */
		?>

 $(document).ready(function() {
     var table = $('#grid').DataTable({
        data:datos,
        columns: [
            { data: 'NAME' },
            { data: 'FECHA' },
            { data: 'DIA' },
            { data: 'ENTRADA' },
            { data: 'SALIDA' }
        ],
        columnDefs: [
            { 'title': 'NOMBRE', className: "text-left", 'targets': 0},
            { 'title': 'FECHA', className: "text-left", 'targets': 1},
            { 'title': 'DIA', className: "text-left", 'targets': 2},
            { 'title': 'ENTRADA', className: "text-left", 'targets': 3},
            { 'title': 'SALIDA', className: "text-left", 'targets': 4}
        ],
        'createdRow': function ( row, data, index ) {
        },
        dom: 'lfBrtip',    
        paging: false,
        searching: true,
        ordering: false,
        buttons: [
            {
                extend: 'copy',
                message: 'PDF created by PDFMake with Buttons for DataTables.',
                text: 'Copiar',
                exportOptions: {
                    modifier: {
                        page: 'all'
                    }
                }
            },
            {
                extend: 'pdf',
                text: 'PDF',
                filename: 'ASISTENCIAS',
                extension: '.pdf',       
                exportOptions: {
                    columns: ':visible',
                    modifier: {
                        page: 'all'
                    }
                }
            },
            {
                extend: 'csv',
                text: 'CSV',
                header:'true',
                filename: 'ASISTENCIAS',
                extension: '.csv',       
                exportOptions: {
                    columns: ':visible',
                    modifier: {
                        page: 'all'
                    }
                }
            },
            {
                extend: 'excel',
                message: 'PDF creado desde el sistema en linea del tayco.',
                text: 'XLS',
                filename: 'ASISTENCIAS',
                extension: '.xlsx', 
                exportOptions: {
                    columns: ':visible',
                    modifier: {
                        page: 'all'
                    }
                },
                customize: function( xlsx ) {
                    var sheet = xlsx.xl.worksheets['sheet1.xml'];
                    $('row:first c', sheet).attr( 's', '42' );
                }
            },
            {
                extend: 'print',
                message: 'PDF creado desde el sistema en linea del tayco.',
                text: 'Imprimir',
                exportOptions: {
                    stripHtml: false,
                    modifier: {
                        page: 'all'
                    }
                }
            },
        ],
        'pagingType': 'full_numbers',
        'lengthMenu': [[-1], ['Todo']],
        'language': {
            'sProcessing':    'Procesando...',
            'sLengthMenu':    'Mostrar _MENU_ registros',
            'sZeroRecords':   'No se encontraron resultados',
            'sEmptyTable':    'Ningún dato disponible en esta tabla',
            'sInfo':          'Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros',
            'sInfoEmpty':     'Mostrando registros del 0 al 0 de un total de 0 registros',
            'sInfoFiltered':  '(filtrado de un total de _MAX_ registros)',
            'sInfoPostFix':   '',
            'sSearch':        'Buscar:',
            'sUrl':           '',
            'sInfoThousands':  ',',
            'sLoadingRecords': 'Cargando...',
            'oPaginate': {
                'sFirst':    'Primero',
                'sLast':    'Último',
                'sNext':    'Siguiente',
                'sPrevious': 'Anterior'
            },
            'oAria': {
                'sSortAscending':  ': Activar para ordenar la columna de manera ascendente',
                'sSortDescending': ': Activar para ordenar la columna de manera descendente'
            }
        },
        'scrollY':        '60vh',
        'scrollCollapse': true,
        'paging':         false
    } );
    $('#txtbusqueda').on('keyup change', function() {
      //clear global search values
      table.search('');
      table.column($(this).data('columnIndex')).search(this.value).draw();
    });

    $(".dataTables_filter input").on('keyup change', function() {
        //clear column search values
        table.columns().search('');
        $('#txtbusqueda').val('');
    });
} );
</script>
            
