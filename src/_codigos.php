<?php
namespace gamboamartin\validacion;
use gamboamartin\errores\errores;

class _codigos{
    private errores $error;

    public function __construct()
    {
        $this->error = new errores();
    }

    /**
     * Integra una expresion regular del 0 al 9 repitiendo los numeros n veces = a la longittud
     * @param int $longitud Longitud de la cadena permitida de numeros
     * @param array $patterns
     * @return string|array
     * @version 1.4.0
     */
    final public function init_cod_int_0_n_numbers(int $longitud, array $patterns): string|array
    {
        if($longitud<=0){
            return  $this->error->error(mensaje: 'Error longitud debe ser mayor a 0',data: $longitud);
        }
        $key = 'cod_int_0_'.$longitud.'_numbers';
        $patterns[$key] = '/^[0-9]{'.$longitud.'}$/';
        return $patterns[$key];
    }
}
