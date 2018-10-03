<?php include("../../funciones.php"); 
try{ 
    
    if ($_POST){
        ini_set("soap.wsdl_cache_enabled", "0");
        //$Empresa = $_POST["CmbEmpresa"];
        $A =  $_POST["Ffin"]; 
        $De = $_POST["Fini"];
        $Cliente =  $_POST["TxtClave"]; 
        $Moneda =  $_POST["CmbMoneda"];
        $Sucursal =  $_POST["Cmbsucursales"];

        //parametros de la llamada
        $parametros = array();
        $parametros['sId_Empresa'] = $Empresa;
        $parametros['dtFechaIni'] = $De;
        $parametros['dtFechaFin'] = $A;
        $parametros['sId_Cliente'] = $Cliente;
        $parametros['sMoneda'] = $Moneda;
        $parametros['sId_Sucursal'] = $Sucursal;
    
        //ini_set("soap.wsdl_cache_enabled", "0");
        //Invocación al web service
        $WS = new SoapClient($WebService, $parametros);
        //recibimos la respuesta dentro de un objeto
        $result = $WS->CLI_FactDiaria($parametros);
        $xml = $result->CLI_FactDiariaResult->any;
        $obj = simplexml_load_string($xml);
        $Datos = $obj->NewDataSet->Table;
//echo $xml;
    }
    else{}
} catch(SoapFault $e){
  var_dump($e);
}

echo "<div class='table-responsive'><table id='grid' class='table table-striped table-bordered table-condensed table-hover display compact' cellspacing='0' width='100%' ><tfoot><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tfoot></table></div>";

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
/*
			$sGridNomb = '#grid';
			$sWsNomb = 'cliedoctagral';
            $aColumnas = array("FECHA","CVE_DOCUMENTO","CARGO","ABONO","SALDOCLIENTE","CONCEPTO","REFERENCIA","FECHAVENCE","SALDODOCTO","SALDOMOVTO","DIASVENCE","SUBTOTAL","IMPIVA","DESCTO","TOTAL","CVEDOCTO","TIPODOCTO","FUM","ID_USUARIO");
            $aTitulos = array("FECHA","CVE_DOCUMENTO","CARGO","ABONO","SALDOCLIENTE","CONCEPTO","REFERENCIA","FECHAVENCE","SALDODOCTO","SALDOMOVTO","DIASVENCE","SUBTOTAL","IMPIVA","DESCTO","TOTAL","CVEDOCTO","TIPODOCTO","FUM","ID_USUARIO");
			echo GrdRptShort($sGridNomb,$sWsNomb,$aColumnas,$aTitulos);
            
		?>*/
$(document).ready(function() {
         var table = $('#grid').DataTable({
            data:datos,
            columns: [
                { data: 'FECHA' },
                { data: 'SUCURSAL' },
                { data: 'SERIE' },
                { data: 'FOLIO' },
                { data: 'MONEDA' },
                { data: 'TC' },
                { data: 'CLIENTE' },
                { data: 'CONCEPTO' },
                { data: 'TOTAL' }
            ],
            columnDefs: [
                { 'title': 'FECHA', className: "text-center", 'targets': 0},
                { 'title': 'SUCURSAL', className: "text-left", 'targets': 1},
                { 'title': 'SERIE', className: "text-left", 'targets': 2},
                { 'title': 'FOLIO', className: "text-left", 'targets': 3},
                { 'title': 'MONEDA', className: "text-left", 'targets': 4},
                { 'title': 'TC', className: "text-right", 'targets': 5},
                { 'title': 'CLIENTE', className: "text-left", 'targets': 6},
                { 'title': 'CONCEPTO', className: "text-left", 'targets': 7},
                { 'title': 'TOTAL', className: "text-right", 'targets': 8}
            ],
            'createdRow': function ( row, data, index ) {
                $(row).attr({id:data.Movimiento});
                $(row).addClass('tar');
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
                    customize: function ( doc ) {
                        // Splice the image in after the header, but before the table
                        doc.content.splice( 1, 0, {
                            margin: [ 0, 0, 0, 12 ],
                            alignment: 'center'
                        } );
                        // Data URL generated by http://dataurl.net/#dataurlmaker
                    },
                    filename: 'factdiaria',
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
                    filename: 'factdiaria',
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
                    filename: 'factdiaria',
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
            'scrollY': '40vh',
            'scrollCollapse': true,
            'scrollX': true,
            'paging': false,
             fixedHeader: {
                header: true,
                footer: false
            },
            'responsive':true,
       "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
           
            var api_anoant = this.api(), data;
            var api_anoact = this.api(), data;
            var api_utilper = this.api(), data;
            var api_inggen = this.api(), data;
            var api_promen = this.api(), data;
            var api_acuene = this.api(), data;
            var api_variac = this.api(), data;
            var api_mesant = this.api(), data;
            var api_mesact = this.api(), data;

            
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
           
            //===========================================================================
            total_anoact = api_anoact
                .column( 8 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            // Update footer
            $( api_anoact.column( 8 ).footer() ).html('$'+ total_anoact.toFixed(2) );
        }
        } );
        $('#txtbusqueda').on('keyup change', function() {
          //clear global search values
          table.search('');
          table.column($(this).data('columnIndex')).search(this.value).draw();
        });

        $(".dataTables_filter input").on('keyup change', function() {
          //clear column search values
          table.columns().search('');
          //clear input values
          $('#txtbusqueda').val('');
        });
    });
    </script>

            
