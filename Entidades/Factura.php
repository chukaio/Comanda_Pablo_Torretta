<?php
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
include_once("DB/AccesoDatos.php");
include_once("Reportes/FPDF/fpdf.php");
//include_once("Reportes/PhpSpreadsheet/src/PhpSpreadsheet/Spreadsheet.php");
require 'vendor/autoload.php';

class Factura
{
    //Atributos//
    public $idFactura;
    public $importe;
    public $codigoMesa;
    public $fecha;

    //Metodos//
    //GenerateFactura
    public static function Generar($importe, $codigoMesa)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $respuesta = "";
        try {
            date_default_timezone_set("America/Argentina/Buenos_Aires");
            $fecha = date('Y-m-d H:i:s');
            $consulta = $objetoAccesoDato->RetornarConsulta("INSERT INTO facturas (importe, codigoMesa, fecha) 
                                                            VALUES (:importe, :codigoMesa, :fecha);");

            $consulta->bindValue(':codigoMesa', $codigoMesa, PDO::PARAM_STR);
            $consulta->bindValue(':fecha', $fecha, PDO::PARAM_STR);
            $consulta->bindValue(':importe', $importe, PDO::PARAM_INT);

            $consulta->execute();

            $respuesta = array("Estado" => "OK", "Mensaje" => "Factura generada correctamente.Importe: ".$importe);
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $respuesta = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        }
        finally {
            return $respuesta;
        }
    }
    //GetFacturas
    public static function ListarTodos()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $respuesta = "";
        try {
            $consulta = $objetoAccesoDato->RetornarConsulta("SELECT idFactura, importe, codigoMesa, fecha 
                                                            FROM facturas;");

            $consulta->execute();

            $respuesta = $consulta->fetchAll(PDO::FETCH_CLASS, "Factura");
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $respuesta = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        }
        finally {
            return $respuesta;
        }
    }
    //ListarFacturasEntreFechas
    public static function ListarEntreFechas($fecha1,$fecha2)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $respuesta = "";
        try {
            $consulta = $objetoAccesoDato->RetornarConsulta("SELECT idFactura, importe, codigoMesa, fecha 
                                                            FROM facturas WHERE fecha BETWEEN :fecha1 AND :fecha2;");
            $consulta->bindValue(':fecha1', $fecha1, PDO::PARAM_STR);
            $consulta->bindValue(':fecha2', $fecha2, PDO::PARAM_STR);
            $consulta->execute();

            $respuesta = $consulta->fetchAll(PDO::FETCH_CLASS, "Factura");
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $respuesta = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        }
        finally {
            return $respuesta;
        }
    }
    //GenerarFacturaPDF
    public static function ListarPDF(){
        $pdf = new FPDF("P","mm","A4");
        $pdf->AddPage();
        $pdf->SetFont("Arial","B",12);
        //ancho de la celda, alto de la celda, contenido de la celda, borde (1 o 0), salto de linea (1 o 0), alineacion (L C R)
        $pdf->Cell(50,10,'Fecha',1,0,"C");
        $pdf->Cell(50,10,'Codigo Mesa',1,0,"C");
        $pdf->Cell(50,10,'Importe',1,1,"C");
        $facturas = Factura::ListarTodos();
        // echo "<br>"; 
        // echo('<pre>');
        // print_r($facturas);
        // echo('</pre>');
        // echo "<br>";
        foreach($facturas as $factura){
            $pdf->Cell(50,10,((object)$factura)->fecha,1,0,"C");
            $pdf->Cell(50,10,((object)$factura)->codigoMesa,1,0,"C");
            $pdf->Cell(50,10,"$".((object)$factura)->importe,1,1,"C");
        }
        $pdf->Output("F","./Reportes/Ventas.pdf",true);
        
        return array("Estado" => "OK", "Mensaje" => "PDF generado correctamente.");
    }
    //GenerarFacturaExcel
    public static function ListarExcel(){
        $excel = new Spreadsheet();
        $excel->getProperties()
        ->setCreator("Pablo Torretta")
        ->setTitle("Listado de Ventas")
        ->setDescription("Listado de Ventas");

        $excel->setActiveSheetIndex(0);
        $excel->getActiveSheet()
        ->getColumnDimension('A')
        ->setAutoSize(true);

        $excel->getActiveSheet()
        ->getColumnDimension('B')
        ->setAutoSize(true);

        $excel->getActiveSheet()
        ->getColumnDimension('C')
        ->setAutoSize(true);

        $excel->getActiveSheet()->setTitle("Listado de Ventas");

        $excel->getActiveSheet()->setCellValue("A1","Fecha");
        $excel->getActiveSheet()->setCellValue("B1","Codigo Mesa");
        $excel->getActiveSheet()->setCellValue("C1","Importe");

        $facturas = Factura::ListarTodos();
        $fila = 2;
        // foreach($facturas as $factura){
        //     $excel->getActiveSheet()->setCellValue("A$fila",$factura->fecha);
        //     $excel->getActiveSheet()->setCellValue("B$fila",$factura->codigoMesa);
        //     $excel->getActiveSheet()->setCellValue("C$fila",$factura->importe);
        //     $fila++;
        // }
        foreach($facturas as $factura){
            $excel->getActiveSheet()->setCellValue("A$fila",((object)$factura)->fecha);
            $excel->getActiveSheet()->setCellValue("B$fila",((object)$factura)->codigoMesa);
            $excel->getActiveSheet()->setCellValue("C$fila",((object)$factura)->importe);
            $fila++;
        }

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename-"./Reportes/Ventas.xlsx"');
        header('Cache-Control: max-age=0');

       // $writer = IOFactory::createWriter($excel, 'Xlsx');
        $writer = new Xlsx($excel);
        $writer->save("./Reportes/VentasExcel.xlsx");

        return array("Estado" => "OK", "Mensaje" => "Excel generado correctamente.");
    }
}