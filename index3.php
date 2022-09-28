<?php

$salida = 'C:/xampp/htdocs/conversion_bne/salida/conversion.txt';
$dni_faltantes = 'C:/xampp/htdocs/conversion_bne/salida/dni_faltantes.txt';

date_default_timezone_set('America/Argentina/Buenos_Aires');

if(isset($_GET['foo'])) {
    setLocale(LC_TIME, 'Spanish');
    $fecha = strftime("%A-%d-%B-%Y-%H_%M_%S");
    //Descargar txt
    header("Content-type: text/plain");
    header("Content-Disposition: attachment; filename=$fecha.conversion.txt;");
    readfile($salida);
} else {
    if(!isset($_FILES['archivo']['tmp_name'])) exit("Debe enviar el formulario");
    if($_FILES['archivo']['error'] > 0) exit("No subió ningún archivo");
    
    $archivo = file_get_contents($_FILES['archivo']['tmp_name']);
    $data = explode(chr(10), $archivo);
    $data2 = $data;
    //Quitar 2 Primeras Filas y guardar e variables
    
    $linea0 = array_shift($data);
    $linea1 = array_shift($data);
    
    //Quitar ultima Filas    
    array_pop($data);

/*
file_get_contents ( string $filename , bool $use_include_path = false , resource $context = ? , int $offset = 0 , int $maxlen = ? ) : string
*/

    $archivo = file_get_contents('C:/xampp/htdocs/conversion_bne/personal.csv', true);
    $personal = explode(chr(10), $archivo);
    array_shift($personal);
    if($personal[count($personal)-1] == "") array_pop($personal);

    $contenido = "";
    $contenido1 = "";
    $legajos_no_en_archivo = "";
    $apellido = "";

    for ($i=0; ($i<=1); $i++){
        if ($i<1) {
            $contenido1 .= rtrim($linea0);

            $contenido .= $contenido1."                                                                                                                                                               \r\n";
            
        }else
            {
                $lineaFecha =  substr($linea1, 0, 22);             
                $cuitEmpresa = "30672394631";
                $inicio2daLinea =  $lineaFecha."30672394631                   11COMPLEMENTARIAS                                                                                            ";
                $contenido .= str_pad($inicio2daLinea."\r\n", 89, ' ', STR_PAD_RIGHT);
            }      
    }

    foreach($data as &$fila){
        
        $legajo = substr($fila, 11, 5);
        $dni = 0;
        $cuil = 0;
        $legajos_en_archivo_personal = array();
        foreach($personal as $fila_personal){
            $cols = explode(";", $fila_personal);  // delimitador columna en CSV
            
            if($cols[2] == $legajo) {
                $dni = @explode(': ', $cols[3])[1];
                $apellido = $cols[1];
                $cuil = $cols[7];
                # Si encuentro un DNI válido, guardo el legajo en un array
                if($dni) $legajos_en_archivo_personal[] = $legajo;
                break;
            }
        }
        
        # Si el número de legajo NO está en el array, significa que no hay DNI
        if(!in_array($legajo, $legajos_en_archivo_personal)) {
            $legajos_no_en_archivo .= "$legajo\n";
        }
        
        $i=$i++;
        
        $inicioUno =  substr($fila, 0, 16);

        $inicioDos =  substr($fila, 17, 3);

        $inicioDos ="4014";

        $inicioTres = substr($fila, 20, 38);
        
        $inicioCaracter = $inicioUno.$inicioDos.$inicioTres;
   
        //$cuil_nuevo = str_pad('0800'.$cuil, 2, ' ', STR_PAD_LEFT);

        
        $cuil_nuevo = substr('0800'.$cuil, 0, 15);
        
        $apellido_nuevo = substr($apellido, 0, 28);
      
        $apellido_formateado = str_pad($apellido_nuevo, 29, ' ', STR_PAD_RIGHT);

        $periodo =  substr("0".$fila.' 0000000000000000000 ', 106, 35);/*INTERIOR*/
        
        $contenido .= "$inicioCaracter  $cuil_nuevo$apellido_formateado $periodo 0000000000000000000 \r\n";

        $cadenaConvertida = iconv('Windows-1252', 'UTF-8', $contenido); // Codificación inicial, Codificación final, Cadena a convertir.
        
            
    }//EndForeach datos

    
    file_put_contents($salida, $cadenaConvertida, true);   
    file_put_contents($dni_faltantes.$legajos_no_en_archivo, true);

    if($legajos_no_en_archivo) {     
        print "
        <pre>
            Falta el DNI de los siguientes legajos:
            $legajos_no_en_archivo
            
            <button type=button onclick=\"location.href='index.php?foo=bar'\">¿Continuar?</button>
        </pre>
        ";
    } else {
        header("Location: index.php?foo=bar");
    }
}

//Si falta algun dni enviar archivos.

?>