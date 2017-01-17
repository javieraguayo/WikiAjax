<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
   

</head>

<div class="row">
                <div class="col-md-12">
                    <h3>Insertar Datos </h3>
                    <div class="form-group col-md-4">
                        <label for="ejemplo_email_1">Nombre Producto</label>
                        <input type="text" class="form-control" id="nombre_producto"
                               placeholder="Introduce nombre del producto" value="<?php if(isset($producto)){echo $producto->NombreProducto;}?>">
                         <br>
                         <button type="submit" id="btn-response-view"
                         onclick="SaveData()" class="btn btn-default">Guardar</button>      
                    </div>
                </div>
        </div>       
        <div id="Resultado-View"></div>

<body>
    <table class="table" style="width:100%">
    <thead>
        <tr>
            <th>
                IdProducto
            </th>
            <th>
                Nombre Producto
            </th>
        </tr>
    </thead>
    <tbody>
       <?php
                if(isset($getProductos)){
                    foreach ($getProductos as $key => $p) {
                    ?>
                <tr id="fila_<?=$p->token?>"> <!-- siempre va en un tr-->
                    <td><?=$p->codigo;?></td>
                    <td><?=$p->NombreProducto;?></td>
                    <td>
                        <td> <button type="button" onclick="Elimina('<?=$p->token?>')" class="btn btn-primary"><i class="fa fa-trash-o"></i> Eliminar</button></i> </td>
                    </td>
                </tr>


                    <?php
                    }
                }

                ?>
    </tbody>
</table>
</body>
<script>
    
     function Elimina(token){
                
        var ParamObjSend={
            'token':token,
        }
        $.ajax({
            type: "POST",
            url: "<?php print base_url();?>/index.php/Producto/eliminar",
            data: ParamObjSend,
            success: function(objView){
               $('#fila_'+token).remove();
            }
        });
    }

    var opcion="<?php if(isset($producto)){echo '2';}else{echo '1';};?>";
    var token="<?php if(isset($producto)){echo $producto->token;};?>";


    function SaveData(){
        
        //Bloqueo de BOTON.. EJ no realizar dos pago por precionar boton 2 veces
        $("#btn-response-view").prop('disabled',true)

        //Carga en el Boton (Icon) 
        $("#btn-response-view").html('');
        
        
        var ParamObjSend={
            'nombre_producto':$('#nombre_producto').val(),
            'opcion':opcion,
            'token':token,
        }

        $.ajax({
            type: "POST",
            url: "<?php print base_url();?>/index.php/Producto/SaveDatos",
            data: ParamObjSend,
            success: function(objView){
                $("#btn-response-view").prop('disabled',false)
                $("#btn-response-view").html('Guardar');
                $("#Resultado-View").html(objView);
                var opcion="<?php if(isset($producto)){echo '2';}else{echo '1';};?>";
            }
        });
    }


</script>
</html>