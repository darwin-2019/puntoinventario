<?php
//verificar si existe en get el paramtro
if (isset($_GET['parametro'])) {




  function addtocart($pid, $price, $q, $sub_total_v)
  {
    if ($pid < 1 or $q < 1) return;
    if ($q < 1) return;
    if (!empty($_SESSION['detalle_venta'])) {


      if (is_array($_SESSION['detalle_venta'])) {

        if (product_exists($pid, $q)) return;

        $max = count($_SESSION['detalle_venta']);
        $_SESSION['detalle_venta'][$max]['id_producto'] = $pid;
        $_SESSION['detalle_venta'][$max]['cart_cantidad'] = $q;
        $_SESSION['detalle_venta'][$max]['cart_precio'] = $price;
        $_SESSION['detalle_venta'][$max]['cart_subtotal_v'] = $sub_total_v;
      } else {
        $_SESSION['detalle_venta'] = array();
        $_SESSION['detalle_venta'][0]['id_producto'] = $pid;
        $_SESSION['detalle_venta'][0]['cart_cantidad'] = $q;
        $_SESSION['detalle_venta'][0]['cart_precio'] = $price;
        $_SESSION['detalle_venta'][0]['cart_subtotal_v'] = $sub_total_v;
      }
    } else {
      $_SESSION['detalle_venta'] = array();
      $_SESSION['detalle_venta'][0]['id_producto'] = $pid;
      $_SESSION['detalle_venta'][0]['cart_cantidad'] = $q;
      $_SESSION['detalle_venta'][0]['cart_precio'] = $price;
      $_SESSION['detalle_venta'][0]['cart_subtotal_v'] = $sub_total_v;
    }

    return true;
  }
  function product_exists($pid, $q) //Verificar si existe un producto para actualizar la cantidad
  {
    $pid = intval($pid);
    $max = count($_SESSION['detalle_venta']);
    $flag = 0;
    for ($i = 0; $i < $max; $i++) {
      if ($pid == $_SESSION['detalle_venta'][$i]['id_producto']) {
        if ($q > 0) {
          $flag = 1;
          $_SESSION['detalle_venta'][$i]['cart_cantidad'] = $_SESSION['detalle_venta'][$i]['cart_cantidad'] + $q;
          $_SESSION['detalle_venta'][$i]['cart_subtotal_v'] = $_SESSION['detalle_venta'][$i]['cart_precio'] * $_SESSION['detalle_venta'][$i]['cart_cantidad'];
          break;
        }
        $flag = 1;

        break;
      }
    }
    return $flag;
  }

  function producto_cantidad($pid) //Verificar si existe un producto para actualizar la cantidad
  {
    $pid = intval($pid);
    $max = count($_SESSION['detalle_venta']);
    $cantidad = 0;
    for ($i = 0; $i < $max; $i++) {
      if ($pid == $_SESSION['detalle_venta'][$i]['id_producto']) {
       
         
          $cantidad = $_SESSION['detalle_venta'][$i]['cart_cantidad'];
        
          break;
     
      }
    }
    return $cantidad;
  }

  function removetocart($pid)
  {

    //Eliminar Producto del arreglo de sessiones
    unset($_SESSION['detalle_venta'][$pid]);
    $_SESSION['detalle_venta'] = array_values($_SESSION['detalle_venta']);
  }

 

  function  qty_status()//guardar la cantidad de productos
  {
    $cart_value = 0;
    if (isset($_SESSION['detalle_venta'])) {
      if (!empty($_SESSION['detalle_venta'])) {
        $count_cart = count($_SESSION['detalle_venta']);
        for ($i = 0; $i < $count_cart; $i++) {
          $cart_value  +=  $_SESSION['detalle_venta'][$i]['cart_cantidad'];
        }
      }
    }
    return $cart_value;
  }


  //Instancia a la tabla Producto
  require_once '../model/Producto.php';
  $obj = new producto();

  if ($_GET['parametro'] == "session") { //Mostrando los datos de la tabla producto 

    $idpro = intval($_GET['id_p']);
    $cantidad = intval($_GET['qty']);
    $precio = floatval($_GET['precio']);
    $cantidadActual = intval($_GET['cantidad']);
    $subtotal = ($cantidad * $precio);
    //Buscar cantidad total
    $qtyTotal = (producto_cantidad($idpro) + $cantidad);
    if ($qtyTotal > $cantidadActual) {
      echo "supera";
    } else {
      addtocart($idpro, $precio, $cantidad, $subtotal);
      echo "add";
    }
  } else if ($_GET['parametro'] == "deletesession") {
    $id = intval($_GET['id_']);
    removetocart($id);
  } else if ($_GET['parametro'] == "notificar") {
    echo qty_status();
  }
} else {

  header("location:../");
}
