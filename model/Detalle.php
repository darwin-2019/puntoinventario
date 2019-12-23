<?php
//llamando archivo conexion
require_once '../model/ConexionPdo.php';

class Detalle
{
    //Declaracion d variables
    private $pdo;

    public $id_detalle;
    public $cantidad;
    public $precio_actual;
    public $subtotal;
    public $id_producto;
    public $id_venta;
    //Constructor de la función
    public function __CONSTRUCT()
    {
        try {
            $this->pdo = ConexionPdo::Conexion();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }


    public function Listar($id) //Funcion para mostrar las ventas desde la base de datos
    {
        try {
            //Arrreglo
            $result = array();

            $stm = $this->pdo->prepare("SELECT * FROM tb_detalle_venta where id_venta=?");
            $stm->execute(array($id));

            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    //Función para registrar venta
    public function registrarDetalleVenta(Detalle $data)
    {
        try {
            $sql = "INSERT INTO tb_detalle_venta (cantidad,precio_actual,subtotal,id_producto,id_venta) 
		        VALUES (?, ?, ?,?, ?)";

            $this->pdo->prepare($sql)
                ->execute(
                    array(

                        $data->cantidad,
                        $data->precio_actual,
                        $data->subtotal,
                        $data->id_producto,
                        $data->id_venta
                    )
                );
            return true;
        } catch (Exception $e) {
            die($e->getMessage());
        }

        return false;
    }
}
