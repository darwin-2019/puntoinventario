<?php
//verificar si existe en get el paramtro
if (isset($_GET['parametro'])) {


    //Instancia a la tablas
    require_once '../model/Producto.php';
    $obje = new Producto();
    require_once '../model/Venta.php';
    $obj = new Venta();
    require_once '../model/Detalle.php';



    if ($_GET['parametro'] == "cart_save") { //Mostrando los datos de la tabla producto 

        //capturando los datos
        $obj->nombre_cliente = htmlentities($_GET['cliente']);
        $obj->responsable_venta = htmlentities($_GET['responsable']);
        $obj->fecha_venta = $_GET['fecha'];
        //Registrar Venta
        $obj->registrarVenta($obj);
        //Obtener el ultimo id de las ventas
        $idventa = new Venta();
        $idventa =  $obj->Obtener_ultimo_id();
        $id_ultimo = $idventa->id_venta;

        if (!empty($_SESSION['detalle_venta'])) {
            $count_cart = count($_SESSION['detalle_venta']);

            for ($i = 0; $i < $count_cart; $i++) {
                //instancia al detalle
                $objDetalle = new Detalle();
                $objDetalle->cantidad = $_SESSION['detalle_venta'][$i]['cart_cantidad'];
                $objDetalle->precio_actual = $_SESSION['detalle_venta'][$i]['cart_precio'];
                $objDetalle->subtotal = $_SESSION['detalle_venta'][$i]['cart_subtotal_v'];
                $objDetalle->id_producto = $_SESSION['detalle_venta'][$i]['id_producto'];
                $objDetalle->id_venta = $id_ultimo;
                //Registrar Detalle de venta
                $objDetalle->registrarDetalleVenta($objDetalle);

                //Descontar cantidad del inventario
                $objProducto = new Producto();
                $objProducto->cantidad = $_SESSION['detalle_venta'][$i]['cart_cantidad'];
                $objProducto->id = $_SESSION['detalle_venta'][$i]['id_producto'];

                $objProducto->actualizarProductoCantidad($objProducto);
            }
            //Limpiar session
            unset($_SESSION['detalle_venta']);
            @$_SESSION['detalle_venta'] = array_values(@$_SESSION['detalle_venta']);

            echo "add";
        }
    } else if ($_GET['parametro'] == "lista") { //Mostrando los datos de la tabla producto 
        $objVenta = new Venta();
?>
        <!-- Tabla de los Ventas -->
        <script>
            function imprSelec(historial) {
                var ficha = document.getElementById(historial);
                var ventimp = window.open(' ', 'popimpr');
                ventimp.document.write('<link href="./librerias/bootstrap.min.css" rel="stylesheet">');
                ventimp.document.write(ficha.innerHTML);
                ventimp.document.close();
                ventimp.print();
                ventimp.close();
            }
        </script>
        <div class="table-responsive" id="imprimir_">
            <table id="venta_view" class="table table-striped table-bordered table-hover" border="1px">
                <thead class="btn-warning">
                    <tr>
                        <th width="6%">#ID</th>

                        <th>Nombre Cliente</th>
                        <th>Responsable de Venta</th>
                        <th>Fecha</th>
                        <th>Detalle</th>
                    </tr>
                </thead>

                <tbody>

                    <?php foreach ($objVenta->Listar() as $res) : //Recorrer la tabla mediante la función
                    ?>
                        <tr>

                            <td><?php echo $res->id_venta; ?></td>
                            <td><?php echo $res->nombre_cliente; ?></td>
                            <td><?php echo $res->responsable_venta; ?></td>
                            <td><?php echo $res->fecha_venta; ?></td>
                            <td>
                                <table class="table table-striped table-bordered table-hover" border="1px">
                                    <thead class="panel-default">
                                        <tr>
                                            <th>Nombre Producto</th>
                                            <th>Precio</th>
                                            <th>Cantidad</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $total = 0;
                                        $cant = 0;
                                        $objDetallar = new Detalle();
                                        foreach ($objDetallar->Listar($res->id_venta) as $resu) : //Recorrer la tabla mediante la función
                                            $total += $resu->subtotal;
                                            $cant += $resu->cantidad;
                                            $product = new Producto();
                                            $product = $obje->Obtener_productos_id($resu->id_producto);

                                        ?>
                                            <tr>
                                                <td><?php echo $product->nombre_producto; ?></td>
                                                <td><?php echo $resu->precio_actual; ?></td>
                                                <td><?php echo $resu->cantidad; ?></td>
                                                <td><?php echo $resu->subtotal; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="2" class="alert text-right">

                                                <h5><strong>Totales: </strong>
                                                </h5>

                                            </td>
                                            <td><span style="color: white;" class="badge badge-success" id="canti_"> <?php echo $cant; ?></span></td>
                                            <td>$ <?php echo number_format($total, 2); ?></td>
                                            <td></td>
                                        </tr>

                                    </tfoot>
                                </table>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>


            </table>

            <br>


        </div>

<?php
    } else if ($_GET['parametro'] == "import") {
        $fileName = $_FILES["archivocsv"]["tmp_name"];

        if ($_FILES["archivocsv"]["size"] > 0) {

            $file = fopen($fileName, "r");
            $i = 0;
            while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
                if ($i != 0) {
                    $objeto = new Producto();
                    $objeto->nombre_producto = $column[1];
                    $objeto->descripcion = $column[2];
                    $objeto->cantidad = $column[3];
                    $objeto->registrarProducto($objeto);
                }
                $i++;
            }
        }
    } else {
        header("location:../");
    } //fin if 
} else {

    header("location:../");
}
