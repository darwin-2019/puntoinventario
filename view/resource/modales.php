<!-- Inicio del Modal de registro del producto -->

<div class="myModalProducto modal fade" style="display: none;">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#f1c40f;color:white">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h5 style="text-align: center; font-size: 40px;"><i class="fa fa-plus"></i> <span>Registrar Producto</span> <span class="fa fa-briefcase"></span></h5>
            </div>
            <div class="modal-body">
                <!-- Formulario de ingreso de los datos -->
                <form class="" id="form_producto" name="form_producto" autocomplete="off" method="POST" action="#">

                    <div align="right">
                        <span style="color:red;">*</span> Datos Obligatorios
                    </div>
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#datosinf">Datos del Producto</a></li>

                    </ul><br>

                    <div id="add-brand-messages"></div>
                    <div class="tab-content">


                        <div id="datosinf" class="tab-pane fade in active">
                            <table width="100%" class="responsive">

                                <tr>
                                    <td colspan="4">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td align="right">Nombre Producto: <span style="color:red;">*</span>&nbsp;</td>
                                    <td><input type="text" name="pro_nombre" onkeypress="return soloLetras(event)" onkeyup="this.value = this.value.toUpperCase();" onpaste="return false" id="pro_nombre" placeholder="Nombre Producto" class="form-control"></td>

                                    <td align="right">Cantidad: <span style="color:red;">*</span>&nbsp;</td>
                                    <td><input type="number" min="1" value="1" name="pro_cantidad" id="pro_cantidad" placeholder="Cantidad" class="form-control" required="" onblur="roundNumber(this,1);" onkeydown="roundNumber(this,1);"></td>

                                </tr>


                                <tr>
                                    <td colspan="4">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td align="right">Descripci&oacute;n&nbsp;: <span style="color:red;">*</span>&nbsp; &nbsp; </td>
                                    <td colspan="3"><textarea class="form-control" placeholder="Descripci&oacute;n&nbsp;" name="pro_descripcion" id="pro_descripcion"></textarea> </td>

                                </tr>
                            </table>


                        </div>
                        <br>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-info"><i class="fa fa-eraser"></i> Limpiar</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>
                            <l id="btnguardar_pro">Guardar</l>
                        </button>
                    </div>
                </form> <!-- Fin form-->

            </div>
        </div>
    </div>
</div><!-- Fin modal-->

<!-- Inicio del Modal de actualización del producto -->

<div class="myModalProducto_edit modal fade" style="display: none;">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#f1c40f;color:white">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h5 style="text-align: center; font-size: 40px;"><i class="fa fa-pencil"></i> <span>Actualizar Producto</span> <span class="fa fa-briefcase"></span></h5>
            </div>
            <div class="modal-body">
                <!-- Formulario de ingreso de los datos -->
                <form class="" id="form_producto_edit" name="form_producto_edit" autocomplete="off" method="POST" action="#">
                    <input type="hidden" name="id_edit" id="id_edit" value="">

                    <div align="right">
                        <span style="color:red;">*</span> Datos Obligatorios
                    </div>
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#datosinf">Datos del Producto</a></li>

                    </ul><br>

                    <div id="add-brand-messages_edit"></div>
                    <div class="tab-content">


                        <div id="datosinf" class="tab-pane fade in active">
                            <table width="100%" class="responsive">

                                <tr>
                                    <td colspan="4">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td align="right">Nombre Producto: <span style="color:red;">*</span>&nbsp;</td>
                                    <td><input type="text" name="pro_nombre_edit" onkeypress="return soloLetras(event)" onkeyup="this.value = this.value.toUpperCase();" onpaste="return false" id="pro_nombre_edit" placeholder="Nombre Producto" class="form-control"></td>

                                    <td align="right">Cantidad: <span style="color:red;">*</span>&nbsp;</td>
                                    <td><input type="number" min="1" name="pro_cantidad_edit" id="pro_cantidad_edit" placeholder="Cantidad" class="form-control" required="" onblur="roundNumber(this,1);" onkeydown="roundNumber(this,1);"></td>

                                </tr>


                                <tr>
                                    <td colspan="4">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td align="right">Descripci&oacute;n&nbsp;: <span style="color:red;">*</span>&nbsp; &nbsp; </td>
                                    <td colspan="3"><textarea class="form-control" placeholder="Descripci&oacute;n&nbsp;" name="pro_descripcion_edit" id="pro_descripcion_edit"></textarea> </td>

                                </tr>
                            </table>


                        </div>
                        <br>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-info"><i class="fa fa-eraser"></i> Limpiar</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>
                            <l id="btneditar_pro">Actualizar</l>
                        </button>
                    </div>
                </form> <!-- Fin form-->

            </div>
        </div>
    </div>
