<?php
//Incluir el encabezado o menu de la página
include 'resource/header.php';

?>

<!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#" aria-controls="tab_desc" role="tab" data-toggle="tab" aria-expanded="true">Listado de Productos</a></li>

</ul>

<!-- Tab panes -->
<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="tab_desc">
        <div><br></div>
        <table width="100%">
            <tbody>
                <tr>
                    <td><button type="button" class="btn btn-success" data-toggle="modal" data-target=".myModalProducto"> <span class="fa fa-plus"></span> Nuevo</button></td>
                    <td align="right">
                        <div class="btn-group pull-right">
                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> <i class="fa fa-file-o"></i> Acciones <span class="fa fa-caret-down"></span></button>
                            <ul class="dropdown-menu">
                                <li><a href="./reporte/export.php" target="_blank"><i class="fa fa-file-excel-o"></i>  Export xls <i class="fa fa-download"></i></a> </li>
                                <li><a href="javascript: void();"  data-toggle="modal" data-target=".myModalProducto_import"><i class="fa fa-file-excel-o"></i> Import CSV <i class="fa fa-upload"></i></a> </li>

                            </ul>

                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <br>
        <div id="mensaje"></div>
        <!-- Cargar los datos mediante ajax -->
        <div id="loader" style="position: absolute; text-align: left; top: 320px;  width: 100%;display:none;"></div>
        <div class="vertabla"></div>

    </div>


</div>


<?php
//Incluir el pie de página
include 'resource/footer.php';
?>