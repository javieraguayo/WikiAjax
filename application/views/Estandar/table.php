<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

</head>

<div class="row">
                <div class="col-md-12">
                    <h3>Insertar Datos </h3>
                    <div class="form-group col-md-4">
                        <label for="ejemplo_email_1">Nombre Producto</label>
                        <input type="text" name="nombre" class="form-control" id="nombre_producto"
                               placeholder="Introduce nombre del producto" value="<?php if(isset($producto)){echo $producto->NombreProducto;}?>">
                         <br>
                         <input type="hidden" name="token" id="token" value="<?php if (isset($producto)){echo $producto->token;}?>">
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
                    <td> <a href="<?=base_url();?>index.php/Producto/Modificar/<?=$p->token?>/2" class="btn btn-primary"><i class="fa fa-edit"></i>Editar</i></a>
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

    function modificar(){
    
    var token = $('#token').val();
    var nombre =$('#nombre').val();
  

    var ObjJson={
      'token':token,
      'nombre':nombre,
      
    };
    


    $.ajax({
      type: "POST",
      url: "<?php print base_url();?>index.php/Producto/editar",
      data: ObjJson,
      success: function(datos){
        alert('Sucursal Modificada');
        window.location="<?=base_url();?>index.php/Producto/editar";
      }
    });

  }


</script>
</html>