<?php include("../../validasesion.php"); ?>
<!DOCTYPE html>
<html class="no-js">

<?php include("../../funciones.php"); ?>
<?php echo Cabecera('Reporte tareas'); ?>
<?php
    $TituloPantalla = 'Reporte tareas';    
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
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="TxtClave" name="TxtClave" value="<?php $id = $_GET["e"]; echo $id;?>" placeholder="Ingrese ejercicio">
                    </div>
                    <button type="submit" id="btnEnviar" class="btn btn-primary btn-sm" onMouseOver="">                         <span class="glyphicon glyphicon-search" aria-hidden="true"></span> Consultar</button>                     <button type="button" id="btnExcel" class="btn btn-success btn-sm" onMouseOver="">                         <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Excel</button>                     <button type="button" id="btnPDF" class="btn btn-danger btn-sm" onMouseOver="">                         <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> PDF</button>                     <button type="button" id="btnPrint" class="btn btn-default btn-sm" onMouseOver="">                         <span class="glyphicon glyphicon-print" aria-hidden="true"></span> Imprimir</button>
                </form>
                <div class="respuesta"></div>                 
                <div class="form-inline">
                    <label for="inputFechaIni">Filtro:</label>
                    <input type="text" class="form-control" id="txtbusqueda" name="txtbusqueda" data-column-index='0' value="" placeholder="Busqueda rapida">
                </div>
				<?php echo CargaGif();?>
            </div>
        </div>
           <div class='modal' id='mdlcom' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
              <div class='modal-dialog' role='document'>
                <div class='modal-content'>
                  <div class='modal-header'>
                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                    <h4 class='modal-title' id='myModalLabel'>Responder comentario</h4>
                  </div>
                  <div id='divmdlcom' class='modal-body'>
                    <form id="frmcoment" class="form-horizontal" method="POST">
                        <input type="hidden" class="form-control" id="TxtTarea" name="TxtTarea" value="" placeholder="Ingrese ejercicio">
                        <input type="hidden" class="form-control" id="Txtidsolicita" name="Txtidsolicita" value="<?php $tarea = $_GET["e"]; echo $id;?>" placeholder="Ingrese ejercicio">
                    <div class="comentarios"></div>

                    </form>
                    <form id="frmrecoment" class="form-horizontal" method="POST">
                        <input type="hidden" class="form-control" id="TxtTareaCom" name="TxtTareaCom" value="" placeholder="Ingrese ejercicio">
                        <input type="hidden" class="form-control" id="Txtidsolicita" name="Txtidsolicitacom" value="<?php $tarea = $_GET["e"]; echo $id;?>" placeholder="Ingrese ejercicio">
                      <div class="form-group">
                        <label for="inputtext3" class="col-sm-2 control-label">Comentario:</label>
                        <div class="col-sm-10">
                            <input type="date" name="txtFechaCom" id="txtFechaCom" value="<?php echo date("Y-m-d");?>" class="form-control" placeholder="Rango Fecha Final" style="display:none">
                          <input type="text" name="TxtComentario" class="form-control" id="TxtComentario" placeholder="text">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-12">
                          <button type="submit" class="btn btn-primary" id="addRow">agregar comentario</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal" id="closecom">cerrar</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
    </body>

    <?php echo Script(); ?>

    <script type="text/javascript"> 
        
        $(document).ready(function() {
            var table = $('#grid').DataTable({
                scrollY: 200,
                scrollX: true
            } );
        } );

    </script>

    <script type="text/javascript">
        $(function() {        
        $( "#btnExcel" ).click(function() {$('.buttons-excel').click();});         
        $( "#btnPDF" ).click(function() {$('.buttons-pdf').click();});         
        $( "#btnPrint" ).click(function() {$('.buttons-print').click();});

        $("form").on('submit', function(e) {
            $('#CargaGif').show();
            e.preventDefault();
            $('#btnEnviar').attr('disabled', 'disabled')
            $.ajax({
                type: "POST",
                url: 'tabla_tarreportetareas.php',
                data: $("form").serialize(), // Adjuntar los campos del formulario enviado.
                success: function(data) {
                    $('#CargaGif').hide();
                    $('#btnEnviar').removeAttr('disabled');
                    $(".respuesta").html(data); // Mostrar la respuestas del script PHP.
                    $(".respuesta").show();
                    $('#grid').DataTable().draw();
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

        $('.Seleccionado').dblclick(function() {
            var id = $(this).attr("data-id");
            var name = $(this).attr("data-name");
            $("#TxtCliente").val(id);
            $("#title").html("Reporte cliente - " + id + " " + name);
            $("#cabecera").html("Reporte cliente - " + id + " " + name);
            $('#myModal').modal('hide');
        });
        
        $(document).on('click touchstart','tr.tar',function(){
            var id = $(this).attr("id");
            $("#TxtTarea").val(id);
            $('#CargaGif').show();
            $.ajax({
                type: "POST",
                url: 'nvo-tareascomselect.php',
                data: $("#frmcoment").serialize(), // Adjuntar los campos del formulario enviado.
                success: function(data) {
                    //$('#btnEnviar').removeAttr('disabled');
                    $('#CargaGif').hide();
                    $(".comentarios").html(data); // Mostrar la respuestas del script PHP.
                    $("#frmcoment")[0].reset();
                    $('#btnEnviar2').click();
                    //$("#mdlcom").show();
                    //$('.comentarios').modal('show')
                    $('#gridcom').DataTable().draw();
                },
                error: function(error) {
                    $('#CargaGif').hide();
                    console.log(error);
                    alert('Algo salio mal :S');
                }
            });
            return false;// Evitar ejecutar el submit del formulario.	
        });
    </script>

</html>
