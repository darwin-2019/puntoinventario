<?php
//llamando archivo conexion
require_once '../model/ConexionPdo.php';

class Venta
{
	//Declaracion d variables
	private $pdo;

	public $id_venta;
	public $nombre_cliente;
	public $responsable_venta;
	public $fecha_venta;
	//Constructor de la función
	public function __CONSTRUCT()
	{
		try {
			$this->pdo = ConexionPdo::Conexion();
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function Obtener_ultimo_id()
	{
		try {
			$stm = $this->pdo
				->prepare("SELECT max(id_venta) as id_venta FROM tb_venta");

			$stm->execute();
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
    }
    
    public function Listar() //Funcion para mostrar las ventas desde la base de datos
	{
		try {
			//Arrreglo
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM tb_venta order by id_venta desc");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
    }
    //Función para registrar venta
	public function registrarVenta(Venta $data)
	{
		try {
			$sql = "INSERT INTO tb_venta (nombre_cliente,responsable_venta,fecha_venta) 
		        VALUES (?, ?, ?)";

			$this->pdo->prepare($sql)
				->execute(
					array(

						$data->nombre_cliente,
						$data->responsable_venta,
						$data->fecha_venta
					)
				);
			return true;
		} catch (Exception $e) {
			die($e->getMessage());
		}

		return false;
	}

}
