<?php  
require_once '../model/Producto.php';
$obj = new producto();
$output = '';
  $output .= '<table border="1">
        <thead style="background-color: #f5f5f5;">
            <tr>
                <th>ID</th>
                <th>Nombre Producto</th>
                <th>Descripción</th>
                <th>Cantidad</th>
            </tr>
        </thead>
        <tbody>';

        foreach($obj->Listar() as $res):
            $output.='<tr>
                <td>'.$res->id.'</td>
                <td>'.$res->nombre_producto.'</td>
                <td>'.$res->descripcion.'</td>
                <td>'.$res->cantidad.'</td></tr>';
           endforeach;

        $output .= '</tbody></table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=inventario.xls');
  echo $output;
 

?>