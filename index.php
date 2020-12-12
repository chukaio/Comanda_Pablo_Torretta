<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
require './vendor/autoload.php';
include_once './API/EmpleadoAPI.php';
include_once './API/MesaAPI.php';
include_once './API/MenuAPI.php';
include_once './API/PedidoAPI.php';
include_once './API/EncuestaAPI.php';
include_once './API/FacturaAPI.php';
include_once './Middleware/EmpleadoMW.php';
include_once './Middleware/OperacionMW.php';
include_once './Middleware/PedidoMW.php';
include_once './Middleware/EncuestaMW.php';

$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;
$app = new \Slim\App([
    'settings' => [
        'displayErrorDetails' => true
    ]
]);
//---------------------------------------------------------------------------------
////EMPLEADOS////
$app->group('/empleados', function () {
//AddEmpleado
$this->post('/registrarEmpleado[/]', \EmpleadoAPI::class . ':RegistrarEmpleado')
->add(\OperacionMW::class . ':SumarOperacionAEmpleado')
->add(\EmpleadoMW::class . ':ValidarSocio')
->add(\EmpleadoMW::class . ':ValidarToken');   
//LoginEmpleado
$this->post('/login[/]', \EmpleadoAPI::class . ':LoginEmpleado');
//SuspendEmpleado
$this->delete('/suspender/{usuario}[/]', \EmpleadoAPI::class . ':SuspenderEmpleado')
->add(\OperacionMW::class . ':SumarOperacionAEmpleado')
->add(\EmpleadoMW::class . ':ValidarSocio')
->add(\EmpleadoMW::class . ':ValidarToken'); 
//DeleteEmpleado
$this->delete('/{usuario}[/]', \EmpleadoAPI::class . ':BajaEmpleado')
->add(\OperacionMW::class . ':SumarOperacionAEmpleado')
->add(\EmpleadoMW::class . ':ValidarSocio')
->add(\EmpleadoMW::class . ':ValidarToken'); 
//ModificateEmpleado
$this->post('/modificar[/]', \EmpleadoAPI::class . ':ModificarEmpleado')
->add(\OperacionMW::class . ':SumarOperacionAEmpleado')
->add(\EmpleadoMW::class . ':ValidarSocio')
->add(\EmpleadoMW::class . ':ValidarToken'); 
//GetEmpleados
$this->get('/listar[/]', \EmpleadoAPI::class . ':ListarEmpleados')
->add(\EmpleadoMW::class . ':ValidarSocio')
->add(\EmpleadoMW::class . ':ValidarToken'); 
//ListarLoginEntreFechas
$this->post('/listarEntreFechasLogin[/]', \EmpleadoAPI::class . ':ListarEmpleadosEntreFechasLogin')
->add(\EmpleadoMW::class . ':ValidarSocio')
->add(\EmpleadoMW::class . ':ValidarToken');
//ListarCantOperacionesPorSector
$this->get('/cantidadOperacionesPorSector[/]', \EmpleadoAPI::class . ':ObtenerCantidadOperacionesPorSector')
->add(\EmpleadoMW::class . ':ValidarSocio')
->add(\EmpleadoMW::class . ':ValidarToken');
//ListarCantOperacionesEmpleadosPorSector
$this->post('/cantidadOperacionesEmpleadosPorSector[/]', \EmpleadoAPI::class . ':ObtenerCantidadOperacionesEmpleadosPorSector')
->add(\EmpleadoMW::class . ':ValidarSocio')
->add(\EmpleadoMW::class . ':ValidarToken');
//ListarRegistroEntreFechas
$this->post('/listarEntreFechasRegistro[/]', \EmpleadoAPI::class . ':ListarEmpleadosEntreFechasRegistro')
->add(\EmpleadoMW::class . ':ValidarSocio')
->add(\EmpleadoMW::class . ':ValidarToken');  
// $this->post('/cambiarClave[/]', \EmpleadoAPI::class . ':CambiarClaveEmpleado')
// ->add(\OperacionMW::class . ':SumarOperacionAEmpleado')
// ->add(\EmpleadoMW::class . ':ValidarToken'); 
});
//---------------------------------------------------------------------------------
////MESAS////
$app->group('/mesas', function () {
    //AddMesa
    $this->post('/registrar[/]', \MesaAPI::class . ':RegistrarMesa')
    ->add(\OperacionMW::class . ':SumarOperacionAEmpleado')
    ->add(\EmpleadoMW::class . ':ValidarSocio')
    ->add(\EmpleadoMW::class . ':ValidarToken'); 
    //AdjuntarFotoMesa
    $this->post('/foto[/]', \MesaAPI::class . ':ActualizarFotoMesa')
    ->add(\OperacionMW::class . ':SumarOperacionAEmpleado')
    ->add(\EmpleadoMW::class . ':ValidarMozo')
    ->add(\EmpleadoMW::class . ':ValidarToken');
    //DeleteMesa
    $this->delete('/{codigo}[/]', \MesaAPI::class . ':BajaMesa')
    ->add(\OperacionMW::class . ':SumarOperacionAEmpleado')
    ->add(\EmpleadoMW::class . ':ValidarSocio')
    ->add(\EmpleadoMW::class . ':ValidarToken'); 
    //CambiarEstadoMesaEsperando
    $this->get('/estadoEsperando/{codigo}[/]', \MesaAPI::class . ':CambiarEstado_EsperandoPedido')
    ->add(\OperacionMW::class . ':SumarOperacionAEmpleado')
    ->add(\EmpleadoMW::class . ':ValidarMozo')
    ->add(\EmpleadoMW::class . ':ValidarToken');
    //CambiarEstadoMesaComiendo
    $this->get('/mesas/estadoComiendo/{codigo}[/]', \MesaAPI::class . ':CambiarEstado_Comiendo')
    ->add(\OperacionMW::class . ':SumarOperacionAEmpleado')
    ->add(\EmpleadoMW::class . ':ValidarMozo')
    ->add(\EmpleadoMW::class . ':ValidarToken'); 
    //CambiarEstadoMesaPagando
    $this->get('/estadoPagando/{codigo}[/]', \MesaAPI::class . ':CambiarEstado_Pagando')
    ->add(\OperacionMW::class . ':SumarOperacionAEmpleado')
    ->add(\EmpleadoMW::class . ':ValidarMozo')
    ->add(\EmpleadoMW::class . ':ValidarToken'); 
    //CambiarEstadoMesaCobrando
    $this->get('/cobrar/{codigo}[/]', \MesaAPI::class . ':CobrarMesa')
    ->add(\OperacionMW::class . ':SumarOperacionAEmpleado')
    ->add(\EmpleadoMW::class . ':ValidarSocio')
    ->add(\EmpleadoMW::class . ':ValidarToken');
    //CambiarEstadoMesaCerrada
    $this->get('/estadoCerrada/{codigo}[/]', \MesaAPI::class . ':CambiarEstado_Cerrada')
    ->add(\OperacionMW::class . ':SumarOperacionAEmpleado')
    ->add(\EmpleadoMW::class . ':ValidarSocio')
    ->add(\EmpleadoMW::class . ':ValidarToken'); 
    //GetMesas
    $this->get('/listar[/]', \MesaAPI::class . ':ListarMesas')
    ->add(\EmpleadoMW::class . ':ValidarSocio')
    ->add(\EmpleadoMW::class . ':ValidarToken'); 
    //ListarMasUsada
    $this->get('/MasUsada[/]', \MesaAPI::class . ':MesaMasUsada')
    ->add(\EmpleadoMW::class . ':ValidarSocio')
    ->add(\EmpleadoMW::class . ':ValidarToken'); 
    //ListarMenosUsada
    $this->get('/MenosUsada[/]', \MesaAPI::class . ':MesaMenosUsada')
    ->add(\EmpleadoMW::class . ':ValidarSocio')
    ->add(\EmpleadoMW::class . ':ValidarToken'); 
    //ListarMasFacturacion
    $this->get('/MasFacturacion[/]', \MesaAPI::class . ':MesaMasFacturacion')
    ->add(\EmpleadoMW::class . ':ValidarSocio')
    ->add(\EmpleadoMW::class . ':ValidarToken'); 
    //ListarMenosFacturacion
    $this->get('/MenosFacturacion[/]', \MesaAPI::class . ':MesaMenosFacturacion')
    ->add(\EmpleadoMW::class . ':ValidarSocio')
    ->add(\EmpleadoMW::class . ':ValidarToken'); 
    //ListarConFacturaMayorImporte
    $this->get('/ConFacturaConMasImporte[/]', \MesaAPI::class . ':MesaConFacturaConMasImporte')
    ->add(\EmpleadoMW::class . ':ValidarSocio')
    ->add(\EmpleadoMW::class . ':ValidarToken'); 
    //ListarConFacturaMenorImporte
    $this->get('/ConFacturaConMenosImporte[/]', \MesaAPI::class . ':MesaConFacturaConMenosImporte')
    ->add(\EmpleadoMW::class . ':ValidarSocio')
    ->add(\EmpleadoMW::class . ':ValidarToken');
    //ListarFacturacionEntreFechas
    $this->post('/FacturacionEntreFechas[/]', \MesaAPI::class . ':MesaFacturacionEntreFechas')
    ->add(\EmpleadoMW::class . ':ValidarSocio')
    ->add(\EmpleadoMW::class . ':ValidarToken');
    //ListarConMejorPuntuacion
    $this->get('/ConMejorPuntuacion[/]', \MesaAPI::class . ':MesaConMejorPuntuacion')
    ->add(\EmpleadoMW::class . ':ValidarSocio')
    ->add(\EmpleadoMW::class . ':ValidarToken'); 
    //ListarConPeorPuntuacion
    $this->get('/ConPeorPuntuacion[/]', \MesaAPI::class . ':MesaConPeorPuntuacion')
    ->add(\EmpleadoMW::class . ':ValidarSocio')
    ->add(\EmpleadoMW::class . ':ValidarToken');      
});
//---------------------------------------------------------------------------------
////MENU////
$app->group('/menu', function () {
    //AddMenu
    $this->post('/registrar[/]', \MenuAPI::class . ':RegistrarComida')
    ->add(\OperacionMW::class . ':SumarOperacionAEmpleado')
    ->add(\EmpleadoMW::class . ':ValidarSocio')
    ->add(\EmpleadoMW::class . ':ValidarToken');  
    //DeleteMenu
    $this->delete('/{id}[/]', \MenuAPI::class . ':BajaMenu')
    ->add(\OperacionMW::class . ':SumarOperacionAEmpleado')
    ->add(\EmpleadoMW::class . ':ValidarSocio')
    ->add(\EmpleadoMW::class . ':ValidarToken');
    //ModificateMenu
    $this->post('/modificar[/]', \MenuAPI::class . ':ModificarComida')
    ->add(\OperacionMW::class . ':SumarOperacionAEmpleado')
    ->add(\EmpleadoMW::class . ':ValidarSocio')
    ->add(\EmpleadoMW::class . ':ValidarToken');
    //GetMenues
    $this->get('/listar[/]', \MenuAPI::class . ':ListarMenu')
    ->add(\EmpleadoMW::class . ':ValidarSocio')
    ->add(\EmpleadoMW::class . ':ValidarToken');            
});
//---------------------------------------------------------------------------------
////PEDIDOS////
$app->group('/pedido', function () {
//AddPedido
$this->post('/registrar[/]', \PedidoAPI::class . ':RegistrarPedido')
->add(\OperacionMW::class . ':SumarOperacionAEmpleado')
->add(\EmpleadoMW::class . ':ValidarMozo')
->add(\EmpleadoMW::class . ':ValidarToken'); 
//DeletePedido
$this->delete('/{codigo}[/]', \PedidoAPI::class . ':CancelarPedido')
->add(\OperacionMW::class . ':SumarOperacionAEmpleado')
->add(\EmpleadoMW::class . ':ValidarMozo')
->add(\EmpleadoMW::class . ':ValidarToken'); 
//TomarPedido
$this->post('/tomarPedido[/]', \PedidoAPI::class . ':TomarPedidoPendiente')
->add(\OperacionMW::class . ':SumarOperacionAEmpleado')
->add(\PedidoMW::class . ':ValidarTomarPedido')
->add(\EmpleadoMW::class . ':ValidarToken');  
//CambiarEstadoPedidoListoParaServir
$this->post('/listoParaServir[/]', \PedidoAPI::class . ':InformarPedidoListoParaServir')
->add(\OperacionMW::class . ':SumarOperacionAEmpleado')
->add(\PedidoMW::class . ':ValidarInformarListoParaServir')
->add(\EmpleadoMW::class . ':ValidarToken');  
//ServirPedido
$this->post('/servir[/]', \PedidoAPI::class . ':ServirPedido')
->add(\OperacionMW::class . ':SumarOperacionAEmpleado')
->add(\PedidoMW::class . ':ValidarServir')
->add(\EmpleadoMW::class . ':ValidarMozo')
->add(\EmpleadoMW::class . ':ValidarToken');
//GetPedidos
$this->get('/listarTodos[/]', \PedidoAPI::class . ':ListarTodosLosPedidos')
->add(\EmpleadoMW::class . ':ValidarSocio')
->add(\EmpleadoMW::class . ':ValidarToken');
//ListarPedidosCancelados
$this->get('/listarCancelados[/]', \PedidoAPI::class . ':ListarTodosLosPedidosCancelados')
->add(\EmpleadoMW::class . ':ValidarSocio')
->add(\EmpleadoMW::class . ':ValidarToken');
//ListarPedidosPorFecha
$this->post('/listarTodosPorFecha[/]', \PedidoAPI::class . ':ListarTodosLosPedidosPorFecha')
->add(\EmpleadoMW::class . ':ValidarSocio')
->add(\EmpleadoMW::class . ':ValidarToken');  
//ListarPedidoPorMesa
$this->get('/listarPorMesa/{codigoMesa}[/]', \PedidoAPI::class . ':ListarTodosLosPedidosPorMesa');
//ListarPedidosPendientes
$this->get('/listarActivos[/]', \PedidoAPI::class . ':ListarPedidosActivos')
->add(\EmpleadoMW::class . ':ValidarToken');  
// ListarTiempoRestante
$this->get('/tiempoRestante/{codigoPedido}[/]', \PedidoAPI::class . ':TiempoRestantePedido');
// ListarFueraTiempoEstipulado
$this->get('/listarFueraDelTiempoEstipulado[/]', \PedidoAPI::class . ':ListarPedidosFueraDelTiempoEstipulado')
->add(\EmpleadoMW::class . ':ValidarSocio')
->add(\EmpleadoMW::class . ':ValidarToken'); 
//ListarPedidoMasVendido
$this->get('/MasVendido[/]', \PedidoAPI::class . ':LoMasVendido')
->add(\EmpleadoMW::class . ':ValidarSocio')
->add(\EmpleadoMW::class . ':ValidarToken');  
//ListarPedidoMenosVendido
$this->get('/MenosVendido[/]', \PedidoAPI::class . ':LoMenosVendido')
->add(\EmpleadoMW::class . ':ValidarSocio')
->add(\EmpleadoMW::class . ':ValidarToken');  
});
//---------------------------------------------------------------------------------
////FACTURAS////
$app->group('/factura', function () {
    //GenerarFacturaPDF
    $this->get('/listarVentasPDF[/]', \FacturaAPI::class . ':ListarVentasPDF')
    ->add(\EmpleadoMW::class . ':ValidarSocio')
    ->add(\EmpleadoMW::class . ':ValidarToken');  
    //GenerarFacturaExcel
    $this->get('/listarVentasExcel[/]', \FacturaAPI::class . ':ListarVentasExcel')
    ->add(\EmpleadoMW::class . ':ValidarSocio')
    ->add(\EmpleadoMW::class . ':ValidarToken');  
    //ListarFacturasEntreFechas
    $this->post('/listarEntreFechas[/]', \FacturaAPI::class . ':ListarFacturasEntreFechas')
    ->add(\EmpleadoMW::class . ':ValidarSocio')
    ->add(\EmpleadoMW::class . ':ValidarToken'); 
});
//---------------------------------------------------------------------------------
////ENCUESTA////
$app->group('/encuesta', function () {
    //RegisterEncuesta
    $this->post('/registrar[/]', \EncuestaAPI::class . ':RegistrarEncuesta')
    ->add(\EncuestaMW::class . ':ValidarEncuesta'); 
    //ListarEncuestas
    $this->get('/listar[/]', \EncuestaAPI::class . ':ListarEncuestas')
    ->add(\EmpleadoMW::class . ':ValidarSocio')
    ->add(\EmpleadoMW::class . ':ValidarToken'); 
    //ListarEncuestaEntreFechas
    $this->post('/listarEntreFechas[/]', \EncuestaAPI::class . ':ListarEncuestasEntreFechas')
    ->add(\EmpleadoMW::class . ':ValidarSocio')
    ->add(\EmpleadoMW::class . ':ValidarToken'); 
});
//---------------------------------------------------------------------------------
$app->run();