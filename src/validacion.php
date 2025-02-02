<?php
namespace gamboamartin\validacion;

use gamboamartin\errores\errores;
use stdClass;


class validacion {
    public array $patterns = array();
    protected errores $error;
    private array $regex_fecha = array();
    public array $styles_css = array();
    public function __construct(){
        $this->error = new errores();
        $fecha = "[1-2][0-9]{3}-((0[1-9])|(1[0-2]))-((0[1-9])|([1-2][0-9])|(3)[0-1])";
        $hora_min_sec = "(([0-1][0-9])|(2[0-3])):([0-5][0-9]):([0-5][0-9])";
        $funcion = "([a-z]+)((_?[a-z]+)|[a-z]+)*";
        $filtro = "$funcion\.$funcion(\.$funcion)*";
        $file_php = "$filtro\.php";
        $fecha_hms_punto = "$fecha\.$hora_min_sec";
        $telefono_mx = "[1-9]{1}[0-9]{9}";
        $entero_positivo = "[1-9]+[0-9]*";
        $texto_pep_8 = "[a-z]+(_?[a-z]+)*";
        $param_json = "($texto_pep_8)\s*:\s*($texto_pep_8)";
        $params_json = "($param_json)+(\s*,\s*$param_json)*";
        $params_json_parentesis = "\s*\{\s*$params_json\s*\}\s*";
        $key_id = "([a-z]+_[a-z]+)+_id";
        $celda_calc = '[A-Z]+[0-9]+';

        $this->patterns['celda_calc'] = "/^$celda_calc$/";
        $this->patterns['cod_1_letras_mayusc'] = '/^[A-Z]$/';
        $this->patterns['cod_1_2_letras_mayusc'] = '/^[A-Z]{1,2}$/';
        $this->patterns['cod_3_letras_mayusc'] = '/^[A-Z]{3}$/';
        $this->patterns['texto_pep_8'] = "/^$texto_pep_8$/";
        $this->patterns['param_json'] = "/^$param_json$/";
        $this->patterns['params_json'] = "/^$params_json$/";
        $this->patterns['params_json_parentesis'] = "/^$params_json_parentesis$/";
        $this->patterns['key_id'] = "/^$key_id$/";
        $this->patterns['solo_texto'] = "/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s'’-]+$/";

        $this->patterns['cod_int_0_numbers'] = '/^[0-9]{5,7}$/';
        $this->patterns['cod_int_0_2_numbers'] = '/^[0-9]{2}$/';
        $this->patterns['cod_int_0_3_numbers'] = '/^[0-9]{3}$/';
        $this->patterns['cod_int_0_4_numbers'] = '/^[0-9]{4}$/';
        $this->patterns['cod_int_0_5_numbers'] = '/^[0-9]{5}$/';
        $this->patterns['cod_int_0_6_numbers'] = '/^[0-9]{6}$/';
        $this->patterns['cod_int_0_8_numbers'] = '/^[0-9]{8}$/';
        $this->patterns['correo_html5'] = "[a-z0-9!#$%&'*+=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$";
        $this->patterns['correo_html_base'] = "[^@\s]+@[^@\s]+[^.\s]";
        $this->patterns['correo'] = '/^'.$this->patterns["correo_html5"].'/';
        $this->patterns['double'] = '/^[0-9]*.[0-9]*$/';
        $this->patterns['id'] = "/^$entero_positivo$/";
        $this->patterns['fecha'] = "/^$fecha$/";
        $this->patterns['fecha_hora_min_sec_esp'] = "/^$fecha $hora_min_sec$/";
        $this->patterns['fecha_hora_min_sec_t'] = "/^$fecha".'T'."$hora_min_sec$/";
        $this->patterns['hora_min_sec'] = "/^$hora_min_sec$/";
        $this->patterns['letra_numero_espacio'] = '/^(([a-zA-Z áéíóúÁÉÍÓÚñÑ]+[1-9]*)+(\s)?)+([a-zA-Z áéíóúÁÉÍÓÚñÑ]+[1-9]*)*$/';
        $this->patterns['nomina_antiguedad'] = "/^P[0-9]+W$/";
        $this->patterns['rfc_html'] = "[A-Z]{3,4}[0-9]{6}([A-Z]|[0-9]){3}";
        $this->patterns['rfc'] = "/^[A-Z]{3,4}[0-9]{6}([A-Z]|[0-9]){3}$/";
        $this->patterns['url'] = "/http(s)?:\/\/(([a-z])+.)+([a-z])+/";
        $this->patterns['telefono_mx'] = "/^$telefono_mx$/";
        $this->patterns['telefono_mx_html'] = "$telefono_mx";
        $this->patterns['entero_positivo_html'] = "$entero_positivo";
        $this->patterns['funcion'] = "/^$funcion$/";
        $this->patterns['filtro'] = "/^$filtro$/";
        $this->patterns['file_php'] = "/^$file_php$/";
        $this->patterns['file_service_lock'] = "/^$file_php\.lock$/";
        $this->patterns['file_service_info'] = "/^$file_php\.$fecha_hms_punto\.info$/";
        $this->patterns['status'] = "/^activo|inactivo$/";

        $lada_html = "[0-9]{2,3}";
        $this->patterns['lada_html'] = $lada_html;
        $this->patterns['lada'] = "/^$lada_html$/";

        $tel_sin_lada_html = "[0-9]{7,8}";
        $this->patterns['tel_sin_lada_html'] = $tel_sin_lada_html;
        $this->patterns['tel_sin_lada'] = "/^$tel_sin_lada_html$/";

        $curp_html = "([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])[HM](?:AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)";
        $curp = "/^$curp_html$/";

        $this->patterns['curp_html'] = $curp_html;
        $this->patterns['curp'] = $curp;

        $nss_html = "(\d{2})(\d{2})(\d{2})\d{5}";
        $this->patterns['nss_html'] = $nss_html;
        $this->patterns['nss'] = "/^$nss_html$/";;


        $this->regex_fecha[] = 'fecha';
        $this->regex_fecha[] = 'fecha_hora_min_sec_esp';
        $this->regex_fecha[] = 'fecha_hora_min_sec_t';

        $this->styles_css = array('danger','dark','info','light','link','primary','secondary','success','warning');


        $regex = $this->base_regex_0_numbers(max_long: 20);
        if(errores::$error){
            $error = $this->error->error(mensaje: 'Error al inicializar regex', data: $regex);
            print_r($error);
            exit;
        }


    }

    /**
     * REG
     * Genera un conjunto de expresiones regulares para validar cadenas numéricas de distintas longitudes,
     * desde 1 hasta `$max_long`. Cada expresión regular se genera llamando al método `init_cod_int_0_n_numbers()`
     * de la clase `_codigos`.
     *
     * - Si `$max_long` es menor o igual a 0, se registra un error a través de `$this->error->error()` y
     *   se retorna un arreglo con la información del error.
     * - En caso contrario, se itera desde 1 hasta `$max_long`, generando cada patrón y guardándolo
     *   en el arreglo `$patterns`.
     * - Si en el proceso de generación ocurre algún error (por ejemplo, al invocar `init_cod_int_0_n_numbers()`),
     *   también se registra y se retorna el correspondiente arreglo de error.
     *
     * @param int $max_long La longitud máxima para la cual se generará un patrón. Debe ser mayor a 0.
     *
     * @return array Retorna un arreglo con todas las expresiones regulares generadas si el proceso fue exitoso.
     *               En caso de error, retorna un arreglo con la información del error.
     *
     * @example
     *  Ejemplo 1: Generar patrones de 1 a 3 dígitos
     *  -----------------------------------------------------------------------------
     *  // Suponiendo que este método pertenece a la clase X, y que $this->patterns
     *  // está definido como un arreglo de patrones dentro de dicha clase.
     *
     *  $max_long = 3;
     *  $patronesGenerados = $this->base_regex_0_numbers($max_long);
     *
     *  // $patronesGenerados podría lucir así:
     *  // [
     *  //   '/^[0-9]{1}$/',  // 1 dígito
     *  //   '/^[0-9]{2}$/',  // 2 dígitos
     *  //   '/^[0-9]{3}$/'   // 3 dígitos
     *  // ]
     *
     *  // Si $max_long fuera 0 o menor, se retornaría un arreglo con la información de error.
     *
     * @example
     *  Ejemplo 2: Manejo de error si max_long es inválido
     *  -----------------------------------------------------------------------------
     *  $max_long = 0;
     *  $resultado = $this->base_regex_0_numbers($max_long);
     *
     *  // $resultado será un arreglo con la descripción del error proveniente de
     *  // $this->error->error(), indicando que "max_long debe ser mayor a 0".
     */
    private function base_regex_0_numbers(int $max_long): array
    {
        if ($max_long <= 0) {
            return $this->error->error(
                mensaje: 'Error max_long debe ser mayor a 0',
                data: $max_long,
                es_final: true
            );
        }

        $longitud_cod_0_n_numbers = 1;
        $patterns = array();

        // Genera patrones para cada longitud desde 1 hasta $max_long
        while ($longitud_cod_0_n_numbers <= $max_long) {
            $regex = (new _codigos())->init_cod_int_0_n_numbers(
                longitud: $longitud_cod_0_n_numbers,
                patterns: $this->patterns
            );

            // Si se detectó un error al crear el patrón, retornar el mensaje de error
            if (errores::$error) {
                return $this->error->error(
                    mensaje: 'Error al inicializar regex',
                    data: $regex
                );
            }

            // Agrega el patrón generado al arreglo $patterns
            $patterns[] = $regex;
            $longitud_cod_0_n_numbers++;
        }

        return $patterns;
    }


    /**
     * REG
     * Valida que el arreglo `$data_boton` contenga ciertos índices requeridos (`filtro`, `id`, `etiqueta`) y que estos
     * cumplan con el tipo de dato esperado (por ejemplo, `filtro` debe ser un array).
     *
     * En caso de que falte alguno de estos índices, o no cumpla con las validaciones correspondientes,
     * registra un error a través de `$this->error->error()` y retorna un arreglo con la información del error.
     * Si todo está correcto, retorna `true`.
     *
     * @param array $data_boton Arreglo que contiene los datos necesarios para la creación o configuración de un botón.
     *                          Debe incluir al menos las siguientes claves:
     *                          - 'filtro'  (array)
     *                          - 'id'      (mixed)
     *                          - 'etiqueta' (mixed)
     *
     * @return bool|array Retorna `true` si las validaciones son exitosas. En caso de error, retorna un
     *                    arreglo con la información detallada del mismo.
     *
     * @example
     *  Ejemplo 1: Uso mínimo con datos correctos
     *  --------------------------------------------------------------------------------
     *  $data = [
     *      'filtro'  => ['activo' => true],
     *      'id'      => 'btn-123',
     *      'etiqueta'=> 'Enviar'
     *  ];
     *
     *  $resultado = $this->btn_base($data);
     *  if ($resultado === true) {
     *      echo "Validación exitosa, se puede continuar con el flujo";
     *  } else {
     *      // Manejo de error, $resultado contendrá los detalles de la falla
     *  }
     *
     * @example
     *  Ejemplo 2: Falta el índice 'filtro'
     *  --------------------------------------------------------------------------------
     *  $data = [
     *      'id'      => 'btn-123',
     *      'etiqueta'=> 'Enviar'
     *  ];
     *
     *  $resultado = $this->btn_base($data);
     *  // Aquí se retornará un arreglo de error, indicando que 'filtro' no existe en $data_boton.
     *
     * @example
     *  Ejemplo 3: 'filtro' no es un array
     *  --------------------------------------------------------------------------------
     *  $data = [
     *      'filtro'  => 'valor no válido',
     *      'id'      => 'btn-123',
     *      'etiqueta'=> 'Enviar'
     *  ];
     *
     *  $resultado = $this->btn_base($data);
     *  // Se retornará un arreglo de error, indicando que '$data_boton[filtro] debe ser un array'.
     */
    final public function btn_base(array $data_boton): bool|array
    {
        if (!isset($data_boton['filtro'])) {
            return $this->error->error(
                mensaje: 'Error: $data_boton[filtro] debe existir',
                data: $data_boton,
                es_final: true
            );
        }
        if (!is_array($data_boton['filtro'])) {
            return $this->error->error(
                mensaje: 'Error: $data_boton[filtro] debe ser un array',
                data: $data_boton,
                es_final: true
            );
        }
        if (!isset($data_boton['id'])) {
            return $this->error->error(
                mensaje: 'Error: $data_boton[id] debe existir',
                data: $data_boton,
                es_final: true
            );
        }
        if (!isset($data_boton['etiqueta'])) {
            return $this->error->error(
                mensaje: 'Error: $data_boton[etiqueta] debe existir',
                data: $data_boton,
                es_final: true
            );
        }

        return true;
    }


    /**
     * REG
     * Valida que el arreglo `$data_boton` contenga ciertos índices necesarios (`etiqueta` y `class`),
     * verificando además que sus valores no estén vacíos.
     *
     * Si alguna validación falla, registra un error a través de `$this->error->error()` y
     * retorna un arreglo con la información del error. De lo contrario, retorna `true`.
     *
     * @param array $data_boton Arreglo con los datos necesarios para configurar un botón:
     *                          - 'etiqueta' (string no vacío)
     *                          - 'class'   (string no vacío)
     *
     * @return bool|array Retorna `true` si las validaciones pasan. Si hay algún problema,
     *                    retorna un arreglo con la información del error.
     *
     * @example
     *  Ejemplo 1: Validación exitosa
     *  ----------------------------------------------------------------------------
     *  $data = [
     *      'etiqueta' => 'Guardar',
     *      'class'    => 'btn btn-success'
     *  ];
     *
     *  $resultado = $this->btn_second($data);
     *  if($resultado === true){
     *      echo "Datos del botón validados correctamente.";
     *  } else {
     *      // $resultado contendrá detalles del error
     *  }
     *
     * @example
     *  Ejemplo 2: Falta la clave 'etiqueta'
     *  ----------------------------------------------------------------------------
     *  $data = [
     *      'class' => 'btn btn-primary'
     *  ];
     *
     *  $resultado = $this->btn_second($data);
     *  // Retornará un arreglo con el mensaje de error indicando que 'etiqueta' no existe.
     *
     * @example
     *  Ejemplo 3: 'etiqueta' está vacía
     *  ----------------------------------------------------------------------------
     *  $data = [
     *      'etiqueta' => '',
     *      'class'    => 'btn btn-primary'
     *  ];
     *
     *  $resultado = $this->btn_second($data);
     *  // Retornará un arreglo con el mensaje de error indicando que 'etiqueta' no puede estar vacía.
     */
    final public function btn_second(array $data_boton): bool|array
    {
        // Validación de 'etiqueta'
        if(!isset($data_boton['etiqueta'])){
            return $this->error->error(
                mensaje: 'Error $data_boton[etiqueta] debe existir',
                data: $data_boton,
                es_final: true
            );
        }
        if($data_boton['etiqueta'] === ''){
            return $this->error->error(
                mensaje: 'Error: "etiqueta" no puede venir vacía',
                data: $data_boton['etiqueta'],
                es_final: true
            );
        }

        // Validación de 'class'
        if(!isset($data_boton['class'])){
            return $this->error->error(
                mensaje: 'Error $data_boton[class] debe existir',
                data: $data_boton,
                es_final: true
            );
        }
        if($data_boton['class'] === ''){
            return $this->error->error(
                mensaje: 'Error: "class" no puede venir vacía',
                data: $data_boton['class'],
                es_final: true
            );
        }

        return true;
    }


    /**
     * REG
     * Valida que el valor provisto cumpla con el patrón asociado a la clave `cod_1_letras_mayusc`.
     *
     * Este método suele usarse para verificar que una cadena (o número convertible a cadena)
     * conste únicamente de letras mayúsculas, dependiendo de cómo se haya definido el patrón
     * en la propiedad `$this->patterns['cod_1_letras_mayusc']`.
     *
     * Si el valor no cumple con el patrón, o si la clave del patrón no existe, retornará `false`.
     *
     * @param int|string|null $txt Valor a validar. Si es `int` o `null`, internamente se convertirá a string
     *                             para realizar la validación.
     *
     * @return bool `true` si el valor `$txt` coincide con el patrón `cod_1_letras_mayusc`, `false` en caso contrario.
     *
     * @example
     *  // Ejemplo 1: Valor válido con letras mayúsculas
     *  ----------------------------------------------------------------------------
     *  // Suponiendo que $this->patterns['cod_1_letras_mayusc'] = '/^[A-Z]+$/'
     *
     *  $resultado = $this->cod_1_letras_mayusc('ABC');
     *  // $resultado será true, ya que 'ABC' coincide con el patrón de solo letras mayúsculas.
     *
     * @example
     *  // Ejemplo 2: Valor numérico que se convierte en string
     *  ----------------------------------------------------------------------------
     *  // Si el patrón considera sólo letras, por ejemplo '/^[A-Z]+$/', un valor numérico '123'
     *  // no pasará la validación.
     *
     *  $resultado = $this->cod_1_letras_mayusc(123);
     *  // $resultado será false, ya que '123' no coincide con el patrón de letras mayúsculas.
     *
     * @example
     *  // Ejemplo 3: Uso con valor nulo
     *  ----------------------------------------------------------------------------
     *  $resultado = $this->cod_1_letras_mayusc(null);
     *  // Internamente null se convertirá a cadena vacía '', y no coincidirá con el patrón (retornará false).
     */
    final public function cod_1_letras_mayusc(int|string|null $txt): bool
    {
        return $this->valida_pattern(key: 'cod_1_letras_mayusc', txt: $txt);
    }


    /**
     * REG
     * Valida que el valor provisto cumpla con el patrón identificado por la clave `cod_3_letras_mayusc`.
     *
     * Generalmente, este patrón (almacenado en `$this->patterns['cod_3_letras_mayusc']`)
     * requiere que la cadena contenga exactamente 3 letras mayúsculas (por ejemplo, `/^[A-Z]{3}$/`).
     *
     * - Si la clave `cod_3_letras_mayusc` no existe en `$this->patterns`, el método subyacente
     *   (`valida_pattern()`) retornará `false`.
     * - Si `$txt` no coincide con el patrón, también se retorna `false`.
     * - Si `$txt` coincide con el patrón, se retorna `true`.
     *
     * @param int|string|null $txt El valor a validar. Si es un entero o `null`, se convertirá a cadena
     *                             internamente para la verificación del patrón.
     *
     * @return bool Retorna `true` si `$txt` cumple el patrón `cod_3_letras_mayusc`; de lo contrario `false`.
     *
     * @example
     *  Ejemplo 1: Valor válido de 3 letras mayúsculas
     *  -------------------------------------------------------------------------------------
     *  // Suponiendo que $this->patterns['cod_3_letras_mayusc'] = '/^[A-Z]{3}$/'
     *  $resultado = $this->cod_3_letras_mayusc("ABC");
     *  // $resultado será true.
     *
     * @example
     *  Ejemplo 2: Valor insuficiente (menos de 3 letras)
     *  -------------------------------------------------------------------------------------
     *  $resultado = $this->cod_3_letras_mayusc("AB");
     *  // $resultado será false, ya que no cumple exactamente 3 letras mayúsculas.
     *
     * @example
     *  Ejemplo 3: Valor nulo
     *  -------------------------------------------------------------------------------------
     *  // Al convertir null a cadena resulta '', que no coincide con '/^[A-Z]{3}$/'
     *  $resultado = $this->cod_3_letras_mayusc(null);
     *  // $resultado será false.
     */
    final public function cod_3_letras_mayusc(int|string|null $txt): bool
    {
        return $this->valida_pattern(key: 'cod_3_letras_mayusc', txt: $txt);
    }


