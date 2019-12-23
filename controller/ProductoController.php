<?php
//verificar si existe en get el paramtro
if (isset($_GET['parametro'])) {


    //Instancia a la tabla Producto
    require_once '../model/Producto.php';
    $obj = new Producto();

    if ($_GET['parametro'] == "mostrar") { //Mostrando los datos de la tabla producto 

?>

        <!-- Tabla de los productos -->
        <div class="table-responsive">
            <table id="producto_view" class="table table-striped table-bordered table-hover">
                <thead class="btn-warning">
                    <tr>
                        <th width="6%">#ID</th>

                        <th>Nombre Producto</th>
                        <th>Descripción</th>
                        <th>Cantidad</th>

                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>

                    <?php foreach ($obj->Listar() as $res) : //Recorrer la tabla mediante la función
                    ?>
                        <tr>
                            <!-- Inputs para mostrar los valores en el modal de edición -->
                            <input type="hidden" id="pro_nombre_<?php echo $res->id; ?>" value="<?php echo $res->nombre_producto; ?>">
                            <input type="hidden" id="pro_descripcion_<?php echo $res->id; ?>" value="<?php echo $res->descripcion; ?>">
                            <input type="hidden" id="pro_cantidad_<?php echo $res->id; ?>" value="<?php echo $res->cantidad; ?>">


                            <td><?php echo $res->id; ?></td>
                            <td><?php echo $res->nombre_producto; ?></td>
                            <td><?php echo $res->descripcion; ?></td>
                            <td><?php echo $res->cantidad; ?></td>
                            <td width="8%">
                                <div class="btn-group pull-right">
                                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> <i class="fa fa-cog"></i> Acciones <span class="fa fa-caret-down"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="javascript:void();" onclick="editar_producto(<?php echo $res->id; ?>);" data-toggle="modal" data-target=".myModalProducto_edit"><i class="fa fa-edit"></i> Editar</a></li>


                                        <li><a href="javascript:void();" onclick="eliminar_producto(<?php echo $res->id; ?>);"><i class="fa fa-trash"></i> Eliminar</a></li>

                                    </ul>

                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>


            </table>

            <br>
            <script>
                $(document).ready(function() {


                    //datatables
                    table = $('#producto_view').DataTable({
                        "pageLength": 5,
                        "order": [
                            [0, "desc"]
                        ]
                    });
                });
            </script>

        </div>
    <?php
    } else  if ($_GET['parametro'] == "add") { //Mostrando los datos en la tabla de la factura

    ?>
        <script>
            $(document).ready(function() {


                $(".precios_venta").inputmask();

            });
        </script>
        <!-- Tabla que se muestra en el modal de factura -->
        <div class="table-responsive">
            <table id="producto_view_cart" class="table table-striped table-bordered table-hover">
                <thead class="btn-warning">
                    <tr>

                        <th>Descripción del Producto</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Add</th>
                    </tr>
                </thead>

                <tbody>

                    <?php foreach ($obj->Listar() as $res) : ?>
                        <tr>

                            <input type="hidden" id="_cantidad<?php echo $res->id; ?>" value="<?php echo $res->cantidad; ?>">
                            <td><strong><?php echo $res->nombre_producto; ?></strong><br>
                                <small><?php echo $res->descripcion; ?></small></td>
                            <td width="6%"><?php echo $res->cantidad; ?></td>
                            <td><input type="text" id="_precio<?php echo $res->id; ?>" class="form-control precios_venta" data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'placeholder': '0.00'" placeholder="0.00" onblur="validarDecimal(this);" onkeydown="validarDecimal(this);"></td>
                            <td width="7%">


                                <div class="form-group">
                                    <div class="input-group" style="width:130px">

                                        <input value="1" class="form-control text-center" id="_qty<?php echo $res->id; ?>" required="" min="1" type="number" onblur="roundNumber(this,1);" onkeydown="roundNumber(this,1);">
                                        <span class="input-group-btn">
                                            <button type="button" name="addToCartBtn" id="addToCartBtn" class="btn btn-default" onclick="addVenta(<?php echo $res->id; ?>)"> <i class="fa fa-shopping-cart"></i></button>
                                        </span>
                                    </div>
                                </div>

                            </td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>


            </table>
            <script>
                $(document).ready(function() {


                    //datatables
                    table = $('#producto_view_cart').DataTable({
                        "pageLength": 5,
                        "order": [
                            [0, "desc"]
                        ]
                    });
                });
            </script>
            <br>

        </div>
    <?php
    } else  if ($_GET['parametro'] == "detalle") { //Mostrando el detalle de venta

    ?>

        <div class="table-responsive">
            <table id="" class="table table-striped table-bordered table-hover">
                <thead style="background-color: #ff9">
                    <tr>
                        <td colspan="8" align="center"><strong>DETALLE DE VENTA</strong></td>
                    </tr>
                </thead>
                <thead class="btn-success">
                    <tr>
                        <th>#</th>
                        <th>Descripción del Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Sub-Total</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>

                    <?php
                    $total = 0;
                    $cant = 0;
                    $count_cart = 0;
                    if (!empty($_SESSION['detalle_venta'])) {
                        $count_cart = count($_SESSION['detalle_venta']);
                        for ($i = 0; $i < $count_cart; $i++) {
                            $product = new Producto();
                            $product = $obj->Obtener_productos_id($_SESSION['detalle_venta'][$i]['id_producto']);
                            $total += $_SESSION['detalle_venta'][$i]['cart_subtotal_v'];
                            $cant += $_SESSION['detalle_venta'][$i]['cart_cantidad'];
                    ?>
                            <tr>
                                <td><?php echo $i + 1 ?></td>
                                <td><strong><?php echo $product->nombre_producto; ?></strong>
                                    <br>
                                    <small><?php echo $product->descripcion; ?></small></td>
                                <td>$ <?php echo number_format($_SESSION['detalle_venta'][$i]['cart_precio'], 2) ?></td>
                                <td width="6%"> <?php echo $_SESSION['detalle_venta'][$i]['cart_cantidad'] ?></td>
                                <td width="15%">
                                    $ <?php echo number_format($_SESSION['detalle_venta'][$i]['cart_subtotal_v'], 2) ?>
                                </td>
                                <td width="6%"><button class="btn btn-danger" onclick="eliminar_producto_session(<?php echo $i; ?>);"><span class="fa fa-trash"></span></button></td>
                            </tr>

                        <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="8" style="text-align: center;">
                                <div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong><i class="fa fa-shopping-cart"></i></strong> No hay productos agregados
                                </div>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                <tfoot>
                    <tr>
                        <td colspan="3" class="alert text-right">

                            <h5><strong>Totales: </strong>
                            </h5>

                        </td>
                        <td><span style="color: white;" class="badge badge-success" id="canti_"> <?php echo $cant; ?></span></td>
                        <td>$ <?php echo number_format($total, 2); ?></td>
                        <td></td>
                    </tr>


                    <tr>
                        <td colspan="8" class="alert alert-info">
                            ¡Advertencia!, Para finalizar la venta, debes presionar "Procesar Venta" </td>
                    </tr>
                </tfoot>
                </tbody>
                <input type="hidden" value="<?php echo $count_cart; ?>" id="recorrer_t">


            </table>

            <br>

        </div>
<?php
    } else if ($_GET['parametro'] == "guardar") { //Guardar datos

        //capturando los datos
        $obj->nombre_producto = htmlentities($_POST['pro_nombre']);
        $obj->descripcion = htmlentities($_POST['pro_descripcion']);
        $obj->cantidad = intval($_POST['pro_cantidad']);

        //verificar si se almacenó con exito
        if ($obj->registrarProducto($obj)) {
            echo "registrado";
        } else {
            echo "error";
        } //fin if
    } else if ($_GET['parametro'] == "eliminar") { //Elimar datos
        //capturando id
        $id = intval($_GET['id_producto']);
        //verificar si hubo eliminación con exito
        if ($obj->eliminarProducto($id)) {
            echo "eliminado";
        } else {
            echo "error";
        } //fin if
    } else if ($_GET['parametro'] == "editar") { //Actualizar datos

        //capturando los datos
        $obj->id = intval($_POST['id_edit']);
        $obj->nombre_producto = htmlentities($_POST['pro_nombre_edit']);
        $obj->descripcion = htmlentities($_POST['pro_descripcion_edit']);
        $obj->cantidad = intval($_POST['pro_cantidad_edit']);

        //verificar si se almacenó con exito
        if ($obj->actualizarProducto($obj)) {
            echo "actualizado";
        } else {
            echo "error";
        } //fin if
    } else {
        header("location:../");
    } //fin if 
} else {

    header("location:../");
}


?>