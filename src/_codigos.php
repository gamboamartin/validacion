<?php
namespace gamboamartin\validacion;

use gamboamartin\errores\errores;

/**
 * REG
 * Clase encargada de generar y manejar patrones de validación para cadenas de texto numéricas o alfanuméricas.
 *
 * Dentro de esta clase se utilizan métodos que definen expresiones regulares (regex) basadas en parámetros
 * dinámicos (por ejemplo, longitud fija de dígitos). Además, centraliza la comunicación con la clase
 * {@see errores} para el manejo de posibles incidencias o validaciones fallidas, retornando arreglos
 * detallados cuando se requiere registrar un error.
 *
 * @package gamboamartin\validacion
 *
 * @property errores $error Instancia privada para el manejo de errores y registro de incidencias.
 *
 * @example
 *  Ejemplo de uso básico
 *  -------------------------------------------------------------------------------------------
 *  use gamboamartin\validacion\_codigos;
 *
 *  $validador = new _codigos();
 *  $patterns  = [];
 *
 *  // Genera un patrón para validar una cadena de longitud 5 compuesta únicamente por dígitos.
 *  $resultado = $validador->init_cod_int_0_n_numbers(5, $patterns);
 *  // $resultado contendrá '/^[0-9]{5}$/' si la longitud es correcta.
 *  // En caso de error (longitud <= 0), retornará un arreglo con la información del error.
 *
 * @author
 * @version 1.0
 */
class _codigos
{
    /**
     * Manejo de errores. Se utiliza para registrar y devolver información detallada en caso de fallos.
     *
     * @var errores
     */
    private errores $error;

    /**
     * Constructor de la clase.
     *
     * Inicializa la instancia de la clase de errores para permitir el registro y manejo
     * de validaciones fallidas o anomalías detectadas en los métodos de este servicio.
     */
    public function __construct()
    {
        $this->error = new errores();
    }

    /**
     * REG
     * Genera un patrón de expresión regular para validar una cadena compuesta únicamente por dígitos
     * (0-9) con una longitud fija de `$longitud`. El patrón se guarda en `$patterns` bajo la clave
     * `cod_int_0_{$longitud}_numbers`.
     *
     * - Si `$longitud` es menor o igual a cero, se retorna un arreglo de error generado por `$this->error->error()`.
     * - En caso contrario, se crea la expresión `/^[0-9]{$longitud}$/` y se devuelve como `string`.
     *
     * @param int   $longitud Cantidad exacta de dígitos que deberá tener la cadena validada.
     * @param array $patterns Arreglo de patrones donde se almacenará la nueva clave y su expresión regular.
     *
     * @return string|array   Retorna el patrón (string) si `$longitud` es válido. Si hay error, retorna un arreglo
     *                        con la información generada por `$this->error->error()`.
     *
     * @example
     *  Ejemplo 1: Generar un patrón para 3 dígitos
     *  ---------------------------------------------------------------------------------
     *  $patterns = [];
     *  $resultado = $this->init_cod_int_0_n_numbers(3, $patterns);
     *  // $resultado será '/^[0-9]{3}$/'
     *  // Y en $patterns['cod_int_0_3_numbers'] se guardará el mismo valor.
     *
     * @example
     *  Ejemplo 2: Error al pasar longitud <= 0
     *  ---------------------------------------------------------------------------------
     *  // Suponiendo que $this->error->error() retorna un arreglo con información del error
     *  $patterns = [];
     *  $resultado = $this->init_cod_int_0_n_numbers(0, $patterns);
     *  // $resultado será un arreglo con la descripción del error, pues 0 no es válido.
     */
    final public function init_cod_int_0_n_numbers(int $longitud, array $patterns): string|array
    {
        if ($longitud <= 0) {
            return $this->error->error(
                mensaje: 'Error: la longitud debe ser mayor a 0',
                data: $longitud,
                es_final: true
            );
        }

        $key = 'cod_int_0_' . $longitud . '_numbers';
        $patterns[$key] = '/^[0-9]{' . $longitud . '}$/';

        return $patterns[$key];
    }
}
