<?php
//llamando archivo conexion
require_once '../model/ConexionPdo.php';

class Producto
{
	//Declaracion d variables
	private $pdo;

	public $id;
	public $nombre_producto;
	public $cantidad;
	public $descripcion;
	//Constructor de la función
	public function __CONSTRUCT()
	{
		try {
			$this->pdo = ConexionPdo::Conexion();
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function Listar() //Funcion para mostrar los productos desde la base de datos
	{
		try {
			//Arrreglo
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM tb_producto");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	//Función para registrar producto
	public function registrarProducto(Producto $data)
	{
		try {
			$sql = "INSERT INTO tb_producto (nombre_producto,descripcion,cantidad) 
		        VALUES (?, ?, ?)";

			$this->pdo->prepare($sql)
				->execute(
					array(

						$data->nombre_producto,
						$data->descripcion,
						$data->cantidad

					)
				);
			return true;
		} catch (Exception $e) {
			die($e->getMessage());
		}

		return false;
	}

	//Función para eliminar Prodcucto
	public function eliminarProducto($id)
	{
		try {
			$stm = $this->pdo
				->prepare("DELETE FROM tb_producto WHERE id = ?");
			$stm->execute(array($id));
			return true;
		} catch (Exception $e) {
			die($e->getMessage());
		}
		return false;
	}

	//Función para buscar productos pod ID
	public function Obtener_productos_id($id)
	{
		try {
			$stm = $this->pdo
				->prepare("SELECT * FROM tb_producto WHERE id = ?");


			$stm->execute(array($id));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}


	public function actualizarProducto(Producto $data)
	{
		try {
			$sql = "UPDATE tb_producto SET 
						nombre_producto      		= ?,
						descripcion          = ?, 
						cantidad        = ?
						
				    WHERE id = ?";

			$this->pdo->prepare($sql)
				->execute(
					array(
						$data->nombre_producto,
						$data->descripcion,
						$data->cantidad,
						$data->id
					)
				);
			return true;
		} catch (Exception $e) {
			die($e->getMessage());
		}
		return false;
	} //Fin if actualizarProducto
	public function actualizarProductoCantidad(Producto $data)
	{
		try {
			$sql = "UPDATE tb_producto SET 
						cantidad = (cantidad - ?)
						
				    WHERE id = ?";

			$this->pdo->prepare($sql)
				->execute(
					array(
						$data->cantidad,
						$data->id
					)
				);
			return true;
		} catch (Exception $e) {
			die($e->getMessage());
		}
		return false;
	} //Fin if actualizarProducto
}
