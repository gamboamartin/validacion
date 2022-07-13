<?php
namespace gamboamartin\validacion;

use gamboamartin\errores\errores;
use JetBrains\PhpStorm\Pure;
use stdClass;

class validacion {
    public array $patterns = array();
    protected errores $error;
    private array $regex_fecha = array();
    #[Pure] public function __construct(){
        $this->error = new errores();
        $fecha = "[1-2][0-9]{3}-((0[1-9])|(1[0-2]))-((0[1-9])|([1-2][0-9])|(3)[0-1])";
        $hora_min_sec = "(([0-1][0-9])|(2[0-3])):([0-5][0-9]):([0-5][0-9])";
        $funcion = "([a-z]+)((_?[a-z]+)|[a-z]+)*";
        $filtro = "$funcion\.$funcion(\.$funcion)*";
        $file_php = "$filtro\.php";
        $fecha_hms_punto = "$fecha\.$hora_min_sec";

        $this->patterns['letra_numero_espacio'] = '/^(([a-zA-Z áéíóúÁÉÍÓÚñÑ]+[1-9]*)+(\s)?)+([a-zA-Z áéíóúÁÉÍÓÚñÑ]+[1-9]*)*$/';
        $this->patterns['id'] = '/^[1-9]+[0-9]*$/';
        $this->patterns['fecha'] = "/^$fecha$/";
        $this->patterns['hora_min_sec'] = "/^$hora_min_sec$/";
        $this->patterns['fecha_hora_min_sec_esp'] = "/^$fecha $hora_min_sec$/";
        $this->patterns['fecha_hora_min_sec_t'] = "/^$fecha".'T'."$hora_min_sec$/";
        $this->patterns['double'] = '/^[0-9]*.[0-9]*$/';
        $this->patterns['nomina_antiguedad'] = "/^P[0-9]+W$/";
        $this->patterns['correo'] = "/^[a-z0-9!#$%&'*+=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$/";
        $this->patterns['telefono_mx'] = "/^[1-9]{1}[0-9]{9}$/";

        $this->patterns['funcion'] = "/^$funcion$/";
        $this->patterns['filtro'] = "/^$filtro$/";
        $this->patterns['file_php'] = "/^$file_php$/";
        $this->patterns['file_service_lock'] = "/^$file_php\.lock$/";
        $this->patterns['file_service_info'] = "/^$file_php\.$fecha_hms_punto\.info$/";

