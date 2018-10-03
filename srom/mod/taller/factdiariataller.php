<?php include("validasesion.php"); ?>
<!DOCTYPE html>
<html class="no-js">

<?php include("../../funciones.php"); ?>
<?php echo Cabecera('Reporte Facturacion Diaria'); ?>
<?php
    $TituloPantalla = 'Reporte Facturacion Diaria';    
?>

    <body>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h6 id="cabecera">
                    <?php ECHO $TituloPantalla; /*Incluir modal nvo*/?>
                </h6>
            </div>
            <div class="panel-body">
                <form id="formulario" method="POST" class="form-inline">
                    <input type="hidden" class="form-control" id="TxtClave" name="TxtClave" placeholder="Buscar cliente">
                    <div class="form-group">
                        <?php echo CmbMoneda();?>
                    </div>
                    <div class="input-group">
                        <?php echo CmbClientes(); ?> 
                    </div>
                    <div class="form-group">
                        <?php echo TxtDateRango(); ?>
                    </div>
                    <button type="submit" id="btnEnviar" class="btn btn-primary btn-sm" onMouseOver="">                         
                        <span class="glyphicon glyphicon-search" aria-hidden="true"></span> Consultar</button>
                    <button type="button" id="btnExcel" class="btn btn-success btn-sm" onMouseOver="">                         
                        <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Excel</button>
                    <button type="button" id="btnPDF" class="btn btn-danger btn-sm" onMouseOver="">
                        <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> PDF</button>
                    <button type="button" id="btnPrint" class="btn btn-default btn-sm" onMouseOver="">                         
                        <span class="glyphicon glyphicon-print" aria-hidden="true"></span> Imprimir</button>
                </form>
                <div class="controles form-horizontal">
            
                </div>
                <div class="respuesta"></div>
                <div class="griddet"></div>
                <div class="form-inline">
                    <label for="inputFechaIni">Filtro:</label>
                    <input type="text" class="form-control" id="txtbusqueda" name="txtbusqueda" data-column-index='0' value="" placeholder="Busqueda rapida">
                </div>                
                <?php echo CargaGif();?>
            </div>
        </div>
    </body>

    <?php echo Script(); ?>

    <script type="text/javascript">
        var timer = 0;
        $(function() {       
            $( "#btnExcel" ).click(function() {$('.buttons-excel').click();});         
            $( "#btnPDF" ).click(function() {$('.buttons-pdf').click();});         
            $( "#btnPrint" ).click(function() {$('.buttons-print').click();});
            
            document.addEventListener('touchmove', function(e) {
                e.preventDefault();
                var touch = e.touches[0];
                //alert(touch.pageX + " - " + touch.pageY);
            }, false);
        

            $("form").on('submit', function(e) {
                e.preventDefault();
                $('#CargaGif').show();
                $('#btnEnviar').attr('disabled', 'disabled')
                $.ajax({
                    type: "POST",
                    url: 'tabla-tallfactdiariataller.php',
                    data: $("form").serialize(), // Adjuntar los campos del formulario enviado.
                    success: function(data) {
                        $('#CargaGif').hide();
                        $('#btnEnviar').removeAttr('disabled');
                        $(".respuesta").html(data); // Mostrar la respuestas del script PHP.
                        $(".respuesta").show();
                    },
                    error: function(error) {
                        $('#CargaGif').hide();
                        console.log(error);
                        alert('Algo salio mal :S');
                    }
                });
                return false; // Evitar ejecutar el submit del formulario.
            });
        });
        
        $(document).on('click touchstart','tr.tar',function(){
            if(timer == 0){
                timer = 1;
                timer = setTimeout(function(){ timer = 0; }, 600);
            }
            else { 
                var id = $(this).attr("id");
                $("#TxtClave").val(id);
                $('#CargaGif').show();
                $.ajax({
                    type: "POST",
                    url: 'tabla-detallefacturas.php',
                    data: $("form").serialize(), 
                    success: function(data) {
                        $('#CargaGif').hide();
                        $(".griddet").html(data);
                        $('#btnEnviar2').click();
                        $('#gridcom').DataTable().draw();
                    },
                    error: function(error) {
                        $('#CargaGif').hide();
                        console.log(error);
                        alert('Algo salio mal :S');
                    }
                });
                return false;
                timer = 0; 
            }
        });
        
        <?php echo JqueryCmbClientes(); ?> 

    </script>

</html>
