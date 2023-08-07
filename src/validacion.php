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

        $this->patterns['cod_1_letras_mayusc'] = '/^[A-Z]$/';
        $this->patterns['cod_1_2_letras_mayusc'] = '/^[A-Z]{1,2}$/';
        $this->patterns['cod_3_letras_mayusc'] = '/^[A-Z]{3}$/';
        $this->patterns['texto_pep_8'] = "/^$texto_pep_8$/";
        $this->patterns['param_json'] = "/^$param_json$/";
        $this->patterns['params_json'] = "/^$params_json$/";
        $this->patterns['params_json_parentesis'] = "/^$params_json_parentesis$/";


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
     * Integra a validacion->patterns los regex numericos la veces que este el max_long definido
     * @param int $max_long N veces que se ejecutara la funcion init_cod_int_0_n_numbers
     * @return array
     * @version 2.27.0
     */
    private function base_regex_0_numbers(int $max_long): array
    {
        if($max_long<=0){
            return $this->error->error(mensaje: 'Error max_long debe ser mayor a 0', data: $max_long);
        }
        $longitud_cod_0_n_numbers = 1;
        $patterns = array();
        while($longitud_cod_0_n_numbers <= $max_long){
            $regex = $this->init_cod_int_0_n_numbers(longitud: $longitud_cod_0_n_numbers);
            if(errores::$error){
                return $this->error->error(mensaje: 'Error al inicializar regex', data: $regex);
            }
            $patterns[] = $regex;
            $longitud_cod_0_n_numbers++;
        }
        return $patterns;
    }


    /**
     * Verifica los datos minimos necesarios para la creacion de un boton en html
     * @version 1.0.0
     * @param array $data_boton datos['filtro'=>array(),'id', 'etiqueta]
     * @return bool|array Bool true si es exito
     */
    final public function btn_base(array $data_boton): bool|array
    {
        if(!isset($data_boton['filtro'])){
            return $this->error->error(mensaje: 'Error $data_boton[filtro] debe existir',data: $data_boton);
        }
        if(!is_array($data_boton['filtro'])){
            return $this->error->error(mensaje: 'Error $data_boton[filtro] debe ser un array',data: $data_boton);
        }
        if(!isset($data_boton['id'])){
            return $this->error->error(mensaje: 'Error $data_boton[id] debe existir',data: $data_boton);
        }
        if(!isset($data_boton['etiqueta'])){
            return $this->error->error(mensaje: 'Error $data_boton[etiqueta] debe existir',data: $data_boton);
        }
        return true;
    }

    /**
     * Valida los datos para la emision de un boton
     * @version 1.0.0
     * @param array $data_boton Datos de boton
     * @return bool|array true si son validos los datos
     */
    final public function btn_second(array $data_boton): bool|array
    {
        if(!isset($data_boton['etiqueta'])){
            return $this->error->error(mensaje: 'Error $data_boton[etiqueta] debe existir',data: $data_boton);
        }
        if($data_boton['etiqueta'] === ''){
            return $this->error->error(mensaje: 'Error etiqueta no puede venir vacio',data: $data_boton['etiqueta']);
        }
        if(!isset($data_boton['class'])){
            return $this->error->error(mensaje: 'Error $data_boton[class] debe existir',data: $data_boton);
        }
        if($data_boton['class'] === ''){
            return $this->error->error(mensaje: 'Error class no puede venir vacio',data: $data_boton['class']);
        }
        return true;
    }

    /**
     * Valida regex codigos tres letras con mayusculas A
     * @param int|string|null $txt valor a verificar
     * @return bool
     * @version 0.23.1
     */
    final public function cod_1_letras_mayusc(int|string|null $txt):bool{
        return $this->valida_pattern(key:'cod_1_letras_mayusc', txt:$txt);
    }

    /**
     * Valida regex codigos tres letras con mayusculas AAA
     * @param int|string|null $txt valor a verificar
     * @return bool
     * @version 0.20.1
     */
    final public function cod_3_letras_mayusc(int|string|null $txt):bool{
        return $this->valida_pattern(key:'cod_3_letras_mayusc', txt:$txt);
    }

    /**
     * Valida regex codigos tres letras con mayusculas 000
     * @param int|string|null $txt texto a validar
     * @return bool
     * @version 0.27.1
     */
    final public function cod_int_0_numbers(int|string|null $txt):bool{
        return $this->valida_pattern(key:'cod_int_0_numbers', txt:$txt);
    }

    /**
     * Valida que un codigo sea numero y con 0 iniciales
     * @param int|string|null $txt Texto a validar
     * @return bool
     * @version 2.43.0
     */
    final public function cod_int_0_2_numbers(int|string|null $txt):bool{
        return $this->valida_pattern(key:'cod_int_0_2_numbers', txt:$txt);
    }

    /**
     * Valida un elemento con 3 numeros
     * @param int|string|null $txt
     * @return bool
     * @version 0.33.1
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
     * @return bool
     */
    final public function cod_int_0_n_numbers(int $longitud, int|string|null $txt): bool
    {
        $key = 'cod_int_0_'.$longitud.'_numbers';
        $this->patterns[$key] = "/^[0-9]{$longitud}$/";

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
     * @version 1.0.0
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
     *
     * Verifica si existe un elemento en un array
     * @version 0.7.0
     * @param string $key Key a buscar en el arreglo
     * @param array $arreglo arreglo donde se buscara la llave
     * @return bool
     */
    final public function existe_key_data(array $arreglo, string $key ):bool{
        $r = true;
        if(!isset($arreglo[$key])){
            $r = false;
        }
        return $r;
    }

    /**
     *
     * Verifica los keys que existen dentro de data para ver que este cargada de manera correcta la fecha
     * @version 0.14.1
     * @param array|stdClass $data arreglo donde se verificaran las fechas en base a los keys enviados
     * @param array $keys Keys a verificar
     * @param string $tipo_val El key debe ser el tipo val para la obtencion del regex de formato de fecha
     * utiliza los patterns de las siguientes formas
     *          fecha=yyyy-mm-dd
     *          fecha_hora_min_sec_esp = yyyy-mm-dd hh-mm-ss
     *          fecha_hora_min_sec_t = yyyy-mm-ddThh-mm-ss
     * @return bool|array
     */
    final public function fechas_in_array(array|stdClass $data, array $keys, string $tipo_val = 'fecha'): bool|array
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
     *
     * Funcion para validar la forma correcta de un id
     * @version 0.8.1
     * @param int|string|null $txt valor a validar
     *
     * @return bool true si cumple con pattern false si no cumple
     * @example
     *      $registro['registro_id'] = 1;
     *      $id_valido = $this->validacion->id($registro['registro_id']);
     *
     */
    final public function id(int|string|null $txt):bool{
        return $this->valida_pattern(key:'id', txt:$txt);
    }

    /**
     * Integra una expresion regular del 0 al 9 repitiendo los numeros n veces = a la longittud
     * @param int $longitud Longitud de la cadena permitida de numeros
     * @return string|array
     * @version 1.4.0
     */
    private function init_cod_int_0_n_numbers(int $longitud): string|array
    {
        if($longitud<=0){
            return  $this->error->error(mensaje: 'Error longitud debe ser mayor a 0',data: $longitud);
        }
        $key = 'cod_int_0_'.$longitud.'_numbers';
        $this->patterns[$key] = '/^[0-9]{'.$longitud.'}$/';
        return $this->patterns[$key];
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
     */
    final public function rfc(int|string|null $txt):bool{
        return $this->valida_pattern(key:'rfc', txt:$txt);
    }

    /**
     * Funcion que valida el dato de una seccion corresponda con la existencia de un modelo
     * @version 1.0.0
     * @param string $seccion
     * @return array|bool
     *
     */
    private function seccion(string $seccion):array|bool{
        $seccion = str_replace('models\\','',$seccion);
        $seccion = strtolower(trim($seccion));
        if(trim($seccion) === ''){
            $fix = 'La seccion debe ser un string no numerico y no vacio seccion=elemento_txt_no_numerico_ni_vacio';
            $fix .= 'seccion=tabla';
            return  $this->error->error(mensaje: 'Error seccion  no puede ser vacio',data: $seccion, fix: $fix);
        }
        return true;
    }

    /**
     *
     * verifica los datos de una seccion y una accion sean correctos
     * @version 0.6.0
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
            return  $this->error->error(mensaje: 'Error accion  no puede ser vacio',data: $accion, fix: $fix);
        }
        return true;
    }

    /**
     *
     * @param $codigo
     * @return bool|array
     */
    final public function upload($codigo): bool|array
    {
        switch ($codigo)
        {
            case UPLOAD_ERR_OK: //0
                //$mensajeInformativo = 'El fichero se ha subido correctamente (no se ha producido errores).';
                return true;
            case UPLOAD_ERR_INI_SIZE: //1
                $mensajeInformativo = 'El archivo que se ha intentado subir sobrepasa el límite de tamaño permitido. Revisad la directiva de php.ini UPLOAD_MAX_FILSIZE. ';
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
     * Valida que un elemento sea un array
     * @param mixed $value Valor a validar
     * @return bool|array
     * @version 0.38.1
     */
    final public function valida_array(mixed $value): bool|array
    {
        if(!is_array($value)){
            return $this->error->error(mensaje: 'Error el valor no es un array',data: $value);
        }
        return true;
    }

    /**
     * Valida que un elemento sea un arreglo
     * @param array $keys Conjunto de elementos a verificar
     * @param array|stdClass $row Registro en proceso
     * @return bool|array
     * @version 2.42.0
     */
    final public function valida_arrays(array $keys, array|stdClass $row): bool|array
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
     * Aplica validacion base de keys
     * @param string $key Key a verificar
     * @param array|stdClass $registro Registro a verificar
     * @param bool $valida_int Si valida int valida que el numero sea mayor a 0
     * @return bool|array
     * @version 0.25.1
     */
    private function valida_base(string $key, array|stdClass $registro, bool $valida_int = true): bool|array
    {
        $key = trim($key);
        if($key === ''){
            return $this->error->error(mensaje: 'Error key no puede venir vacio '.$key,data: $registro);
        }

        if(is_object($registro)){
            $registro = (array) $registro;
        }

        if(!isset($registro[$key])){
            return $this->error->error(mensaje:'Error no existe en registro el key '.$key,data:$registro);
        }
        if((string)$registro[$key] === ''){
            return $this->error->error(mensaje:'Error esta vacio '.$key,data:$registro);
        }
        if($valida_int) {
            if ((int)$registro[$key] <= 0) {
                return $this->error->error(mensaje: 'Error el ' . $key . ' debe ser mayor a 0', data: $registro);
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

    final public function valida_cod_1_letras_mayusc(string $key, array $registro): bool|array{

        $valida = $this->valida_base(key: $key, registro: $registro);
        if(errores::$error){
            return $this->error->error(mensaje:'Error al validar '.$key ,data:$valida);
        }

        if(!$this->cod_1_letras_mayusc(txt:$registro[$key])){
            return $this->error->error(mensaje:'Error el '.$key.' es invalido',data:$registro);
        }

        return true;
    }

    final public function valida_cod_3_letras_mayusc(string $key, array $registro): bool|array{

        $valida = $this->valida_base(key: $key, registro: $registro);
        if(errores::$error){
            return $this->error->error(mensaje:'Error al validar '.$key ,data:$valida);
        }

        if(!$this->cod_3_letras_mayusc(txt:$registro[$key])){
            return $this->error->error(mensaje:'Error el '.$key.' es invalido',data:$registro);
        }

        return true;
    }

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
     * @version 2.46.0
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
     * @param array $registro Registro a validar
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
     * @version 2.47.0
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
     * @version 0.44.1
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
     * PARAMS-ORDER P INT ERRREV DOC
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
     * PARAMS ORDER P INT ERRREV DOC
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
     * Funcion que valida la existencia y forma de un modelo enviando un txt con el nombre del modelo a validar
     * @version 1.0.0
     *
     * @param string $name_modelo txt con el nombre del modelo a validar
     * @example
     *     $valida = $this->valida_data_modelo($name_modelo);
     *
     * @return array|string $name_modelo
     * @throws errores $name_modelo = vacio
     * @throws errores $name_modelo = numero
     * @throws errores $name_modelo no existe una clase con el nombre del modelo
     * @uses modelo_basico->asigna_registros_hijo
     * @uses modelo_basico->genera_modelo
     */
    final public function valida_data_modelo(string $name_modelo):array|bool{
        $name_modelo = trim($name_modelo);
        $name_modelo = str_replace('models\\','',$name_modelo);
        if(trim($name_modelo) ===''){
            return $this->error->error(mensaje: "Error modelo vacio",data: $name_modelo);
        }
        if(is_numeric($name_modelo)){
            return $this->error->error(mensaje:"Error modelo",data:$name_modelo);
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
     */
    final public function valida_estructura_menu(int $menu_id):array|bool{
        if(!isset($_SESSION['grupo_id'])){
            return $this->error->error(mensaje: 'Error debe existir grupo_id',data: $_SESSION);
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
     * P INT  P ORDER
     * Valida la estructura
     * @param string $seccion
     * @param string $accion
     * @return array|bool conjunto de resultados
     * @example
     *        $valida = $this->valida_estructura_seccion_accion($seccion,$accion);
     * @uses directivas
     */
    final public function valida_estructura_seccion_accion(string $accion, string $seccion):array|bool{ //FIN PROT
        $seccion = str_replace('models\\','',$seccion);
        $class_model = 'models\\'.$seccion;
        if($seccion === ''){
            return   $this->error->error('$seccion no puede venir vacia', $seccion);
        }
        if($accion === ''){
            return   $this->error->error('$accion no puede venir vacia', $accion);
        }
        if(!class_exists($class_model)){
            return   $this->error->error('no existe la clase '.$seccion, $seccion);
        }
        return true;
    }

    /**
     *
     * Funcion para validar que exista o no sea vacia una llave dentro de un arreglo
     * @version 1.0.0
     * @param array $keys Keys a validar
     * @param array|stdClass $registro Registro a validar
     * @param bool $valida_vacio Si es true verificara el key sea vacio si es false solo valida que existe el key
     * @return array|bool array con datos del registro
     * @example
     *      $keys = array('clase','sub_clase','producto','unidad');
     * $valida = $this->validacion->valida_existencia_keys($datos_formulario,$keys);
     * if(isset($valida['error'])){
     * return $this->errores->error('Error al validar $datos_formulario',$valida);
     * }
     */
    final public function valida_existencia_keys(array $keys, mixed $registro, bool $valida_vacio = true):array|bool{

        if(is_object($registro)){
            $registro = (array)$registro;
        }
        foreach ($keys as $key){
            if($key === ''){
                return $this->error->error(mensaje:'Error '.$key.' no puede venir vacio',data: $keys);
            }
            if(!isset($registro[$key])){
                return $this->error->error(mensaje: 'Error '.$key.' no existe en el registro', data: $registro);
            }
            if($registro[$key] === '' && $valida_vacio){
                return $this->error->error(mensaje: 'Error '.$key.' esta vacio en el registro', data: $registro);
            }
        }

        return true;
    }

    /**
     *
     * @param string $path ruta del documento de dropbox
     * @return bool|array
     */
    final public function valida_extension_doc(string $path): bool|array
    {
        $extension_origen = pathinfo($path, PATHINFO_EXTENSION);
        if(!$extension_origen){
            return $this->error->error('Error el $path no tiene extension', $path);
        }
        return true;
    }

    /**
     *
     * Funcion para validar LA ESTRUCTURA DE UNA FECHA
     * @version 0.7.1
     * @param string $fecha txt con fecha a validar
     * @param string $tipo_val
     *          utiliza los patterns de las siguientes formas
     *          fecha=yyyy-mm-dd
     *          fecha_hora_min_sec_esp = yyyy-mm-dd hh-mm-ss
     *          fecha_hora_min_sec_t = yyyy-mm-ddThh-mm-ss
     *
     * @return array|bool con resultado de validacion
     * @example
     *      $valida_fecha = $this->validaciones->valida_fecha($fecha);
     */
    final public function valida_fecha(mixed $fecha, string $tipo_val = 'fecha'): array|bool
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
     * P INT P ORDER PROBADO
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
     *
     * @uses modelo_basico->obten_filtro_especial
     */
    final public function valida_filtro_especial(string $campo, array $filtro):array|bool{ //DOC //DEBUG
        if(!isset($filtro['operador'])){
            return $this->error->error("Error operador no existe",$filtro);
        }
        if(!isset($filtro['valor_es_campo']) &&is_numeric($campo)){
            return $this->error->error("Error campo invalido",$filtro);
        }
        if(!isset($filtro['valor'])){
            return $this->error->error("Error valor no existe",$filtro);
        }
        if($campo === ''){
            return $this->error->error("Error campo vacio",$campo);
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
     * Valida si un id es valido, en base a los keys a verificar
     * @version 1.0.0
     * @param string $key Key a validar de tipo id
     * @param array $registro Registro a validar
     * @return bool|array array con datos del registro y mensaje de exito
     * @example
     *      $registro['registro_id'] = 1;
     *      $key = 'registro_id';
     *      $id_valido = $this->valida_id($registro, $key);
     */
    final public function valida_id(string $key, array $registro): bool|array{
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
     *
     * Funcion para validar la forma correcta de un id basada en un conjunto de keys para verificar dentro de un
     * registro
     * @param array $keys Keys a validar
     *
     * @param array|object|string $registro Registro a validar
     * @return array array con datos del registro y mensaje de exito
     * @version 1.0.0
     * @example
     *      $registro['registro_id'] = 1;
     *      $keys = array('registro_id')
     *      $valida = $this->validacion->valida_ids($registro,$keys);
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
     * Funcion que revisa si una expresion regular es valida declarada con this->patterns
     * @version 1.0.0
     * @param  string $key key definido para obtener de this->patterns
     * @param  string $txt valor a comparar
     *
     * @example
     *      return $this->valida_pattern('letra_numero_espacio',$txt);
     *
     * @return bool true si cumple con pattern false si no cumple
     * @uses validacion
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
     * TODO Valida un rango de fechas
     * @param array $fechas conjunto de fechas fechas['fecha_inicial'], fechas['fecha_final']
     * @param string $tipo_val
     *          utiliza los patterns de las siguientes formas
     *          fecha=yyyy-mm-dd
     *          fecha_hora_min_sec_esp = yyyy-mm-dd hh-mm-ss
     *          fecha_hora_min_sec_t = yyyy-mm-ddThh-mm-ss
     * @return array|bool true si no hay error
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
     * @version 0.33.1
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
     * Valida que un texto sea valido conforme pep_8
     * @param string $txt Texto a validar
     * @return array|true
     * @example var_a
     * @version 2.33.0
     */
    final public function valida_texto_pep_8(string $txt): bool|array
    {
        $valida = $this->valida_pattern(key: 'texto_pep_8', txt: $txt);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al validar txt', data: $valida);
        }
        if(!$valida){
            return $this->error->error(mensaje: 'Error el txt ex invalido', data: $this->patterns['texto_pep_8']);

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