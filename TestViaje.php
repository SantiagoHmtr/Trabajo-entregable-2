<?php
include_once ("Pasajero.php");
include_once ("ResponsableV.php");
include_once ('Viaje.php');
//Se ingresan los datos del viaje para generar el objeto de la clase Viaje
echo "Ingrese el codigo del viaje:\n" ;
$codViaje = trim(fgets(STDIN));
echo "Ingrese el destino: \n";
$destinoViaje = trim(fgets(STDIN));
echo "Ingrese el limite de pasajeros:\n";
$cantMax = trim(fgets(STDIN));

//Se instancian tres pasajeros de la clase objeto, luego se genera un array estos.
$pasajero1 = new Pasajero ("Santiago", "Garcia", 40181871, 12345);
$pasajero2 = new Pasajero ("Lionel", "Messi", 101010, 1);
$pasajero3 = new Pasajero ("Admin", "Papu",666, 69 );
$arrayPasajeros = [$pasajero1, $pasajero2, $pasajero3];
//Utilizo el metodo setColeccionPasajeros para establecer el valor
$nuevoViaje = new Viaje ($codViaje, $destinoViaje, $cantMax);
$nuevoViaje->setColeccionPasajeros($arrayPasajeros);


#Ejecucion de menu
do{
    textoMenu();
    $opcion = trim(fgets(STDIN));
    switch ($opcion) {
        case '1':
            //Se imprimen los datos del viaje
            echo $nuevoViaje;
            break;
         case '2':
            //Con dos switch anidados se eligen opciones para modificar los datos de el viaje.
            echo "Ingrese la opcion deseada: \n" . "1.Modificar el codigo de viaje.\n 2.Modificar el destino del viaje. \n 3. Modificar la cantidad maxima de asientos en el viaje.\n 4.Salir.\n";

            $opcion2 = trim(fgets(STDIN));
            switch ($opcion2) {
                case '1':
                    echo "Ingrese el nuevo codigo de viaje: \n";
                    $nuevoCodigo = trim(fgets(STDIN));
                    $nuevoViaje->setCodigoViaje($nuevoCodigo);
                    break;
                case '2':
                    echo "Ingrese el nuevo destino del viaje:\n ";
                    $nuevoDestino = trim(fgets(STDIN));
                    $nuevoViaje->setDestino($nuevoDestino);
                    break;
                case '3':
                    echo "Ingrese la nueva cantidad maxima de personas en el viaje: \n";
                    $nuevaCantMax = trim(fgets(STDIN));
                    $nuevoViaje->setCantMaxPasajeros($nuevaCantMax);
                    break;
                
                default:
                    
                    break;
            }
            break;
            case '3':
           //Se imprimen en pantalla los datos del pasajero, este siendo buscado por su DNI, ya que en la practica seria un valor unico

            echo "Ingrese el DNI del pasajero para revisar sus datos.\n";
            $pasajerosViaje = $nuevoViaje->getColeccionPasajeros();
            $dniIngresado= trim(fgets(STDIN));
            $busqueda =$nuevoViaje->findPasajero($dniIngresado);
            if ($busqueda != -1){
            print_r($pasajerosViaje[$busqueda]); }
            else {
                echo "El DNI ingresado no pertenece a ningun pasajero.\n";
            }
            break;
            
         case '4':
            //Se modifican los datos de un pasajero, nuevamente se lo encuentra por el DNI
            echo "Ingrese el DNI del pasajero.";
            $arrayPasajeroModificado = $nuevoViaje->getColeccionPasajeros();
            $dniCambio = trim(fgets(STDIN));
            $indicePasajero = $nuevoViaje->findPasajero($dniCambio);
            if ($indicePasajero != -1){
                echo "Ingrese el nuevo Nombre: ";
                $nombreNuevo = trim(fgets(STDIN));
                echo "Ingrese el nuevo apellido: ";
                $apellidoNuevo = trim(fgets(STDIN));
                echo "Ingrese el nuevo numero de telefono:";
                $numeroNuevo = trim(fgets(STDIN));
                $pasajeroModificado = new Pasajero($nombreNuevo, $apellidoNuevo, $dniCambio, $numeroNuevo);
                $arrayPasajeroModificado[$indicePasajero] = $pasajeroModificado;
                $nuevoViaje->setColeccionPasajeros($arrayPasajeroModificado);
            }   else {
                echo "Intentelo nuevamente.\n";
            }

            break;
         case '5':
            //Se agregan pasajeros al viaje.
            if ($nuevoViaje->asientosDisponibles()){
                echo "Ingrese el nombre del pasajero:\n";
                $nomb = trim(fgets(STDIN));
                echo "Ingrese el apellido del pasajero: \n";
                $apellido = trim(fgets(STDIN));
                echo "Ingrese el DNI del pasajero: \n";
                $dni = trim(fgets(STDIN));
                echo " Ingrese el numero de telefono: " ; 
                $numTel = trim(fgets(STDIN));
            $nuevoPasajero = new Pasajero ($nomb, $apellido, $dni, $numTel);
            if ($nuevoViaje->agregarPasajero($nuevoPasajero)){
            $nuevoViaje->agregarPasajero($nuevoPasajero);
            }else {
                echo "El DNI ingresado ya se encuentra registrado, intentelo nuevamente";
            }


            }
            
            else{
                echo "Error :El viaje alcanzo la cantidad maxima de pasajeros.";
            }
            break;
         case '6':
            //Se piden los datos para generar la instancia del responsable y luego se settea el mismo en la clase Viaje
            echo "Ingrese el nombre:\n";
            $nombreResponsable = trim(fgets(STDIN));
            echo "Ingrese el apellido: \n";
            $apellidoResponsable = trim(fgets(STDIN));
            echo "Ingrese el numnero de empleado: \n";
            $numEmpleadoResponsable = trim(fgets(STDIN));
            echo " Ingrese el numero de licencia: " ; 
            $numLicenciaResponsable = trim(fgets(STDIN));
            $responsable = new ResponsableV($nombreResponsable, $apellidoResponsable, $numEmpleadoResponsable, $numLicenciaResponsable);
            $nuevoViaje->setResponsableViaje($responsable);

            break;
        case '7':

            break;
       
       
    }


}while($opcion !=6);