    /**
     * REG
     * Verifica si el valor proporcionado cumple con el patrón `cod_int_0_numbers`.
     *
     * Generalmente, este patrón (definido en `$this->patterns['cod_int_0_numbers']`)
     * comprueba que la cadena contenga solo dígitos (`0-9`). El número de dígitos permitidos
     * dependerá de cómo se haya configurado dicho patrón.
     *
     * - Si la clave `cod_int_0_numbers` no existe en `$this->patterns`, el método
     *   `valida_pattern()` retornará `false`.
     * - Si `$txt` no coincide con el patrón (por ejemplo, contiene letras o símbolos),
     *   también se retorna `false`.
     * - Si cumple el patrón, se retorna `true`.
     *
     * @param int|string|null $txt Valor a validar. Si es un entero o `null`, se convertirá
     *                             internamente a cadena para evaluar el patrón.
     *
     * @return bool `true` si `$txt` coincide con el patrón `cod_int_0_numbers`; de lo contrario `false`.
     *
     * @example
     *  Ejemplo 1: Valor únicamente con números
     *  ---------------------------------------------------------------------------------
     *  // Suponiendo que $this->patterns['cod_int_0_numbers'] = '/^[0-9]+$/'
     *  $resultado = $this->cod_int_0_numbers("12345");
     *  // $resultado será true.
     *
     * @example
     *  Ejemplo 2: Valor vacío o nulo
     *  ---------------------------------------------------------------------------------
     *  // Si el patrón exige al menos un dígito, la cadena vacía '' o null (convertido a '')
     *  // no coincidirá y retornará false.
     *
     *  $resultado = $this->cod_int_0_numbers(null);
     *  // $resultado será false.
     *
     * @example
     *  Ejemplo 3: Valor con caracteres no numéricos
     *  ---------------------------------------------------------------------------------
     *  $resultado = $this->cod_int_0_numbers("ABC123");
     *  // $resultado será false, ya que contiene letras.
     */
    final public function cod_int_0_numbers(int|string|null $txt): bool
    {
        return $this->valida_pattern(key: 'cod_int_0_numbers', txt: $txt);
    }


    /**
     * REG
     * Verifica si el valor `$txt` cumple con el patrón `cod_int_0_2_numbers`.
     *
     * Por lo general, este patrón (almacenado en `$this->patterns['cod_int_0_2_numbers']`) valida
     * que el valor consista únicamente en dígitos (`0-9`) y tenga exactamente 2 caracteres de longitud.
     * Por ejemplo, podría lucir así: `/^[0-9]{2}$/`.
     *
     * - Si `$txt` no coincide con el patrón (por ejemplo, es más largo, más corto o contiene caracteres distintos de dígitos),
     *   se retornará `false`.
     * - Si la clave `cod_int_0_2_numbers` no existe en `$this->patterns`, `valida_pattern()` también retornará `false`.
     * - Si coincide correctamente, se retorna `true`.
     *
     * @param int|string|null $txt El valor a validar. Si es entero o nulo, se convertirá internamente a cadena para verificar el patrón.
     *
     * @return bool `true` si `$txt` cumple con el patrón `cod_int_0_2_numbers`; `false` en caso contrario.
     *
     * @example
     *  Ejemplo 1: Valor válido
     *  -----------------------------------------------------------------------------------
     *  // Suponiendo que $this->patterns['cod_int_0_2_numbers'] = '/^[0-9]{2}$/'
     *  $resultado = $this->cod_int_0_2_numbers("12");
     *  // $resultado será true, ya que "12" coincide con el patrón de 2 dígitos.
     *
     * @example
     *  Ejemplo 2: Valor con longitud incorrecta
     *  -----------------------------------------------------------------------------------
     *  $resultado = $this->cod_int_0_2_numbers("123");
     *  // $resultado será false, ya que tiene más de 2 dígitos.
     *
     * @example
     *  Ejemplo 3: Valor nulo o vacío
     *  -----------------------------------------------------------------------------------
     *  // Si null se convierte a '', y el patrón requiere 2 dígitos, no coincide.
     *  $resultado = $this->cod_int_0_2_numbers(null);
     *  // $resultado será false.
     *
     * @example
     *  Ejemplo 4: Caracteres no numéricos
     *  -----------------------------------------------------------------------------------
     *  $resultado = $this->cod_int_0_2_numbers("1A");
     *  // $resultado será false, porque "1A" no son solo dígitos.
     */
    final public function cod_int_0_2_numbers(int|string|null $txt): bool
    {
        return $this->valida_pattern(key:'cod_int_0_2_numbers', txt:$txt);
    }


    /**
     * REG
     * Valida que el valor proporcionado cumpla con el patrón identificado por la clave `cod_int_0_3_numbers`.
     *
     * Por lo general, este patrón (por ejemplo `'/^[0-9]{3}$/'`) exige que la cadena contenga exactamente
     * 3 dígitos numéricos. Se asume que `$this->patterns['cod_int_0_3_numbers']` ya está definido.
     *
     * - Si la clave `cod_int_0_3_numbers` no existe en `$this->patterns`, la validación fallará y retornará `false`.
     * - Si `$txt` no coincide con el patrón (es más corto/largo o tiene caracteres no numéricos), se retornará `false`.
     * - Si sí coincide, se retornará `true`.
     *
     * @param int|string|null $txt Valor a validar. Si es un entero o `null`, se convertirá a cadena antes de validar.
     *
     * @return bool `true` si `$txt` cumple con el patrón `cod_int_0_3_numbers`; `false` en caso contrario.
     *
     * @example
     *  Ejemplo 1: Valor válido con 3 dígitos
     *  ----------------------------------------------------------------------------
     *  // Asumiendo que $this->patterns['cod_int_0_3_numbers'] = '/^[0-9]{3}$/'
     *  $resultado = $this->cod_int_0_3_numbers("123");
     *  // Retorna true, ya que "123" coincide con el patrón de 3 dígitos.
     *
     * @example
     *  Ejemplo 2: Longitud incorrecta
     *  ----------------------------------------------------------------------------
     *  $resultado = $this->cod_int_0_3_numbers("1234");
     *  // Retorna false, ya que tiene 4 dígitos en lugar de 3.
     *
     * @example
     *  Ejemplo 3: Caracteres no numéricos
     *  ----------------------------------------------------------------------------
     *  $resultado = $this->cod_int_0_3_numbers("12A");
     *  // Retorna false, ya que "12A" incluye una letra.
     */
    final public function cod_int_0_3_numbers(int|string|null $txt): bool
    {
        return $this->valida_pattern(key: 'cod_int_0_3_numbers', txt: $txt);
    }


    /**
     * REG
     * Valida si un valor cumple con el patrón definido para `cod_int_0_5_numbers`.
     *
     * Este método utiliza un patrón predefinido en el sistema para verificar si el valor
     * proporcionado es un código que puede contener entre 0 y 5 números. La validación
     * garantiza que el formato del valor sea consistente con las reglas establecidas.
     *
     * @param int|string|null $txt El valor a validar. Puede ser un entero, una cadena o `null`.
     *
     * @return bool
     *   - `true` si el valor cumple con el patrón.
     *   - `false` si el valor no cumple con el patrón.
     *
     * @example
     *  Ejemplo 1: Valor válido (entero)
     *  ---------------------------------
     *  $txt = 12345;
     *
     *  $resultado = $this->cod_int_0_5_numbers($txt);
     *  // $resultado será:
     *  // true
     *
     * @example
     *  Ejemplo 2: Valor válido (cadena)
     *  ---------------------------------
     *  $txt = '123';
     *
     *  $resultado = $this->cod_int_0_5_numbers($txt);
     *  // $resultado será:
     *  // true
     *
     * @example
     *  Ejemplo 3: Valor fuera del rango
     *  ---------------------------------
     *  $txt = '123456';
     *
     *  $resultado = $this->cod_int_0_5_numbers($txt);
     *  // $resultado será:
     *  // false
     *
     * @example
     *  Ejemplo 4: Valor nulo
     *  ----------------------
     *  $txt = null;
     *
     *  $resultado = $this->cod_int_0_5_numbers($txt);
     *  // $resultado será:
     *  // false
     *
     * @example
     *  Ejemplo 5: Valor con caracteres no numéricos
     *  ---------------------------------------------
     *  $txt = '12a34';
     *
     *  $resultado = $this->cod_int_0_5_numbers($txt);
     *  // $resultado será:
     *  // false
     *
     * @throws array Si el método `valida_pattern` genera un error durante su ejecución,
     *               este error será manejado por la lógica definida en el sistema.
     */
    final public function cod_int_0_5_numbers(int|string|null $txt): bool
    {
        return $this->valida_pattern(key: 'cod_int_0_5_numbers', txt: $txt);
    }


    /**
     * REG
     * Valida que el valor proporcionado cumpla con el patrón para un código numérico de 6 dígitos.
     *
     * Este método verifica si el valor `$txt` coincide con el patrón definido en la clave
     * `cod_int_0_6_numbers` de la propiedad `$this->patterns`. Se espera que el valor contenga
     * exactamente 6 dígitos numéricos. La validación se realiza utilizando el método
     * `valida_pattern()`, que aplica la expresión regular correspondiente.
     *
     * ### Funcionamiento:
     * - El método recibe como parámetro un valor que puede ser de tipo entero, cadena o nulo.
     * - Si el valor es un entero, se convertirá a cadena internamente para la validación.
     * - Si el valor es `null` o una cadena vacía, la validación fallará.
     * - Se utiliza el patrón asociado a la clave `'cod_int_0_6_numbers'` para comprobar que el
     *   valor contenga únicamente 6 dígitos.
     *
     * ### Casos de uso exitosos:
     * - **Ejemplo 1: Valor válido (cadena)**
     *   ```php
     *   $resultado = $obj->cod_int_0_6_numbers("123456");
     *   // Retorna true, ya que "123456" contiene exactamente 6 dígitos.
     *   ```
     *
     * - **Ejemplo 2: Valor válido (entero)**
     *   ```php
     *   $resultado = $obj->cod_int_0_6_numbers(123456);
     *   // Retorna true, ya que el entero 123456 se convierte a "123456", que cumple con el patrón.
     *   ```
     *
     * ### Casos de error:
     * - **Ejemplo 3: Valor con longitud incorrecta**
     *   ```php
     *   $resultado = $obj->cod_int_0_6_numbers("12345");
     *   // Retorna false, ya que "12345" tiene solo 5 dígitos, no cumple con el patrón.
     *   ```
     *
     * - **Ejemplo 4: Valor con caracteres no numéricos**
     *   ```php
     *   $resultado = $obj->cod_int_0_6_numbers("12A456");
     *   // Retorna false, ya que "12A456" contiene una letra y no es estrictamente numérico.
     *   ```
     *
     * @param int|string|null $txt El valor que se desea validar. Este valor debe representar un código
     *                             numérico de 6 dígitos. Si se pasa un entero, se convertirá a cadena.
     *                             Si se pasa `null` o una cadena vacía, la validación fallará.
     *
     * @return bool Devuelve `true` si `$txt` cumple con el patrón de 6 dígitos (según `$this->patterns['cod_int_0_6_numbers']`),
     *              o `false` en caso contrario.
     */
    final public function cod_int_0_6_numbers(int|string|null $txt): bool {
        return $this->valida_pattern(key: 'cod_int_0_6_numbers', txt: $txt);
    }


    /**
     * POR DOCUMENTAR EN WIKI FINAL REV
     * Valida un regex con 0 inicial minimo
     * @param int $longitud Longitud de cadena con ceros
     * @param int|string|null $txt Texto a verificar
     * @return bool|array
     * @version 2.49.0
     */
    final public function cod_int_0_n_numbers(int $longitud, int|string|null $txt): bool|array
    {
        if($longitud<=0){
            return $this->error->error(mensaje: 'Error longitud debe ser mayor a 0', data: $longitud, es_final: true);
        }
        $txt = trim($txt);
        if($txt === ''){
            return $this->error->error(mensaje: 'Error txt esta vacio', data: $txt, es_final: true);
        }
        $key = 'cod_int_0_'.$longitud.'_numbers';
        $this->patterns[$key] = "/^[0-9]{".$longitud."}$/";


        return $this->valida_pattern(key:$key, txt:$txt);

    }

    /**
     *
     * Valida que una clase de tipo modelo sea correcta y la inicializa como models\\tabla
     * @version 1.0.0
     * @param string $tabla Tabla o estructura de la base de datos y modelo
     * @return string|array clase depurada con models integrado
     */
    private function class_depurada(string $tabla): string|array
    {
        $tabla = trim($tabla);
        if($tabla === ''){
            return $this->error->error(mensaje: 'Error la tabla no puede venir vacia', data: $tabla, es_final: true);
        }
        $tabla = str_replace('models\\','',$tabla);

        $tabla = trim($tabla);
        if($tabla === ''){
            return $this->error->error(mensaje: 'Error la tabla no puede venir vacia', data: $tabla, es_final: true);
        }

        return 'models\\'.$tabla;
    }

