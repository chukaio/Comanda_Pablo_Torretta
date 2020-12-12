<?php
include_once("Entidades/Token.php");
include_once("Entidades/Factura.php");

class FacturaAPI extends Factura
{
    //Metodos//    
    //GenerarFacturaPDF
    public function ListarVentasPDF($request, $response, $args)
    {
        $respuesta = Factura::ListarPDF();
        $newResponse = $response->withJson($respuesta, 200);
        return $newResponse;
    }
    //GenerarFacturaExcel
    public function ListarVentasExcel($request, $response, $args)
    {
        $respuesta = Factura::ListarExcel();
        $newResponse = $response->withJson($respuesta, 200);
        return $newResponse;
    }
    //ListarFacturasEntreFechas
    public function ListarFacturasEntreFechas($request, $response, $args)
    {
        $parametros = $request->getParsedBody();
        $fecha1 = $parametros["fecha1"];
        $fecha2 = $parametros["fecha2"];
        $respuesta = Factura::ListarEntreFechas($fecha1, $fecha2);
        $newResponse = $response->withJson($respuesta, 200);
        return $newResponse;
    }
}