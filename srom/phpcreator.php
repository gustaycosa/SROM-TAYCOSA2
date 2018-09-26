<!DOCTYPE html>
<html class="no-js">

<head>
    <title id="title">phpcreator</title>
    <meta charset=utf-8>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="TAYCO SA DE CV" />
    <link rel="stylesheet" type="text/css" href="css/normalize.css" />
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"  />
    <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" type="text/css" href="css/buttons.dataTables.min.css"/>
    <link rel="stylesheet" type="text/css" href="css/PushMenu.css"/>
    <link rel="stylesheet" type="text/css" href="css/ThemeBlue.css"  />
    <link rel="stylesheet" type="text/css" href="css/barratareas.css"  />
    <link rel="stylesheet" type="text/css" href="css/CargaGif.css"  />
    <link rel="shortcut icon" href="favicon.ico">
</head>

<body>
    <div class="col-sm-6">
        <div class="form-horizontal col-sm-12" id="contact-form">

          <h3 class="page-header"></h3>
 <button>wtf</button>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 control-label">Nombre:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="txtnombre" maxlength="60"  name="txtnombre" value="" placeholder="escriba ws">
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 control-label">Webservice:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="txtws" maxlength="60"  name="txtws" value="" placeholder="escriba ws">
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 control-label">Post:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="txtpost1" maxlength="60"  name="txtpost1" value="" placeholder="Ej: Fernandez">
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 control-label">Varpost:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="txtvarpost1" maxlength="60"  name="txtvarpost1" value="" placeholder="Ej: Fernandez">
                </div>
            </div>
            <button id="btnaddpost">agrega parametro</button>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 control-label">Columna:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="txtcol1" maxlength="60"  name="txtcol1" value="" placeholder="Colx">
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 control-label">Titulo:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="txttit1" maxlength="60"  name="txttit1" value="" placeholder="Ej: Fernandez">
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 control-label">Ancho:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="txtanch" maxlength="60"  name="txtanch" value="60" placeholder="Ej: Fernandez">
                </div>
            </div>
            <div class="form-group">
                <input type="radio" selected name="radalg" value="left"/>Left 
                <input type="radio" name="radalg" value="center"/>Center
                <input type="radio" name="radalg" value="right"/>Right
            </div>
            <button id="btnaddcol">agrega columna</button>
            <div class="form-group">
                busqueda
                <input type="radio" selected name="radbus" class="radbus" value="true"/>Si 
                <input type="radio" name="radbus" class="radbus" value="false"/>No
            </div>
            <div class="form-group">
                ordenar columnas
                <input type="radio" selected name="radord" class="radordl" value="true"/>Si 
                <input type="radio" name="radord" class="radord" value="false"/>No
            </div>
            <div class="form-group">
                agregar botones
                <input type="radio" selected name="radbtns" class="radbtnsl" value="true"/>Si 
                <input type="radio" name="radbtns" class="radbtns" value="false"/>No
            </div>
            <div class="form-group">
                <div class="col-sm-8">
                    <input type="button" class="btn btn-primary" name="action" value="Copiar" />
                </div>
            </div>
<!-- Disparador -->
<button class="btn" data-clipboard-target="#foo">
  Copiar al portapapeles
