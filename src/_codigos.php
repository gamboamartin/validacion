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
     * TOTAL
     * Esta función se utiliza para inicializar un código de longitud especificada
     * con números enteros del 0.
     *
     * @param int $longitud Representa la longitud del código.
     * @param array $patterns Un array que almacena patrones de búsqueda.
     *
     * @return string|array En caso de éxito, devuelve el patrón de búsqueda.
     * Si falla, devuelve un mensaje de error.
     * @version 3.7.0
     * @url https://github.com/gamboamartin/validacion/wiki/src._codigos.init_cod_int_0_n_numbers
     */
    final public function init_cod_int_0_n_numbers(int $longitud, array $patterns): string|array
    {
        if($longitud<=0){
            return  $this->error->error(mensaje: 'Error longitud debe ser mayor a 0',data: $longitud,es_final: true);
        }
        $key = 'cod_int_0_'.$longitud.'_numbers';
        $patterns[$key] = '/^[0-9]{'.$longitud.'}$/';
        return $patterns[$key];
    }
}
