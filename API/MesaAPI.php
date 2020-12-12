<?php
include_once("Entidades/Token.php");
include_once("Entidades/Mesa.php");
include_once("Entidades/Foto.php");

class MesaApi extends Mesa
{
    //Metodos//
    //AddMesa
    public function RegistrarMesa($request, $response, $args)
    {
        $parametros = $request->getParsedBody();
        $codigo = $parametros["codigo"];

        $respuesta = Mesa::Registrar($codigo);
        $newResponse = $response->withJson($respuesta, 200);
        return $newResponse;
    }
    //GetMesas
    public function ListarMesas($request, $response, $args)
    {
        $respuesta = Mesa::Listar();
        $newResponse = $response->withJson($respuesta, 200);
        return $newResponse;
    }
    //DeleteMesa
    public function BajaMesa($request, $response, $args)
    {
        $codigo = $args["codigo"];
        $respuesta = Mesa::Baja($codigo);
        $newResponse = $response->withJson($respuesta, 200);
        return $newResponse;
    }
    //AdjuntarFotoMesa
    public function ActualizarFotoMesa($request, $response, $args)
    {
        $parametros = $request->getParsedBody();
        $files = $request->getUploadedFiles();
        $codigoMesa = $parametros["codigoMesa"];
        $foto = $files["foto"];

        //Consigo la extensión de la foto.  
        $ext = Foto::ObtenerExtension($foto);
        if ($ext != "ERROR") {
            //Guardo la foto.
            $rutaFoto = "./Fotos/Mesas/" . $codigoMesa . "." . $ext;
            Foto::GuardarFoto($foto, $rutaFoto);

            $respuesta = Mesa::ActualizarFoto($rutaFoto, $codigoMesa);
            $newResponse = $response->withJson($respuesta, 200);
            return $newResponse;
        } else {
            $respuesta = "Ocurrio un error.";
            $newResponse = $response->withJson($respuesta, 200);
            return $newResponse;
        }
    }
    //CambiarEstadoMesaEsperando
    public function CambiarEstado_EsperandoPedido($request, $response, $args)
    {
        $codigo = $args["codigo"];
        $respuesta = Mesa::EstadoEsperandoPedido($codigo);
        $newResponse = $response->withJson($respuesta, 200);
        return $newResponse;
    }
    //CambiarEstadoMesaComiendo
    public function CambiarEstado_Comiendo($request, $response, $args)
    {
        $codigo = $args["codigo"];
        $respuesta = Mesa::EstadoComiendo($codigo);
        $newResponse = $response->withJson($respuesta, 200);
        return $newResponse;
    }
    //CambiarEstadoMesaPagando
    public function CambiarEstado_Pagando($request, $response, $args)
    {
        $codigo = $args["codigo"];
        $respuesta = Mesa::EstadoPagando($codigo);
        $newResponse = $response->withJson($respuesta, 200);
        return $newResponse;
    }
    //CambiarEstadoMesaCerrada
    public function CambiarEstado_Cerrada($request, $response, $args)
    {
        $codigo = $args["codigo"];
        $respuesta = Mesa::EstadoCerrada($codigo);
        $newResponse = $response->withJson($respuesta, 200);
        return $newResponse;
    }
    //CambiarEstadoMesaCobrando
    //Calcula el importe final y genera la factura. Finaliza todos los pedidos de la mesa. 
    public function CobrarMesa($request, $response, $args)
    {
        $codigo = $args["codigo"];
        $respuesta = Mesa::Cobrar($codigo);
        $newResponse = $response->withJson($respuesta, 200);
        return $newResponse;
    }
    //ListarMasUsada
    public function MesaMasUsada($request, $response, $args)
    {
        $respuesta = Mesa::MasUsada();
        $newResponse = $response->withJson($respuesta, 200);
        return $newResponse;
    }
    //ListarMenosUsada
    public function MesaMenosUsada($request, $response, $args)
    {
        $respuesta = Mesa::MenosUsada();
        $newResponse = $response->withJson($respuesta, 200);
        return $newResponse;
    }
    //ListarMasFacturacion
    public function MesaMasFacturacion($request, $response, $args)
    {
        $respuesta = Mesa::MasFacturacion();
        $newResponse = $response->withJson($respuesta, 200);
        return $newResponse;
    }
    //ListarMenosFacturacion
    public function MesaMenosFacturacion($request, $response, $args)
    {
        $respuesta = Mesa::MenosFacturacion();
        $newResponse = $response->withJson($respuesta, 200);
        return $newResponse;
    }
    //ListarConFacturaMayorImporte
    public function MesaConFacturaConMasImporte($request, $response, $args)
    {
        $respuesta = Mesa::ConFacturaConMasImporte();
        $newResponse = $response->withJson($respuesta, 200);
        return $newResponse;
    }
    //ListarConFacturaMenorImporte
    public function MesaConFacturaConMenosImporte($request, $response, $args)
    {
        $respuesta = Mesa::ConFacturaConMenosImporte();
        $newResponse = $response->withJson($respuesta, 200);
        return $newResponse;
    }
    //ListarConMejorPuntuacion
    public function MesaConMejorPuntuacion($request, $response, $args)
    {
        $respuesta = Mesa::ConMejorPuntuacion();
        $newResponse = $response->withJson($respuesta, 200);
        return $newResponse;
    }
    //ListarConPeorPuntuacion
    public function MesaConPeorPuntuacion($request, $response, $args)
    {
        $respuesta = Mesa::ConPeorPuntuacion();
        $newResponse = $response->withJson($respuesta, 200);
        return $newResponse;
    }
    //ListarFacturacionEntreFechas
    public function MesaFacturacionEntreFechas($request, $response, $args)
    {
        $parametros = $request->getParsedBody();
        $codigoMesa = $parametros["codigoMesa"];
        $fecha1 = $parametros["fecha1"];
        $fecha2 = $parametros["fecha2"];
        $respuesta = Mesa::FacturacionEntreFechas($codigoMesa, $fecha1, $fecha2);
        $newResponse = $response->withJson($respuesta, 200);
        return $newResponse;
    }
}