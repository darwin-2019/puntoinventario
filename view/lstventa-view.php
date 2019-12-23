<?php
//Incluir el encabezado o menu de la página
include 'resource/header.php';

?>
<script>
    $(document).ready(function() {


        $("#li_producto").removeClass('active');
        $("#li_venta").addClass('active');
        cargarVenta();
    });
</script>
<!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#" aria-controls="tab_desc" role="tab" data-toggle="tab" aria-expanded="true">Listado de Ventas</a></li>

</ul>

<!-- Tab panes -->
<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="tab_desc">

        <br>
        <a href="javascript:imprSelec('imprimir_')" class="btn btn-info"><span class="fa fa-print"></span></a>
        <!-- Cargar los datos mediante ajax -->
        <div id="loaderv" style="position: absolute; text-align: left; top: 320px;  width: 100%;display:none;"></div>
        <div class="vertablav"></div>

    </div>


</div>


<?php
//Incluir el pie de página
include 'resource/footer.php';
?>