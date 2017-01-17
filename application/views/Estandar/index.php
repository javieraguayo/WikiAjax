<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
            <title>
                Document
            </title>
        </meta>
    </head>
    <body>
    </body>
</html>
<div class="row">
    <div class="col-md-12" id="Resultado-View">
    </div>
    <button class="btn btn-default" id="btn-response-view" onclick="getViewResponse()" type="button">
        Cargar Datos
    </button>
    <!-- agregar onclick-->
</div>
<script type="text/javascript">
    function getViewResponse(){

        //Bloqueo de BOTON.. EJ no realizar dos pago por precionar boton 2 veces
        $("#btn-response-view").prop('disabled',true)

        //Carga en el Boton (Icon)
        $(".btn-carga").html('');

        $.ajax({
            type: "POST",
            url: "<?php print base_url();?>/index.php/Producto/getViewResponse",//forma correcta de llamar con base url
            success: function(objView){
                $("#btn-response-view").prop('disabled',false)
                $(".btn-carga").html('');

                $("#Resultado-View").html(objView.ViewSet);

            }
        });
 }
</script>
