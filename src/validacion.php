<?php
namespace gamboamartin\validacion;

use gamboamartin\errores\errores;
use stdClass;

/**
 * @final rev
 */
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
     * POR DOCUMENTAR EN WIKI
     * Integra a validacion->patterns los regex numericos la veces que este el max_long definido
     * @param int $max_long N veces que se ejecutara la funcion init_cod_int_0_n_numbers
     * @return array
     * @version 3.15.0
     */
    private function base_regex_0_numbers(int $max_long): array
    {
        if($max_long<=0){
            return $this->error->error(mensaje: 'Error max_long debe ser mayor a 0', data: $max_long);
        }
        $longitud_cod_0_n_numbers = 1;
        $patterns = array();
        while($longitud_cod_0_n_numbers <= $max_long){
            $regex = (new _codigos())->init_cod_int_0_n_numbers(
                longitud: $longitud_cod_0_n_numbers,patterns: $this->patterns);
            if(errores::$error){
                return $this->error->error(mensaje: 'Error al inicializar regex', data: $regex);
            }
            $patterns[] = $regex;
            $longitud_cod_0_n_numbers++;
        }
        return $patterns;
    }


    /**
     * POR DOCUMENTAR EN WIKI
     * Verifica la validez y existencia de ciertos parámetros de un botón en una interfaz de usuario.
     *
     * @param array $data_boton Los datos del botón a validar. Este array debe contener las claves 'filtro', 'id' y 'etiqueta'.
     *
     * @return bool|array Devuelve TRUE si la validación es exitosa. En caso contrario, devuelve un array con detalles del error.
     *
     * @throws errores Si algún parámetro obligatorio no existe o no es válido, la función arroja una excepción de tipo ErrorException.
     *
     * Parámetros de $data_boton:
     * - 'filtro' (obligatorio): Debe ser un array. Es el filtro que se aplica a los datos del botón.
     * - 'id' (obligatorio): Es el identificador del botón
     * - 'etiqueta' (obligatorio): Es la etiqueta que se mostrará en el botón.
     * @version 3.20.0
     */
    final public function btn_base(array $data_boton): bool|array
    {
        if(!isset($data_boton['filtro'])){
            return $this->error->error(
                mensaje: 'Error $data_boton[filtro] debe existir',data: $data_boton,es_final: true);
        }
        if(!is_array($data_boton['filtro'])){
            return $this->error->error(mensaje: 'Error $data_boton[filtro] debe ser un array',data: $data_boton
                ,es_final: true);
        }
        if(!isset($data_boton['id'])){
            return $this->error->error(mensaje: 'Error $data_boton[id] debe existir',data: $data_boton,es_final: true);
        }
        if(!isset($data_boton['etiqueta'])){
            return $this->error->error(mensaje: 'Error $data_boton[etiqueta] debe existir',data: $data_boton,
                es_final: true);
        }
        return true;
    }

    /**
     * POR DOCUMENTAR EN WIKI
     * Valida los datos proporcionados para un botón.
     *
     * @param array $data_boton Datos del botón a validar. Los elementos esperados son:
     *     - 'etiqueta': Etiqueta del botón. Debe existir y no puede estar vacía.
     *     - 'class': Clase del botón. Debe existir y no puede estar vacía.
     *
     * @return bool|array Retorna true si la validación es exitosa. Si hay errores, retorna un arreglo con detalles del error.
     *
     * @throws errores Si algún dato proporcionado no cumple los requerimientos de validación,
     * se lanza una excepción con detalles del error.
     * @version 3.21.0
     */
    final public function btn_second(array $data_boton): bool|array
    {
        if(!isset($data_boton['etiqueta'])){
            return $this->error->error(mensaje: 'Error $data_boton[etiqueta] debe existir',data: $data_boton,
                es_final: true);
        }
        if($data_boton['etiqueta'] === ''){
            return $this->error->error(mensaje: 'Error etiqueta no puede venir vacio',data: $data_boton['etiqueta'],
                es_final: true);
        }
        if(!isset($data_boton['class'])){
            return $this->error->error(mensaje: 'Error $data_boton[class] debe existir',data: $data_boton,
                es_final: true);
        }
        if($data_boton['class'] === ''){
            return $this->error->error(mensaje: 'Error class no puede venir vacio',data: $data_boton['class'],
                es_final: true);
        }
        return true;
    }

    /**
     * POR DOCUMENTAR EN WIKI FINAL REV
     * Valida una entrada de texto $txt según el patrón 'cod_1_letras_mayusc'.
     *
     * Esta función acepta una entrada que puede ser un valor entero, una cadena de texto o null.
     * Comprueba la validación utilizando el patrón con key 'cod_1_letras_mayusc'.
     *
     * @param int|string|null $txt La entrada a validar.
     *
     * @return bool Retorna verdadero si la entrada pasa la validación, falso en caso contrario.
     *
     * @example
     * // Crear un nuevo objeto de validación
     * $validador = new validacion();
     *
     * //Entrada del usuario
     * $entrada = "ABCD";
     *
     * // Usar la entrada del usuario para verificar su validez
     * $esValido = $validador->cod_1_letras_mayusc($entrada);
     *
     * if ($esValido) {
     *     echo "La entrada es valida."
     * } else {
     *     echo "La entrada no es valida."
     * }
     * @version 15.13.0
     */
    final public function cod_1_letras_mayusc(int|string|null $txt):bool{
        return $this->valida_pattern(key:'cod_1_letras_mayusc', txt:$txt);
    }

    /**
     * POR DOCUMENTAR EN WIKI
     * Detecta si el texto proporcionado cumple con un patrón específico.
     *
     * Esta función es útil para verificar si una cadena de texto proporcionada cumple con el patrón 'cod_3_letras_mayusc'.
     * Realiza su labor utilizando la función auxiliar `valida_pattern`.
     *
     * @param int|string|null $txt El texto a verificar. Este puede ser un entero, una cadena de texto o incluso nulo.
     * @return bool Retorno verdadero si el texto coincide con el patrón, falso en caso contrario.
     * @version 4.2.0
     */
    final public function cod_3_letras_mayusc(int|string|null $txt):bool{
        return $this->valida_pattern(key:'cod_3_letras_mayusc', txt:$txt);
    }

    /**
     * POR DOCUMENTAR EN WIKI
     * Verifica si el texto proporcionado cumple con un patrón específico.
     *
     * Esta función es útil para verificar si una cadena de texto proporcionada cumple con el patrón 'cod_int_0_numbers'.
     * Utiliza la función auxiliar `valida_pattern` para realizar dicha comprobación.
     *
     * @param int|string|null $txt El texto a verificar. Puede ser un entero, una cadena de texto o incluso nulo.
     * @return bool Retorna verdadero si el texto coincide con el patrón, falso en caso contrario.
     * @version 4.3.0
     */
    final public function cod_int_0_numbers(int|string|null $txt):bool{
        return $this->valida_pattern(key:'cod_int_0_numbers', txt:$txt);
    }

    /**
     * POR DOCUMENTAR EN WIKI
     * Comprueba si el texto proporcionado coincide con el patrón determinado.
     *
     * Esta función es útil para verificar si una cadena de texto cumple con el patrón 'cod_int_0_2_numbers'.
     * Para realizar esta verificación, utiliza la función auxiliar `valida_pattern`.
     *
     * @param int|string|null $txt El texto a verificar. Puede ser un número entero, una cadena de texto, o nulo.
     * @return bool Retorna verdadero si el texto coincided con el patrón. Falso, en caso contrario.
     * @version 4.5.0
     */
    final public function cod_int_0_2_numbers(int|string|null $txt):bool{
        return $this->valida_pattern(key:'cod_int_0_2_numbers', txt:$txt);
    }

    /**
     * Valida un elemento con 3 numeros
     * @param int|string|null $txt
     * @return bool
     */
    final public function cod_int_0_3_numbers(int|string|null $txt):bool{
        return $this->valida_pattern(key:'cod_int_0_3_numbers', txt:$txt);
    }

    /**
     * Valida un codigo con 5 digitos
     * @param int|string|null $txt Texto a verificar
     * @return bool
     * @version 0.34.1
     */
    final public function cod_int_0_5_numbers(int|string|null $txt):bool{
        return $this->valida_pattern(key:'cod_int_0_5_numbers', txt:$txt);
    }

    /**
     * Valida un codigo con 6 digitos
     * @param int|string|null $txt Texto a verificar
     * @return bool
     * @version 0.34.1
     */
    final public function cod_int_0_6_numbers(int|string|null $txt):bool{
        return $this->valida_pattern(key:'cod_int_0_6_numbers', txt:$txt);
    }

    /**
     * Valida un regex con 0 inicial minimo
     * @param int $longitud Longitud de cadena con ceros
     * @param int|string|null $txt Texto a verificar
     * @return bool|array
     * @version 2.49.0
     */
    final public function cod_int_0_n_numbers(int $longitud, int|string|null $txt): bool|array
    {
        if($longitud<=0){
            return $this->error->error(mensaje: 'Error longitud debe ser mayor a 0', data: $longitud);
        }
        $txt = trim($txt);
        if($txt === ''){
            return $this->error->error(mensaje: 'Error txt esta vacio', data: $txt);
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
            return $this->error->error(mensaje: 'Error la tabla no puede venir vacia', data: $tabla);
        }
        $tabla = str_replace('models\\','',$tabla);

        $tabla = trim($tabla);
        if($tabla === ''){
            return $this->error->error(mensaje: 'Error la tabla no puede venir vacia', data: $tabla);
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

    /**
     * POR DOCUMENTAR EN WIKI
     * Comprueba si una clave específica existe en un array.
     *
     * La función 'existe_key_data' recibe dos parámetros: un array y una clave en forma de string.
     * Verifica si la clave proporcionada existe en el array. Si la clave existe en el array, devuelve 'true',
     * en caso contrario, devuelve 'false'.
     *
     * @param  array $arreglo El array en el que queremos buscar la clave.
     * @param  string $key La clave que queremos comprobar si existe en el array.
     * @return bool Devuelve 'true' si la clave existe en el array, 'false' en caso contrario.
     *
     * Ejemplo de uso:
     *
     * ```php
     * $miArray = array(
     *   "clave1" => "valor1",
     *   "clave2" => "valor2"
     * );
     * $miClave = "clave1";
     * $resultado = existe_key_data($miArray, $miClave);
     * ```
     * En este caso, `$resultado` será 'true' ya que "clave1" existe en `$miArray`.
     *
     * @version 3.27.0
     */
    final public function existe_key_data(array $arreglo, string $key ):bool{
        $r = true;
        if(!isset($arreglo[$key])){
            $r = false;
        }
        return $r;
    }

    /**
     * POR DOCUMENTAR EN WIKI
     * Verifica los keys que existen dentro de data para ver que este cargada de manera correcta la fecha
     * @param array|stdClass $data arreglo donde se verificaran las fechas en base a los keys enviados
     * @param array $keys Keys a verificar
     * @param string $tipo_val El key debe ser el tipo val para la obtencion del regex de formato de fecha
     * utiliza los patterns de las siguientes formas
     *          fecha=yyyy-mm-dd
     *          fecha_hora_min_sec_esp = yyyy-mm-dd hh-mm-ss
     *          fecha_hora_min_sec_t = yyyy-mm-ddThh-mm-ss
     * @return true|array
     *
     * @version 3.30.0
     */
    final public function fechas_in_array(array|stdClass $data, array $keys, string $tipo_val = 'fecha'): true|array
    {
        if(is_object($data)){
            $data = (array)$data;
        }
        foreach($keys as $key){

            if($key === ''){
                return $this->error->error(mensaje: "Error key no puede venir vacio", data: $key);
            }
            $valida = $this->existe_key_data(arreglo: $data, key: $key);
            if(!$valida){
                return $this->error->error(mensaje: "Error al validar existencia de key", data: $key);
            }

            $valida = $this->valida_fecha(fecha: $data[$key],tipo_val: $tipo_val);
            if(errores::$error){
                return $this->error->error(mensaje: "Error al validar fecha: ".'$data['.$key.']', data: $valida);
            }
        }
        return true;
    }

    /**
     * POR DOCUMENTAR EN WIKI
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
     */
    final public function id(int|string|null $txt):bool{
        return $this->valida_pattern(key:'id', txt:$txt);
    }

    /**
     * POR DOCUMENTAR EN WIKI
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
     * FINAL REV
     * Verifica si el valor proporcionado es un array.
     *
     * @param mixed $value El valor a verificar.
     *
     * @return bool|array Retorna true si el valor es un array.
     *                    En caso contrario, retorna un array con información del error.
     *
     * @version 3.4.0
     * @por_documentar_wiki
     */
    final public function valida_array(mixed $value): bool|array
    {
        if(!is_array($value)){
            return $this->error->error(mensaje: 'Error el valor no es un array',data: $value,es_final: true);
        }
        return true;
    }

    /**
     * POR DOCUMENTAR EN WIKI FINAL REV
     * Valida la existencia de un conjunto de claves en un array o en un objeto y luego valida todos los
     * elementos de las claves proporcionadas usando el método valida_array.
     *
     * @param array $keys El array que contiene las claves a verificar.
     * @param array|stdClass $row El array u objeto en el que se buscarán las cl.keys.
     *
     * @return true|array Retorna verdadero si la validación es exitosa.
     * Si hay un error, retorna un array con los detalles del error.
     * @version 3.5.0
     *
     */
    final public function valida_arrays(array $keys, array|stdClass $row): true|array
    {
        if(is_object($row)){
            $row = (array)$row;
        }
        if(count($keys) === 0){
            return $this->error->error(mensaje: 'Error keys esta vacio', data: $keys);
        }
        $valida_existe = $this->valida_existencia_keys(keys: $keys,registro: $row);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al validar registro', data: $valida_existe);
        }
        foreach ($keys as $key){
            $valida = $this->valida_array(value: $row[$key]);
            if(errores::$error){
                return $this->error->error(mensaje: 'Error al validar registro['.$key.']', data: $valida);
            }
        }
        return true;
    }

    /**
     * POR DOCUMENTAR EN WIKI FINAL REV
     * Este método se encarga de validar la existencia y el valor correcto de un
     * índice dentro de un array o un objeto stdClass (que será convertido a array).
     *
     * @param string $key La llave que se quiere validar en el registro.
     * @param array|stdClass $registro El array o el objeto stdClass que contiene el dato a validar.
     * @param bool $valida_int Determina si se realiza una validación adicional en el caso
     * que el valor sea un número entero. Por defecto es true, indicando que los valores
     * integer deben ser mayores a 0 para ser considerados válidos.
     *
     * @return true|array Retorna true en caso de que todas las validaciones sean correctas.
     * Si se llega a encontrar algún error, se retorna un array con información del error
     * generado.
     *
     * @throws errores En caso de encontrar un error, se lanza una excepción con una
     * descripción del mismo.
     *
     * Ejemplos de uso:
     *
     * valida_base('nombre', ['nombre' => 'Luis', 'edad'=> 24]);
     * valida_base('numero', ['numero' => 123, 'edad'=> 24]);
     * valida_base('nombre', (object)['nombre' => 'Luis', 'edad'=> 24], false);
     *
     * @author Martin Gamboa
     * @version 3.12.0
     */
    private function valida_base(string $key, array|stdClass $registro, bool $valida_int = true): true|array
    {
        $key = trim($key);
        if($key === ''){
            return $this->error->error(mensaje: 'Error key no puede venir vacio '.$key,data: $registro
                , es_final: true);
        }

        if(is_object($registro)){
            $registro = (array) $registro;
        }

        if(!isset($registro[$key])){
            return $this->error->error(mensaje:'Error no existe en registro el key '.$key,data:$registro
                , es_final: true);
        }
        if((string)$registro[$key] === ''){
            return $this->error->error(mensaje:'Error esta vacio '.$key,data:$registro, es_final: true);
        }
        if($valida_int) {
            if ((int)$registro[$key] <= 0) {
                return $this->error->error(mensaje: 'Error el ' . $key . ' debe ser mayor a 0', data: $registro
                    , es_final: true);
            }
        }

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
     * POR DOCUMENTAR EN WIKI
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
            return $this->error->error(mensaje: 'Error el celda esta vacia', data: $celda);
        }

        $es_celda = $this->valida_pattern(key:'celda_calc', txt:$celda);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error validar regex celda', data: $es_celda);
        }

        if(!$es_celda){
            return $this->error->error(mensaje: 'Error la celda es invalida', data: $this->patterns['celda_calc']);
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
     * Valida que in elemento que sea de una sola letra y sea mayuscula
     * @param string $key Key de array a verificar
     * @param array|object $registro Registro a verificar
     * @return bool|array
     */
    final public function valida_cod_1_letras_mayusc(string $key, array|object $registro): bool|array{

        if(is_object($registro)){
            $registro = (array)$registro;
        }
        $valida = $this->valida_base(key: $key, registro: $registro,valida_int: false);
        if(errores::$error){
            return $this->error->error(mensaje:'Error al validar '.$key ,data:$valida);
        }

        if(!$this->cod_1_letras_mayusc(txt:$registro[$key])){
            return $this->error->error(mensaje:'Error el '.$key.' es invalido',data:$registro);
        }

        return true;
    }

    /**
     * Valida los codigos con 3 letras en mayusculas
     * @param string $key Key a validar
     * @param array $registro Registro donde se encuentra el campo
     * @return bool|array
     */
    final public function valida_cod_3_letras_mayusc(string $key, array $registro): bool|array{

        $valida = $this->valida_base(key: $key, registro: $registro,valida_int: false);
        if(errores::$error){
            return $this->error->error(mensaje:'Error al validar '.$key ,data:$valida);
        }

        if(!$this->cod_3_letras_mayusc(txt:$registro[$key])){
            return $this->error->error(mensaje:'Error el '.$key.' es invalido',data:$registro);
        }

        return true;
    }

    /**
     * Valida un codigo de 3 digitos permisibles con 0 derecha
     * @param string $key Key a validar
     * @param array|stdClass $registro Registro donde se ubica campo a verificar
     * @return bool|array
     */
    final public function valida_cod_int_0_numbers(string $key, array|stdClass $registro): bool|array{

        $valida = $this->valida_base(key: $key, registro: $registro);
        if(errores::$error){
            return $this->error->error(mensaje:'Error al validar '.$key ,data:$valida);
        }

        if(!$this->cod_int_0_numbers(txt:$registro[$key])){
            return $this->error->error(mensaje:'Error el '.$key.' es invalido',data:$registro);
        }

        return true;
    }

    /**
     * Valida un entero de forma 01,02,03,0n donde n es cualquier numero del 0-9
     * @param string $key Key a verificar en el registro
     * @param array|stdClass $registro Registro en proceso
     * @return bool|array
     */
    final public function valida_cod_int_0_2_numbers(string $key, array|stdClass $registro): bool|array{

        if(is_object($registro)){
            $registro = (array) $registro;
        }
        $valida = $this->valida_base(key: $key, registro: $registro);
        if(errores::$error){
            return $this->error->error(mensaje:'Error al validar '.$key ,data:$valida);
        }

        if(!$this->cod_int_0_2_numbers(txt:$registro[$key])){
            return $this->error->error(mensaje:'Error el '.$key.' es invalido',data:$registro);
        }

        return true;
    }

    final public function valida_cod_int_0_3_numbers(string $key, array|stdClass $registro): bool|array{

        if(is_object($registro)){
            $registro = (array) $registro;
        }
        $valida = $this->valida_base(key: $key, registro: $registro);
        if(errores::$error){
            return $this->error->error(mensaje:'Error al validar '.$key ,data:$valida);
        }

        if(!$this->cod_int_0_3_numbers(txt:$registro[$key])){
            return $this->error->error(mensaje:'Error el '.$key.' es invalido',data:$registro);
        }

        return true;
    }

    final public function valida_cod_int_0_5_numbers(string $key, array|stdClass $registro): bool|array{

        $valida = $this->valida_base(key: $key, registro: $registro);
        if(errores::$error){
            return $this->error->error(mensaje:'Error al validar '.$key ,data:$valida);
        }

        if(!$this->cod_int_0_5_numbers(txt:$registro[$key])){
            return $this->error->error(mensaje:'Error el '.$key.' es invalido',data:$registro);
        }

        return true;
    }

    /**
     * Valida un numero con 6 digitos con 0 iniciales
     * @param string $key Key de row a validar
     * @param array|stdClass $registro Registro a validar
     * @return bool|array
     * @version 0.37.1
     */
    final public function valida_cod_int_0_6_numbers(string $key, array|stdClass $registro): bool|array{

        $valida = $this->valida_base(key: $key, registro: $registro);
        if(errores::$error){
            return $this->error->error(mensaje:'Error al validar '.$key ,data:$valida);
        }

        if(!$this->cod_int_0_6_numbers(txt:$registro[$key])){
            return $this->error->error(mensaje:'Error el '.$key.' es invalido',data:$registro);
        }

        return true;
    }

    /**
     * Se integra validacion cd 0 to n number con prefijos 0
     * @param string $key Key a validar
     * @param int $longitud Longitud
     * @param array|stdClass $registro Registro
     * @return bool|array
     */
    final public function valida_cod_int_0_n_numbers(string $key, int $longitud, array|stdClass $registro): bool|array{

        $valida = $this->valida_base(key: $key, registro: $registro);
        if(errores::$error){
            return $this->error->error(mensaje:'Error al validar '.$key ,data:$valida);
        }

        if(!$this->cod_int_0_n_numbers(longitud: $longitud, txt:$registro[$key])){
            return $this->error->error(mensaje:'Error el '.$key.' es invalido',data:$registro);
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
     * Valida que un conjunto de keys cumplan con la validacion de codigos del tipo 01,02,0n donde n sea del 1-9
     * @param array $keys Keys a validar
     * @param array|object $registro Registro a validar
     * @return array
     */
    final public function valida_codigos_int_0_2_numbers(array $keys, array|object $registro):array{
        if(count($keys) === 0){
            return $this->error->error(mensaje: "Error keys vacios",data: $keys);
        }

        if(is_object($registro)){
            $registro = (array)$registro;
        }

        foreach($keys as $key){
            if($key === ''){
                return $this->error->error(mensaje:'Error '.$key.' Invalido esta vacio',data:$registro);
            }
            if(!isset($registro[$key])){
                return  $this->error->error(mensaje:'Error no existe '.$key,data:$registro);
            }
            $id_valido = $this->valida_cod_int_0_2_numbers(key: $key, registro: $registro);
            if(errores::$error){
                return  $this->error->error(mensaje:'Error '.$key.' Invalido',data:$id_valido);
            }
        }
        return array('mensaje'=>'ids validos',$registro,$keys);
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

    final public function valida_codigos_int_0_6_numbers(array $keys, array|object $registro):array{
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
            $id_valido = $this->valida_cod_int_0_6_numbers(key: $key, registro: $registro);
            if(errores::$error){
                return  $this->error->error(mensaje:'Error '.$key.' Invalido',data:$id_valido);
            }
        }
        return array('mensaje'=>'ids validos',$registro,$keys);
    }

    final public function valida_codigos_int_0_n_numbers(array $keys, int $longitud, array|object $registro):array{
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
     *
     * POR DOCUMENTAR EN WIKI ERROR REV
     * Funcion que valida la existencia y forma de un modelo enviando un txt con el nombre del modelo a validar
     * @version 1.0.0
     *
     * @param string $name_modelo txt con el nombre del modelo a validar
     * @example
     *     $valida = $this->valida_data_modelo($name_modelo);
     *
     * @return array|string $name_modelo
     */
    final public function valida_data_modelo(string $name_modelo):array|bool{
        $name_modelo = trim($name_modelo);
        $name_modelo = str_replace('models\\','',$name_modelo);
        if(trim($name_modelo) ===''){
            return $this->error->error(mensaje: "Error modelo vacio",data: $name_modelo, es_final: true);
        }
        if(is_numeric($name_modelo)){
            return $this->error->error(mensaje:"Error modelo",data:$name_modelo, es_final: true);
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
     * Valida que un estilo css sea valido
     * @param mixed $style Valor a revisar
     * @return array|bool
     * @version 0.40.1
     */
    final public function valida_estilo_css(mixed $style):array|bool{
        if(!is_string($style)){
            return $this->error->error(mensaje: 'Error style debe ser un texto ',data: $style);
        }
        $style = trim($style);
        if($style === ''){
            return $this->error->error(mensaje: 'Error style esta vacio ',data: $style);
        }

        if(is_numeric($style)){
            return $this->error->error(mensaje: 'Error style debe ser un texto ',data: $style);
        }

        if(!in_array($style, $this->styles_css)){
            return $this->error->error(mensaje: 'Error style invalido '.$style,data: $this->styles_css);
        }

        return  true;
    }

    final public function valida_estilos_css(array $keys, array|stdClass $row): bool|array
    {
        if(is_object($row)){
            $row = (array)$row;
        }
        $valida_existe = $this->valida_existencia_keys(keys: $keys,registro: $row);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al validar registro', data: $valida_existe);
        }
        foreach ($keys as $key){
            $valida = $this->valida_estilo_css(style: $row[$key]);
            if(errores::$error){
                return $this->error->error(mensaje: 'Error al validar registro['.$key.']', data: $valida);
            }
        }
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
     * POR DOCUMENTAR EN WIKI FINAL REV
     * Valida la existencia de varias claves en un registro dado.
     *
     * @param array $keys          Las claves que se van a validar en el registro.
     * @param mixed $registro      El registro en el que se va a buscar las claves.
     * @param bool  $valida_vacio  Controla si se debería validar la existencia de claves vacías.
     *
     * @return array|true  Retorna un array  si ocurre un error y true si todo está bien.
     * @version 3.2.0
     *
     */
    final public function valida_existencia_keys(array $keys, mixed $registro, bool $valida_vacio = true):array|true{

        if(is_object($registro)){
            $registro = (array)$registro;
        }
        foreach ($keys as $key){
            if($key === ''){
                return $this->error->error(mensaje:'Error '.$key.' no puede venir vacio',data: $keys
                    , es_final: true);
            }
            if(!isset($registro[$key])){
                return $this->error->error(mensaje: 'Error '.$key.' no existe en el registro', data: $registro
                    , es_final: true);
            }
            if($registro[$key] === '' && $valida_vacio){
                return $this->error->error(mensaje: 'Error '.$key.' esta vacio en el registro', data: $registro
                    , es_final: true);
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
     * POR DOCUMENTAR EN WIKI
     * Valida una fecha.
     *
     * @param mixed $fecha La fecha que se necesita validar. Debe ser una cadena de texto.
     * @param string $tipo_val El tipo de validación que se realizará. Debe ser una de las fechas válidas predefinidas.
     *
     * @return array|bool Retorna true si la fecha es válida.
     * Si la fecha no es válida, retorna un array que contiene un mensaje de error y parte de datos proporcionados.
     *
     * @throws errores Si la fecha no es una cadena de texto o si el tipo de validación no es válido.
     * @version 3.29.0
     */
    final public function valida_fecha(mixed $fecha, string $tipo_val = 'fecha'): array|true
    {
        if(!is_string($fecha)){
            return $this->error->error(mensaje: 'Error la fecha debe ser un texto', data: $fecha);
        }
        $fecha = trim($fecha);
        if($fecha === ''){
            return $this->error->error(mensaje: 'Error la fecha esta vacia', data: $fecha);
        }
        $tipo_val = trim($tipo_val);
        if($tipo_val === ''){
            return $this->error->error(mensaje: 'Error tipo_val no puede venir vacio', data: $tipo_val);
        }

        if(!in_array($tipo_val, $this->regex_fecha, true)){
            return $this->error->error(mensaje: 'Error el tipo val no pertenece a fechas validas',
                data: $this->regex_fecha);
        }

        if(! $this->valida_pattern(key: $tipo_val,txt: $fecha)){
            return $this->error->error(mensaje: 'Error fecha invalida', data: $fecha);
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
     * POR DOCUMENTAR EN WIKI
     * Valida un identificador en PHP.
     *
     * Esta función toma como argumentos una clave $key y un array $registro y realiza una validación.
     * Al principio, la función llama a 'valida_base' pasando la clave y el registro como parámetros.
     * Si 'valida_base' devuelve un error, 'valida_id' devuelve el error.
     * En el siguiente paso, comprueba si el valor del registro asociado con la clave es un identificador válido.
     * Si no es un identificador válido, devuelve un error. De lo contrario, devuelve verdadero.
     *
     * @param string $key La clave a validar.
     * @param array $registro Un array que contiene los registros a validar.
     *
     * @return true|array Si la verificación es correcta, se devuelve true. Si hay algún error, se devuelve un array con errores.
     *
     * @example
     * $validacion = new validacion();
     * $idValido = $validacion->valida_id('id', ['id' => '12345']);
     * if ($idValido === true) {
     *   echo "El id es válido.";
     * } else {
     *   echo "Hubo un error en la validación. Errores: ";
     *   print_r($idValido);
     * }
     * @version 3.17.0
     **/
    final public function valida_id(string $key, array $registro): true|array{
        $valida = $this->valida_base(key: $key, registro: $registro);
        if(errores::$error){
            return $this->error->error(mensaje:'Error al validar '.$key ,data:$valida);
        }
        if(!$this->id(txt:$registro[$key])){
            return $this->error->error(mensaje:'Error el '.$key.' es invalido',data:$registro);
        }

        return true;
    }

    /**
     * POR DOCUMENTAR EN WIKI
     * Valida las claves proporcionadas en los registros correspondientes.
     *
     * @param array $keys Una matriz de claves para validar en el registro.
     * @param array|object|string $registro El registro en el que se validarán las claves. Puede ser un array, un objeto o una cadena.
     *
     * @return array Devuelve un array con los mensajes de estado y los registros válidos. En caso de error, devuelve
     * el mensaje de error correspondiente con detalles.
     *
     * @throws errores Lanza una excepción en caso de que los registros sean de tipo string o las claves estén vacías.
     *
     * @example
     * Uso básico:
     * ```php
     * $validacion = new Validacion();
     * $resultado = $validacion->valida_ids(['id1', 'id2'], ['id1' => '123', 'id2' => '456']);
     * print_r($resultado);
     * ```
     *  Salida:
     * ```php
     * [
     *     'mensaje' => 'ids validos',
     *     ['id1' => '123', 'id2' => '456'],
     *     ['id1', 'id2']
     * ]
     * ```
     *
     * @see valida_id() Donde cada identificador individual es validado.
     * @version 3.18.0
     */
    final public function valida_ids(array $keys, array|object|string $registro):array{
        if(is_string($registro)){
            return $this->error->error(mensaje: "Error registro debe ser un array",data: $keys);
        }

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
            $id_valido = $this->valida_id(key: $key, registro: $registro);
            if(errores::$error){
                return  $this->error->error(mensaje:'Error '.$key.' Invalido',data:$id_valido);
            }
        }
        return array('mensaje'=>'ids validos',$registro,$keys);
    }

    /**
     * POR DOCUMENTAR EN WIKI
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
     * Valida que una lada sea correcta con formato de mexico de 2 a 3 numeros
     * @param string $lada Lada a validar
     * @return bool|array
     * @version 2.60.0
     */
    final public function valida_lada(string $lada): bool|array
    {
        $lada = trim($lada);
        if($lada === ''){
            return $this->error->error(mensaje: 'Error lada vacia',data:  $this->patterns['lada']);
        }
        if(!is_numeric($lada)){
            return $this->error->error(mensaje: 'Error lada debe ser un numero',data:  $this->patterns['lada']);
        }

        $es_valida = $this->valida_pattern(key: 'lada',txt:  $lada);
        if(!$es_valida){
            return $this->error->error(mensaje: 'Error lada invalida',data:  $this->patterns['lada']);
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
     * Valida un numero telefonico sin lada mexicano 7 a 8 numeros
     * @param string $tel Telefono a validar
     * @return bool|array
     * @version 2.63.0
     */
    final public function valida_numero_sin_lada(string $tel): bool|array
    {
        $tel = trim($tel);
        if($tel === ''){
            return $this->error->error(mensaje: 'Error tel vacia',data:  $this->patterns['tel_sin_lada']);
        }
        if(!is_numeric($tel)){
            return $this->error->error(mensaje: 'Error tel debe ser un numero',data:  $this->patterns['tel_sin_lada']);
        }

        $es_valida = $this->valida_pattern(key: 'tel_sin_lada',txt:  $tel);
        if(!$es_valida){
            return $this->error->error(mensaje: 'Error telefono invalido',data:  $this->patterns['tel_sin_lada']);
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
     * POR DOCUMENTAR EN WIKI FINAL REV
     * Función para validar una cadena de texto según un patrón regex predefinido.
     *
     * @param string $key La llave del patrón predefinido a utilizar para la validación.
     * @param string $txt La cadena de texto a validar.
     *
     * @return bool Regresa verdadero si la cadena coincide con el patrón. Falso en caso contrario.
     * @version 3.8.0
     */
    final public function valida_pattern(string $key, string $txt):bool{
        if($key === ''){
            return false;
        }
        if(!isset($this->patterns[$key])){
            return false;
        }
        $result = preg_match($this->patterns[$key], $txt);
        $r = false;
        if((int)$result !== 0){
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
     *
     * Funcion que valida que un campo de status sea valido
     * @param array $keys keys del registro a validar campos
     * @param array|stdClass $registro registro a validar campos
     * @return array|bool resultado de la validacion
     * @example
     *       $valida = $this->validaciones->valida_statuses($entrada_producto,array('producto_es_inventariable'));
     * @internal $this->valida_existencia_keys($registro,$keys);
     */
    final public function valida_statuses(array $keys, array|stdClass $registro):array|bool{
        if(is_object($registro)){
            $registro = (array)$registro;
        }
        $valida_existencias = $this->valida_existencia_keys(keys: $keys, registro: $registro);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error status invalido',data: $valida_existencias);
        }
        foreach ($keys as $key){
            if($registro[$key] !== 'activo' && $registro[$key]!=='inactivo'){
                return $this->error->error(mensaje: 'Error '.$key.' debe ser activo o inactivo',data: $registro);
            }
        }
        return true;
    }

    /**
     * POR DOCUMENTAR EN WIKI
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
                data: array($this->patterns['texto_pep_8'],$txt));
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