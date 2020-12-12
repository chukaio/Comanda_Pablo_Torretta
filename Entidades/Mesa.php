<?php
include_once("DB/AccesoDatos.php");
class Mesa
{
    //Atributos//
    public $codigo;
    public $estado;
    public $foto;

    //Metodos//
    //AddMesa
    public static function Registrar($codigo)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $respuesta = "";
        try {
            $consulta = $objetoAccesoDato->RetornarConsulta("INSERT INTO mesas (codigo_mesa, estado) 
                                                            VALUES (:codigo, 'Cerrada');");

            $consulta->bindValue(':codigo', $codigo, PDO::PARAM_STR);

            $consulta->execute();

            $respuesta = array("Estado" => "OK", "Mensaje" => "Mesa registrada correctamente.Codigo: ".$codigo);
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $respuesta = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        }
        finally {
            return $respuesta;
        }
    }    
    //GetMesas
    public static function Listar()
    {
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

            $consulta = $objetoAccesoDato->RetornarConsulta("SELECT codigo_mesa as codigo, estado, foto FROM mesas");

            $consulta->execute();

            $resultado = $consulta->fetchAll(PDO::FETCH_CLASS, "Mesa");
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $resultado = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        }
        finally {
            return $resultado;
        }
    }
    //Obtiene la mesa correspondiente al código
    public static function ObtenerPorCodigo($codigoMesa)
    {
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

            $consulta = $objetoAccesoDato->RetornarConsulta("SELECT codigo_mesa as codigo, estado, foto FROM mesas
                                                            WHERE codigo_mesa = :codigo");

            $consulta->bindValue(':codigo', $codigoMesa, PDO::PARAM_STR);
            $consulta->execute();

            $resultado = $consulta->fetchAll(PDO::FETCH_CLASS, "Mesa");
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $resultado = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        }
        finally {
            return $resultado;
        }
    }
    //DeleteMesa
    public static function Baja($codigo)
    {
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

            $consulta = $objetoAccesoDato->RetornarConsulta("DELETE FROM mesas WHERE codigo_mesa = :codigo");

            $consulta->bindValue(':codigo', $codigo, PDO::PARAM_STR);

            $consulta->execute();

            $respuesta = array("Estado" => "OK", "Mensaje" => "Mesa eliminada correctamente.");
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $respuesta = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        }
        finally {
            return $respuesta;
        }
    }
    //AdjuntarFotoMesa
    public static function ActualizarFoto($rutaFoto, $codigoMesa)
    {
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

            $consulta = $objetoAccesoDato->RetornarConsulta("UPDATE mesas SET foto = :rutaFoto WHERE codigo_mesa = :codigo");

            $consulta->bindValue(':codigo', $codigoMesa, PDO::PARAM_STR);
            $consulta->bindValue(':rutaFoto', $rutaFoto, PDO::PARAM_STR);

            $consulta->execute();

            $resultado = array("Estado" => "OK", "Mensaje" => "Foto actualizada correctamente.");
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $resultado = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        }
        finally {
            return $resultado;
        }
    }
    //CambiarEstadoMesaEsperando
    public static function EstadoEsperandoPedido($codigoMesa)
    {
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

            $consulta = $objetoAccesoDato->RetornarConsulta("UPDATE mesas SET estado = 'Con cliente esperando pedido' WHERE codigo_mesa = :codigo");

            $consulta->bindValue(':codigo', $codigoMesa, PDO::PARAM_STR);

            $consulta->execute();

            $resultado = array("Estado" => "OK", "Mensaje" => "Cambio de estado exitoso.");
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $resultado = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        }
        finally {
            return $resultado;
        }

    }
    //CambiarEstadoMesaComiendo
    public static function EstadoComiendo($codigoMesa)
    {
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

            $consulta = $objetoAccesoDato->RetornarConsulta("UPDATE mesas SET estado = 'Con clientes comiendo' WHERE codigo_mesa = :codigo");

            $consulta->bindValue(':codigo', $codigoMesa, PDO::PARAM_STR);

            $consulta->execute();

            $resultado = array("Estado" => "OK", "Mensaje" => "Cambio de estado exitoso.");
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $resultado = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        }
        finally {
            return $resultado;
        }
    }
    //CambiarEstadoMesaPagando
    public static function EstadoPagando($codigoMesa)
    {
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

            $consulta = $objetoAccesoDato->RetornarConsulta("UPDATE mesas SET estado = 'Con clientes pagando' WHERE codigo_mesa = :codigo");

            $consulta->bindValue(':codigo', $codigoMesa, PDO::PARAM_STR);

            $consulta->execute();

            $resultado = array("Estado" => "OK", "Mensaje" => "Cambio de estado exitoso.");
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $resultado = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        }
        finally {
            return $resultado;
        }
    }
    //CambiarEstadoMesaCerrada
    public static function EstadoCerrada($codigoMesa)
    {
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

            $consulta = $objetoAccesoDato->RetornarConsulta("UPDATE mesas SET estado = 'Cerrada' WHERE codigo_mesa = :codigo");

            $consulta->bindValue(':codigo', $codigoMesa, PDO::PARAM_STR);

            $consulta->execute();

            $resultado = array("Estado" => "OK", "Mensaje" => "Cambio de estado exitoso.");
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $resultado = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        }
        finally {
            return $resultado;
        }
    }
    //CambiarEstadoMesaCobrando
    //Calcula el importe final y genera la factura. Finaliza todos los pedidos de la mesa. 
    public static function Cobrar($codigoMesa)
    {
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $pedidos = Pedido::ListarPorMesa($codigoMesa);
            $importeFinal = 0;
            // echo "<br>"; 
            // echo('<pre>');
            // print_r($pedidos);
            // echo('</pre>');
            // echo "<br>";
            foreach($pedidos as $pedido){
                if(((object)$pedido)->estado == "Entregado"){ //Ver Cuando aplica este estado a que metodo y corregir el token en NuevoPedido
                    $importeFinal += ((object)$pedido)->importe;
                    // echo "<br>";  
                    // echo "ENTRE AL FIN AL IF";
                    // echo "<br>";  
                }                
            }   
            // echo "<br>"; 
            // echo $importeFinal;            
            // echo "<br>";   
            // echo $codigoMesa; 
            // echo "<br>";        
            Factura::Generar($importeFinal,$codigoMesa);
            Pedido::Finalizar($codigoMesa);
            $resultado = array("Estado" => "OK", "Mensaje" => "Se ha cobrado a la mesa con exito.");
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $resultado = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        }
        finally {
            return $resultado;
        }
    }    
    //ListarMasUsada
    public static function MasUsada()
    {
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

            $consulta = $objetoAccesoDato->RetornarConsulta("SELECT f.codigoMesa, count(f.codigoMesa) as cantidad_usos FROM facturas f 
                                                            GROUP BY(f.codigoMesa) HAVING count(f.codigoMesa) = 
                                                            (SELECT MAX(sel.cantidad_usos) FROM 
                                                            (SELECT count(f2.codigoMesa) as cantidad_usos FROM facturas f2 GROUP BY(f2.codigoMesa)) sel)");

            $consulta->execute();

            $resultado = $consulta->fetchAll();
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $resultado = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        }
        finally {
            return $resultado;
        }
    }    
    //ListarMenosUsada
    public static function MenosUsada()
    {
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

            $consulta = $objetoAccesoDato->RetornarConsulta("SELECT f.codigoMesa, count(f.codigoMesa) as cantidad_usos FROM facturas f 
                                                            GROUP BY(f.codigoMesa) HAVING count(f.codigoMesa) = 
                                                            (SELECT MIN(sel.cantidad_usos) FROM 
                                                            (SELECT count(f2.codigoMesa) as cantidad_usos FROM facturas f2 GROUP BY(f2.codigoMesa)) sel)");

            $consulta->execute();

            $resultado = $consulta->fetchAll();
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $resultado = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        }
        finally {
            return $resultado;
        }
    }
    //ListarMasFacturacion
    public static function MasFacturacion()
    {
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

            $consulta = $objetoAccesoDato->RetornarConsulta("SELECT f.codigoMesa, SUM(f.importe) as facturacion_total FROM facturas f 
                                                            GROUP BY(f.codigoMesa) HAVING SUM(f.importe) = 
                                                            (SELECT MAX(sel.facturacion_total) FROM
                                                            (SELECT SUM(f2.importe) as facturacion_total FROM facturas f2 GROUP BY(f2.codigoMesa)) sel)");

            $consulta->execute();

            $resultado = $consulta->fetchAll();
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $resultado = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        }
        finally {
            return $resultado;
        }
    }
    //ListarMenosFacturacion
    public static function MenosFacturacion()
    {
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

            $consulta = $objetoAccesoDato->RetornarConsulta("SELECT f.codigoMesa, SUM(f.importe) as facturacion_total FROM facturas f 
                                                            GROUP BY(f.codigoMesa) HAVING SUM(f.importe) = 
                                                            (SELECT MIN(sel.facturacion_total) FROM
                                                            (SELECT SUM(f2.importe) as facturacion_total FROM facturas f2 GROUP BY(f2.codigoMesa)) sel)");

            $consulta->execute();

            $resultado = $consulta->fetchAll();
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $resultado = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        }
        finally {
            return $resultado;
        }
    }
    //ListarConFacturaMayorImporte
    public static function ConFacturaConMasImporte()
    {
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

            $consulta = $objetoAccesoDato->RetornarConsulta("SELECT f.codigoMesa, f.importe as importe FROM facturas f WHERE f.importe = 
                                                            (SELECT MAX(f2.importe) as importe FROM facturas f2 ) GROUP BY (f.codigoMesa)");

            $consulta->execute();

            $resultado = $consulta->fetchAll();
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $resultado = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        }
        finally {
            return $resultado;
        }
    }
    //ListarConFacturaMenorImporte
    public static function ConFacturaConMenosImporte()
    {
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

            $consulta = $objetoAccesoDato->RetornarConsulta("SELECT f.codigoMesa, f.importe as importe FROM facturas f WHERE f.importe = 
                                                            (SELECT MIN(f2.importe) as importe FROM facturas f2 ) GROUP BY (f.codigoMesa)");

            $consulta->execute();

            $resultado = $consulta->fetchAll();
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $resultado = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        }
        finally {
            return $resultado;
        }
    }
    //ListarConMejorPuntuacion
    public static function ConMejorPuntuacion()
    {
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

            $consulta = $objetoAccesoDato->RetornarConsulta("SELECT f.codigoMesa, AVG(f.puntuacion_mesa) as puntuacion_promedio FROM encuestas f 
                                                            GROUP BY(f.codigoMesa) HAVING AVG(f.puntuacion_mesa) = 
                                                            (SELECT MAX(sel.puntuacion_promedio) FROM
                                                            (SELECT AVG(f2.puntuacion_mesa) as puntuacion_promedio FROM encuestas f2 GROUP BY(f2.codigoMesa)) sel)");

            $consulta->execute();

            $resultado = $consulta->fetchAll();
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $resultado = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        }
        finally {
            return $resultado;
        }
    }
    //ListarConPeorPuntuacion
    public static function ConPeorPuntuacion()
    {
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

            $consulta = $objetoAccesoDato->RetornarConsulta("SELECT f.codigoMesa, AVG(f.puntuacion_mesa) as puntuacion_promedio FROM encuestas f 
                                                            GROUP BY(f.codigoMesa) HAVING AVG(f.puntuacion_mesa) = 
                                                            (SELECT MIN(sel.puntuacion_promedio) FROM
                                                            (SELECT AVG(f2.puntuacion_mesa) as puntuacion_promedio FROM encuestas f2 GROUP BY(f2.codigoMesa)) sel)");

            $consulta->execute();

            $resultado = $consulta->fetchAll();
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $resultado = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        }
        finally {
            return $resultado;
        }
    }
    //ListarFacturacionEntreFechas
    public static function FacturacionEntreFechas($codigoMesa,$fecha1,$fecha2)
    {
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

            $consulta = $objetoAccesoDato->RetornarConsulta("SELECT f.codigoMesa, f.fecha, f.importe FROM facturas f 
                                                            WHERE f.codigoMesa = :codigoMesa AND f.fecha BETWEEN :fecha1 AND :fecha2;");

            $consulta->bindValue(':codigoMesa', $codigoMesa, PDO::PARAM_STR);
            $consulta->bindValue(':fecha1', $fecha1, PDO::PARAM_STR);
            $consulta->bindValue(':fecha2', $fecha2, PDO::PARAM_STR);
            $consulta->execute();

            $resultado = $consulta->fetchAll();
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $resultado = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        }
        finally {
            return $resultado;
        }
    }
}