<?php
namespace tests\src;

use gamboamartin\errores\errores;
use gamboamartin\test\liberator;
use gamboamartin\test\test;
use gamboamartin\validacion\validacion;




class validacionTest extends test {
    public errores $errores;
    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->errores = new errores();
    }

    public function test_btn_base(): void
    {
        errores::$error = false;
        $val = new validacion();

        $data_boton = array();
        $resultado = $val->btn_base($data_boton);
        $this->assertIsArray( $resultado);
        $this->assertStringContainsStringIgnoringCase('Error $data_boton[filtro] debe existir', $resultado['mensaje']);
        $this->assertTrue(errores::$error);

        errores::$error = false;

        $data_boton = array();
        $data_boton['filtro'] = '';
        $resultado = $val->btn_base($data_boton);
        $this->assertIsArray( $resultado);
        $this->assertStringContainsStringIgnoringCase('Error $data_boton[filtro] debe ser un array', $resultado['mensaje']);
        $this->assertTrue(errores::$error);

        errores::$error = false;

        $data_boton = array();
        $data_boton['filtro'] = array();
        $resultado = $val->btn_base($data_boton);
        $this->assertIsArray( $resultado);
        $this->assertStringContainsStringIgnoringCase('Error $data_boton[id] debe existir', $resultado['mensaje']);
        $this->assertTrue(errores::$error);

        errores::$error = false;

        $data_boton = array();
        $data_boton['filtro'] = array();
        $data_boton['id'] = array();
        $resultado = $val->btn_base($data_boton);
        $this->assertIsArray( $resultado);
        $this->assertStringContainsStringIgnoringCase('Error $data_boton[etiqueta] debe existir', $resultado['mensaje']);
        $this->assertTrue(errores::$error);

        errores::$error = false;

        $data_boton = array();
        $data_boton['filtro'] = array();
        $data_boton['id'] = array();
        $data_boton['etiqueta'] = array();
        $resultado = $val->btn_base($data_boton);
        $this->assertIsBool( $resultado);
        $this->assertTrue($resultado);
        $this->assertNotTrue(errores::$error);
        errores::$error = false;
    }

    public function test_btn_second()
    {

        errores::$error = false;
        $validacion = new validacion();
        $data_boton = array();
        $resultado = $validacion->btn_second($data_boton);
        $this->assertIsArray( $resultado);
        $this->assertStringContainsStringIgnoringCase('Error $data_boton[etiqueta] debe existir', $resultado['mensaje']);
        $this->assertTrue(errores::$error);

        errores::$error = false;
        $data_boton = array();
        $data_boton['etiqueta'] = 'a';
        $resultado = $validacion->btn_second($data_boton);
        $this->assertIsArray( $resultado);
        $this->assertStringContainsStringIgnoringCase('Error $data_boton[class] debe existir', $resultado['mensaje']);
        $this->assertTrue(errores::$error);

        errores::$error = false;
        $data_boton = array();
        $data_boton['etiqueta'] = 'a';
        $data_boton['class'] = 'b';
        $resultado = $validacion->btn_second($data_boton);
        $this->assertIsBool( $resultado);
        $this->assertTrue($resultado);
        $this->assertNotTrue(errores::$error);
        errores::$error = false;
    }

    public function test_class_depurada(): void{
        errores::$error = false;
        $val = new validacion();
        $val = new liberator($val);

        $tabla = '';
        $resultado = $val->class_depurada(tabla: $tabla);
        $this->assertIsArray( $resultado);
        $this->assertStringContainsStringIgnoringCase('Error la tabla no puede venir vacia', $resultado['mensaje']);
        $this->assertTrue(errores::$error);

        errores::$error = false;

        $tabla = 'a';
        $resultado = $val->class_depurada(tabla: $tabla);
        $this->assertIsString( $resultado);
        $this->assertEquals('models\\a', $resultado);
        $this->assertNotTrue(errores::$error);
        errores::$error = false;
    }

    public function test_existe_key_data(): void{
        errores::$error = false;
        $val = new validacion();
        $val = new liberator($val);

        $arreglo = array();
        $key = '';
        $resultado = $val->existe_key_data($arreglo, $key);
        $this->assertIsBool( $resultado);
        $this->assertNotTrue($resultado);
        $this->assertNotTrue(errores::$error);

        errores::$error = false;

        $arreglo = array();
        $arreglo['a'] = 'a';
        $key = 'a';
        $resultado = $val->existe_key_data($arreglo, $key);
        $this->assertIsBool( $resultado);
        $this->assertTrue($resultado);
        $this->assertNotTrue(errores::$error);
        errores::$error = false;
    }

    public function test_id(): void{
        errores::$error = false;
        $val = new validacion();
        //$val = new liberator($val);

        $txt = '';
        $resultado = $val->id($txt);
        $this->assertIsBool( $resultado);
        $this->assertNotTrue($resultado);
        $this->assertNotTrue(errores::$error);

        errores::$error = false;

        $txt = '111';
        $resultado = $val->id($txt);
        $this->assertIsBool( $resultado);
        $this->assertTrue($resultado);
        $this->assertNotTrue(errores::$error);
        errores::$error = false;
    }

    public function test_letra_numero_espacio(): void{
        errores::$error = false;
        $val = new validacion();

        $txt = '';
        $resultado = $val->letra_numero_espacio($txt);
        $this->assertIsBool( $resultado);
        $this->assertNotTrue($resultado);
        $this->assertNotTrue(errores::$error);

        $txt = 'a';
        $resultado = $val->letra_numero_espacio($txt);
        $this->assertIsBool( $resultado);
        $this->assertTrue($resultado);
        $this->assertNotTrue(errores::$error);
        errores::$error = false;
    }

    public function test_correo(){

        errores::$error = false;
        $validacion = new validacion();
        $validacion = new liberator($validacion);

        $correo = '';
        $resultado = $validacion->correo($correo);
        $this->assertIsArray( $resultado);
        $this->assertStringContainsStringIgnoringCase('Error el correo esta vacio', $resultado['mensaje']);
        $this->assertTrue(errores::$error);

        errores::$error = false;

        $correo = 'a';
        $resultado = $validacion->correo($correo);
        $this->assertIsBool( $resultado);
        $this->assertNotTrue($resultado);
        $this->assertNotTrue(errores::$error);

        errores::$error = false;

        $correo = 'a@a.com';
        $resultado = $validacion->correo($correo);
        $this->assertIsBool( $resultado);
        $this->assertTrue($resultado);
        $this->assertNotTrue(errores::$error);

        errores::$error = false;
    }

    public function test_seccion(): void{
        errores::$error = false;
        $val = new validacion();
        $val = new liberator($val);

        $seccion = '';
        $resultado = $val->seccion($seccion);
        $this->assertIsArray( $resultado);
        $this->assertStringContainsStringIgnoringCase('Error seccion  no puede ser vacio', $resultado['mensaje']);
        $this->assertTrue(errores::$error);

        errores::$error = false;
        $seccion = 'a';
        $resultado = $val->seccion($seccion);
        $this->assertIsBool( $resultado);
        $this->assertTrue($resultado);
        $this->assertNotTrue(errores::$error);
        errores::$error = false;
    }

    public function test_seccion_accion(): void{
        errores::$error = false;
        $val = new validacion();
        //$val = new liberator($val);

        $seccion = '';
        $accion = '';
        $resultado = $val->seccion_accion($accion, $seccion);
        $this->assertIsArray( $resultado);
        $this->assertStringContainsStringIgnoringCase('Error al validar seccion', $resultado['mensaje']);
        $this->assertTrue(errores::$error);

        errores::$error = false;


        $seccion = 'a';
        $accion = '';
        $resultado = $val->seccion_accion($accion, $seccion);
        $this->assertIsArray( $resultado);
        $this->assertStringContainsStringIgnoringCase('Error accion  no puede ser vacio', $resultado['mensaje']);
        $this->assertTrue(errores::$error);

        errores::$error = false;


        $seccion = 'a';
        $accion = 'b';
        $resultado = $val->seccion_accion($accion, $seccion);
        $this->assertIsBool( $resultado);
        $this->assertTrue($resultado);
        $this->assertNotTrue(errores::$error);

        errores::$error = false;
    }

    public function test_valida_campo_obligatorio(): void
    {
        errores::$error = false;
        $val = new validacion();
        $registro = array();
        $campos_obligatorios = array();
        $tabla = '';
        $resultado = $val->valida_campo_obligatorio(campos_obligatorios: $campos_obligatorios,registro:  $registro,
            tabla: $tabla);

        $this->assertIsArray( $resultado);
        $this->assertEmpty($resultado);
        $this->assertNotTrue(errores::$error);
        errores::$error = false;


    }

    public function test_valida_class(): void
    {
        errores::$error = false;
        $val = new validacion();
        $val = new liberator($val);
        $class = '';
        $tabla = '';
        $resultado = $val->valida_class(class: $class, tabla: $tabla);
        $this->assertIsArray( $resultado);
        $this->assertStringContainsStringIgnoringCase('Error tabla no puede venir vacia', $resultado['mensaje']);
        $this->assertTrue(errores::$error);

        errores::$error = false;
        $class = '';
        $tabla = 'a';
        $resultado = $val->valida_class(class: $class, tabla: $tabla);
        $this->assertIsArray( $resultado);
        $this->assertStringContainsStringIgnoringCase('Error CLASE no existe models', $resultado['mensaje']);
        $this->assertTrue(errores::$error);

        errores::$error = false;
        $class = 'a';
        $tabla = 'a';
        $resultado = $val->valida_class(class: $class, tabla: $tabla);
        $this->assertIsArray( $resultado);
        $this->assertStringContainsStringIgnoringCase('Error CLASE no existe models', $resultado['mensaje']);
        $this->assertTrue(errores::$error);

        errores::$error = false;
        $class = 'a';
        $tabla = 'seccion';
        $resultado = $val->valida_class(class: $class, tabla: $tabla);
        $this->assertIsArray( $resultado);
        $this->assertStringContainsStringIgnoringCase('Error CLASE no existe models', $resultado['mensaje']);
        $this->assertTrue(errores::$error);

        errores::$error = false;
        $class = 'seccion';
        $tabla = 'seccion';
        $resultado = $val->valida_class(class: $class, tabla: $tabla);
        $this->assertIsArray( $resultado);
        $this->assertStringContainsStringIgnoringCase('Error CLASE no existe models', $resultado['mensaje']);
        $this->assertTrue(errores::$error);
        errores::$error = false;

    }

    public function test_valida_data_modelo(): void{
        errores::$error = false;
        $val = new validacion();

        $name_modelo = '';
        $resultado = $val->valida_data_modelo($name_modelo);
        $this->assertIsArray( $resultado);
        $this->assertStringContainsStringIgnoringCase('Error modelo vacio', $resultado['mensaje']);
        $this->assertTrue(errores::$error);

        errores::$error = false;
        $name_modelo = 'z';
        $resultado = $val->valida_data_modelo($name_modelo);
        $this->assertIsArray( $resultado);
        $this->assertStringContainsStringIgnoringCase('Error modelo', $resultado['mensaje']);
        $this->assertTrue(errores::$error);

        errores::$error = false;
        $name_modelo = 'prueba';
        $resultado = $val->valida_data_modelo($name_modelo);
        $this->assertIsBool( $resultado);
        $this->assertNotTrue(errores::$error);
        $this->assertTrue($resultado);

    }


    public function test_valida_estructura_input_base(){
        errores::$error = false;
        $val = new validacion();
        $columnas = array();
        $tabla = '';
        $resultado = $val->valida_estructura_input_base($columnas, $tabla);
        $this->assertIsArray( $resultado);
        $this->assertStringContainsStringIgnoringCase('Error deben existir columnas', $resultado['mensaje']);
        $this->assertTrue(errores::$error);

        errores::$error = false;
        $columnas = array();
        $tabla = '';
        $columnas[] = 'a';
        $resultado = $val->valida_estructura_input_base($columnas, $tabla);
        $this->assertIsArray( $resultado);
        $this->assertStringContainsStringIgnoringCase('Error la tabla no puede venir vacia', $resultado['mensaje']);
        $this->assertTrue(errores::$error);

        errores::$error = false;
        $columnas = array();
        $tabla = 'a';
        $columnas[] = 'a';
        $resultado = $val->valida_estructura_input_base($columnas, $tabla);
        $this->assertIsBool( $resultado);
        $this->assertNotTrue(errores::$error);

        errores::$error = false;
        $columnas = array();
        $tabla = 'prueba';
        $columnas[] = 'a';
        $resultado = $val->valida_estructura_input_base($columnas, $tabla);
        $this->assertIsBool( $resultado);
        $this->assertTrue($resultado);
        $this->assertNotTrue(errores::$error);
        errores::$error = false;

    }

    public function test_valida_existencia_key(): void
    {
        errores::$error = false;
        $val = new validacion();
        $registro = array();
        $keys = array();
        $resultado = $val->valida_existencia_keys(keys: $keys, registro: $registro);
        $this->assertIsBool( $resultado);
        $this->assertTrue($resultado);
        $this->assertNotTrue(errores::$error);


        errores::$error = false;
        $registro = array();
        $keys = array();
        $keys[] = '';
        $resultado = $val->valida_existencia_keys(keys: $keys, registro: $registro);
        $this->assertIsArray( $resultado);
        $this->assertStringContainsStringIgnoringCase('Error  no puede venir vacio', $resultado['mensaje']);
        $this->assertTrue(errores::$error);

        errores::$error = false;
        $registro = array();
        $keys = array();
        $keys[] = 'a';
        $registro['a'] = 'a';
        $resultado = $val->valida_existencia_keys(keys: $keys, registro: $registro);
        $this->assertIsBool( $resultado);
        $this->assertTrue($resultado);
        $this->assertNotTrue(errores::$error);

        errores::$error = false;
        $registro = array();
        $keys = array();
        $keys[] = 'a';
        $registro['a'] = 'a';
        $resultado = $val->valida_existencia_keys(keys: $keys, registro: $registro, valida_vacio: false);
        $this->assertIsBool( $resultado);
        $this->assertTrue($resultado);
        $this->assertNotTrue(errores::$error);

        errores::$error = false;
        $registro = array();
        $keys = array();
        $keys[] = 'a';
        $registro['a'] = '';
        $resultado = $val->valida_existencia_keys(keys: $keys, registro: $registro, valida_vacio: false);
        $this->assertIsBool( $resultado);
        $this->assertTrue($resultado);
        $this->assertNotTrue(errores::$error);
        errores::$error = false;

    }

    public function test_valida_fecha()
    {

        errores::$error = false;
        $validacion = new validacion();
        $fecha = '';
        $resultado = $validacion->valida_fecha($fecha);
        $this->assertIsArray( $resultado);
        $this->assertStringContainsStringIgnoringCase('Error la fecha esta vacia', $resultado['mensaje']);
        $this->assertTrue(errores::$error);

        errores::$error = false;
        $fecha = 'a';
        $resultado = $validacion->valida_fecha($fecha);
        $this->assertIsArray( $resultado);
        $this->assertStringContainsStringIgnoringCase('Error fecha invalida', $resultado['mensaje']);
        $this->assertTrue(errores::$error);

        errores::$error = false;
        $fecha = '2022-01-01';
        $resultado = $validacion->valida_fecha($fecha);
        $this->assertIsBool( $resultado);
        $this->assertTrue($resultado);
        $this->assertNotTrue(errores::$error);

        errores::$error = false;
        $fecha = '2022-01-01';
        $resultado = $validacion->valida_fecha($fecha, 'fecha');
        $this->assertIsBool( $resultado);
        $this->assertTrue($resultado);
        $this->assertNotTrue(errores::$error);

        errores::$error = false;
        $fecha = '2022-01-01 01:01:11';
        $resultado = $validacion->valida_fecha($fecha, 'fecha');
        $this->assertIsArray( $resultado);
        $this->assertStringContainsStringIgnoringCase('Error fecha invalida', $resultado['mensaje']);
        $this->assertTrue(errores::$error);

        errores::$error = false;
        $fecha = '2022-01-01 01:01:11';
        $resultado = $validacion->valida_fecha($fecha, 'fecha_hora_min_sec_esp');
        $this->assertIsBool( $resultado);
        $this->assertTrue($resultado);
        $this->assertNotTrue(errores::$error);

        errores::$error = false;
        $fecha = '2022-01-01';
        $resultado = $validacion->valida_fecha($fecha, 'fecha_hora_min_sec_esp');
        $this->assertIsArray( $resultado);
        $this->assertStringContainsStringIgnoringCase('Error fecha invalida', $resultado['mensaje']);
        $this->assertTrue(errores::$error);

        errores::$error = false;
        $fecha = '2022-01-01 12:54:41';
        $resultado = $validacion->valida_fecha($fecha, 'fecha_hora_min_sec_esp');
        $this->assertIsBool( $resultado);
        $this->assertTrue($resultado);
        $this->assertNotTrue(errores::$error);

        errores::$error = false;
        $fecha = '2022-01-01T12:54:41';
        $resultado = $validacion->valida_fecha($fecha, 'fecha_hora_min_sec_esp');
        $this->assertIsArray( $resultado);
        $this->assertStringContainsStringIgnoringCase('Error fecha invalida', $resultado['mensaje']);
        $this->assertTrue(errores::$error);

        errores::$error = false;
        $fecha = '2022-01-01T12:54:41';
        $resultado = $validacion->valida_fecha($fecha, 'fecha_hora_min_sec_t');
        $this->assertIsBool( $resultado);
        $this->assertTrue($resultado);
        $this->assertNotTrue(errores::$error);

        errores::$error = false;
        $fecha = '2022-01-01T12:54:41';
        $resultado = $validacion->valida_fecha($fecha, '');
        $this->assertIsArray( $resultado);
        $this->assertStringContainsStringIgnoringCase('Error tipo_val no puede venir vacio', $resultado['mensaje']);
        $this->assertTrue(errores::$error);

        errores::$error = false;
        $fecha = '2022-01-01T12:54:41';
        $resultado = $validacion->valida_fecha($fecha, 'xxx');
        $this->assertIsArray( $resultado);
        $this->assertStringContainsStringIgnoringCase('Error el tipo val no pertenece a fechas validas',
            $resultado['mensaje']);
        $this->assertTrue(errores::$error);

        errores::$error = false;
    }

    public function test_valida_filtro_especial(){

        errores::$error = false;
        $validacion = new validacion();
        $campo = '';
        $filtro = array();
        $resultado = $validacion->valida_filtro_especial($campo, $filtro);
        $this->assertIsArray( $resultado);
        $this->assertStringContainsStringIgnoringCase('Error operador no existe', $resultado['mensaje']);
        $this->assertTrue(errores::$error);

        errores::$error = false;

        $campo = 'z';
        $filtro = array();
        $filtro['operador'] = 'a';
        $filtro['valor'] = 'a';
        $resultado = $validacion->valida_filtro_especial($campo, $filtro);
        $this->assertIsBool( $resultado);
        $this->assertTrue($resultado);
        $this->assertNotTrue(errores::$error);
        errores::$error = false;
    }

    public function test_valida_filtros(): void{
        errores::$error = false;
        $val = new validacion();
        $_POST = array();
        $resultado = $val->valida_filtros();
        $this->assertIsArray( $resultado);
        $this->assertStringContainsStringIgnoringCase('Error filtros debe existir por POST', $resultado['mensaje']);
        $this->assertTrue(errores::$error);

        errores::$error = false;
        $_POST['filtros'] = '';
        $resultado = $val->valida_filtros();
        $this->assertIsArray( $resultado);
        $this->assertStringContainsStringIgnoringCase('Error filtros debe ser un array', $resultado['mensaje']);
        $this->assertTrue(errores::$error);

        errores::$error = false;
        $_POST['filtros'] = array();
        $resultado = $val->valida_filtros();
        $this->assertIsBool( $resultado);
        $this->assertTrue($resultado);
        $this->assertNotTrue(errores::$error);
        errores::$error = false;

    }

    public function test_valida_id(): void
    {
        errores::$error = false;
        $val = new validacion();
        $key = '';
        $registro = array();
        $resultado = $val->valida_id(key: $key, registro: $registro);
        $this->assertIsArray( $resultado);
        $this->assertStringContainsStringIgnoringCase('Error key no puede venir vacio', $resultado['mensaje']);
        $this->assertTrue(errores::$error);

        errores::$error = false;
        $key = 'a';
        $registro = array();
        $resultado = $val->valida_id(key: $key, registro: $registro);
        $this->assertIsArray( $resultado);
        $this->assertStringContainsStringIgnoringCase('Error no existe a', $resultado['mensaje']);

        errores::$error = false;
        $key = 'a';
        $registro = array();
        $registro['a'] = 'z';
        $resultado = $val->valida_id(key: $key, registro: $registro);
        $this->assertIsArray( $resultado);
        $this->assertStringContainsStringIgnoringCase('Error el a debe ser mayor a 0', $resultado['mensaje']);
        $this->assertTrue(errores::$error);


        errores::$error = false;
        $key = 'a';
        $registro = array();
        $registro['a'] = '1';
        $resultado = $val->valida_id(key: $key, registro: $registro);
        $this->assertIsBool( $resultado);
        $this->assertTrue($resultado);
        $this->assertNotTrue(errores::$error);
        errores::$error = false;
    }

    public function test_valida_ids(){

        errores::$error = false;
        $validacion = new validacion();
        $registro = array();
        $keys = array();
        $resultado = $validacion->valida_ids( keys: $keys, registro: $registro);
        $this->assertTrue(errores::$error);
        $this->assertIsArray($resultado);
        $this->assertArrayHasKey('data',$resultado);
        $this->assertStringContainsStringIgnoringCase('Error keys vacios',$resultado['mensaje']);

        errores::$error = false;
        $registro = array();
        $keys = array();
        $keys[] = '';
        $resultado = $validacion->valida_ids(keys: $keys, registro: $registro);
        $this->assertTrue(errores::$error);
        $this->assertIsArray($resultado);
        $this->assertArrayHasKey('data',$resultado);
        $this->assertStringContainsStringIgnoringCase('Error  Invalido',$resultado['mensaje']);

        errores::$error = false;
        $registro = array();
        $keys = array();
        $keys[] = 'x';
        $resultado = $validacion->valida_ids(keys: $keys, registro: $registro);
        $this->assertTrue(errores::$error);
        $this->assertIsArray($resultado);
        $this->assertArrayHasKey('data',$resultado);
        $this->assertStringContainsStringIgnoringCase('Error no existe x',$resultado['mensaje']);

        errores::$error = false;
        $registro = array();
        $keys = array();
        $keys[] = 'x';
        $registro['x'] = '';
        $resultado = $validacion->valida_ids(keys: $keys, registro: $registro);
        $this->assertTrue(errores::$error);
        $this->assertIsArray($resultado);
        $this->assertArrayHasKey('data',$resultado);
        $this->assertStringContainsStringIgnoringCase('Error x Invalido',$resultado['mensaje']);

        errores::$error = false;
        $registro = array();
        $keys = array();
        $keys[] = 'x';
        $registro['x'] = '1';
        $resultado = $validacion->valida_ids(keys: $keys, registro: $registro);
        $this->assertNotTrue(errores::$error);
        $this->assertIsArray($resultado);
        errores::$error = false;

    }

    public function test_valida_modelo(){

        errores::$error = false;
        $validacion = new validacion();

        $tabla = '';
        $resultado = $validacion->valida_modelo($tabla);
        $this->assertTrue(errores::$error);
        $this->assertIsArray($resultado);
        $this->assertArrayHasKey('data',$resultado);
        $this->assertStringContainsStringIgnoringCase('Error al ajustar class',$resultado['mensaje']);

        errores::$error = false;


        $tabla = 'a';
        $resultado = $validacion->valida_modelo($tabla);
        $this->assertTrue(errores::$error);
        $this->assertIsArray($resultado);
        $this->assertArrayHasKey('data',$resultado);
        $this->assertStringContainsStringIgnoringCase('Error al validar a',$resultado['mensaje']);

        errores::$error = false;


        $tabla = 'prueba';
        $resultado = $validacion->valida_modelo($tabla);
        errores::$error = false;
    }

    public function test_valida_name_clase(){

        errores::$error = false;
        $validacion = new validacion();
        $tabla = '';
        $resultado = $validacion->valida_name_clase($tabla);
        $this->assertTrue(errores::$error);
        $this->assertIsArray($resultado);
        $this->assertArrayHasKey('data',$resultado);
        $this->assertStringContainsStringIgnoringCase('Error tabla no puede venir vacio',$resultado['mensaje']);

        errores::$error = false;
        $tabla = 'a';
        $resultado = $validacion->valida_name_clase($tabla);
        $this->assertTrue(errores::$error);
        $this->assertIsArray($resultado);
        $this->assertArrayHasKey('data',$resultado);
        $this->assertStringContainsStringIgnoringCase('Error no existe la clase models\a',$resultado['mensaje']);
        errores::$error = false;

    }

    public function test_valida_numeric(): void{
        errores::$error = false;
        $val = new validacion();
        //$val = new liberator($val);

        $value = '';
        $resultado = $val->valida_numeric($value);

        $this->assertTrue(errores::$error);
        $this->assertIsArray($resultado);
        $this->assertArrayHasKey('data',$resultado);
        $this->assertStringContainsStringIgnoringCase('Error el valor no es un numero',$resultado['mensaje']);

        errores::$error = false;
        $value = 'a';
        $resultado = $val->valida_numeric($value);
        $this->assertTrue(errores::$error);
        $this->assertIsArray($resultado);
        $this->assertArrayHasKey('data',$resultado);
        $this->assertStringContainsStringIgnoringCase('Error el valor no es un numero',$resultado['mensaje']);

        errores::$error = false;
        $value = '1';
        $resultado = $val->valida_numeric($value);
        $this->assertNotTrue(errores::$error);
        $this->assertIsBool($resultado);
        $this->assertTrue($resultado);

        errores::$error = false;
        $value = '1.1';
        $resultado = $val->valida_numeric($value);
        $this->assertNotTrue(errores::$error);
        $this->assertIsBool($resultado);
        $this->assertTrue($resultado);

        errores::$error = false;
    }

    public function test_valida_pattern(): void{
        errores::$error = false;
        $val = new validacion();
        //$val = new liberator($val);
        $key = '';
        $txt = '';
        $resultado = $val->valida_pattern($key, $txt);

        $this->assertIsBool( $resultado);
        $this->assertNotTrue($resultado);
        $this->assertNotTrue(errores::$error);

        errores::$error = false;

        $key = 'id';
        $txt = '';
        $resultado = $val->valida_pattern($key, $txt);
        $this->assertIsBool( $resultado);
        $this->assertNotTrue($resultado);
        $this->assertNotTrue(errores::$error);

        errores::$error = false;
        $key = 'id';
        $txt = '10';
        $resultado = $val->valida_pattern($key, $txt);
        $this->assertIsBool( $resultado);
        $this->assertTrue($resultado);
        $this->assertNotTrue(errores::$error);


        errores::$error = false;
        $key = 'funcion';
        $txt = 'a';
        $resultado = $val->valida_pattern($key, $txt);
        $this->assertIsBool( $resultado);
        $this->assertTrue($resultado);
        $this->assertNotTrue(errores::$error);

        errores::$error = false;
        $key = 'funcion';
        $txt = 'a_';
        $resultado = $val->valida_pattern($key, $txt);
        $this->assertIsBool( $resultado);
        $this->assertNotTrue($resultado);
        $this->assertNotTrue(errores::$error);

        errores::$error = false;
        $key = 'funcion';
        $txt = 'a_a_as';
        $resultado = $val->valida_pattern($key, $txt);
        $this->assertIsBool( $resultado);
        $this->assertTrue($resultado);
        $this->assertNotTrue(errores::$error);

        errores::$error = false;
        $key = 'filtro';
        $txt = 'a';
        $resultado = $val->valida_pattern($key, $txt);
        $this->assertIsBool( $resultado);
        $this->assertNotTrue($resultado);
        $this->assertNotTrue(errores::$error);

        errores::$error = false;
        $key = 'filtro';
        $txt = 'aa';
        $resultado = $val->valida_pattern($key, $txt);
        $this->assertIsBool( $resultado);
        $this->assertNotTrue($resultado);
        $this->assertNotTrue(errores::$error);

        errores::$error = false;
        $key = 'filtro';
        $txt = 'aa_';
        $resultado = $val->valida_pattern($key, $txt);
        $this->assertIsBool( $resultado);
        $this->assertNotTrue($resultado);
        $this->assertNotTrue(errores::$error);


        errores::$error = false;
        $key = 'filtro';
        $txt = 'aa_x';
        $resultado = $val->valida_pattern($key, $txt);
        $this->assertIsBool( $resultado);
        $this->assertNotTrue($resultado);
        $this->assertNotTrue(errores::$error);

        errores::$error = false;
        $key = 'filtro';
        $txt = 'aa_x.';
        $resultado = $val->valida_pattern($key, $txt);
        $this->assertIsBool( $resultado);
        $this->assertNotTrue($resultado);
        $this->assertNotTrue(errores::$error);

        errores::$error = false;
        $key = 'filtro';
        $txt = 'aa_x.s';
        $resultado = $val->valida_pattern($key, $txt);
        $this->assertIsBool( $resultado);
        $this->assertTrue($resultado);
        $this->assertNotTrue(errores::$error);

        errores::$error = false;
        $key = 'filtro';
        $txt = 'aa_x.s_';
        $resultado = $val->valida_pattern($key, $txt);
        $this->assertIsBool( $resultado);
        $this->assertNotTrue($resultado);
        $this->assertNotTrue(errores::$error);

        errores::$error = false;
        $key = 'filtro';
        $txt = 'aa_x.s_s';
        $resultado = $val->valida_pattern($key, $txt);
        $this->assertIsBool( $resultado);
        $this->assertTrue($resultado);
        $this->assertNotTrue(errores::$error);

        errores::$error = false;
        $key = 'filtro';
        $txt = 'aa_x.s_s.';
        $resultado = $val->valida_pattern($key, $txt);
        $this->assertIsBool( $resultado);
        $this->assertNotTrue($resultado);
        $this->assertNotTrue(errores::$error);

        errores::$error = false;
        $key = 'filtro';
        $txt = 'aa_x.s_s.d';
        $resultado = $val->valida_pattern($key, $txt);
        $this->assertIsBool( $resultado);
        $this->assertTrue($resultado);
        $this->assertNotTrue(errores::$error);

        errores::$error = false;
        $key = 'filtro';
        $txt = 'aa_x.s_s._d';
        $resultado = $val->valida_pattern($key, $txt);
        $this->assertIsBool( $resultado);
        $this->assertNotTrue($resultado);
        $this->assertNotTrue(errores::$error);

        errores::$error = false;
        $key = 'file_php';
        $txt = 'aa_x.s_s._d';
        $resultado = $val->valida_pattern($key, $txt);
        $this->assertIsBool( $resultado);
        $this->assertNotTrue($resultado);
        $this->assertNotTrue(errores::$error);

        errores::$error = false;
        $key = 'file_php';
        $txt = 'aa_x.s_s_d.';
        $resultado = $val->valida_pattern($key, $txt);
        $this->assertIsBool( $resultado);
        $this->assertNotTrue($resultado);
        $this->assertNotTrue(errores::$error);

        errores::$error = false;
        $key = 'file_php';
        $txt = 'aa_x.s_s.d.php';
        $resultado = $val->valida_pattern($key, $txt);
        $this->assertIsBool( $resultado);
        $this->assertTrue($resultado);
        $this->assertNotTrue(errores::$error);

        errores::$error = false;
        $key = 'file_service_lock';
        $txt = 'aa_x.s_s.d.php';
        $resultado = $val->valida_pattern($key, $txt);
        $this->assertIsBool( $resultado);
        $this->assertNotTrue($resultado);
        $this->assertNotTrue(errores::$error);

        errores::$error = false;
        $key = 'file_service_lock';
        $txt = 'aa_x.s_s.d.php.lock';
        $resultado = $val->valida_pattern($key, $txt);
        $this->assertIsBool( $resultado);
        $this->assertTrue($resultado);
        $this->assertNotTrue(errores::$error);

        errores::$error = false;
        $key = 'file_service_lock';
        $txt = 'aa_x.s_s.d.php.lock';
        $resultado = $val->valida_pattern($key, $txt);
        $this->assertIsBool( $resultado);
        $this->assertTrue($resultado);
        $this->assertNotTrue(errores::$error);

        errores::$error = false;
        $key = 'file_service_info';
        $txt = 'aa_x.s_s.d.php';
        $resultado = $val->valida_pattern($key, $txt);
        $this->assertIsBool( $resultado);
        $this->assertNotTrue($resultado);
        $this->assertNotTrue(errores::$error);

        errores::$error = false;
        $key = 'file_service_info';
        $txt = 'aa_x.s_s.d.php.';
        $resultado = $val->valida_pattern($key, $txt);
        $this->assertIsBool( $resultado);
        $this->assertNotTrue($resultado);
        $this->assertNotTrue(errores::$error);

        errores::$error = false;
        $key = 'file_service_info';
        $txt = 'aa_x.s_s.d.php.2020-12-12';
        $resultado = $val->valida_pattern($key, $txt);
        $this->assertIsBool( $resultado);
        $this->assertNotTrue($resultado);
        $this->assertNotTrue(errores::$error);

        errores::$error = false;
        $key = 'file_service_info';
        $txt = 'aa_x.s_s.d.php.2020-12-12.';
        $resultado = $val->valida_pattern($key, $txt);
        $this->assertIsBool( $resultado);
        $this->assertNotTrue($resultado);
        $this->assertNotTrue(errores::$error);

        errores::$error = false;
        $key = 'file_service_info';
        $txt = 'aa_x.s_s.d.php.2020-12-12.23:54';
        $resultado = $val->valida_pattern($key, $txt);
        $this->assertIsBool( $resultado);
        $this->assertNotTrue($resultado);
        $this->assertNotTrue(errores::$error);

        errores::$error = false;
        $key = 'file_service_info';
        $txt = 'aa_x.s_s.d.php.2020-12-12.23:54:14';
        $resultado = $val->valida_pattern($key, $txt);
        $this->assertIsBool( $resultado);
        $this->assertNotTrue($resultado);
        $this->assertNotTrue(errores::$error);

        errores::$error = false;
        $key = 'file_service_info';
        $txt = 'aa_x.s_s.d.php.2020-12-12.23:54:14.info';
        $resultado = $val->valida_pattern($key, $txt);
        $this->assertIsBool( $resultado);
        $this->assertTrue($resultado);
        $this->assertNotTrue(errores::$error);


        errores::$error = false;


    }

    public function test_valida_rango_fecha(){

        errores::$error = false;
        $validacion = new validacion();

        $fechas = array();
        $resultado = $validacion->valida_rango_fecha($fechas);
        $this->assertTrue(errores::$error);
        $this->assertIsArray($resultado);
        $this->assertArrayHasKey('data',$resultado);
        $this->assertStringContainsStringIgnoringCase('Error al validar fechas',$resultado['mensaje']);

        errores::$error = false;

        $fechas = array();
        $fechas['fecha_inicial'] = '2020-01-01';
        $resultado = $validacion->valida_rango_fecha($fechas);
        $this->assertTrue(errores::$error);
        $this->assertIsArray($resultado);
        $this->assertArrayHasKey('data',$resultado);
        $this->assertStringContainsStringIgnoringCase('Error al validar fechas',$resultado['mensaje']);

        errores::$error = false;

        $fechas = array();
        $fechas['fecha_inicial'] = '2020-01-01';
        $fechas['fecha_final'] = '2020-01-01';
        $resultado = $validacion->valida_rango_fecha($fechas);
        $this->assertNotTrue(errores::$error);
        $this->assertIsBool($resultado);
        $this->assertTrue($resultado);

        errores::$error = false;

        $fechas = array();
        $fechas['fecha_inicial'] = '2020-01-01';
        $fechas['fecha_final'] = '2010-01-01';
        $resultado = $validacion->valida_rango_fecha($fechas);
        $this->assertTrue(errores::$error);
        $this->assertIsArray($resultado);
        $this->assertArrayHasKey('data',$resultado);
        $this->assertStringContainsStringIgnoringCase('Error la fecha inicial no puede ser mayor a la final',$resultado['mensaje']);
        errores::$error = false;
    }


}