</div><!-- Fin modal-->


<!-- Inicio del Modal de importar de archivo CSV -->

<div class="myModalProducto_import modal fade" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#f1c40f;color:white">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h5 style="text-align: center; font-size: 40px;"><i class="fa fa-upload"></i> <span>Importar CSV</span> <span class="fa fa-file-excel-o"></span></h5>
            </div>
            <div class="modal-body">
                <!-- Formulario de ingreso de los datos -->
                <form class="" id="form_producto_import" name="form_producto_import" autocomplete="off" method="POST" action="#" enctype="multipart/form-data">

                    <div align="right">
                        <span style="color:red;">*</span> Datos Obligatorios
                    </div>
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#datosinf">Subir Datos</a></li>

                    </ul><br>

                    <div id="add-brand-messages_import"></div>
                    <div class="tab-content">


                        <div id="datosinf" class="tab-pane fade in active">
                            <table width="100%" class="responsive">

                                <tr>
                                    <td colspan="4">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td align="right">Archivo CSV: <span style="color:red;">*</span>&nbsp;</td>
                                    <td><input type="file" name="archivocsv" id="archivocsv" accept=".csv" placeholder="Archivo CSV" class="form-control" required=""></td>

                                </tr>


                            </table>


                        </div>
                        <br>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-info"><i class="fa fa-eraser"></i> Limpiar</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
                        <button type="submit" class="btn btn-success"><i class="fa fa-cloud-upload"></i>
                            <l id="btnsubir_pro">Guardar</l>
                        </button>
                    </div>
                </form> <!-- Fin form-->

            </div>
        </div>
    </div>
</div><!-- Fin modal-->






<!-- Inicio del Modal de Carrito de Compras -->

<div class="myModalProducto_cart modal fade" style="display: none;">
    <div class="modal-dialog modal-lg" style="width: 100%;">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#f1c40f;color:white">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h5 style="text-align: center; font-size: 40px;"><i class="fa fa-money"></i> <span> FACTURA </span> <span class="fa fa-shopping-cart"></span></h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-5">
                        <!-- Cargar los datos mediante ajax -->
                        <div id="loader_" style="position: absolute; text-align: left; top: 320px;  width: 100%;display:none;"></div>
                        <div class="vertabla_"></div>
                    </div>

                    <div class="col-md-7">

                        <div align="right">
                            <span style="color:red;">*</span> Datos Obligatorios
                        </div>
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#datosinf">Datos de Factura</a></li>

                        </ul><br>
                        <div id="mensaje_"></div>
                        <div class="tab-content">


                            <div id="datosinf" class="tab-pane fade in active">
                                <table width="100%" class="responsive">
                                    <tr>
                                        <td colspan="4">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td align="right">Cliente: <span style="color:red;">*</span>&nbsp;</td>
                                        <td><input type="text" name="cli_nombre" onkeypress="return soloLetras(event)" onkeyup="this.value = this.value.toUpperCase();" onpaste="return false" id="cli_nombre" placeholder="Nombre Cliente" class="form-control"></td>

                                        <td align="right">Responsable: <span style="color:red;">*</span>&nbsp;</td>
                                        <td><input type="text" name="responsable" id="responsable" onkeypress="return soloLetras(event)" onkeyup="this.value = this.value.toUpperCase();" placeholder="Responsable Venta" class="form-control"></td>

                                    </tr>


                                    <tr>
                                        <td colspan="4">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td align="right">Fecha: <span style="color:red;">*</span>&nbsp;</td>
                                        <td><input type="date" name="fecha" id="fecha" placeholder="Fecha Venta" value="<?php echo date('Y-m-d'); ?>" class="form-control"></td>

                                    </tr>

                                </table>

                            </div> <br>
                            <!-- Cargar los datos mediante ajax -->
                            <div id="loaderr" style="position: absolute; text-align: left; top: 320px;  width: 100%;display:none;"></div>
                            <div class="vertablar"></div>

                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-danger"><i class="fa fa-eraser"></i> Vaciar</button> -->
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
                    <button type="submit" class="guardar-carrito btn btn-success"><i class="fa fa-check-square-o"></i>
                        Procesar Venta
                    </button>
                </div>


            </div>
        </div>
    </div>
</div><!-- Fin modal-->