        $this->regex_fecha[] = 'fecha';
        $this->regex_fecha[] = 'fecha_hora_min_sec_esp';
        $this->regex_fecha[] = 'fecha_hora_min_sec_t';
    }

    /**
     * Verifica los datos minimos necesarios para la creacion de un boton en html
     * @version 1.0.0
     * @param array $data_boton datos['filtro'=>array(),'id', 'etiqueta]
     * @return bool|array Bool true si es exito
     */
    public function btn_base(array $data_boton): bool|array
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
    public function btn_second(array $data_boton): bool|array
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
    public function existe_key_data(array $arreglo, string $key ):bool{
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
    public function fechas_in_array(array|stdClass $data, array $keys, string $tipo_val = 'fecha'): bool|array
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
    public function id(int|string|null $txt):bool{
        return $this->valida_pattern(key:'id', txt:$txt);
    }

    /**
     *  P ORDER P INT
     * @return string[]
     */
    private function keys_documentos(): array
    {
        return array('ruta','ruta_relativa','ruta_absoluta');
    }

    /**
     * PROBADO-PARAMS ORDER P INT
     * Funcion para validar letra numero espacio
     *
     * @param  string $txt valor a validar
     *
     * @example
     *      $etiqueta = 'xxx xx';
     *      $this->validacion->letra_numero_espacio($etiqueta);
     *
     * @return bool true si cumple con pattern false si no cumple
     */
    public function letra_numero_espacio(string $txt):bool{
        return $this->valida_pattern(key: 'letra_numero_espacio',txt: $txt);
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
    public function seccion_accion(string $accion, string $seccion):array|bool{
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
     * PRUEBAS FINALIZADAS
     * @param $codigo
     * @return bool|array
     */
    public function upload($codigo): bool|array
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
     * Funcion que valida los campos obligatorios para una transaccion
     * @version 0.13.1
     * @param array $campos_obligatorios
     * @param array $registro
     * @param string $tabla
     * @return array $this->campos_obligatorios
     * @example
     *     $valida_campo_obligatorio = $this->valida_campo_obligatorio();
     */
    public function valida_campo_obligatorio(array $campos_obligatorios, array $registro, string $tabla):array{
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
        $class = str_replace('models\\','',$class);
        $class = 'models\\'.$class;

        if($tabla === ''){
            return $this->error->error(mensaje: 'Error tabla no puede venir vacia',data: $tabla);
        }
        if($class === ''){
            return $this->error->error(mensaje:'Error $class no puede venir vacia',data: $class);
        }
        if(!class_exists($class)){
            return $this->error->error(mensaje:'Error CLASE no existe '.$class,data: $tabla);
        }
        return true;
    }

    /**
     * P INT P ORDER ERROR
     * Funcion para verificar que dentro de un registro exista de manera correcta colonia_id
     * @param array $registro Registro a validar
     * @return bool|array array si hay error
     */
    public function valida_colonia(array $registro): bool|array
    {
        $keys = array('colonia_id');
        $valida = $this->valida_ids(keys: $keys, registro: $registro);
        if (errores::$error) {
            return $this->error->error(mensaje: 'Error al validar registro', data: $valida, params: get_defined_vars());
        }
        return true;
    }

    protected function valida_cons_empresa(): bool|array
    {
        if(!defined('EMPRESA_EJECUCION')){
            return $this->error->error('Error no existe empresa en ejecucion', '');
        }
        if(!is_array(EMPRESA_EJECUCION)){
            return $this->error->error('Error EMPRESA_EJECUCION debe ser un array', EMPRESA_EJECUCION);
        }
        return true;
    }

    /**
     * PARAMS-ORDER P INT ERRREV DOC
     * Valida si un correo es valido
     * @param string $correo txt con correo a validar
     * @return bool|array bool true si es un correo valido, array si error
     */
    public function valida_correo(string $correo): bool|array
    {
        $valida = $this->correo(correo: $correo);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error el correo es invalido',data:  $valida,
                params: get_defined_vars());
        }
        if(!$valida){
            return $this->error->error(mensaje: 'Error el correo es invalido',data:  $correo,
                params: get_defined_vars());
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
    public function valida_correos( array $keys, array $registro): bool|array
    {
        if(count($keys) === 0){
            return $this->error->error(mensaje: "Error keys vacios",data: $keys, params: get_defined_vars());
        }
        foreach($keys as $key){
            if($key === ''){
                return $this->error->error(mensaje: 'Error '.$key.' Invalido',data: $registro,
                    params: get_defined_vars());
            }
            if(!isset($registro[$key])){
                return  $this->error->error(mensaje: 'Error no existe '.$key,data: $registro,
                    params: get_defined_vars());
            }
            if(trim($registro[$key]) === ''){
                return  $this->error->error(mensaje: 'Error '.$key.' vacio',data: $registro,
                    params: get_defined_vars());
            }
            $value = (string)$registro[$key];
            $correo_valido = $this->valida_correo(correo: $value);
            if(errores::$error){
                return  $this->error->error(mensaje: 'Error '.$key.' Invalido',data: $correo_valido,
                    params: get_defined_vars());
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
    public function valida_data_modelo(string $name_modelo):array|bool{
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
     * ERROR
     * @param string $value valor a validar
     * @return array con exito y valor
     * @throws errores (string)$value === ''
     * @throws errores (float)$value <= 0.0
     * @throws errores pattern de double
     * @example
     *      $valida = $this->valida_double_mayor_0($registro[$key]);
     * @uses validacion
     * @uses entrada_producto
     * @uses producto
     * @internal  $this->valida_pattern('double',$value)
     */
    public function valida_double_mayor_0(string $value):array{
        if($value === ''){
            return $this->error->error(mensaje: 'Error esta vacio '.$value,data: $value, params: get_defined_vars());
        }
        if((float)$value <= 0.0){
            return $this->error->error(mensaje: 'Error el '.$value.' debe ser mayor a 0',data: $value,
                params: get_defined_vars());
        }

        if(! $this->valida_pattern(key: 'double',txt: $value)){
            return $this->error->error(mensaje: 'Error valor vacio['.$value.']',data: $value, params: get_defined_vars());
        }

        return array('mensaje'=>'exito',$value);
    }

    /**
     * PHPUNIT
     * Valida que un numero sea mayor o igual a 0 y cumpla con forma de un numero
     * @param string $value valor a validar
     * @return array con exito y valor
     * @throws errores (string)$value === ''
     * @throws errores (float)$value < 0.0
     * @throws errores pattern double
     * @example
     *        $valida = $this->validaciones->valida_double_mayor_igual_0($movimiento['valor_unitario']);
     * @uses producto
     * @internal  $this->valida_pattern('double',$value)
     */
    public function valida_double_mayor_igual_0(string $value): array
    {

        if($value === ''){
            return $this->error->error('Error no existe '.$value,$value);
        }
        if((float)$value < 0.0){
            return $this->error->error('Error el '.$value.' debe ser mayor a 0',$value);
        }
        if(!is_numeric($value)){
            return $this->error->error('Error el '.$value.' debe ser un numero',$value);
        }

        if(! $this->valida_pattern('double',$value)){
            return $this->error->error('Error valor vacio['.$value.']',$value);
        }

        return array('mensaje'=>'exito',$value);
    }

    /**
     * PHPUNIT
     * Valida que un conjunto de  numeros sea mayor a 0 y no este vacio
     * @param array  $registro valores a validar
     * @param array  $keys keys de registros a validar
     * @return array con exito y registro
     * @throws errores definidos en internals
     * @example
     *       $valida = $this->validacion->valida_double_mayores_0($_POST, $keys);
     * @uses controlador_traspaso
     * @uses entrada_producto
     * @uses producto
     * @uses traspaso_producto
     * @internal  $this->valida_existencia_keys($registro,$keys);
     * @internal  $this->valida_double_mayor_0($registro[$key]);
     */
    public function valida_double_mayores_0(array $registro, array $keys):array{
        $valida = $this->valida_existencia_keys(keys: $keys, registro: $registro,);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al validar $registro no existe un key ',data: $valida,
                params: get_defined_vars());
        }

        foreach($keys as $key){
            $valida = $this->valida_double_mayor_0($registro[$key]);
            if(errores::$error){
                return$this->error->error(mensaje: 'Error $registro['.$key.']',data: $valida, params: get_defined_vars());
            }
        }
        return array('mensaje'=>'exito',$registro);
    }

    /**
     * PHPUNIT
     * @param array $registro
     * @param array $keys
     * @return array
     */
    public function valida_double_mayores_igual_0(array $registro, array $keys):array{
        $valida = $this->valida_existencia_keys($registro,$keys);
        if(errores::$error){
            return $this->error->error('Error al validar $registro no existe un key ',$valida);
        }

        foreach($keys as $key){
            $valida = $this->valida_double_mayor_igual_0($registro[$key]);
            if(errores::$error){
                return$this->error->error('Error $registro['.$key.']',$valida);
            }
        }
        return array('mensaje'=>'exito',$registro);
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
    public function valida_estructura_input_base(array $columnas, string $tabla):array|bool{
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
    public function valida_estructura_menu(int $menu_id):array|bool{
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
    public function valida_estructura_seccion_accion(string $accion, string $seccion):array|bool{ //FIN PROT
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
    public function valida_existencia_keys(array $keys, mixed $registro, bool $valida_vacio = true):array|bool{

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
    public function valida_extension_doc(string $path): bool|array
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
    public function valida_fecha(string $fecha, string $tipo_val = 'fecha'): array|bool
    {
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
    public function valida_filtro_especial(string $campo, array $filtro):array|bool{ //DOC //DEBUG
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
     * PROBADO
     * @return bool|array
     */
    public function valida_filtros(): bool|array
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
    public function valida_id(string $key, array $registro): bool|array{
        $key = trim($key);
        if($key === ''){
            return $this->error->error(mensaje: 'Error key no puede venir vacio '.$key,data: $registro);
        }
        if(!isset($registro[$key])){
            return $this->error->error(mensaje:'Error no existe '.$key,data:$registro);
        }
        if((string)$registro[$key] === ''){
            return $this->error->error(mensaje:'Error esta vacio '.$key,data:$registro);
        }
        if((int)$registro[$key] <= 0){
            return $this->error->error(mensaje:'Error el '.$key.' debe ser mayor a 0',data:$registro);
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
     * @param array|object $registro Registro a validar
     * @return array array con datos del registro y mensaje de exito
     * @version 1.0.0
     * @example
     *      $registro['registro_id'] = 1;
     *      $keys = array('registro_id')
     *      $valida = $this->validacion->valida_ids($registro,$keys);
     *
     */
    public function valida_ids(array $keys, array|object $registro):array{
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
     * P ORDER P INT
     * @param array $registro
     * @return array
     */
    protected function valida_keys_documento(array $registro): array
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
    public function valida_modelo(string $tabla): bool|array
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
    public function valida_name_clase(string $tabla): bool|array
    {
        $namespace = 'models\\';
        $tabla = str_replace($namespace,'',$tabla);
        $clase = $namespace.$tabla;
        if($tabla === ''){
            return $this->error->error(mensaje: 'Error tabla no puede venir vacio',data: $tabla);
        }
        if(!class_exists($clase)){
            return $this->error->error(mensaje: 'Error no existe la clase '.$clase,data: $clase);
        }
        return true;
    }

    /** Valida que un valor sea un numero
     * @version 0.9.1
     * @param mixed $value Valor a verificar
     * @return bool|array
     */
    public function valida_numeric(mixed $value): bool|array
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
    public function valida_numerics(array $keys, array|stdClass $row): bool|array
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
    public function valida_pattern(string $key, string $txt):bool{
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
    public function valida_rango_fecha(array $fechas, string $tipo_val = 'fecha'): array|bool
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
     * P ORDER P INT
     * @param string $seccion
     * @return array
     */
    public function valida_seccion_base( string $seccion): array
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
     * P ORDER P INT
     * Funcion que valida que un campo de status sea valido
     * @param array $registro registro a validar campos
     * @param array $keys keys del registro a validar campos
     * @return array resultado de la validacion
     * @throws errores si valor es diferente de activo inactivo
     * @example
     *       $valida = $this->validaciones->valida_statuses($entrada_producto,array('producto_es_inventariable'));
     * @internal $this->valida_existencia_keys($registro,$keys);
     * @uses clientes
     * @uses entrada_producto
     * @uses producto
     * @uses ubicacion
     */
    public function valida_statuses(array $keys, array $registro):array{
        $valida_existencias = $this->valida_existencia_keys(keys: $keys, registro: $registro);
        if(errores::$error){
            return $this->error->error('Error status invalido',$valida_existencias);
        }
        foreach ($keys as $key){
            if($registro[$key] !== 'activo' && $registro[$key]!=='inactivo'){
                return $this->error->error('Error '.$key.' debe ser activo o inactivo',$registro);
            }
        }
        return array('mensaje'=>'exito',$registro);
    }



}