    /**
     * Valida el regex de un correo
     * @param int|string|null $correo texto con correo a validar
     * @return bool|array true si es valido el formato de correo false si no lo es
     */
    private function correo(int|string|null $correo):bool|array{
        $correo = trim($correo);
        if($correo === ''){
            return $this->error->error(mensaje: 'Error el correo esta vacio', data:$correo,params: get_defined_vars());
        }
        $valida = $this->valida_pattern(key: 'correo',txt: $correo);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error verificar regex', data:$valida,params: get_defined_vars());
        }
        return $valida;
    }

    private function texto(int|string|null $texto):bool|array{
        $texto = trim($texto);
        if($texto === ''){
            return $this->error->error(mensaje: 'Error el valor ingresado esta vacio', data:$texto,params: get_defined_vars());
        }
        $valida = $this->valida_pattern(key: 'solo_texto',txt: $texto);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al verificar regex', data:$valida,params: get_defined_vars());
        }
        return $valida;
    }

    /**
     * REG
     * Verifica si una clave específica existe en un arreglo.
     *
     * Este método comprueba si la clave especificada existe en el arreglo proporcionado.
     * Devuelve `true` si la clave está definida en el arreglo, y `false` en caso contrario.
     *
     * @param array  $arreglo El arreglo en el que se buscará la clave. Este arreglo puede contener cualquier
     *                        tipo de elementos y la clave se buscará a nivel de índices.
     * @param string $key     La clave a buscar dentro del arreglo. Se espera que sea una cadena que
     *                        represente el nombre o índice del elemento.
     *
     * @return bool Retorna `true` si la clave existe en el arreglo; de lo contrario, retorna `false`.
     *
     * @example
     * // Ejemplo 1: Clave existente en el arreglo
     * $datos = ['nombre' => 'Juan', 'edad' => 30];
     * $resultado = $this->existe_key_data($datos, 'nombre');
     * // $resultado será true, ya que la clave 'nombre' existe en el arreglo.
     *
     * @example
     * // Ejemplo 2: Clave inexistente en el arreglo
     * $datos = ['nombre' => 'Juan', 'edad' => 30];
     * $resultado = $this->existe_key_data($datos, 'direccion');
     * // $resultado será false, ya que la clave 'direccion' no se encuentra en el arreglo.
     *
     * @example
     * // Ejemplo 3: Arreglo vacío
     * $datos = [];
     * $resultado = $this->existe_key_data($datos, 'cualquier_clave');
     * // $resultado será false, ya que el arreglo está vacío y por ende no contiene ninguna clave.
     */
    final public function existe_key_data(array $arreglo, string $key): bool {
        $r = true;
        if (!isset($arreglo[$key])) {
            $r = false;
        }
        return $r;
    }


    /**
     * REG
     * Valida que un conjunto de fechas en un arreglo u objeto stdClass cumpla con un formato determinado.
     *
     * Esta función se encarga de verificar que, para cada clave especificada en el arreglo `$keys`,
     * exista en el conjunto de datos `$data` y que su valor sea una fecha válida de acuerdo al formato
     * indicado por `$tipo_val`. La validación del formato de fecha se realiza mediante el método
     * `valida_fecha()`, que utiliza patrones predefinidos (por ejemplo, "yyyy-mm-dd" para el tipo 'fecha').
     *
     * El flujo de validación es el siguiente:
     * - Si `$data` es un objeto (stdClass), se convierte a un arreglo.
     * - Para cada clave en `$keys`:
     *   1. Se verifica que la clave no sea una cadena vacía; de ser vacía, se retorna un error.
     *   2. Se comprueba que la clave exista en `$data` mediante el método `existe_key_data()`. Si la clave no existe,
     *      se retorna un error indicando la ausencia de la misma.
     *   3. Se valida que el valor asociado a la clave en `$data` sea una fecha válida, utilizando el método
     *      `valida_fecha()`, que se encarga de verificar que el valor cumpla con el formato definido por `$tipo_val`.
     *
     * Si todas las claves existen y sus valores son fechas válidas, la función retorna `true`. Si alguna validación
     * falla, se retorna un arreglo con los detalles del error generado por `$this->error->error()`.
     *
     * @param array|stdClass $data     Conjunto de datos en el que se buscarán las fechas. Puede ser un arreglo asociativo o un objeto de tipo stdClass.
     * @param array          $keys    Arreglo de claves que se deben verificar en `$data`. Cada clave representa el nombre de un campo que contiene una fecha.
     *                                Ejemplo: `['fecha_inicio', 'fecha_fin']`
     * @param string         $tipo_val Tipo de fecha a validar. Este valor debe corresponder a uno de los formatos predefinidos
     *                                en la propiedad `$this->regex_fecha` (por ejemplo, 'fecha' para "yyyy-mm-dd", 'fecha_hora_min_sec_esp' para "yyyy-mm-dd hh:mm:ss", etc.).
     *                                Por defecto es 'fecha'.
     *
     * @return true|array Devuelve `true` si todas las claves existen y sus valores son fechas válidas según el formato especificado.
     *                    En caso de error, retorna un arreglo con la información del error.
     *
     * @example Ejemplo 1: Validación exitosa con un arreglo asociativo
     * ```php
     * $data = [
     *     'fecha_inicio' => '2023-01-01',
     *     'fecha_fin'    => '2023-12-31'
     * ];
     * $keys = ['fecha_inicio', 'fecha_fin'];
     * $resultado = $this->fechas_in_array($data, $keys);
     * // Resultado esperado: true, ya que ambas fechas cumplen con el formato "yyyy-mm-dd".
     * ```
     *
     * @example Ejemplo 2: Validación exitosa con un objeto stdClass
     * ```php
     * $data = new stdClass();
     * $data->fecha_inicio = '2023-01-01';
     * $data->fecha_fin = '2023-12-31';
     * $keys = ['fecha_inicio', 'fecha_fin'];
     * $resultado = $this->fechas_in_array($data, $keys);
     * // Resultado esperado: true.
     * ```
     *
     * @example Ejemplo 3: Error por clave vacía en el arreglo de claves
     * ```php
     * $data = [
     *     'fecha_inicio' => '2023-01-01',
     *     'fecha_fin'    => '2023-12-31'
     * ];
     * $keys = [''];  // Se proporciona una clave vacía
     * $resultado = $this->fechas_in_array($data, $keys);
     * // Resultado esperado: Retorna un error indicando "Error key no puede venir vacio".
     * ```
     *
     * @example Ejemplo 4: Error por ausencia de una clave en el conjunto de datos
     * ```php
     * $data = [
     *     'fecha_inicio' => '2023-01-01'
     * ];
     * $keys = ['fecha_inicio', 'fecha_fin'];
     * $resultado = $this->fechas_in_array($data, $keys);
     * // Resultado esperado: Retorna un error indicando "Error al validar existencia de key" para 'fecha_fin'.
     * ```
     *
     * @example Ejemplo 5: Error por formato de fecha inválido
     * ```php
     * $data = [
     *     'fecha_inicio' => '2023-01-01',
     *     'fecha_fin'    => '31-12-2023'  // Formato incorrecto
     * ];
     * $keys = ['fecha_inicio', 'fecha_fin'];
     * $resultado = $this->fechas_in_array($data, $keys);
     * // Resultado esperado: Retorna un error indicando "Error al validar fecha: $data[fecha_fin]" si el método valida_fecha detecta el formato incorrecto.
     * ```
     */
    final public function fechas_in_array(array|stdClass $data, array $keys, string $tipo_val = 'fecha'): true|array
    {
        if (is_object($data)) {
            $data = (array)$data;
        }
        foreach ($keys as $key) {

            if ($key === '') {
                return $this->error->error(
                    mensaje: "Error key no puede venir vacio",
                    data: $key,
                    es_final: true
                );
            }
            $valida = $this->existe_key_data(arreglo: $data, key: $key);
            if (!$valida) {
                return $this->error->error(
                    mensaje: "Error al validar existencia de key",
                    data: $key,
                    es_final: true
                );
            }

            $valida = $this->valida_fecha(fecha: $data[$key], tipo_val: $tipo_val);
            if (errores::$error) {
                return $this->error->error(
                    mensaje: "Error al validar fecha: " . '$data[' . $key . ']',
                    data: $valida
                );
            }
        }
        return true;
    }


    /**
     * TOTAL
     * Valida el valor del ID proporcionado.
     *
     * Este método invoca a la función 'valida_pattern' con un patrón predefinido 'id'.
     * Está diseñado para validar si el valor de entrada cumple con los criterios de un ID válido,
     * que en este caso son números enteros positivos no nulos.
     *
     * @param int|string|null $txt El ID que se validará. Puede ser un entero, una cadena o null.
     *
     * @return bool Devuelve true si $txt es un ID válido, false en caso contrario.
     * @version 3.16.0
     * @url https://github.com/gamboamartin/validacion/wiki/src.validacion.id.5.28.0
     */
    final public function id(int|string|null $txt):bool{
        return $this->valida_pattern(key:'id', txt:$txt);
    }

    /**
     * POR DOCUMENTAR EN WIKI FINAL REV
     * Valida un patrón de ID de clave (key_id)
     *
     * Esta función toma un valor de entrada y verifica si corresponde a
     * el patrón de ID de clave (key_id), que consiste en una secuencia de palabras
     * separadas por guiones bajos (_) y termina con "_id".
     *
     * @param string $txt El valor de la entrada para validar.
     * Puede ser una cadena de texto o nulo.
     * @return bool Retorna 'true' si el valor de la entrada corresponde al patrón, y 'false' en caso contrario.
     * @version 3.11.0
     *
     */
    final public function key_id(string $txt):bool{
        return $this->valida_pattern(key:'key_id', txt:$txt);
    }

    /**
     * Obtiene los keys de un registro documento
     * @return string[]
     * @version 0.32.1
     */
    private function keys_documentos(): array
    {
        return array('ruta','ruta_relativa','ruta_absoluta');
    }

    /**
     *
     * Funcion para validar letra numero espacio
     *
     * @param  string $txt valor a validar
     *
     * @example
     *      $etiqueta = 'xxx xx';
     *      $this->validacion->letra_numero_espacio($etiqueta);
     *
     * @return bool true si cumple con pattern false si no cumple
     * @version 0.16.1
     * @verfuncion 0.1.0
     * @author mgamboa
     * @fecha 2022-08-01 13:42
     */
    final public function letra_numero_espacio(string $txt):bool{
        return $this->valida_pattern(key: 'letra_numero_espacio',txt: $txt);
    }

    /**
     * Valida que un rfc
     * @param int|string|null $txt texto a validar
     * @return bool
     * @version 2.54.0
     */
    final public function rfc(int|string|null $txt):bool{
        return $this->valida_pattern(key:'rfc', txt:$txt);
    }

    /**
     * POR DOCUMENTAR EN WIKI FINAL REV
     * Funcion que valida el dato de una seccion corresponda con la existencia de un modelo
     * @param string $seccion Seccion a validar
     * @return array|bool
     * @version 4.7.0
     *
     */
    private function seccion(string $seccion):array|bool{
        $seccion = str_replace('models\\','',$seccion);
        $seccion = strtolower(trim($seccion));
        if(trim($seccion) === ''){
            $fix = 'La seccion debe ser un string no numerico y no vacio seccion=elemento_txt_no_numerico_ni_vacio';
            $fix .= 'seccion=tabla';
            return  $this->error->error(mensaje: 'Error seccion  no puede ser vacio', data: $seccion,
                es_final: true, fix: $fix);
        }
        return true;
    }

    /**
     *
     * verifica los datos de una seccion y una accion sean correctos
     * @param string $seccion seccion basada en modelo
     * @param string $accion accion a ejecutar
     * @example
     * $seccion = 'menu';
     * $accion = 'alta'
     * $valida = (new validacion())->seccion_accion(accion:$accion, seccion:$seccion);
     * $print_r($valida); // true|1 siempre
     * @return array|bool array si hay error bool true exito
     */
    final public function seccion_accion(string $accion, string $seccion):array|bool{
        $valida = $this->seccion(seccion: $seccion);
        if(errores::$error){
            $fix = 'La seccion debe ser un string no numerico y no vacio seccion=elemento_txt_no_numerico_ni_vacio';
            $fix .= 'seccion=tabla';
            return  $this->error->error(mensaje: 'Error al validar seccion',data: $valida, fix: $fix);
        }
        if(trim($accion) === ''){
            $fix = 'La accion debe ser un string no numerico y no vacio accion=elemento_txt_no_numerico_ni_vacio';
            $fix .= 'seccion=lista';
            return  $this->error->error(mensaje: 'Error accion  no puede ser vacio', data: $accion,
                es_final: true, fix: $fix);
        }
        return true;
    }

    /**
     *
     * Conjunto de errores de FILES
     * @param int|string $codigo Codigo de error de FILES
     * @return bool|array
     * @version 2.57.0
     */
    final public function upload(int|string $codigo): bool|array
    {
        switch ($codigo)
        {
            case UPLOAD_ERR_OK: //0
                //$mensajeInformativo = 'El fichero se ha subido correctamente (no se ha producido errores).';
                return true;
            case UPLOAD_ERR_INI_SIZE: //1
                $mensajeInformativo = 'El archivo que se ha intentado subir sobrepasa el límite de tamaño permitido. Revisar la directiva de php.ini UPLOAD_MAX_FILSIZE. ';
                break;
            case UPLOAD_ERR_FORM_SIZE: //2
                $mensajeInformativo = 'El fichero subido excede la directiva MAX_FILE_SIZE especificada en el formulario HTML. Revisa la directiva de php.ini MAX_FILE_SIZE.';
                break;
            case UPLOAD_ERR_PARTIAL: //3
                $mensajeInformativo = 'El fichero fue sólo parcialmente subido.';
                break;
            case UPLOAD_ERR_NO_FILE: //4
                $mensajeInformativo = 'No se ha subido ningún documento';
                break;
            case UPLOAD_ERR_NO_TMP_DIR: //6
                $mensajeInformativo = 'No se ha encontrado ninguna carpeta temporal.';
                break;
            case UPLOAD_ERR_CANT_WRITE: //7
                $mensajeInformativo = 'Error al escribir el archivo en el disco.';
                break;
            case UPLOAD_ERR_EXTENSION: //8
                $mensajeInformativo = 'Carga de archivos detenida por extensión.';
                break;
            default:
                $mensajeInformativo = 'Error sin identificar.';
                break;
        }
        return $this->error->error($mensajeInformativo,$codigo);
    }

    /**
     * @param int|string|null $url Ligar a validar
     * @return bool|array
     * @version 0.26.1
     */
    private function url(int|string|null $url):bool|array{
        $url = trim($url);
        if($url === ''){
            return $this->error->error(mensaje: 'Error la url esta vacia', data:$url);
        }
        $valida = $this->valida_pattern(key: 'url',txt: $url);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error verificar regex', data:$valida);
        }
        return $valida;
    }

    /**
     * REG
     * Verifica que el valor proporcionado sea un arreglo (`array`).
     *
     * - Si `$value` no es un arreglo, se retorna un arreglo que describe el error,
     *   generado por `$this->error->error()`.
     * - En caso contrario, retorna `true`.
     *
     * @param mixed $value Valor a validar.
     *
     * @return true|array  Retorna `true` si `$value` es un arreglo. De lo contrario,
     *                     retorna un arreglo con información del error.
     *
     * @example
     *  Ejemplo 1: Validación exitosa
     *  --------------------------------------------------------------------------------
     *  $valor = ['dato1', 'dato2'];
     *  $resultado = $this->valida_array($valor);
     *  // Retorna true, puesto que $valor es un array.
     *
     * @example
     *  Ejemplo 2: Validación fallida
     *  --------------------------------------------------------------------------------
     *  $valor = "No soy un array";
     *  $resultado = $this->valida_array($valor);
     *  // Retorna un arreglo de error indicando que el valor no es un array.
     */
    final public function valida_array(mixed $value): true|array
    {
        if (!is_array($value)) {
            return $this->error->error(
                mensaje: 'Error el valor no es un array',
                data: $value,
                es_final: true
            );
        }
        return true;
    }


    /**
     * REG
     * Verifica que un arreglo u objeto `$row` contenga las claves especificadas en `$keys` y que,
     * además, los valores de cada una de esas claves sean arreglos (`array`).
     *
     * Pasos principales:
     *  1. **Convertir `$row` a arreglo si es un `stdClass`.**
     *  2. **Verificar** que `$keys` no esté vacío.
     *  3. **Validar la existencia** de cada clave en `$row` usando {@see valida_existencia_keys()}.
     *  4. **Verificar** que el contenido de `$row[$key]` sea un arreglo, llamando a {@see valida_array()}.
     *
     * Si alguna validación falla, se retorna un arreglo de error generado por `$this->error->error()`.
     * Si todo es correcto, se retorna `true`.
     *
     * @param array|\stdClass $row  Estructura de datos a validar. Si es un objeto, se convierte a array.
     * @param array           $keys Lista de claves que deben existir en `$row` y contener arrays.
     *
     * @return true|array Retorna:
     *  - `true` si todas las claves existen y sus valores son arreglos.
     *  - Un arreglo de error (resultado de `$this->error->error()`) si alguna validación falla.
     *
     * @example
     *  Ejemplo 1: Validación exitosa con array
     *  ----------------------------------------------------------------------------
     *  $row = [
     *      'productos' => ['item1', 'item2'],
     *      'clientes'  => ['cliente1', 'cliente2']
     *  ];
     *  $keys = ['productos', 'clientes'];
     *
     *  $resultado = $this->valida_arrays($keys, $row);
     *  // Retorna true, puesto que todas las claves existen y contienen un array.
     *
     * @example
     *  Ejemplo 2: Falta una clave
     *  ----------------------------------------------------------------------------
     *  $row = [
     *      'productos' => ['item1', 'item2']
     *  ];
     *  $keys = ['productos', 'clientes'];
     *
     *  $resultado = $this->valida_arrays($keys, $row);
     *  // Retorna un arreglo de error indicando que 'clientes' no existe en el registro.
     *
     * @example
     *  Ejemplo 3: Valor que no es un array
     *  ----------------------------------------------------------------------------
     *  $row = [
     *      'productos' => 'No es un array',
     *      'clientes'  => ['cliente1', 'cliente2']
     *  ];
     *  $keys = ['productos', 'clientes'];
     *
     *  $resultado = $this->valida_arrays($keys, $row);
     *  // Retorna un arreglo de error indicando que 'productos' no es un array.
     *
     * @example
     *  Ejemplo 4: `$row` como stdClass
     *  ----------------------------------------------------------------------------
     *  $obj = new stdClass();
     *  $obj->productos = ['item1', 'item2'];
     *  $obj->clientes = ['cliente1', 'cliente2'];
     *
     *  $resultado = $this->valida_arrays(['productos', 'clientes'], $obj);
     *  // Se convierte a array y se valida. Retorna true si todo está correcto.
     */
    final public function valida_arrays(array $keys, array|\stdClass $row): true|array
    {
        // Convierte $row a array si es un objeto stdClass
        if (is_object($row)) {
            $row = (array)$row;
        }

        // Verifica que keys no esté vacío
        if (count($keys) === 0) {
            return $this->error->error(
                mensaje: 'Error keys esta vacio',
                data: $keys,
                es_final: true
            );
        }

        // Valida la existencia de todas las claves en $row
        $valida_existe = $this->valida_existencia_keys(keys: $keys, registro: $row);
        if (errores::$error) {
            return $this->error->error(
                mensaje: 'Error al validar registro',
                data: $valida_existe
            );
        }

        // Verifica que el valor en cada clave sea un array
        foreach ($keys as $key) {
            $valida = $this->valida_array(value: $row[$key]);
            if (errores::$error) {
                return $this->error->error(
                    mensaje: 'Error al validar registro[' . $key . ']',
                    data: $valida
                );
            }
        }

        return true;
    }


    /**
     * REG
     * Valida la existencia y contenido de una clave dentro de un arreglo u objeto stdClass.
     *
     * Esta función se asegura de que el índice o propiedad `$key` exista en `$registro`, no sea vacío
     * y, opcionalmente, verifica que su valor sea un entero mayor que cero. En caso de que alguna de
     * estas condiciones falle, se registra un error a través de `$this->error->error()` y se retorna
     * un arreglo con la información del error.
     *
     * @param string               $key        Clave que se buscará y validará dentro de `$registro`.
     * @param array|stdClass      $registro   Colección de datos donde se validará la existencia de `$key`.
     * @param bool                 $valida_int Si es `true`, se valida que el valor asociado a `$key` sea un entero > 0.
     *
     * @return true|array Retorna `true` si la validación es exitosa; en caso de error, retorna un array que describe el error.
     *
     * @example
     *  Ejemplo 1: Uso con un arreglo y validación de entero
     *  ----------------------------------------------------------------------------
     *  $registro = [
     *      'usuario_id' => 15,
     *      'nombre'     => 'Juan Pérez'
     *  ];
     *
     *  // Se validará que 'usuario_id' exista, no sea vacío y sea > 0.
     *  $resultado = $this->valida_base('usuario_id', $registro, true);
     *
     *  if($resultado !== true) {
     *      // Manejo de error, $resultado contendrá los datos del error devueltos por $this->error->error()
     *  }
     *
     * @example
     *  Ejemplo 2: Uso con un arreglo y SIN validación de entero
     *  ----------------------------------------------------------------------------
     *  $registro = [
     *      'descripcion' => 'Texto de ejemplo'
     *  ];
     *
     *  // Se validará que 'descripcion' exista y no sea vacío, pero no se forzará que sea un entero.
     *  $resultado = $this->valida_base('descripcion', $registro, false);
     *
     *  if($resultado !== true) {
     *      // Manejo de error, $resultado contendrá los datos del error.
     *  }
     *
     * @example
     *  Ejemplo 3: Uso con un stdClass
     *  ----------------------------------------------------------------------------
     *  $registro_obj = new stdClass();
     *  $registro_obj->cantidad = 10;
     *
     *  // Se validará que 'cantidad' exista y sea un entero mayor que 0.
     *  // Internamente, se convertirá $registro_obj a un array para hacer la validación.
     *  $resultado = $this->valida_base('cantidad', $registro_obj, true);
     *
     *  if($resultado !== true) {
     *      // Manejo de error, $resultado contendrá los datos del error.
     *  }
     *
     *  // IMPORTANTE: Si la clave o propiedad no existe, o si no cumple los criterios,
     *  // se retornará un arreglo con la información del error en lugar de `true`.
     */
    private function valida_base(string $key, array|\stdClass $registro, bool $valida_int = true): true|array
    {
        $key = trim($key);
        if ($key === '') {
            // Retorna arreglo de error si la clave está vacía
            return $this->error->error(
                mensaje: 'Error: key no puede venir vacío ' . $key,
                data: $registro,
                es_final: true
            );
        }

        // Convierte objeto stdClass a array para facilitar la validación
        if (is_object($registro)) {
            $registro = (array)$registro;
        }

        // Verifica existencia de la clave en el array
        if (!isset($registro[$key])) {
            return $this->error->error(
                mensaje: 'Error: no existe en $registro el key ' . $key,
                data: $registro,
                es_final: true
            );
        }

        // Verifica que no esté vacío
        if ((string)$registro[$key] === '') {
            return $this->error->error(
                mensaje: 'Error: está vacío ' . $key,
                data: $registro,
                es_final: true
            );
        }

        // Si se requiere validar entero mayor a 0
        if ($valida_int) {
            if ((int)$registro[$key] <= 0) {
                return $this->error->error(
                    mensaje: 'Error: el ' . $key . ' debe ser mayor a 0',
                    data: $registro,
                    es_final: true
                );
            }
        }

        // Si todas las validaciones pasan
        return true;
    }


    /**
     * Valida un elemento sea bool
     * @param mixed $value Valor a verificar
     * @return bool|array
     * @version 0.45.1
     *
     */
    final public function valida_bool(mixed $value): bool|array
    {
        if(!is_bool($value)){
            return $this->error->error(mensaje: 'Error el valor no es un booleano',data: $value);
        }
        return true;
    }

    /**
     * Valida un conjunto de valores booleanos
     * @param array $keys keys a validar en el objeto o array
     * @param array|stdClass $row registro a validar
     * @return bool|array
     * @version 0.45.1
     */
    final public function valida_bools(array $keys, array|stdClass $row): bool|array
    {
        if(is_object($row)){
            $row = (array)$row;
        }
        $valida_existe = $this->valida_existencia_keys(keys: $keys,registro: $row);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al validar registro', data: $valida_existe);
        }
        foreach ($keys as $key){
            $valida = $this->valida_bool(value: $row[$key]);
            if(errores::$error){
                return $this->error->error(mensaje: 'Error al validar registro['.$key.']', data: $valida);
            }
        }
        return true;
    }

    /**
     * Funcion que valida los campos obligatorios para una transaccion
     * @version 0.13.1
     * @param array $campos_obligatorios
     * @param array $registro
     * @param string $tabla
     * @return array $this->campos_obligatorios
     * @example
     *     $valida_campo_obligatorio = $this->valida_campo_obligatorio();
     */
    final public function valida_campo_obligatorio(array $campos_obligatorios, array $registro, string $tabla):array{
        foreach($campos_obligatorios as $campo_obligatorio){
            $campo_obligatorio = trim($campo_obligatorio);
            if(!array_key_exists($campo_obligatorio,$registro)){
                return $this->error->error(mensaje: 'Error el campo '.$campo_obligatorio.' debe existir en el registro de '.$tabla,
                    data: array($registro,$campos_obligatorios));

            }
            if(is_array($registro[$campo_obligatorio])){
                return $this->error->error(mensaje: 'Error el campo '.$campo_obligatorio.' no puede ser un array',
                    data: array($registro,$campos_obligatorios));
            }
            if((string)$registro[$campo_obligatorio] === ''){
                return $this->error->error(mensaje: 'Error el campo '.$campo_obligatorio.' no puede venir vacio',
                    data: array($registro,$campos_obligatorios));
            }
        }

        return $campos_obligatorios;

    }

    /**
     * POR DOCUMENTAR EN WIKI FINAL REV
     * Verifica si una celda dada es válida.
     *
     * Esta función toma una cadena, que representa una celda,
     * luego verifica si está vacío y si coincide con el patrón 'celda_calc'.
     * En caso de encontrar algún error, este será registrado y retornado.
     *
     * @param string $celda La celda que se va a validar.
     *
     * @return array|true Retorna verdadero si la celda es válida, de lo contrario
     * retorna los detalles del error.
     *
     *
     * @final Esta función es final y no puede ser sobrescrita.
     *
     * @access public Esta función es accesible públicamente.
     * @version 4.6.0
     */
    final public function valida_celda_calc(string $celda):array|true
    {
        $celda = trim($celda);
        if($celda === ''){
            return $this->error->error(mensaje: 'Error el celda esta vacia', data: $celda, es_final: true);
        }

        $es_celda = $this->valida_pattern(key:'celda_calc', txt:$celda);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error validar regex celda', data: $es_celda);
        }

        if(!$es_celda){
            return $this->error->error(mensaje: 'Error la celda es invalida', data: $this->patterns['celda_calc'],
                es_final: true);
        }
        return true;

    }

    /**
     * Valida si una clase de tipo modelo es valida
     * @version 1.0.0
     * @param string $tabla Tabla o estructura de la bd
     * @param string $class Class o estructura de una bd regularmente la misma que tabla
     * @return bool|array verdadero si las entradas son validas
     */
    private function valida_class(string $class, string $tabla): bool|array
    {

        if($tabla === ''){
            return $this->error->error(mensaje: 'Error tabla no puede venir vacia',data: $tabla);
        }
        if($class === ''){
            return $this->error->error(mensaje:'Error $class no puede venir vacia',data: $class);
        }

        return true;
    }

    /**
     * REG
     * Valida que el campo `$key` dentro de `$registro`:
     *  1. Exista y no esté vacío (usando `valida_base()`).
     *  2. Cumpla con el patrón definido para `cod_1_letras_mayusc` (por ejemplo, solo letras mayúsculas).
     *
     * Si no se cumplen estas condiciones, registra un error y retorna un arreglo con los datos del error.
     * De lo contrario, retorna `true`.
     *
     * @param string        $key      Clave que se validará dentro de `$registro`.
     * @param array|object  $registro Arreglo u objeto que contiene la información a validar.
     *
     * @return bool|array   Retorna `true` si la validación es exitosa. En caso de error, retorna un arreglo
     *                      con la información detallada del mismo.
     *
     * @example
     *  Ejemplo 1: Validación exitosa con un array
     *  ----------------------------------------------------------------------------------
     *  $registro = [
     *      'codigo' => 'ABC'
     *  ];
     *  $resultado = $this->valida_cod_1_letras_mayusc('codigo', $registro);
     *  if ($resultado === true) {
     *      echo "La validación fue exitosa. 'codigo' contiene solo letras mayúsculas.";
     *  } else {
     *      // Manejo de error, $resultado contendrá la información del error
     *  }
     *
     * @example
     *  Ejemplo 2: Validación con un stdClass
     *  ----------------------------------------------------------------------------------
     *  $registroObj = new stdClass();
     *  $registroObj->codigo = 'XYZ';
     *  $resultado = $this->valida_cod_1_letras_mayusc('codigo', $registroObj);
     *  if ($resultado === true) {
     *      echo "La validación fue exitosa. 'codigo' es solo mayúsculas.";
     *  } else {
     *      // Manejo de error (se convierte el objeto en array internamente)
     *  }
     *
     * @example
     *  Ejemplo 3: Falla al validar por estar vacío o no existir la clave
     *  ----------------------------------------------------------------------------------
     *  $registro = [];
     *  // Aquí la clave 'codigo' no existe en el arreglo
     *  $resultado = $this->valida_cod_1_letras_mayusc('codigo', $registro);
     *  // $resultado contendrá la información de error proveniente de valida_base()
     *
     * @example
     *  Ejemplo 4: Falla al validar el patrón (no cumple solo mayúsculas)
     *  ----------------------------------------------------------------------------------
     *  $registro = [
     *      'codigo' => 'AbC123'
     *  ];
     *  $resultado = $this->valida_cod_1_letras_mayusc('codigo', $registro);
     *  // Retornará error, ya que 'AbC123' no coincide con el patrón de mayúsculas
     */
    final public function valida_cod_1_letras_mayusc(string $key, array|object $registro): bool|array
    {
        if (is_object($registro)) {
            $registro = (array) $registro;
        }

        // Valida que el key exista, no esté vacío, y NO fuerce int > 0 (valida_int=false)
        $valida = $this->valida_base(key: $key, registro: $registro, valida_int: false);
        if (errores::$error) {
            return $this->error->error(
                mensaje: 'Error al validar ' . $key,
                data: $valida
            );
        }

        // Valida que el valor del campo cumpla el patrón `cod_1_letras_mayusc`
        if (!$this->cod_1_letras_mayusc(txt: $registro[$key])) {
            return $this->error->error(
                mensaje: 'Error: el ' . $key . ' es inválido (no cumple el patrón de mayúsculas)',
                data: $registro
            );
        }

        return true;
    }


    /**
     * REG
     * Verifica que el índice `$key` dentro del arreglo `$registro`:
     * 1. Exista y no esté vacío (mediante `valida_base()` con `valida_int = false` para no forzar a entero).
     * 2. Cumpla con el patrón `cod_3_letras_mayusc` (por ejemplo, 3 letras mayúsculas seguidas).
     *
     * - Si falla alguna de estas validaciones, se registra un error mediante `$this->error->error()` y se
     *   retorna el arreglo con la información correspondiente.
     * - Si todo es correcto, retorna `true`.
     *
     * @param string $key      Clave dentro de `$registro` que se desea validar.
     * @param array  $registro Arreglo con la información a validar.
     *
     * @return bool|array Retorna `true` si la validación es satisfactoria. En caso de error, retorna un
     *                    arreglo con detalles del mismo.
     *
     * @example
     *  Ejemplo 1: Validación exitosa
     *  ---------------------------------------------------------------------------------------
     *  $registro = ['codigo' => 'ABC'];
     *  $resultado = $this->valida_cod_3_letras_mayusc('codigo', $registro);
     *  if ($resultado === true) {
     *      echo "Valor válido: contiene 3 letras mayúsculas.";
     *  } else {
     *      // Manejo del error, $resultado contiene la información de error
     *  }
     *
     * @example
     *  Ejemplo 2: Falla al no existir la clave
     *  ---------------------------------------------------------------------------------------
     *  $registro = [];
     *  // Falta la clave 'codigo', por lo que valida_base() devolverá error
     *  $resultado = $this->valida_cod_3_letras_mayusc('codigo', $registro);
     *  // Se retorna el arreglo con los detalles del error.
     *
     * @example
     *  Ejemplo 3: Falla al no cumplir el patrón
     *  ---------------------------------------------------------------------------------------
     *  $registro = ['codigo' => 'AB'];
     *  // 'AB' no cumple con el patrón de 3 letras mayúsculas
     *  $resultado = $this->valida_cod_3_letras_mayusc('codigo', $registro);
     *  // Se retorna el arreglo con los detalles del error.
     */
    final public function valida_cod_3_letras_mayusc(string $key, array $registro): bool|array
    {
        // 1. Verifica que el $key exista y no esté vacío en $registro (sin forzar entero > 0).
        $valida = $this->valida_base(key: $key, registro: $registro, valida_int: false);
        if (errores::$error) {
            return $this->error->error(
                mensaje: 'Error al validar ' . $key,
                data: $valida
            );
        }

        // 2. Comprueba que el valor cumpla el patrón de 3 letras mayúsculas (cod_3_letras_mayusc).
        if (!$this->cod_3_letras_mayusc(txt: $registro[$key])) {
            return $this->error->error(
                mensaje: 'Error: el ' . $key . ' es inválido (no cumple el patrón de 3 letras mayúsculas)',
                data: $registro
            );
        }

        return true;
    }


    /**
     * REG
     * Verifica que el índice `$key` dentro de `$registro`:
     *  1. Exista y no esté vacío (mediante `valida_base()` con `valida_int = true` por defecto).
     *  2. Cumpla el patrón `cod_int_0_numbers`, que normalmente valida que sean solo dígitos (`0-9`).
     *
     * - Si alguna de las validaciones falla, se retorna un arreglo con la información del error
     *   (a través de `$this->error->error()`).
     * - Si todo es correcto, retorna `true`.
     *
     * @param string               $key      Clave que se validará dentro de `$registro`.
     * @param array|\stdClass      $registro Colección de datos (array u objeto stdClass) donde se verifica la existencia de `$key`.
     *
     * @return bool|array Retorna `true` si la validación es exitosa; si hay algún error, retorna
     *                    un arreglo con la información de dicho error.
     *
     * @example
     *  Ejemplo 1: Validación exitosa con array
     *  -------------------------------------------------------------------------
     *  $registro = [
     *      'codigo' => '12345'
     *  ];
     *  // Asumiendo que $this->patterns['cod_int_0_numbers'] = '/^[0-9]+$/'
     *  $resultado = $this->valida_cod_int_0_numbers('codigo', $registro);
     *  if ($resultado === true) {
     *      echo "La clave 'codigo' existe y su valor solo contiene dígitos.";
     *  } else {
     *      // Manejo de error.
     *  }
     *
     * @example
     *  Ejemplo 2: Validación con stdClass
     *  -------------------------------------------------------------------------
     *  $registroObj = new stdClass();
     *  $registroObj->codigo = '987654';
     *
     *  $resultado = $this->valida_cod_int_0_numbers('codigo', $registroObj);
     *  // Internamente se convierte $registroObj a array antes de validar.
     *  // Retornará true si '987654' coincide con el patrón solo dígitos.
     *
     * @example
     *  Ejemplo 3: Falta la clave en $registro
     *  -------------------------------------------------------------------------
     *  $registro = [];
     *  $resultado = $this->valida_cod_int_0_numbers('codigo', $registro);
     *  // Se retorna un arreglo de error indicando que 'codigo' no existe.
     *
     * @example
     *  Ejemplo 4: Valor no cumple el patrón
     *  -------------------------------------------------------------------------
     *  $registro = [
     *      'codigo' => '12A45'
     *  ];
     *  // '12A45' no coincide con el patrón solo dígitos
     *  $resultado = $this->valida_cod_int_0_numbers('codigo', $registro);
     *  // Se retorna un arreglo de error indicando que el valor es inválido.
     */
    final public function valida_cod_int_0_numbers(string $key, array|\stdClass $registro): bool|array
    {
        // 1. Verifica que el key exista y sea válido a través de valida_base()
        $valida = $this->valida_base(key: $key, registro: $registro);
        if (errores::$error) {
            return $this->error->error(
                mensaje: 'Error al validar ' . $key,
                data: $valida
            );
        }

        // 2. Comprueba que el valor cumpla con el patrón 'cod_int_0_numbers'
        if (!$this->cod_int_0_numbers(txt: $registro[$key])) {
            return $this->error->error(
                mensaje: 'Error: el ' . $key . ' es inválido (no cumple el patrón solo dígitos)',
                data: $registro
            );
        }

        return true;
    }


    /**
     * REG
     * Valida que el índice `$key` dentro de `$registro`:
     * 1. Exista, no esté vacío y sea un valor válido para ser procesado como número (validado a través de `valida_base()`).
     * 2. Cumpla con el patrón `cod_int_0_2_numbers`, habitualmente definido para exigir exactamente 2 dígitos (`0-9`).
     *
     * - Si `$registro` es un objeto (`stdClass`), se convierte a array.
     * - Si alguna validación falla, se utiliza `$this->error->error()` para registrar el error y se retorna un arreglo con la información correspondiente.
     * - Si todo pasa correctamente, retorna `true`.
     *
     * @param string          $key      Nombre de la clave en `$registro` a validar.
     * @param array|\stdClass $registro Colección de datos; puede ser un array o un objeto `stdClass`.
     *
     * @return true|array Retorna `true` si la validación es satisfactoria. En caso de error, retorna
     *                    un arreglo con los detalles del mismo.
     *
     * @example
     *  Ejemplo 1: Uso con un array válido
     *  ----------------------------------------------------------------------------
     *  $registro = [
     *      'codigo' => '12'
     *  ];
     *
     *  // Suponiendo que el patrón `cod_int_0_2_numbers` requiere exactamente 2 dígitos,
     *  // '12' será válido y la función retornará true.
     *  $resultado = $this->valida_cod_int_0_2_numbers('codigo', $registro);
     *  if ($resultado === true) {
     *      echo "Validación exitosa.";
     *  } else {
     *      // Manejo de error.
     *  }
     *
     * @example
     *  Ejemplo 2: Uso con stdClass
     *  ----------------------------------------------------------------------------
     *  $registroObj = new stdClass();
     *  $registroObj->codigo = '09';
     *
     *  // Se convierte el objeto en array internamente.
     *  $resultado = $this->valida_cod_int_0_2_numbers('codigo', $registroObj);
     *  // Retornará true si '09' cumple el patrón (2 dígitos).
     *
     * @example
     *  Ejemplo 3: Falta la clave en el registro
     *  ----------------------------------------------------------------------------
     *  $registro = [];
     *  $resultado = $this->valida_cod_int_0_2_numbers('codigo', $registro);
     *  // Se retorna un arreglo con la información de error indicando que no existe la clave 'codigo'.
     *
     * @example
     *  Ejemplo 4: Valor inválido para el patrón
     *  ----------------------------------------------------------------------------
     *  $registro = [
     *      'codigo' => '123'
     *  ];
     *  // Dado que son 3 dígitos, no coincide con el patrón de 2 dígitos. Se retorna error.
     *  $resultado = $this->valida_cod_int_0_2_numbers('codigo', $registro);
     *
     */
    final public function valida_cod_int_0_2_numbers(string $key, array|\stdClass $registro): true|array
    {
        // Convierte objeto a array si corresponde
        if (is_object($registro)) {
            $registro = (array)$registro;
        }

        // Valida que la clave $key exista y no esté vacía (además de forzar int > 0 por defecto)
        $valida = $this->valida_base(key: $key, registro: $registro);
        if (errores::$error) {
            return $this->error->error(
                mensaje: 'Error al validar ' . $key,
                data: $valida
            );
        }

        // Verifica que el valor cumpla con el patrón 'cod_int_0_2_numbers'
        if (!$this->cod_int_0_2_numbers(txt: $registro[$key])) {
            return $this->error->error(
                mensaje: 'Error: el ' . $key . ' es inválido (no cumple el patrón de 2 dígitos)',
                data: $registro,
                es_final: true
            );
        }

        return true;
    }


    /**
     * REG
     * Valida que en el arreglo (u objeto `stdClass`) `$registro` exista la clave `$key`, no esté vacía (ni sea cero)
     * y que su valor cumpla con el patrón `cod_int_0_3_numbers` (generalmente 3 dígitos numéricos).
     *
     * Pasos principales:
     *  1. Si `$registro` es un objeto, se convierte a arreglo.
     *  2. Verifica que `$key` exista y no esté vacío dentro de `$registro` mediante {@see valida_base()}.
     *  3. Verifica que el valor asociado a `$key` cumpla el método {@see cod_int_0_3_numbers()}.
     *  4. Si alguna validación falla, se registra un error y se retorna un arreglo describiendo el problema.
     *  5. Si todo pasa, retorna `true`.
     *
     * @param string          $key      Clave que se validará en `$registro`.
     * @param array|\stdClass $registro Estructura que contiene la información a verificar. Si es un objeto,
     *                                  se convierte a arreglo.
     *
     * @return bool|array Devuelve `true` si la validación es satisfactoria; en caso contrario, devuelve
     *                    un arreglo con los detalles del error.
     *
     * @example
     *  Ejemplo 1: Validación exitosa
     *  ----------------------------------------------------------------------------
     *  $registro = ['codigo' => '123'];
     *  // Asumiendo que 'cod_int_0_3_numbers' corresponde a '/^[0-9]{3}$/'
     *  $resultado = $this->valida_cod_int_0_3_numbers('codigo', $registro);
     *  // Retornará true, puesto que 'codigo' existe y su valor es "123", válido con 3 dígitos numéricos.
     *
     * @example
     *  Ejemplo 2: Falta la clave en el arreglo
     *  ----------------------------------------------------------------------------
     *  $registro = [];
     *  $resultado = $this->valida_cod_int_0_3_numbers('codigo', $registro);
     *  // Retornará un arreglo de error indicando que 'codigo' no existe en el registro.
     *
     * @example
     *  Ejemplo 3: Valor no cumple el patrón
     *  ----------------------------------------------------------------------------
     *  $registro = ['codigo' => '12A'];
     *  // '12A' no cumple '/^[0-9]{3}$/'
     *  $resultado = $this->valida_cod_int_0_3_numbers('codigo', $registro);
     *  // Retorna un arreglo de error indicando que el valor de 'codigo' es inválido.
     *
     * @example
     *  Ejemplo 4: `$registro` como stdClass
     *  ----------------------------------------------------------------------------
     *  $obj = new stdClass();
     *  $obj->codigo = '999';
     *
     *  $resultado = $this->valida_cod_int_0_3_numbers('codigo', $obj);
     *  // Se convierte a array internamente y se valida. Retorna true si todo está correcto.
     */
    final public function valida_cod_int_0_3_numbers(string $key, array|\stdClass $registro): bool|array
    {
        // Convierte objeto en array si corresponde
        if (is_object($registro)) {
            $registro = (array) $registro;
        }

        // Valida que la clave exista y sea válida
        $valida = $this->valida_base(key: $key, registro: $registro);
        if (errores::$error) {
            return $this->error->error(
                mensaje: 'Error al validar ' . $key,
                data: $valida
            );
        }

        // Verifica que el valor cumpla con el patrón 'cod_int_0_3_numbers'
        if (!$this->cod_int_0_3_numbers(txt: $registro[$key])) {
            return $this->error->error(
                mensaje: 'Error el ' . $key . ' es invalido',
                data: $registro,
                es_final: true
            );
        }

        return true;
    }


    /**
     * REG
     * Valida que el valor de un campo en un registro cumpla con el patrón `cod_int_0_5_numbers`.
     *
     * Este método:
     * 1. Verifica la existencia y validez del campo `$key` dentro del registro proporcionado.
     * 2. Valida que el valor asociado al campo `$key` cumpla con el patrón `cod_int_0_5_numbers`.
     *    El patrón `cod_int_0_5_numbers` permite entre 0 y 5 números.
     *
     * @param string $key Nombre del campo a validar dentro del registro.
     * @param array|stdClass $registro Registro que contiene los datos a validar.
     *
     * @return bool|array
     *   - Retorna `true` si la validación es exitosa.
     *   - Retorna un arreglo de error si la validación falla. El arreglo incluye detalles del error.
     *
     * @example
     *  Ejemplo 1: Validación exitosa con un registro válido
     *  -----------------------------------------------------
     *  $key = 'codigo';
     *  $registro = ['codigo' => '12345'];
     *
     *  $resultado = $this->valida_cod_int_0_5_numbers($key, $registro);
     *  // $resultado será `true`.
     *
     * @example
     *  Ejemplo 2: Validación fallida por valor inválido
     *  -------------------------------------------------
     *  $key = 'codigo';
     *  $registro = ['codigo' => '123456']; // Más de 5 números
     *
     *  $resultado = $this->valida_cod_int_0_5_numbers($key, $registro);
     *  // $resultado será un arreglo de error:
     *  // [
     *  //   'error' => 1,
     *  //   'mensaje' => 'Error el codigo es invalido',
     *  //   'data' => ['codigo' => '123456'],
     *  //   ...
     *  // ]
     *
     * @example
     *  Ejemplo 3: Validación fallida por ausencia del campo en el registro
     *  -------------------------------------------------------------------
     *  $key = 'codigo';
     *  $registro = ['otro_campo' => '12345'];
     *
     *  $resultado = $this->valida_cod_int_0_5_numbers($key, $registro);
     *  // $resultado será un arreglo de error:
     *  // [
     *  //   'error' => 1,
     *  //   'mensaje' => 'Error al validar codigo',
     *  //   'data' => [...],
     *  //   ...
     *  // ]
     *
     * @example
     *  Ejemplo 4: Validación fallida por tipo de dato no soportado
     *  ------------------------------------------------------------
     *  $key = 'codigo';
     *  $registro = ['codigo' => null];
     *
     *  $resultado = $this->valida_cod_int_0_5_numbers($key, $registro);
     *  // $resultado será un arreglo de error:
     *  // [
     *  //   'error' => 1,
     *  //   'mensaje' => 'Error el codigo es invalido',
     *  //   'data' => ['codigo' => null],
     *  //   ...
     *  // ]
     *
     * @example
     *  Ejemplo 5: Validación con objeto stdClass
     *  ------------------------------------------
     *  $key = 'codigo';
     *  $registro = new stdClass();
     *  $registro->codigo = '123';
     *
     *  $resultado = $this->valida_cod_int_0_5_numbers($key, $registro);
     *  // $resultado será `true`.
     *
     * @throws array
     *   - Si el campo `$key` está vacío, no existe en el registro, o el valor no cumple con el patrón,
     *     retorna un arreglo de error detallando la falla.
     */
    final public function valida_cod_int_0_5_numbers(string $key, array|stdClass $registro): bool|array
    {
        $valida = $this->valida_base(key: $key, registro: $registro);
        if (errores::$error) {
            return $this->error->error(mensaje: 'Error al validar ' . $key, data: $valida);
        }

        if (!$this->cod_int_0_5_numbers(txt: $registro[$key])) {
            return $this->error->error(mensaje: 'Error el ' . $key . ' es invalido', data: $registro, es_final: true);
        }

        return true;
    }


    /**
     * REG
     * Valida que el valor asociado a una clave específica en un registro cumpla con el patrón para un código numérico de 6 dígitos.
     *
     * Este método realiza las siguientes operaciones:
     *
     * 1. **Validación de existencia y contenido básico del campo:**
     *    - Utiliza el método `valida_base()` para comprobar que la clave `$key` exista en el registro `$registro`
     *      y que su valor no esté vacío. Si la validación básica falla, se retorna un array con la descripción del error.
     *
     * 2. **Validación del formato del valor:**
     *    - Llama al método `cod_int_0_6_numbers()` pasando el valor correspondiente a la clave `$key` del registro.
     *    - Este método verifica que el valor cumpla con el patrón definido para códigos numéricos de 6 dígitos.
     *      Si el valor no cumple con el patrón, se retorna un array de error con la descripción del problema.
     *
     * Si ambas validaciones son exitosas, el método retorna `true`; de lo contrario, retorna un array con la información
     * detallada del error.
     *
     * ### Casos de Uso Exitosos:
     *
     * - **Ejemplo 1: Validación con un registro en formato array**
     *   ```php
     *   $registro = ['codigo' => '123456'];
     *   $resultado = $obj->valida_cod_int_0_6_numbers('codigo', $registro);
     *   // Resultado esperado: true, ya que "123456" cumple con el patrón de 6 dígitos.
     *   ```
     *
     * - **Ejemplo 2: Validación con un registro en formato stdClass**
     *   ```php
     *   $registro = new stdClass();
     *   $registro->codigo = '987654';
     *   $resultado = $obj->valida_cod_int_0_6_numbers('codigo', $registro);
     *   // Resultado esperado: true, ya que "987654" cumple con el patrón de 6 dígitos.
     *   ```
     *
     * ### Casos de Error:
     *
     * - **Ejemplo 3: El campo no existe o está vacío**
     *   ```php
     *   $registro = ['otro_campo' => '123456'];
     *   $resultado = $obj->valida_cod_int_0_6_numbers('codigo', $registro);
     *   // Resultado esperado: Array de error indicando que la clave 'codigo' no existe en el registro.
     *   ```
     *
     * - **Ejemplo 4: El valor no cumple con el patrón de 6 dígitos**
     *   ```php
     *   $registro = ['codigo' => '12345']; // Solo 5 dígitos
     *   $resultado = $obj->valida_cod_int_0_6_numbers('codigo', $registro);
     *   // Resultado esperado: Array de error indicando que el valor para 'codigo' es inválido.
     *   ```
     *
     * @param string $key       La clave del registro cuyo valor se va a validar. Se espera que este campo contenga un código de 6 dígitos.
     * @param array|stdClass $registro  El registro en el que se busca la clave. Puede ser un array asociativo o un objeto de tipo stdClass.
     *
     * @return bool|array Devuelve `true` si el valor asociado a `$key` cumple con el patrón para un código numérico de 6 dígitos;
     *                    en caso contrario, devuelve un array con los detalles del error generado.
     *
     * @see valida_base() Para la validación básica de la existencia y contenido del campo.
     * @see cod_int_0_6_numbers() Para la validación del formato del código de 6 dígitos.
     */
    final public function valida_cod_int_0_6_numbers(string $key, array|stdClass $registro): bool|array {

        $valida = $this->valida_base(key: $key, registro: $registro);
        if (errores::$error) {
            return $this->error->error(mensaje: 'Error al validar ' . $key, data: $valida);
        }

        if (!$this->cod_int_0_6_numbers(txt: $registro[$key])) {
            return $this->error->error(mensaje: 'Error el ' . $key . ' es invalido', data: $registro);
        }

        return true;
    }


    /**
     * POR DOCUMENTAR EN WIKI FINAL REV
     * Se integra validacion cd 0 to n number con prefijos 0
     * @param string $key Key a validar
     * @param int $longitud Longitud
     * @param array|stdClass $registro Registro
     * @return bool|array
     * @version 5.18.0
     */
    final public function valida_cod_int_0_n_numbers(string $key, int $longitud, array|stdClass $registro): bool|array{

        $valida = $this->valida_base(key: $key, registro: $registro);
        if(errores::$error){
            return $this->error->error(mensaje:'Error al validar '.$key ,data:$valida);
        }

        if(!$this->cod_int_0_n_numbers(longitud: $longitud, txt:$registro[$key])){
            return $this->error->error(mensaje:'Error el '.$key.' es invalido',data:$registro, es_final: true);
        }

        return true;
    }

    /**
     * Valida que los codigos de un conjunto de campos de un arreglo sean validos conforme a 3 letras mayusculas
     * @param array $keys Keys de campos a validar
     * @param array|object $registro Registro a validar
     * @return array
     */
    final public function valida_codigos_3_letras_mayusc(array $keys, array|object $registro):array{
        if(count($keys) === 0){
            return $this->error->error(mensaje: "Error keys vacios",data: $keys);
        }

        if(is_object($registro)){
            $registro = (array)$registro;
        }

        foreach($keys as $key){
            if($key === ''){
                return $this->error->error(mensaje:'Error '.$key.' Invalido',data:$registro);
            }
            if(!isset($registro[$key])){
                return  $this->error->error(mensaje:'Error no existe '.$key,data:$registro);
            }
            $id_valido = $this->valida_cod_3_letras_mayusc(key: $key, registro: $registro);
            if(errores::$error){
                return  $this->error->error(mensaje:'Error '.$key.' Invalido',data:$id_valido);
            }
        }
        return array('mensaje'=>'ids validos',$registro,$keys);
    }

    final public function valida_codigos_int_0_numbers(array $keys, array|object $registro):array{
        if(count($keys) === 0){
            return $this->error->error(mensaje: "Error keys vacios",data: $keys);
        }

        if(is_object($registro)){
            $registro = (array)$registro;
        }

        foreach($keys as $key){
            if($key === ''){
                return $this->error->error(mensaje:'Error '.$key.' Invalido',data:$registro);
            }
            if(!isset($registro[$key])){
                return  $this->error->error(mensaje:'Error no existe '.$key,data:$registro);
            }
            $id_valido = $this->valida_cod_int_0_numbers(key: $key, registro: $registro);
            if(errores::$error){
                return  $this->error->error(mensaje:'Error '.$key.' Invalido',data:$id_valido);
            }
        }
        return array('mensaje'=>'ids validos',$registro,$keys);
    }

    /**
     * REG
     * Valida que cada clave en `$keys` exista en `$registro` y cumpla con el patrón `cod_int_0_2_numbers`,
     * el cual suele requerir exactamente 2 dígitos (`0-9`).
     *
     * - Si `$keys` está vacío, se registra un error, pues no hay claves para validar.
     * - Si `$registro` es un objeto, se convierte internamente a array.
     * - Se recorre cada clave de `$keys` verificando que no sea una cadena vacía, que exista en el registro
     *   y que el valor asociado cumpla con el método `valida_cod_int_0_2_numbers()`.
     * - Si cualquier validación falla, se registra el error y se retorna un arreglo con la información detallada.
     * - Si todas las validaciones pasan, se retorna un arreglo con el mensaje `"ids validos"` y
     *   el contenido de `$registro` y `$keys`.
     *
     * @param array         $keys     Conjunto de claves que se deben validar dentro de `$registro`.
     * @param array|object  $registro Estructura de datos (array u objeto) que contiene los valores a validar.
     *
     * @return array Retorna:
     *  - `[ 'mensaje' => 'ids validos', $registro, $keys ]` si todas las validaciones son exitosas.
     *  - Un arreglo de error devuelto por `$this->error->error()` si ocurre alguna falla.
     *
     * @example
     *  Ejemplo 1: Validación exitosa con un array
     *  ----------------------------------------------------------------------------
     *  $keys = ['codigo1', 'codigo2'];
     *  $registro = [
     *      'codigo1' => '01',
     *      'codigo2' => '99'
     *  ];
     *
     *  $resultado = $this->valida_codigos_int_0_2_numbers($keys, $registro);
     *  // $resultado será:
     *  // [
     *  //   'mensaje' => 'ids validos',
     *  //   [ 'codigo1' => '01', 'codigo2' => '99' ],
     *  //   ['codigo1', 'codigo2']
     *  // ]
     *
     * @example
     *  Ejemplo 2: `$registro` es un objeto
     *  ----------------------------------------------------------------------------
     *  $obj = new stdClass();
     *  $obj->codigo1 = '12';
     *  $obj->codigo2 = '34';
     *
     *  $resultado = $this->valida_codigos_int_0_2_numbers(['codigo1', 'codigo2'], $obj);
     *  // El objeto se convierte a array internamente antes de validar.
     *  // Retornará el mismo arreglo exitoso si cumple el patrón de 2 dígitos.
     *
     * @example
     *  Ejemplo 3: Claves vacías o faltantes
     *  ----------------------------------------------------------------------------
     *  $keys = ['codigo'];
     *  $registro = [];
     *
     *  // Falta 'codigo' en $registro. Se generará un error:
     *  $resultado = $this->valida_codigos_int_0_2_numbers($keys, $registro);
     *  // Se retornará un arreglo con la información del error.
     *
     * @example
     *  Ejemplo 4: Valor no cumple patrón de 2 dígitos
     *  ----------------------------------------------------------------------------
     *  $keys = ['codigo'];
     *  $registro = ['codigo' => '123']; // 3 dígitos
     *
     *  $resultado = $this->valida_codigos_int_0_2_numbers($keys, $registro);
     *  // Se retornará un arreglo con la información del error, indicando que 'codigo' es inválido.
     */
    final public function valida_codigos_int_0_2_numbers(array $keys, array|object $registro): array
    {
        // Verifica que $keys no esté vacío
        if (count($keys) === 0) {
            return $this->error->error(
                mensaje: "Error: 'keys' está vacío",
                data: $keys
            );
        }

        // Convierte objeto a array si es necesario
        if (is_object($registro)) {
            $registro = (array)$registro;
        }

        // Valida cada clave
        foreach ($keys as $key) {
            // La clave no debe ser una cadena vacía
            if ($key === '') {
                return $this->error->error(
                    mensaje: 'Error: la clave está vacía',
                    data: $registro
                );
            }

            // Verifica existencia de la clave en $registro
            if (!isset($registro[$key])) {
                return $this->error->error(
                    mensaje: 'Error: no existe ' . $key,
                    data: $registro
                );
            }

            // Valida que el valor cumpla el patrón de 2 dígitos
            $id_valido = $this->valida_cod_int_0_2_numbers(key: $key, registro: $registro);
            if (errores::$error) {
                return $this->error->error(
                    mensaje: 'Error: ' . $key . ' es inválido',
                    data: $id_valido
                );
            }
        }

        // Todas las validaciones pasaron correctamente
        return [
            'mensaje' => 'ids validos',
            $registro,
            $keys
        ];
    }


    final public function valida_codigos_int_0_3_numbers(array $keys, array|object $registro):array{
        if(count($keys) === 0){
            return $this->error->error(mensaje: "Error keys vacios",data: $keys);
        }

        if(is_object($registro)){
            $registro = (array)$registro;
        }

        foreach($keys as $key){
            if($key === ''){
                return $this->error->error(mensaje:'Error '.$key.' Invalido',data:$registro);
            }
            if(!isset($registro[$key])){
                return  $this->error->error(mensaje:'Error no existe '.$key,data:$registro);
            }
            $id_valido = $this->valida_cod_int_0_3_numbers(key: $key, registro: $registro);
            if(errores::$error){
                return  $this->error->error(mensaje:'Error '.$key.' Invalido',data:$id_valido);
            }
        }
        return array('mensaje'=>'ids validos',$registro,$keys);
    }

    final public function valida_codigos_int_0_5_numbers(array $keys, array|object $registro):array{
        if(count($keys) === 0){
            return $this->error->error(mensaje: "Error keys vacios",data: $keys);
        }

        if(is_object($registro)){
            $registro = (array)$registro;
        }

        foreach($keys as $key){
            if($key === ''){
                return $this->error->error(mensaje:'Error '.$key.' Invalido',data:$registro);
            }
            if(!isset($registro[$key])){
                return  $this->error->error(mensaje:'Error no existe '.$key,data:$registro);
            }
            $id_valido = $this->valida_cod_int_0_5_numbers(key: $key, registro: $registro);
            if(errores::$error){
                return  $this->error->error(mensaje:'Error '.$key.' Invalido',data:$id_valido);
            }
        }
        return array('mensaje'=>'ids validos',$registro,$keys);
    }

    /**
     * REG
     * Valida que los códigos asociados a un conjunto de claves cumplan con el formato de 6 dígitos.
     *
     * Esta función se encarga de verificar que, para cada clave especificada en el arreglo `$keys`, el registro
     * `$registro` (que puede ser un arreglo asociativo o un objeto de tipo `stdClass`) contenga un valor asociado
     * y que dicho valor cumpla con el patrón definido para códigos numéricos de 6 dígitos (por ejemplo, "000123").
     *
     * El proceso de validación se realiza de la siguiente manera:
     *
     * 1. **Validación de claves vacías:**
     *    Se verifica que el arreglo `$keys` no esté vacío. Si lo está, se retorna un error indicando que no se
     *    han proporcionado claves válidas para la validación.
     *
     * 2. **Conversión de objeto a array:**
     *    Si `$registro` es un objeto (`stdClass`), se convierte a un arreglo asociativo para facilitar la validación.
     *
     * 3. **Validación individual por clave:**
     *    Para cada clave en el arreglo `$keys` se ejecutan las siguientes comprobaciones:
     *    - Se verifica que la clave no sea una cadena vacía.
     *      Si alguna clave es una cadena vacía, se retorna un error indicando que dicha clave es inválida.
     *    - Se comprueba que la clave exista en el registro `$registro`.
     *      Si la clave no se encuentra, se retorna un error indicando que dicha clave no existe en el registro.
     *    - Se invoca el método `valida_cod_int_0_6_numbers(string $key, array|stdClass $registro)` para validar
     *      que el valor asociado a la clave cumpla con el formato de 6 dígitos.
     *      Si la validación falla (por ejemplo, el valor contiene caracteres no numéricos o no tiene la longitud
     *      esperada), se retorna el error generado por dicha función.
     *
     * Si todas las validaciones son exitosas, la función retorna un arreglo con el siguiente formato:
     *
     * ```php
     * [
     *     'mensaje' => 'ids validos',
     *     0 => $registro, // El registro validado (convertido a array si originalmente era un objeto)
     *     1 => $keys      // El arreglo de claves utilizado en la validación
     * ]
     * ```
     *
     * ### Ejemplos de Uso Exitoso
     *
     * **Ejemplo 1: Registro con claves válidas en un array asociativo**
     *
     * ```php
     * // Se define el arreglo de claves que se deben validar
     * $keys = ['codigo1', 'codigo2'];
     *
     * // Se crea un registro asociativo donde cada clave tiene un valor de 6 dígitos
     * $registro = [
     *     'codigo1' => '000123',  // Válido: 6 dígitos
     *     'codigo2' => '045678'   // Válido: 6 dígitos
     * ];
     *
     * // Se invoca la función de validación
     * $resultado = $validacion->valida_codigos_int_0_6_numbers($keys, $registro);
     *
     * // Resultado esperado:
     * // [
     * //     'mensaje' => 'ids validos',
     * //     0 => [
     * //         'codigo1' => '000123',
     * //         'codigo2' => '045678'
     * //     ],
     * //     1 => ['codigo1', 'codigo2']
     * // ]
     * // En este caso, la función retorna un arreglo indicando que los IDs son válidos.
     * ```
     *
     * **Ejemplo 2: Uso con un objeto stdClass como registro**
     *
     * ```php
     * // Se define el arreglo de claves
     * $keys = ['codigo'];
     *
     * // Se crea un objeto stdClass con la propiedad 'codigo'
     * $registro = new stdClass();
     * $registro->codigo = '123456';  // Válido: 6 dígitos
     *
     * // Se llama a la función de validación
     * $resultado = $validacion->valida_codigos_int_0_6_numbers($keys, $registro);
     *
     * // Resultado esperado:
     * // [
     * //     'mensaje' => 'ids validos',
     * //     0 => [
     * //         'codigo' => '123456'
     * //     ],
     * //     1 => ['codigo']
     * // ]
     * // La función convierte el objeto a array internamente y valida el código.
     * ```
     *
     * ### Consideraciones Adicionales
     *
     * - La función depende internamente de la existencia y correcta implementación del método
     *   `valida_cod_int_0_6_numbers(string $key, array|stdClass $registro)`, que realiza la validación
     *   específica del formato (por ejemplo, mediante una expresión regular).
     *
     * - Si alguna de las comprobaciones falla (por ejemplo, si alguna clave es inválida o si el valor no cumple
     *   el formato esperado), se activa la bandera de error en `errores::$error` y la función retorna un arreglo
     *   con la información del error.
     *
     * @param array $keys Arreglo de claves que se deben validar en el registro.
     * @param array|stdClass $registro Registro de datos en el que se buscan las claves. Puede ser un arreglo asociativo o un objeto stdClass.
     * @return array Retorna un arreglo con el mensaje de éxito y los datos validados si todas las claves y sus valores cumplen con el patrón de 6 dígitos; en caso de error, retorna un arreglo con la información detallada del error.
     *
     * @example Uso exitoso:
     * ```php
     * $keys = ['codigo'];
     * $registro = ['codigo' => '000123'];
     * $resultado = $validacion->valida_codigos_int_0_6_numbers($keys, $registro);
     * // Resultado:
     * // [
     * //     'mensaje' => 'ids validos',
     * //     0 => ['codigo' => '000123'],
     * //     1 => ['codigo']
     * // ]
     * ```
     */
    final public function valida_codigos_int_0_6_numbers(array $keys, array|stdClass $registro): array {
        if(count($keys) === 0){
            return $this->error->error(mensaje: "Error keys vacios", data: $keys, es_final: true);
        }

        if(is_object($registro)){
            $registro = (array)$registro;
        }

        foreach($keys as $key){
            if($key === ''){
                return $this->error->error(mensaje:'Error '.$key.' Invalido', data: $registro, es_final: true);
            }
            if(!isset($registro[$key])){
                return $this->error->error(mensaje:'Error no existe '.$key, data: $registro, es_final: true);
            }
            $id_valido = $this->valida_cod_int_0_6_numbers(key: $key, registro: $registro);
            if(errores::$error){
                return $this->error->error(mensaje:'Error '.$key.' Invalido', data: $id_valido);
            }
        }
        return array('mensaje'=>'ids validos', $registro, $keys);
    }


    final public function valida_codigos_int_0_n_numbers(array $keys, int $longitud, array|object $registro):array{
        if(count($keys) === 0){
            return $this->error->error(mensaje: "Error keys vacios",data: $keys, es_final: true);
        }

        if(is_object($registro)){
            $registro = (array)$registro;
        }

        foreach($keys as $key){
            if($key === ''){
                return $this->error->error(mensaje:'Error '.$key.' Invalido',data:$registro, es_final: true);
            }
            if(!isset($registro[$key])){
                return  $this->error->error(mensaje:'Error no existe '.$key,data:$registro, es_final: true);
            }
            $id_valido = $this->valida_cod_int_0_n_numbers(key: $key, longitud: $longitud, registro: $registro);
            if(errores::$error){
                return  $this->error->error(mensaje:'Error '.$key.' Invalido',data:$id_valido);
            }
        }
        return array('mensaje'=>'ids validos',$registro,$keys);
    }

    /**
     * Valida que las columnas de css sean correctas
     * @param string $cols n columnas css
     * @return bool|array
     */
    final public function valida_cols_css(string $cols): bool|array{

        if($cols <= 0){
            return $this->error->error(mensaje: 'Error cols debe ser mayor a 0', data: $cols);
        }
        if($cols > 12){
            return $this->error->error(mensaje: 'Error cols debe ser menor a 13', data: $cols);
        }

        return true;
    }

    /**
     * Valida si un correo es valido
     * @param string $correo txt con correo a validar
     * @return bool|array bool true si es un correo valido, array si error
     */
    final public function valida_correo(string $correo): bool|array
    {
        $valida = $this->correo(correo: $correo);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error el correo es invalido',data:  $valida);
        }
        if(!$valida){
            return $this->error->error(mensaje: 'Error el correo es invalido',data:  $correo);
        }
        return true;
    }

    final public function valida_solo_texto(string $texto): bool|array
    {
        $valida = $this->texto(texto: $texto);
        if(errores::$error){
            return $this->error->error(mensaje: "Error el valor ingresado $texto es invalido",data:  $valida);
        }
        if(!$valida){
            return $this->error->error(mensaje: "Error el valor ingresado $texto es invalido",data:  $texto);
        }
        return true;
    }

    /**
     * Verifica un conjunto de correos integrados en un registro por key
     * @param array $registro registro de donde se obtendran los correos a validar
     * @param array $keys keys que se buscaran en el registro para aplicar validacion de correos
     * @return bool|array
     */
    final public function valida_correos( array $keys, array $registro): bool|array
    {
        if(count($keys) === 0){
            return $this->error->error(mensaje: "Error keys vacios",data: $keys);
        }
        foreach($keys as $key){
            if($key === ''){
                return $this->error->error(mensaje: 'Error '.$key.' Invalido',data: $registro);
            }
            if(!isset($registro[$key])){
                return  $this->error->error(mensaje: 'Error no existe '.$key,data: $registro);
            }
            if(trim($registro[$key]) === ''){
                return  $this->error->error(mensaje: 'Error '.$key.' vacio',data: $registro);
            }
            $value = (string)$registro[$key];
            $correo_valido = $this->valida_correo(correo: $value);
            if(errores::$error){
                return  $this->error->error(mensaje: 'Error '.$key.' Invalido',data: $correo_valido);
            }
        }
        return true;
    }

    /**
     * REG
     * Valida la estructura de un nombre de modelo para garantizar que cumpla con los requisitos establecidos.
     *
     * Este método:
     * 1. Limpia el nombre del modelo eliminando espacios en blanco al inicio y al final.
     * 2. Elimina el prefijo `models\` si está presente en el nombre del modelo.
     * 3. Verifica que el nombre del modelo no sea vacío después de la limpieza.
     * 4. Asegura que el nombre del modelo no sea un valor numérico.
     *
     * Si alguna de estas condiciones falla, retorna un array con los detalles del error.
     *
     * @param string $name_modelo Nombre del modelo a validar.
     *
     * @return array|bool
     *   - `true` si el nombre del modelo cumple con las validaciones.
     *   - Un array de error si alguna validación falla, incluyendo detalles del problema.
     *
     * @example
     *  Ejemplo 1: Nombre de modelo válido
     *  -----------------------------------
     *  $name_modelo = 'models\\Usuario';
     *
     *  $resultado = $this->valida_data_modelo($name_modelo);
     *  // $resultado será:
     *  // true
     *
     * @example
     *  Ejemplo 2: Nombre vacío después de la limpieza
     *  ----------------------------------------------
     *  $name_modelo = '   ';
     *
     *  $resultado = $this->valida_data_modelo($name_modelo);
     *  // $resultado será:
     *  // [
     *  //   'error' => 1,
     *  //   'mensaje' => 'Error modelo vacio',
     *  //   'data' => '',
     *  //   'es_final' => true,
     *  // ]
     *
     * @example
     *  Ejemplo 3: Nombre numérico no válido
     *  -------------------------------------
     *  $name_modelo = '1234';
     *
     *  $resultado = $this->valida_data_modelo($name_modelo);
     *  // $resultado será:
     *  // [
     *  //   'error' => 1,
     *  //   'mensaje' => 'Error modelo',
     *  //   'data' => '1234',
     *  //   'es_final' => true,
     *  // ]
     *
     * @example
     *  Ejemplo 4: Nombre con prefijo innecesario
     *  -----------------------------------------
     *  $name_modelo = 'models\\Producto';
     *
     *  $resultado = $this->valida_data_modelo($name_modelo);
     *  // $resultado será:
     *  // true
     *  // El prefijo `models\` será eliminado antes de la validación.
     */
    final public function valida_data_modelo(string $name_modelo): array|bool
    {
        $name_modelo = trim($name_modelo);
        $name_modelo = str_replace('models\\', '', $name_modelo);
        if (trim($name_modelo) === '') {
            return $this->error->error(
                mensaje: "Error modelo vacio",
                data: $name_modelo,
                es_final: true
            );
        }
        if (is_numeric($name_modelo)) {
            return $this->error->error(
                mensaje: "Error modelo",
                data: $name_modelo,
                es_final: true
            );
        }

        return true;
    }


    /**
     * Valida un numero sea double mayor a 0
     * @param string $value valor a validar
     * @return array|bool con exito y valor
     * @example
     *      $valida = $this->valida_double_mayor_0($registro[$key]);
     * @internal  $this->valida_pattern('double',$value)
     * @version 0.17.1
     */
    final public function valida_double_mayor_0(mixed $value):array|bool{
        if($value === ''){
            return $this->error->error(mensaje: 'Error esta vacio '.$value,data: $value);
        }
        if((float)$value <= 0.0){
            return $this->error->error(mensaje: 'Error el '.$value.' debe ser mayor a 0',data: $value);
        }
        if(is_numeric($value)){
            return true;
        }

        if(! $this->valida_pattern(key: 'double',txt: $value)){
            return $this->error->error(mensaje: 'Error valor vacio['.$value.']',data: $value);
        }

        return  true;
    }

    /**
     *
     * Valida que un numero sea mayor o igual a 0 y cumpla con forma de un numero
     * @param string $value valor a validar
     * @return array|bool con exito y valor
     * @example
     *        $valida = $this->validaciones->valida_double_mayor_igual_0($movimiento['valor_unitario']);
     * @uses producto
     * @internal  $this->valida_pattern('double',$value)
     * @version 0.18.1
     */
    final public function valida_double_mayor_igual_0(mixed $value): array|bool
    {

        if($value === ''){
            return $this->error->error(mensaje: 'Error value vacio '.$value,data: $value);
        }
        if((float)$value < 0.0){
            return $this->error->error(mensaje: 'Error el '.$value.' debe ser mayor a 0',data: $value);
        }
        if(!is_numeric($value)){
            return $this->error->error(mensaje: 'Error el '.$value.' debe ser un numero',data: $value);
        }

        if(! $this->valida_pattern(key: 'double',txt: $value)){
            return $this->error->error(mensaje: 'Error valor vacio['.$value.']',data: $value);
        }

        return true;
    }

    /**
     *
     * Valida que un conjunto de  numeros sea mayor a 0 y no este vacio
     * @param array $keys keys de registros a validar
     * @param array|stdClass $registro valores a validar
     * @return array|bool con exito y registro
     * @example
     *       $valida = $this->validacion->valida_double_mayores_0($_POST, $keys);
     * @internal  $this->valida_existencia_keys($registro,$keys);
     * @internal  $this->valida_double_mayor_0($registro[$key]);
     * @version 1.17.1
     */
    final public function valida_double_mayores_0(array $keys, array|stdClass $registro):array|bool{
        if(is_object($registro)){
            $registro = (array)$registro;
        }
        $valida = $this->valida_existencia_keys(keys: $keys, registro: $registro,);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al validar $registro no existe un key ',data: $valida);
        }

        foreach($keys as $key){
            $valida = $this->valida_double_mayor_0(value:$registro[$key]);
            if(errores::$error){
                return$this->error->error(mensaje: 'Error $registro['.$key.']',data: $valida);
            }
        }
        return true;
    }

    /**
     * Valida elementos mayores igual a 0
     * @param array $keys Keys a validar del registro
     * @param array|stdClass $registro Registro a validar informacion
     * @return array|bool
     * @version 0.18.1
     */
    final public function valida_double_mayores_igual_0(array $keys, array|stdClass $registro):array|bool{
        if(is_object($registro)){
            $registro = (array)$registro;
        }
        $valida = $this->valida_existencia_keys(keys: $keys, registro: $registro);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al validar $registro no existe un key ',data: $valida);
        }

        foreach($keys as $key){
            $valida = $this->valida_double_mayor_igual_0(value:$registro[$key]);
            if(errores::$error){
                return$this->error->error(mensaje: 'Error $registro['.$key.']',data: $valida);
            }
        }
        return true;
    }

    /**
     * REG
     * Valida si el valor proporcionado es un estilo CSS válido.
     *
     * Esta función toma un estilo CSS (en forma de texto) y verifica que sea una cadena no vacía,
     * que no sea numérica y que esté presente en un conjunto predefinido de estilos CSS válidos.
     * Si el valor no cumple con estos requisitos, se devuelve un error. Si todo es válido, se devuelve `true`.
     *
     * @param mixed $style El valor que se va a validar como estilo CSS.
     *
     * El parámetro `$style` debe ser una cadena de texto que represente un estilo CSS. El valor será validado de las siguientes maneras:
     * - Debe ser un string.
     * - No puede estar vacío.
     * - No puede ser un número.
     * - Debe pertenecer a un conjunto de estilos predefinidos disponibles en la propiedad `$this->styles_css`.
     *
     * @return array|bool Devuelve `true` si el estilo es válido, o un array con el mensaje de error si no lo es.
     *
     * @throws errores Si el estilo no cumple con los requisitos de validación, se genera un error.
     *
     * @example Ejemplo de uso:
     * ```php
     * $validacion = new validacion();
     * $resultado = $validacion->valida_estilo_css('info');
     * if ($resultado === true) {
     *     echo "El estilo es válido.";
     * } else {
     *     echo "Error: " . $resultado['mensaje'];  // Se mostrará el mensaje de error si no es válido
     * }
     * ```
     *
     * En este ejemplo, si 'info' es un estilo válido según `$this->styles_css`, se imprimirá "El estilo es válido."
     * Si no es válido, se imprimirá el mensaje de error correspondiente.
     *
     * @version 1.0.0
     */
    final public function valida_estilo_css(mixed $style): array|bool {
        // Verifica si $style es un string
        if (!is_string($style)) {
            return $this->error->error(mensaje: 'Error style debe ser un texto ', data: $style);
        }

        // Elimina espacios en blanco al inicio y al final de la cadena
        $style = trim($style);

        // Verifica si la cadena está vacía
        if ($style === '') {
            return $this->error->error(mensaje: 'Error style esta vacio ', data: $style);
        }

        // Verifica si el valor es numérico
        if (is_numeric($style)) {
            return $this->error->error(mensaje: 'Error style debe ser un texto ', data: $style);
        }

        // Verifica si el estilo está en la lista de estilos válidos
        if (!in_array($style, $this->styles_css)) {
            return $this->error->error(mensaje: 'Error style invalido '.$style, data: $this->styles_css);
        }

        // Si todas las validaciones son exitosas, devuelve true
        return true;
    }


    /**
     * REG
     * Valida los estilos CSS en un conjunto de claves dentro de un registro.
     *
     * Esta función toma un conjunto de claves y un registro (ya sea un array o un objeto),
     * y valida que cada estilo correspondiente en esas claves sea válido. La función se
     * asegura de que cada clave esté presente en el registro y de que el valor de cada estilo
     * sea uno de los estilos permitidos.
     *
     * Si alguna clave no existe o algún estilo es inválido, se devuelve un mensaje de error.
     * Si todos los estilos son válidos, la función retorna `true`.
     *
     * @param array $keys Un array con las claves de los estilos que se van a validar.
     *                    Las claves deben corresponder a los nombres de los campos en el registro.
     *                    Ejemplo: `['color', 'background', 'border']`
     * @param array|stdClass $row El registro que contiene los estilos a validar. Puede ser un array
     *                            o un objeto que contenga los valores correspondientes a las claves.
     *                            Ejemplo:
     *                            ```php
     *                            $row = ['color' => 'red', 'background' => 'blue', 'border' => 'solid'];
     *                            ```
     *
     * @return bool|array Retorna `true` si todos los estilos son válidos. Si ocurre un error,
     *                    devuelve un array con el mensaje de error.
     *
     * @throws array Si algún estilo es inválido o alguna clave no existe en el registro,
     *                   la función devolverá un mensaje de error con detalles de la falla.
     *
     * @example
     * ```php
     * $validacion = new validacion();
     * $keys = ['color', 'background'];
     * $row = ['color' => 'info', 'background' => 'warning'];
     * $resultado = $validacion->valida_estilos_css($keys, $row);
     * // $resultado será true, ya que ambos estilos son válidos.
     * ```
     *
     * @example
     * ```php
     * $keys = ['color', 'background'];
     * $row = ['color' => 'info', 'background' => 'invalid_style']; // Estilo no válido
     * $resultado = $validacion->valida_estilos_css($keys, $row);
     * // $resultado será un array con el mensaje de error.
     * // Ejemplo: ['mensaje' => '<b><span style="color:red">Error al validar registro[background]</span></b>']
     * ```
     *
     * @version 1.0.0
     */
    final public function valida_estilos_css(array $keys, array|stdClass $row): bool|array
    {
        // Convertir a array si el registro es un objeto
        if(is_object($row)){
            $row = (array)$row;
        }

        // Validar que las claves existan en el registro
        $valida_existe = $this->valida_existencia_keys(keys: $keys, registro: $row);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al validar registro', data: $valida_existe);
        }

        // Iterar sobre cada clave y validar el estilo correspondiente
        foreach ($keys as $key){
            $valida = $this->valida_estilo_css(style: $row[$key]);
            if(errores::$error){
                return $this->error->error(mensaje: 'Error al validar registro['.$key.']', data: $valida);
            }
        }

        // Si todo es válido, retornar true
        return true;
    }


    /**
     *
     * Funcion para validar la estructura de los parametros de un input basico
     * @version 0.10.1
     * @param array $columnas Columnas a mostrar en select
     *
     * @param string $tabla Tabla - estructura modelo sistema
     * @return array|bool con las columnas y las tablas enviadas
     * @example
     *      $valida = $this->validacion->valida_estructura_input_base($columnas,$tabla);
     *
     */
    final public function valida_estructura_input_base(array $columnas, string $tabla):array|bool{
        $namespace = 'models\\';
        $tabla = str_replace($namespace,'',$tabla);

        if(count($columnas) === 0){
            return $this->error->error(mensaje: 'Error deben existir columnas',data: $columnas);
        }
        if($tabla === ''){
            return $this->error->error(mensaje: 'Error la tabla no puede venir vacia',data: $tabla);
        }

        return true;
    }

    /**
     * Funcion que valida los campos necesarios para la aplicacion de menu
     * @param int $menu_id Menu id a validar
     * @return array|bool
     * @version 2.70.0
     */
    final public function valida_estructura_menu(int $menu_id):array|bool{
        if(!isset($_SESSION['grupo_id'])){
            return $this->error->error(mensaje: 'Error debe existir grupo_id en SESSION',data: $menu_id);
        }
        if((int)$_SESSION['grupo_id']<=0){
            return $this->error->error(mensaje: 'Error grupo_id debe ser mayor a 0',data: $_SESSION);
        }
        if($menu_id<=0){
            return $this->error->error(mensaje: 'Error $menu_id debe ser mayor a 0',data: "menu_id: ".$menu_id);
        }
        return true;
    }

    /**
     *
     * Valida la estructura
     * @param string $seccion
     * @param string $accion
     * @return array|bool conjunto de resultados
     * @example
     *        $valida = $this->valida_estructura_seccion_accion($seccion,$accion);
     * @uses directivas
     */
    final public function valida_estructura_seccion_accion(string $accion, string $seccion):array|bool{
        $seccion = str_replace('models\\','',$seccion);
        $class_model = 'models\\'.$seccion;
        if($seccion === ''){
            return   $this->error->error(mensaje: '$seccion no puede venir vacia', data: $seccion);
        }
        if($accion === ''){
            return   $this->error->error(mensaje: '$accion no puede venir vacia',data:  $accion);
        }
        if(!class_exists($class_model)){
            return   $this->error->error(mensaje: 'no existe la clase '.$seccion,data:  $seccion);
        }
        return true;
    }

    /**
     * REG
     * Verifica que un conjunto de claves (`$keys`) exista en la estructura `$registro` (que puede ser un arreglo u objeto)
     * y, opcionalmente, que sus valores no estén vacíos.
     *
     * - Si `$registro` es un objeto, primero se convierte a arreglo.
     * - Para cada clave en `$keys`:
     *   1. Verifica que la clave no sea una cadena vacía.
     *   2. Comprueba si dicha clave existe en `$registro`.
     *   3. Si `$valida_vacio` es `true`, asegura que el valor correspondiente no sea una cadena vacía.
     * - Si alguna verificación falla, se registra un error con `$this->error->error()` y se retorna un arreglo describiendo dicho error.
     * - Si todas las validaciones pasan, se retorna `true`.
     *
     * @param array $keys        Lista de claves a verificar en `$registro`.
     * @param mixed $registro    Estructura donde se deben verificar las claves (puede ser array u objeto).
     * @param bool  $valida_vacio Indica si se debe validar que los valores no estén vacíos (por defecto `true`).
     *
     * @return array|true Devuelve:
     *  - `true` si todas las claves existen y (opcionalmente) sus valores no están vacíos.
     *  - Un arreglo con información del error (devuelto por `$this->error->error()`) si alguna validación falla.
     *
     * @example
     *  Ejemplo 1: Validar que existan y no estén vacíos
     *  ----------------------------------------------------------------------------
     *  $keys = ['nombre', 'email'];
     *  $registro = [
     *      'nombre' => 'Juan',
     *      'email'  => 'juan@example.com'
     *  ];
     *
     *  $resultado = $this->valida_existencia_keys($keys, $registro);
     *  // Retorna true, ya que ambos índices existen y no están vacíos.
     *
     * @example
     *  Ejemplo 2: Validar existencia sin importar si está vacío
     *  ----------------------------------------------------------------------------
     *  $keys = ['nombre', 'email'];
     *  $registro = [
     *      'nombre' => 'Juan',
     *      'email'  => ''
     *  ];
     *
     *  // $valida_vacio = false => no se valida que el valor esté vacío
     *  $resultado = $this->valida_existencia_keys($keys, $registro, false);
     *  // Retorna true, pues email existe aunque esté vacío.
     *
     * @example
     *  Ejemplo 3: Falta una clave
     *  ----------------------------------------------------------------------------
     *  $keys = ['nombre', 'email'];
     *  $registro = [
     *      'nombre' => 'Juan'
     *  ];
     *
     *  // Retorna un arreglo de error indicando que "email" no existe en el registro.
     *  $resultado = $this->valida_existencia_keys($keys, $registro);
     *
     * @example
     *  Ejemplo 4: La clave está vacía en el array de claves
     *  ----------------------------------------------------------------------------
     *  $keys = ['nombre', ''];
     *  $registro = [
     *      'nombre' => 'Juan',
     *      'email'  => 'juan@example.com'
     *  ];
     *
     *  // Se retornará un arreglo de error indicando "Error  no puede venir vacio".
     */
    final public function valida_existencia_keys(array $keys, mixed $registro, bool $valida_vacio = true): array|true
    {
        // Convertir objeto a arreglo si corresponde
        if (is_object($registro)) {
            $registro = (array)$registro;
        }

        // Recorrer las claves para validarlas
        foreach ($keys as $key) {
            if ($key === '') {
                return $this->error->error(
                    mensaje: 'Error ' . $key . ' no puede venir vacio',
                    data: $keys,
                    es_final: true
                );
            }

            if (!isset($registro[$key])) {
                return $this->error->error(
                    mensaje: 'Error ' . $key . ' no existe en el registro',
                    data: $registro,
                    es_final: true
                );
            }

            // Validar que el valor no esté vacío si se requiere
            if ($registro[$key] === '' && $valida_vacio) {
                return $this->error->error(
                    mensaje: 'Error ' . $key . ' esta vacio en el registro',
                    data: $registro,
                    es_final: true
                );
            }
        }

        return true;
    }


    /**
     * Valida que un doc tenga extension
     * @param string $path ruta del documento de dropbox
     * @return bool|array
     * @version 2.69.0
     */
    final public function valida_extension_doc(string $path): bool|array
    {
        $path = trim($path);
        if($path === ''){
            return $this->error->error(mensaje: 'Error el $path esta vacio',data:  $path);
        }
        $extension_origen = pathinfo($path, PATHINFO_EXTENSION);
        if(!$extension_origen){
            return $this->error->error(mensaje: 'Error el $path no tiene extension',data:  $path);
        }
        return true;
    }

    /**
     * REG
     * Valida que una fecha proporcionada cumpla con el formato esperado.
     *
     * Este método se encarga de verificar que el valor de entrada `$fecha` sea una cadena de texto no vacía
     * y que cumpla con el patrón definido para el tipo de fecha especificado en `$tipo_val`.
     *
     * La validación se realiza en varios pasos:
     *
     * 1. **Tipo de dato de la fecha:**
     *    Se comprueba que `$fecha` sea una cadena. Si no lo es, se retorna un error indicando que la fecha debe ser un texto.
     *
     * 2. **Contenido de la fecha:**
     *    Se elimina cualquier espacio en blanco adicional mediante `trim()`. Si el resultado es una cadena vacía, se retorna un error.
     *
     * 3. **Tipo de validación (`$tipo_val`):**
     *    - Se limpia el valor de `$tipo_val` con `trim()` y se verifica que no esté vacío.
     *    - Se comprueba que `$tipo_val` se encuentre entre los valores permitidos definidos en el arreglo interno `$this->regex_fecha`.
     *      Si no es así, se retorna un error indicando que el tipo de fecha no pertenece a las opciones válidas.
     *
     * 4. **Validación con patrón:**
     *    Se utiliza el método `valida_pattern()` para validar que el valor de `$fecha` cumpla con el patrón asociado a la clave `$tipo_val`.
     *    Si la validación falla, se retorna un error indicando que la fecha es inválida.
     *
     * Si todas las comprobaciones son correctas, el método retorna `true`.
     *
     * ## Parámetros:
     *
     * @param mixed $fecha
     *        La fecha a validar. Se espera que sea una cadena de texto que represente una fecha en el formato adecuado,
     *        por ejemplo, "2023-05-20".
     *        **Nota:** Si se pasa un valor que no es una cadena, se considerará inválido.
     *
     * @param string $tipo_val
     *        Especifica el formato de la fecha que se desea validar. Este parámetro debe coincidir con una de las claves
     *        definidas en el arreglo interno `$this->regex_fecha`. Por defecto, su valor es `'fecha'`.
     *        Ejemplos de posibles valores:
     *         - `"fecha"` para fechas en formato `yyyy-mm-dd`
     *         - `"fecha_hora_min_sec_esp"` para fechas en formato `yyyy-mm-dd hh:mm:ss`
     *         - `"fecha_hora_min_sec_t"` para fechas en formato `yyyy-mm-ddThh:mm:ss`
     *
     * ## Valor de retorno:
     *
     * @return true|array
     *         - Retorna `true` si la fecha es válida y cumple con el patrón especificado.
     *         - Retorna un array con la información del error (utilizando `$this->error->error()`) si alguna de las validaciones falla.
     *
     * ## Casos de Uso Exitosos:
     *
     * **Ejemplo 1: Fecha Válida en Formato "fecha" (yyyy-mm-dd)**
     * ```php
     * $fecha = "2023-05-20";
     * $tipo_val = "fecha"; // Valor por defecto
     * $resultado = $this->valida_fecha($fecha);
     * // $resultado es true, ya que "2023-05-20" cumple con el patrón de fecha (yyyy-mm-dd)
     * ```
     *
     * **Ejemplo 2: Fecha Válida con Espacios Extra**
     * ```php
     * $fecha = " 2023-12-31 "; // Con espacios antes y después
     * $tipo_val = "fecha";
     * $resultado = $this->valida_fecha($fecha);
     * // $resultado es true, ya que tras aplicar trim() la fecha es "2023-12-31" y es válida
     * ```
     *
     * ## Casos de Error:
     *
     * **Ejemplo 3: Fecha No Es una Cadena**
     * ```php
     * $fecha = 20230520; // Valor numérico en lugar de cadena
     * $resultado = $this->valida_fecha($fecha);
     * // $resultado será un array de error, indicando "Error la fecha debe ser un texto"
     * ```
     *
     * **Ejemplo 4: Fecha Vacía**
     * ```php
     * $fecha = "   "; // Cadena vacía tras aplicar trim()
     * $resultado = $this->valida_fecha($fecha);
     * // $resultado será un array de error, indicando "Error la fecha esta vacia"
     * ```
     *
     * **Ejemplo 5: Tipo de Validación Inválido**
     * ```php
     * $fecha = "2023-05-20";
     * $tipo_val = "fecha_incorrecta"; // No existe en $this->regex_fecha
     * $resultado = $this->valida_fecha($fecha, $tipo_val);
     * // $resultado será un array de error, indicando "Error el tipo val no pertenece a fechas validas"
     * ```
     *
     * **Ejemplo 6: Fecha que No Cumple el Patrón**
     * ```php
     * $fecha = "20-05-2023"; // Formato incorrecto, se espera "yyyy-mm-dd"
     * $resultado = $this->valida_fecha($fecha);
     * // $resultado será un array de error, indicando "Error fecha invalida"
     * ```
     *
     * ## Notas:
     *
     * - Es importante que el parámetro `$tipo_val` coincida exactamente con uno de los valores permitidos en el arreglo `$this->regex_fecha`.
     *   Esto garantiza que se utilice el patrón correcto para validar el formato de la fecha.
     * - El método utiliza `valida_pattern()` para comparar la fecha contra el patrón, retornando `true` si la validación es exitosa.
     *
     * @see valida_pattern()
     * @see $this->regex_fecha
     * @see errores::error()
     */
    final public function valida_fecha(mixed $fecha, string $tipo_val = 'fecha'): array|true
    {
        if (!is_string($fecha)) {
            return $this->error->error(
                mensaje: 'Error la fecha debe ser un texto',
                data: $fecha,
                es_final: true
            );
        }
        $fecha = trim($fecha);
        if ($fecha === '') {
            return $this->error->error(
                mensaje: 'Error la fecha esta vacia',
                data: $fecha,
                es_final: true
            );
        }
        $tipo_val = trim($tipo_val);
        if ($tipo_val === '') {
            return $this->error->error(
                mensaje: 'Error tipo_val no puede venir vacio',
                data: $tipo_val,
                es_final: true
            );
        }

        if (!in_array($tipo_val, $this->regex_fecha, true)) {
            return $this->error->error(
                mensaje: 'Error el tipo val no pertenece a fechas validas',
                data: $this->regex_fecha,
                es_final: true
            );
        }

        if (! $this->valida_pattern(key: $tipo_val, txt: $fecha)) {
            return $this->error->error(
                mensaje: 'Error fecha invalida',
                data: $fecha
            );
        }
        return true;
    }


    /**
     *
     * Valida los datos de entrada para un filtro especial
     *
     * @param string $campo campo de una tabla tabla.campo
     * @param array $filtro filtro a validar
     *
     * @return array|bool
     * @example
     *
     *      Ej 1
     *      $campo = 'x';
     *      $filtro = array('operador'=>'x','valor'=>'x');
     *      $resultado = valida_filtro_especial($campo, $filtro);
     *      $resultado = array('operador'=>'x','valor'=>'x');
     * @version 2.67.0
     *
     */
    final public function valida_filtro_especial(string $campo, array $filtro):array|bool{ //DOC //DEBUG
        if(!isset($filtro['operador'])){
            return $this->error->error(mensaje: "Error operador no existe",data: $filtro);
        }
        if(!isset($filtro['valor_es_campo']) &&is_numeric($campo)){
            return $this->error->error(mensaje: "Error campo invalido",data: $filtro);
        }
        if(!isset($filtro['valor'])){
            return $this->error->error(mensaje: "Error valor no existe",data: $filtro);
        }
        if($campo === ''){
            return $this->error->error(mensaje: "Error campo vacio",data: $campo);
        }
        return true;
    }

    /**
     * Valida que exista filtros en POST
     * @return bool|array
     * @version 0.39.1
     */
    final public function valida_filtros(): bool|array
    {
        if(!isset($_POST['filtros'])){
            return $this->error->error('Error filtros debe existir por POST',$_GET);
        }
        if(!is_array($_POST['filtros'])){
            return $this->error->error('Error filtros debe ser un array',$_GET);
        }
        return true;
    }

    /**
     * REG
     * Verifica que el índice `$key` dentro de `$registro` represente un identificador válido.
     *
     * Los pasos de validación son:
     *  1. Llamar a `valida_base()` para comprobar que `$key` exista en `$registro`, no esté vacío y sea un entero > 0.
     *  2. Validar con el método `id()` que el valor asociado a `$key` cumpla las condiciones de un ID válido.
     *     (Generalmente, se espera un número entero mayor que 0).
     *
     * - Si alguna verificación falla, se registra un error mediante `$this->error->error()` y se retorna un arreglo
     *   con la información correspondiente.
     * - Si todo es exitoso, retorna `true`.
     *
     * @param string $key      Clave que se buscará y validará dentro de `$registro`.
     * @param array  $registro Arreglo de datos que debe contener el índice `$key`.
     *
     * @return true|array Retorna `true` si la validación es satisfactoria; si hay un error, se retorna
     *                    un arreglo con la información detallada del mismo.
     *
     * @example
     *  Ejemplo 1: Validación exitosa de un ID
     *  ----------------------------------------------------------------------------
     *  $registro = [
     *      'id_usuario' => 10
     *  ];
     *
     *  // Suponiendo que la función id() verifica que sea un entero > 0
     *  $resultado = $this->valida_id('id_usuario', $registro);
     *
     *  if ($resultado === true) {
     *      echo "El ID es válido.";
     *  } else {
     *      // Manejo del error. $resultado contendrá la información del error
     *  }
     *
     * @example
     *  Ejemplo 2: Falta la clave o está vacía
     *  ----------------------------------------------------------------------------
     *  $registro = [];
     *
     *  // Falta 'id_usuario', por lo que valida_base() devolverá error
     *  $resultado = $this->valida_id('id_usuario', $registro);
     *  // Se retorna un arreglo con la información del error
     *
     * @example
     *  Ejemplo 3: ID no válido
     *  ----------------------------------------------------------------------------
     *  $registro = [
     *      'id_usuario' => 0
     *  ];
     *
     *  // id() retornará false, ya que 0 no se considera un identificador válido
     *  $resultado = $this->valida_id('id_usuario', $registro);
     *  // Se retorna un arreglo con la información del error
     */
    final public function valida_id(string $key, array $registro): true|array
    {
        // 1. Valida que $key exista, no esté vacío y sea > 0 mediante valida_base()
        $valida = $this->valida_base(key: $key, registro: $registro);
        if (errores::$error) {
            return $this->error->error(
                mensaje: 'Error al validar ' . $key,
                data: $valida
            );
        }

        // 2. Comprueba que cumpla las condiciones definidas en el método id() (ej. entero > 0)
        if (!$this->id(txt: $registro[$key])) {
            return $this->error->error(
                mensaje: 'Error: el ' . $key . ' es inválido (no cumple con el formato de ID)',
                data: $registro,
                es_final: true
            );
        }

        return true;
    }


    /**
     * REG
     * Valida que un conjunto de claves (`$keys`) dentro de `$registro` sean IDs válidos (enteros > 0).
     *
     * - Si `$registro` es una cadena (`string`), se registra un error, pues se espera un array u objeto.
     * - Si `$keys` está vacío, se registra un error indicando que no se proporcionaron claves.
     * - Si `$registro` es un objeto, se convierte en array para la validación.
     * - Para cada clave en `$keys`:
     *   - Verifica que la clave no sea una cadena vacía.
     *   - Comprueba que la clave exista en `$registro`.
     *   - Llama a `valida_id()` para validar que el valor sea un entero válido (> 0).
     * - Si todas las validaciones pasan, retorna un arreglo con un mensaje de éxito y los valores de `$registro` y `$keys`.
     * - Si alguna validación falla, retorna un arreglo con los detalles del error.
     *
     * @param array         $keys     Conjunto de claves que deben existir en `$registro` y ser IDs válidos.
     * @param array|object|string $registro Datos en los que se verificarán dichas claves. Debe ser un arreglo u objeto.
     *
     * @return array Retorna:
     *  - `[ 'mensaje' => 'ids validos', $registro, $keys ]` si todas las validaciones se cumplen.
     *  - Un arreglo de error (resultado de `$this->error->error()`) en caso de validaciones fallidas.
     *
     * @example
     *  Ejemplo 1: Validación exitosa con arreglo
     *  ------------------------------------------------------------------------------------
     *  $keys = ['id_usuario', 'id_rol'];
     *  $registro = [
     *      'id_usuario' => 5,
     *      'id_rol'     => 10
     *  ];
     *  $resultado = $this->valida_ids($keys, $registro);
     *
     *  // Si todo es correcto, $resultado será:
     *  // [
     *  //   'mensaje' => 'ids validos',
     *  //   [ 'id_usuario' => 5, 'id_rol' => 10 ],
     *  //   [ 'id_usuario', 'id_rol' ]
     *  // ]
     *
     * @example
     *  Ejemplo 2: `$registro` es un objeto
     *  ------------------------------------------------------------------------------------
     *  $obj = new stdClass();
     *  $obj->id_usuario = 5;
     *  $obj->id_rol     = 10;
     *
     *  $resultado = $this->valida_ids(['id_usuario', 'id_rol'], $obj);
     *  // El objeto se convierte a array internamente y se validan las claves. Mismo resultado exitoso.
     *
     * @example
     *  Ejemplo 3: Falta una clave en `$registro`
     *  ------------------------------------------------------------------------------------
     *  $keys = ['id_usuario', 'id_rol'];
     *  $registro = [ 'id_usuario' => 5 ];
     *
     *  $resultado = $this->valida_ids($keys, $registro);
     *  // Se retorna un arreglo de error, indicando que 'id_rol' no existe.
     *
     * @example
     *  Ejemplo 4: `$registro` es una cadena en lugar de un arreglo u objeto
     *  ------------------------------------------------------------------------------------
     *  $resultado = $this->valida_ids(['id_usuario'], "cadena no válida");
     *  // Se registra un error indicando "Error registro debe ser un array".
     */
    final public function valida_ids(array $keys, array|object|string $registro): array
    {
        // Verifica que $registro no sea un string
        if (is_string($registro)) {
            return $this->error->error(
                mensaje: "Error: 'registro' debe ser un array u objeto, no un string",
                data: $keys,
                es_final: true
            );
        }

        // Verifica que se hayan proporcionado claves
        if (count($keys) === 0) {
            return $this->error->error(
                mensaje: "Error: 'keys' está vacío",
                data: $keys,
                es_final: true
            );
        }

        // Convierte el registro a array si es un objeto
        if (is_object($registro)) {
            $registro = (array) $registro;
        }

        // Recorre cada clave a validar
        foreach ($keys as $key) {
            // La clave no debe ser una cadena vacía
            if ($key === '') {
                return $this->error->error(
                    mensaje: 'Error: clave vacía',
                    data: $registro,
                    es_final: true
                );
            }

            // La clave debe existir en el array $registro
            if (!isset($registro[$key])) {
                return $this->error->error(
                    mensaje: 'Error: no existe ' . $key,
                    data: $registro,
                    es_final: true
                );
            }

            // Se valida que el valor sea un ID correcto (entero > 0)
            $id_valido = $this->valida_id(key: $key, registro: $registro);
            if (errores::$error) {
                return $this->error->error(
                    mensaje: 'Error: ' . $key . ' es inválido',
                    data: $id_valido,
                    es_final: true
                );
            }
        }

        // Si todas las validaciones pasan, retorna mensaje de éxito
        return [
            'mensaje' => 'ids validos',
            $registro,
            $keys
        ];
    }


    /**
     * POR DOCUMENTAR EN WIKI FINAL REV
     * Valida la key_id proporcionada.
     *
     * @param string $value El valor key_id que necesita ser validado.
     *
     * @return true|array devuelve verdadero si el valor key_id es válido, de lo contrario devuelve un array con el error.
     *
     * @example
     *
     * valida_key_id('123456') -> Devolverá verdadero si '123456' es una key_id válida.
     * valida_key_id('abc') -> Devolverá un array con el error si 'abc' no es una key_id válida.
     *
     * @version 3.14.0
     */
    final public function valida_key_id(string $value): true|array{
        if(!$this->key_id(txt:$value)){
            return $this->error->error(mensaje:'Error al validar key id'.$value ,data:$value);
        }

        return true;
    }

    /**
     * Verifica que los keys de tipo documento esten correctamente asignados
     * @param array $registro Registro en proceso
     * @return array|bool
     * @version 2.40.0
     */
    final protected function valida_keys_documento(array $registro): array|bool
    {
        $keys = $this->keys_documentos();
        if(errores::$error){
            return $this->error->error('Error al obtener keys',$keys);
        }
        $valida = $this->valida_existencia_keys(keys: $keys, registro: $registro);
        if(errores::$error){
            return $this->error->error('Error al validar registro',$valida);
        }
        return $valida;
    }

    /**
     * TOTAL
     * Valida que una lada sea correcta con formato de mexico de 2 a 3 numeros
     * @param string $lada Lada a validar
     * @return true|array
     * @version 2.60.0
     * @url https://github.com/gamboamartin/validacion/wiki/src.validacion.valida_lada.5.26.0
     */
    final public function valida_lada(string $lada): true|array
    {
        $lada = trim($lada);
        if($lada === ''){
            return $this->error->error(mensaje: 'Error lada vacia',
                data:  array('regex'=>$this->patterns['lada'],'value'=>$lada),es_final: true);
        }
        if(!is_numeric($lada)){
            return $this->error->error(mensaje: 'Error lada debe ser un numero',
                data:  array('regex'=>$this->patterns['lada'],'value'=>$lada),es_final: true);
        }

        $es_valida = $this->valida_pattern(key: 'lada',txt:  $lada);
        if(!$es_valida){
            return $this->error->error(mensaje: 'Error lada invalida',
                data:  array('regex'=>$this->patterns['lada'],'value'=>$lada),es_final: true);
        }
        return true;
    }

    /**
     * Se valida que la tabla sea un modelo valido
     * @version 1.0.0
     * @param string $tabla Tabla o estructura de la base de datos y modelo
     * @return bool|array verdadero si es correcta la entrada
     */
    final public function valida_modelo(string $tabla): bool|array
    {
        $class = $this->class_depurada(tabla: $tabla);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al ajustar class',data: $class, params: get_defined_vars());
        }
        $valida = $this->valida_class(class:  $class, tabla: $tabla);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al validar '.$tabla,data: $valida, params: get_defined_vars());
        }
        return $valida;
    }

    /**
     * Valida que de un modelo exista tu clase
     * @version 0.5.0
     * @param string $tabla
     * @return bool|array
     */
    final public function valida_name_clase(string $tabla): bool|array
    {
        $tabla = trim($tabla);

        if($tabla === ''){
            return $this->error->error(mensaje: 'Error tabla no puede venir vacio',data: $tabla);
        }

        return true;
    }

    /** Valida que un valor sea un numero
     * @version 0.9.1
     * @param mixed $value Valor a verificar
     * @return bool|array
     */
    final public function valida_numeric(mixed $value): bool|array
    {
        if(!is_numeric($value)){
            return $this->error->error(mensaje: 'Error el valor no es un numero',data: $value);
        }
        return true;
    }

    /**
     * Valida un conjunto de datos sean numeros
     * @version 0.12.1
     * @param array $keys Keys a verificar
     * @param array|stdClass $row Registro a verificar
     * @return bool|array
     */
    final public function valida_numerics(array $keys, array|stdClass $row): bool|array
    {
        if(is_object($row)){
            $row = (array)$row;
        }
        $valida_existe = $this->valida_existencia_keys(keys: $keys,registro: $row);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al validar registro', data: $valida_existe);
        }
        foreach ($keys as $key){
            $valida = $this->valida_numeric(value: $row[$key]);
            if(errores::$error){
                return $this->error->error(mensaje: 'Error al validar registro['.$key.']', data: $valida);
            }
        }
        return true;
    }

    /**
     * Valida un numero telefonico  mexicano a 10 numeros
     * @param string $tel Telefono a validar
     * @return bool|array
     */
    final public function valida_numero_tel_mx(string $tel): bool|array
    {
        $tel = trim($tel);
        if($tel === ''){
            return $this->error->error(mensaje: 'Error tel vacia',data:  $this->patterns['telefono_mx']);
        }
        if(!is_numeric($tel)){
            return $this->error->error(mensaje: 'Error tel debe ser un numero',data:  $this->patterns['telefono_mx']);
        }

        $es_valida = $this->valida_pattern(key: 'telefono_mx',txt:  $tel);
        if(!$es_valida){
            return $this->error->error(mensaje: 'Error telefono invalido',data:  $this->patterns['telefono_mx']);
        }
        return true;
    }

    /**
     * TOTAL
     * Valida un numero telefonico sin lada mexicano 7 a 8 numeros
     * @param string $tel Telefono a validar
     * @return true|array
     * @version 2.63.0
     * @url https://github.com/gamboamartin/validacion/wiki/src.validacion.valida_numero_sin_lada.5.27.0
     */
    final public function valida_numero_sin_lada(string $tel): true|array
    {
        $tel = trim($tel);
        if($tel === ''){
            return $this->error->error(mensaje: 'Error tel vacia',
                data:  array('regex'=>$this->patterns['tel_sin_lada'],'value'=>$tel),es_final: true);
        }
        if(!is_numeric($tel)){
            return $this->error->error(mensaje: 'Error tel debe ser un numero',
                data:  array('regex'=>$this->patterns['tel_sin_lada'],'value'=>$tel),es_final: true);
        }

        $es_valida = $this->valida_pattern(key: 'tel_sin_lada',txt:  $tel);
        if(!$es_valida){
            return $this->error->error(mensaje: 'Error telefono invalido',
                data:  array('regex'=>$this->patterns['tel_sin_lada'],'value'=>$tel),es_final: true);
        }
        return true;
    }

    /**
     * Valida que sea la estructura correcta un json base
     * @param string $txt texto a validar
     * @return array|true
     * @example {a:a,b:b}
     * @version 2.37.0
     *
     */
    final public function valida_params_json_parentesis(string $txt): bool|array
    {
        $valida = $this->valida_pattern(key: 'params_json_parentesis', txt: $txt);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al validar txt', data: $valida);
        }
        if(!$valida){
            return $this->error->error(mensaje: 'Error el txt ex invalido',
                data: $this->patterns['params_json_parentesis']);

        }
        return true;
    }

    /**
     * REG
     * Valida una cadena de texto `$txt` contra un patrón (expresión regular) identificado por `$key`.
     *
     * La función busca el patrón en la propiedad `$this->patterns[$key]`, realiza la validación
     * utilizando `preg_match()` y retorna `true` si la cadena cumple con el patrón, o `false` en caso contrario.
     *
     * @param string $key  Clave que identifica el patrón dentro de `$this->patterns`. No debe ser una cadena vacía.
     * @param string $txt  Cadena de texto a validar contra el patrón seleccionado.
     *
     * @return bool Retorna `true` si `$txt` coincide con el patrón asociado a `$key`, de lo contrario `false`.
     *
     * @example
     *  Ejemplo 1: Validar un correo electrónico
     *  -------------------------------------------------------------------------------------
     *  // Suponiendo que $this->patterns['email'] = '/^[\w\.\-]+@\w+\.\w{2,}$/'
     *
     *  $isValidEmail = $this->valida_pattern('email', 'usuario@example.com');
     *  if($isValidEmail){
     *      echo "El correo electrónico es válido";
     *  } else {
     *      echo "Correo electrónico no válido";
     *  }
     *
     * @example
     *  Ejemplo 2: Validar un número de teléfono
     *  -------------------------------------------------------------------------------------
     *  // Suponiendo que $this->patterns['telefono'] = '/^[0-9]{10}$/'
     *
     *  $isValidPhone = $this->valida_pattern('telefono', '5512345678');
     *  if($isValidPhone){
     *      echo "El número de teléfono es válido (10 dígitos)";
     *  } else {
     *      echo "Formato de teléfono incorrecto";
     *  }
     *
     * @example
     *  Ejemplo 3: Clave no registrada o vacía
     *  -------------------------------------------------------------------------------------
     *  // Si se pasa una clave que no existe en $this->patterns o está vacía, la función retorna false.
     *
     *  // Caso 3a: Clave vacía
     *  $isValid = $this->valida_pattern('', 'texto');
     *  // $isValid será false.
     *
     *  // Caso 3b: Clave no definida en el arreglo
     *  $isValid = $this->valida_pattern('claveInexistente', 'texto');
     *  // $isValid será false, ya que no existe 'claveInexistente' en $this->patterns.
     */
    final public function valida_pattern(string $key, string $txt): bool
    {
        if ($key === '') {
            return false;
        }
        if (!isset($this->patterns[$key])) {
            return false;
        }

        $result = preg_match($this->patterns[$key], $txt);
        $r = false;

        if ((int)$result !== 0) {
            $r = true;
        }

        return $r;
    }


    /**
     * Valida un rango de fechas
     * @param array $fechas conjunto de fechas fechas['fecha_inicial'], fechas['fecha_final']
     * @param string $tipo_val
     *          utiliza los patterns de las siguientes formas
     *          fecha=yyyy-mm-dd
     *          fecha_hora_min_sec_esp = yyyy-mm-dd hh-mm-ss
     *          fecha_hora_min_sec_t = yyyy-mm-ddThh-mm-ss
     * @return array|bool true si no hay error
     * @version 2.68.0
     */
    final public function valida_rango_fecha(array $fechas, string $tipo_val = 'fecha'): array|bool
    {
        $keys = array('fecha_inicial','fecha_final');
        $valida = $this->valida_existencia_keys(keys:$keys, registro: $fechas);
        if(errores::$error) {
            return $this->error->error(mensaje: 'Error al validar fechas', data: $valida, params: get_defined_vars());
        }

        if($fechas['fecha_inicial'] === ''){
            return $this->error->error(mensaje: 'Error fecha inicial no puede venir vacia',
                data:$fechas['fecha_inicial'], params: get_defined_vars());
        }
        if($fechas['fecha_final'] === ''){
            return $this->error->error(mensaje: 'Error fecha final no puede venir vacia',
                data:$fechas['fecha_final'], params: get_defined_vars());
        }
        $valida = $this->valida_fecha(fecha: $fechas['fecha_inicial'], tipo_val: $tipo_val);
        if(errores::$error) {
            return $this->error->error(mensaje: 'Error al validar fecha inicial',data:$valida,
                params: get_defined_vars());
        }
        $valida = $this->valida_fecha(fecha: $fechas['fecha_final'], tipo_val: $tipo_val);
        if(errores::$error) {
            return $this->error->error(mensaje: 'Error al validar fecha final',data:$valida,
                params: get_defined_vars());
        }
        if($fechas['fecha_inicial']>$fechas['fecha_final']){
            return $this->error->error(mensaje: 'Error la fecha inicial no puede ser mayor a la final',
                data:$fechas, params: get_defined_vars());
        }
        return $valida;
    }

    /**
     * Valida que la estructura de un rfc sea valida
     * @param string $key Key a validar
     * @param array $registro Registro en proceso
     * @return bool|array
     * @version 2.66.0
     */
    final public function valida_rfc(string $key, array $registro): bool|array{

        $valida = $this->valida_base(key: $key, registro: $registro, valida_int: false);
        if(errores::$error){
            return $this->error->error(mensaje:'Error al validar '.$key ,data:$valida);
        }

        if(!$this->rfc(txt:$registro[$key])){
            return $this->error->error(mensaje:'Error el '.$key.' es invalido',data:$registro);
        }

        return true;
    }

    /**
     * Valida los rfc contenidos en un array
     * @param array $keys Keys a validar
     * @param array|object $registro Registro a validar
     * @return array|bool
     * @version 2.67.0
     */
    final public function valida_rfcs(array $keys, array|object $registro):array|bool{
        if(count($keys) === 0){
            return $this->error->error(mensaje: "Error keys vacios",data: $keys);
        }

        if(is_object($registro)){
            $registro = (array)$registro;
        }

        foreach($keys as $key){
            if($key === ''){
                return $this->error->error(mensaje:'Error '.$key.' Invalido',data:$registro);
            }
            if(!isset($registro[$key])){
                return  $this->error->error(mensaje:'Error no existe '.$key,data:$registro);
            }
            $id_valido = $this->valida_rfc(key: $key, registro: $registro);
            if(errores::$error){
                return  $this->error->error(mensaje:'Error '.$key.' Invalido',data:$id_valido);
            }
        }
        return true;
    }

    /**
     * Valida una seccion
     * @param string $seccion Nombre de la seccion a validar
     * @return array
     */
    final public function valida_seccion_base( string $seccion): array
    {
        $namespace = 'models\\';
        $seccion = str_replace($namespace,'',$seccion);
        $class = $namespace.$seccion;
        if($seccion === ''){
            return $this->error->error('Error no existe controler->seccion no puede venir vacia',$class);
        }
        if(!class_exists($class)){
            return $this->error->error('Error no existe la clase '.$class,$class);
        }
        return $_GET;
    }

    /**
     * REG
     * Valida los estados de un conjunto de claves en el registro proporcionado.
     *
     * Esta función valida que las claves especificadas existan en el `$registro` (que puede ser un arreglo u objeto)
     * y que sus valores sean válidos (es decir, que sean `'activo'` o `'inactivo'`).
     * Si alguna clave no existe o su valor no es válido, se devuelve un error con el mensaje correspondiente.
     *
     * - Si `$registro` es un objeto, se convierte a un arreglo para facilitar el acceso a los valores.
     * - La función recorre cada clave en `$keys` y valida que su valor sea `'activo'` o `'inactivo'`.
     *
     * Si alguna de las validaciones falla, se devuelve un arreglo con el mensaje de error. Si todas las validaciones
     * son correctas, la función devuelve `true`.
     *
     * @param array $keys Un arreglo con las claves que deben ser validadas. Estas claves deben tener valores de estado
     *                     válidos (`'activo'` o `'inactivo'`).
     * @param array|stdClass $registro El registro (puede ser un arreglo o un objeto) donde se almacenan las claves y sus
     *                                 valores correspondientes.
     *
     * @return bool|array Devuelve `true` si todas las claves existen y sus valores son válidos. Si alguna validación falla,
     *                    devuelve un arreglo con el mensaje de error correspondiente.
     *
     * @throws errores Si ocurre algún error durante la validación, se genera un error que se captura y se devuelve como
     *                 un mensaje.
     *
     * @example Ejemplo 1: Validar un registro con estados válidos
     * ```php
     * $keys = ['status', 'active_status'];
     * $registro = [
     *     'status' => 'activo',
     *     'active_status' => 'inactivo'
     * ];
     *
     * $resultado = $this->valida_statuses($keys, $registro);
     * // Retorna true, ya que ambos estados son válidos.
     * ```
     *
     * @example Ejemplo 2: Validar un registro con un estado inválido
     * ```php
     * $keys = ['status'];
     * $registro = [
     *     'status' => 'desconocido'  // Valor inválido
     * ];
     *
     * $resultado = $this->valida_statuses($keys, $registro);
     * // Retorna un arreglo de error: 'Error status debe ser activo o inactivo'.
     * ```
     *
     * @example Ejemplo 3: Validar un registro con una clave faltante
     * ```php
     * $keys = ['status', 'active_status'];
     * $registro = [
     *     'status' => 'activo'
     *     // Faltando 'active_status'
     * ];
     *
     * $resultado = $this->valida_statuses($keys, $registro);
     * // Retorna un arreglo de error indicando que 'active_status' no existe en el registro.
     * ```
     *
     * @example Ejemplo 4: Validar un registro cuando el parámetro es un objeto en lugar de un arreglo
     * ```php
     * $keys = ['status', 'active_status'];
     * $registro = (object) [
     *     'status' => 'activo',
     *     'active_status' => 'inactivo'
     * ];
     *
     * $resultado = $this->valida_statuses($keys, $registro);
     * // Retorna true, ya que el objeto se convierte en un arreglo y ambos estados son válidos.
     * ```
     *
     * @version 1.0.0
     */
    final public function valida_statuses(array $keys, array|stdClass $registro): array|bool
    {
        // Convertir el objeto a un arreglo si es necesario
        if (is_object($registro)) {
            $registro = (array)$registro;
        }

        // Validar la existencia de las claves en el registro
        $valida_existencias = $this->valida_existencia_keys(keys: $keys, registro: $registro);
        if (errores::$error) {
            return $this->error->error(mensaje: 'Error status invalido', data: $valida_existencias);
        }

        // Recorrer cada clave y validar que su valor sea 'activo' o 'inactivo'
        foreach ($keys as $key) {
            if ($registro[$key] !== 'activo' && $registro[$key] !== 'inactivo') {
                return $this->error->error(mensaje: 'Error ' . $key . ' debe ser activo o inactivo', data: $registro);
            }
        }

        return true;
    }


    /**
     * POR DOCUMENTAR EN WIKI ES FINAL REV
     * Función que valida si un texto dado cumple con el estándar PEP 8.
     *
     * @param string $txt El texto que se va a validar.
     *
     * @return bool|array Retorna true si el texto cumple con el estándar PEP 8.
     *  En caso contrario, retorna una matriz con información sobre los errores encontrados.
     *
     * @throws errores Lanza una excepción si se produce un error durante la validación.
     * @version 3.19.0
     */
    final public function valida_texto_pep_8(string $txt): bool|array
    {
        $valida = $this->valida_pattern(key: 'texto_pep_8', txt: $txt);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al validar txt', data: $valida);
        }
        if(!$valida){
            return $this->error->error(mensaje: 'Error el txt ex invalido',
                data: array($this->patterns['texto_pep_8'],$txt),es_final: true);
        }
        return true;
    }

    /**
     * @param string $url Liga a validar
     * @return bool|array
     * @version 0.26.1
     */

    final public function valida_url(string $url): bool|array
    {
        $valida = $this->url(url: $url);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error la url es valida',data:  $valida);
        }
        if(!$valida){
            return $this->error->error(mensaje: 'Error la url es invalida',data:  $url);
        }
        return true;
    }



}