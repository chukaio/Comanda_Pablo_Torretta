<?php
class OperacionMW
{
    //Metodos//
    //Suma operación a empleado    
    public static function SumarOperacionAEmpleado($request, $response, $next)
    {
        $payload = $request->getAttribute("payload")["Payload"];

        Empleado::SumarOperacion($payload->id);

        return $next($request, $response);
    }
}