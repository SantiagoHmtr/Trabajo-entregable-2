<?php
include_once ("Pasajero.php");
Class Viaje {

    private $codigoViaje; //Codigo que se le asigna al viaje
    private $destino;   //Destino del viaje
    private $cantMaxPasajeros;  //Cantidad maxima de pasajeros que pueden ingresar en el viaje
    private $cantidadDePasajeros;   //Cantidad de pasajeros actuales
    private $coleccionPasajeros = [];   //Una coleccion en forma de array multidimensional para almacenar los datos de los pasajeros
    private $responsableDeViaje;



    #Construsctor
    public function __construct($codigoViaje, $destino, $cantMaxPasajeros)
    {
        $this->codigoViaje = $codigoViaje;
        $this->destino = $destino;
        $this->cantMaxPasajeros = $cantMaxPasajeros;
        
    }
    #Metodos get y set 
    function getCodigoViaje(){
        return $this->codigoViaje;
    }
    function setCodigoViaje($codigoViaje){
        $this->codigoViaje = $codigoViaje;
    }
    function getDestino(){
        return $this->destino;
    }
    function setDestino($destino){
        $this->destino = $destino;
    }
    function getCantMaxPasajeros(){
        return $this->cantMaxPasajeros;
    }
    function setCantMaxPasajeros($cantMaxPasajeros){
        $this->cantMaxPasajeros = $cantMaxPasajeros;
    }

    function getColeccionPasajeros(){
        return $this->coleccionPasajeros;
    }

    function setColeccionPasajeros($coleccionPasajeros){
        $this->coleccionPasajeros = $coleccionPasajeros;
    }

    function getCantidadDePasajeros(){
        return $this->cantidadDePasajeros;
    }
    function setCantidadDepasajeros($cantidadDePasajeros){
        $this->cantidadDePasajeros = $cantidadDePasajeros;
    }
    function getResponsableViaje(){
        return $this->responsableDeViaje;
    }
    function setResponsableViaje($responsableDeViaje){
        $this->responsableDeViaje = $responsableDeViaje;
    }

    #Verificar si el viaje esta lleno / True = hay lugar disponible / False = no hay lugar disponible

    public function   asientosDisponibles(){
        if ((count($this->coleccionPasajeros)< $this->cantMaxPasajeros)){
            return true;
        } else return false;
    }


    public function __toString()
    {
        return "Codigo de viaje :" . $this->getCodigoViaje() ."\n" . "Destino = " . $this->getDestino(). " \n" . "Cantidad maxima de personas:\n" . $this->getCantMaxPasajeros();
    }

    //Metodo para encontrar, si se encuentra el pasajero se retorna el indice que le corresponde en el array, sino retorna -1, para luego reutilizar con falicidad esta informacion
    public function findPasajero($dniIngresado){
        $bandera = false;
        $arrayAux = $this->getColeccionPasajeros();
        $i=0;
        while ($i < (count($arrayAux)) && $bandera == false){
            $pasajero = $arrayAux[$i];
            $dniPasajero = $pasajero->getDocumento();
            if ($dniPasajero == $dniIngresado){
                $bandera = true;
                return $i;
            }
            $i++;
        }
        $i = -1;
        return $i;
    }
   
    //Funcion para agregar pasajero,
    public function agregarPasajero($objPasajero){
     
        $dniNuevoPasajero = $objPasajero->getDocumento();
        $bandera = false;
        $arrayAux = $this->getColeccionPasajeros();
        $i=0;
        while ($i < (count($arrayAux)) && $bandera == false){
            $pasajero = $arrayAux[$i];
            $dniPasajero = $pasajero->getDocumento();
            if ($dniPasajero == $dniNuevoPasajero){
                $bandera = true;
                return $bandera;
            }
            $i++;
        }
        if ($bandera == false){
            array_push($arrayAux, $objPasajero);
            $this->setColeccionPasajeros($arrayAux);
        }
    }

}

//Una funcion para imprimir un menu en pantalla
function textoMenu(){
    echo "\n Ingrese la opcion deseada:\n" .
    "1. Mostrar datos del viaje.\n".
    "2. Modificar datos del viaje(Codigo, destino, cantidad maxima de asientos dispoinbles.)\n" .
    "3. Mostrar datos de un pasajero \n" . 
    "4.Modificar informacion de un pasajero. \n" .
    "5.Agregar nuevo pasajero\n" .
    "6.Agregar responsable de viaje.\n".
    "7.Salir.\n";
 


}