</button>
        </div>
    </div>
    
    <style>
        code{ display: block; margin:0px;}
        code span{ color:cadetblue; background: #e2faff; }
        #codpost span, #codparam span{ display:block; }
        #foo{ background: whitesmoke; height: 100%; overflow-y: scroll; position: relative; }
        xmp{ padding: 2px 4px; font-size: 90%; color: #c7254e; background-color: #f9f2f4; margin:0px;}
        code xmp{ padding: 0px; margin: 0px; display: inline-block; position: relative;}
    </style>
    <div id="foo" class="col-sm-6">
        <xmp>
        <?php
        </xmp>
        <code>try{</code>
        <code>if ($_POST){</code>
        <code id="codpost"></code>            
        <code>$WebService="http://dwh.taycosa.mx/WEB_SERVICES/DataLogs.asmx?wsdl";</code>        
        <code id="codparam">$parametros = array();</code>
        <code>$WS = new SoapClient($WebService, $parametros);</code>
        <code>$result = $WS-><span id="varws"></span>($parametros);</code>        
        <code>$xml = $result-><span id="varwsr"></span>Result->any;</code>        
        <code>$obj = simplexml_load_string($xml);</code>        
        <code>$Datos = $obj->NewDataSet->Table;</code>
        <code>}</code>
        <code>else{}</code>
        <code>} catch(SoapFault $e){</code>
        <code>var_dump($e);</code>
        <code>}</code>
        <xmp>echo "<div class='table-responsive'>
            <table id='grid' class='table table-striped table-bordered 
            table-condensed table-hover display compact nowrap' cellspacing='0' width='100%'><tfoot>
        </xmp><code id="codfoot"></code><xmp> 
        </tfoot>
            </table></div>"; 
                $arreglo = [];
                for($i=0; $i<count($Datos); $i++){
                    $arreglo[$i]=$Datos[$i];
                }

            ?>
        </xmp>
<xmp>

<script type="text/javascript"> 

var datos = <?php echo json_encode($arreglo);?> ;
 $(document).ready(function() {
         var table = $('#grid').DataTable({
            data:datos,
</xmp>
<code id="xmpcolumns">
             columns: [</span>

           
</code>
<code id="xmptitles">
              ],
            columnDefs: [
                
</code>
<code id="trid">
            ],
            "createdRow": function ( row, data, index ) {
                $(row).attr({ id:data.Id_ConceptoCtb});
</code>
<xpm>}</xmp>
<code id="codbtns">dom: 'lfBrtip',</code>    
<code>paging: false,</code>
<code>searching: <span id="spanbus"></span>,</code>
<code>ordering: <span id="spanorder"></span>,</code>
<code>buttons: [</code>
<code>{</code>
<code>extend: 'copy',</code>
<code>message: 'PDF created by PDFMake with Buttons for DataTables.',</code>
<code>text: 'Copiar',</code>
<code>exportOptions: {</code>
<code>modifier: {</code>
<code>page: 'all'</code>
<code>}</code>
<code>}</code>
<code>},</code>
<code>{</code>
<code>extend: 'pdf',</code>
<code>text: 'PDF',</code>
<code>customize: function ( doc ) {</code>
<code>// Splice the image in after the header, but before the table</code>
<code>doc.content.splice( 1, 0, {</code>
<code></code>
<code>alignment: 'center'</code>
<code>} );</code>
<code>// Data URL generated by http://dataurl.net/#dataurlmaker</code>
<code>},</code>
<code>filename:<span class="spannombre"></span>,</code>
<code>extension: '.pdf',       </code>
<code>exportOptions: {</code>
<code>columns: ':visible',</code>
<code>modifier: {</code>
<code>page: 'all'</code>
<code>}</code>
<code>}</code>
<code>},</code>
<code>{</code>
<code>extend: 'excel',</code>
<code>message: 'PDF creado desde el sistema en linea del tayco.',</code>
<code>text: 'XLS',</code>
<code>filename: <span class="spannombre"></span>,</code>
<code>extension: '.xlsx', </code>
<code>exportOptions: {</code>
<code>columns: ':visible',</code>
<code>modifier: {</code>
<code>page: 'all'</code>
<code>}</code>
<code>},</code>
<code>customize: function( xlsx ) {</code>
<code>var sheet = xlsx.xl.worksheets['sheet1.xml'];</code>
<code>$('row:first c', sheet).attr( 's', '42' );</code>
<code>}</code>
<code>},</code>
<code>{</code>
<code>extend: 'print',</code>
<code>message: 'PDF creado desde el sistema en linea del tayco.',</code>
<code>text: 'Imprimir',</code>
<code>exportOptions: {</code>
<code>stripHtml: false,</code>
<code>modifier: {</code>
<code>page: 'all'</code>
<code>}</code>
<code>}</code>
<code>},</code>
<code>],</code>
<code>'pagingType': 'full_numbers',</code>
<code>'lengthMenu': [[-1], ['Todo']],</code>
<code>'language': {</code>
<code>'sProcessing':    'Procesando...',</code>
<code>'sLengthMenu':    'Mostrar _MENU_ registros',</code>
<code>'sZeroRecords':   'No se encontraron resultados',</code>
<code>'sEmptyTable':    'Ningún dato disponible en esta tabla',</code>
<code>'sInfo':          'Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros',</code>
<code>'sInfoEmpty':     'Mostrando registros del 0 al 0 de un total de 0 registros',</code>
<code>'sInfoFiltered':  '(filtrado de un total de _MAX_ registros)',</code>
<code>'sInfoPostFix':   '',</code>
<code>'sSearch':        'Buscar:',</code>
<code>'sUrl':           '',</code>
<code>'sInfoThousands':  ',',</code>
<code>'sLoadingRecords': 'Cargando...',</code>
<code>'oPaginate': {</code>
<code>'sFirst':    'Primero',</code>
<code>'sLast':    'Último',</code>
<code>'sNext':    'Siguiente',</code>
<code>'sPrevious': 'Anterior'</code>
<code>},</code>
<code>'oAria': {</code>
<code>'sSortAscending':  ': Activar para ordenar la columna de manera ascendente',</code>
<code>'sSortDescending': ': Activar para ordenar la columna de manera descendente'</code>
<code>}</code>
<code>},</code>
<code>'scrollY': '60vh',</code>
<code>'scrollCollapse': true,</code>
<code>'scrollX': true,</code>
<code>'paging': false,</code>
<code>fixedHeader: {</code>
<code>header: true,</code>
<code>footer: false</code>
<code>},</code>
<code>'responsive':true</code>
<code>} );</code>
<code>});</code>
<code></script></code>

    </div>
</body>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/validaciones.js"></script>
<link rel="stylesheet" type="text/css" href="css/dataTables.bootstrap.min.css">
<script type="text/javascript" src="js/jeditable.min.js" ></script>
<script type="text/javascript" src="js/jquery.dataTables.min.js" ></script>
<script type="text/javascript" src="js/dataTables.bootstrap.min.js" ></script>


<script type="text/javascript">
    $(document).ready(function() {
//        $("#span1").text(   );
//      
        var contador = 1;
        var contador2 = 1;
        var d = new Date();
        var strDate = d.getFullYear() + "/" + (d.getMonth()+1) + "/" + d.getDate();
        
        $("#txtws").keyup(function () {
            var value = $(this).val();
            $("#varws").text( value );
            $("#varwsr").text( value );
        }).keyup();

        $("#btnaddpost").click(function() {
            var post = $("#txtpost1").val();
            var varpost = $("#txtvarpost1").val();
            $( "#codpost" ).append( '<span id="varpost'+contador+'">$'+varpost+' =  $_POST["'+post+'"];</span>' );
            $( "#codparam" ).append( '<span id="param'+contador+'">$parametros["'+varpost+'"] = $'+varpost+';</span>' );
            contador = contador + 1;
        });
        $("#btnaddcol").click(function() {
            var columna = $("#txtcol1").val();
            var titulo = $("#txttit1").val();
            var ancho = $("#txtanch").val();
            var align = $("input[name='radalg']:checked").val();
            $( "#codfoot" ).append("<xmp id='foot"+contador2+"'><th></th></xmp>");
            $( "#xmpcolumns" ).append( "<span id='columna"+contador2+"'> { data: '"+columna+"' },"+"</span><br>" );
            $( "#xmptitles" ).append( "<span id='titulo"+contador2+"'> { 'title': '"+titulo+"', 'width': '"+ancho+"px', 'className': 'text-"+align+"', 'targets':"+contador2+" },"+"</span><br>" );
            
            contador2 = contador2 + 1;
        });
    
        $("#txtnombre").keyup(function () {
          var value = $(this).val();
          $("span.spannombre").text( "'" + value + "_" + strDate + "'");
        }).keyup();

        $(".radbus").click(function() {
            var busqueda = $(this).val();
            $( "#spanbus" ).empty();
            $( "#spanbus" ).append( "'" + busqueda + "'" );
        });

        $(".radord").click(function() {
            var ordenar = $(this).val();
            $( "#spanorder" ).empty();
            $( "#spanorder" ).append( "'" + ordenar + "'" );
        });
    
        $(".radbtns").click(function() {
            var botones = $(this).val();
            $( "#codbtns" ).empty();
            if ( botones == 'true' ){
                $( "#codbtns" ).append( "'dom': 'lfBrtip'," );
            }else{
                $( "#codbtns" ).append( "" );
            }
            
        });

  });
</script>

<script src="https://cdn.rawgit.com/zenorocha/clipboard.js/v1.5.3/dist/clipboard.min.js"></script>
<script type="text/javascript">
  var clipboard = new Clipboard('.btn');
</script>