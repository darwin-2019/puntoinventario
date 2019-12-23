<?php
session_start();
header("Content-Type: text/html;charset=utf-8");
class ConexionPdo
{
    private $conn = null;
    

    public static function Conexion()
    {
     

        try {
         
            @$conn = new PDO('mysql:host=localhost;port=3307; dbname=db_prueba', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
            //echo 'Conexion satisfactoria.<br>';
            

        } catch (PDOException $e) {
            echo '<script>';
            echo 'var pBar = document.getElementById("p");
     var updateProgress = function(value)
     {
        pBar.value = value;
        pBar.getElementByTagName("span")[0].innerHTML = Math.floor((100 / 70) * value);
     }';
            echo "</script>";
            echo "<style='background-color:lightgrey'>";
            echo "<hr>";
            echo '<br><center><h1 style="font-size:300%"><p><font color="red">¡No se puede conectar con la base de datos!</font></p></h1>';
            echo "<embed src='./model/cad.png' heigth='50' width='50'></embed><br><br><progress id='p' max='70'> <span>0</span>%</progress><br>";
            echo "<hr width='80%' color='black' size='8' /></center>";
            echo "<p>Posibles causas:</p>
    <ol>
        <li>Ha perdido conexión con el servidor. </li>
        <li>Base de datos no encontrada. </li>
        <li>Conexión expirada. </li>
        <li>Clave o usuario incorrectos. </li>
        <li>La base de datos fue removida. </li>
    </ol>";

            echo "<center><h2 style='color:green'>Debes consultar a soporte t&eacute;cnico.</h2></center>";
            exit();
        }

        return $conn;
    }
}
