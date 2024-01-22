<?php
namespace tests\src;

use gamboamartin\errores\errores;
use gamboamartin\test\liberator;
use gamboamartin\test\test;
use gamboamartin\validacion\validacion;
use stdClass;

class validacionTest extends test {
    public errores $errores;
    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->errores = new errores();
    }


    public function test_base_regex_0_numbers(): void
    {
        errores::$error = false;
        $val = new validacion();
        $val = new liberator($val);

        $max_long = 5;
        $resultado = $val->base_regex_0_numbers($max_long);
        $this->assertIsArray( $resultado);
        $this->assertEquals("/^[0-9]{1}$/", $resultado[0]);
        $this->assertEquals("/^[0-9]{2}$/", $resultado[1]);
        $this->assertEquals("/^[0-9]{3}$/", $resultado[2]);
        $this->assertEquals("/^[0-9]{4}$/", $resultado[3]);
        $this->assertEquals("/^[0-9]{5}$/", $resultado[4]);
        $this->assertNotTrue(errores::$error);
        errores::$error = false;
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

    public function test_cod_1_letras_mayusc(): void
    {
        errores::$error = false;
        $val = new validacion();
        $txt = 'A';

        $resultado = $val->cod_1_letras_mayusc($txt);
        $this->assertIsBool( $resultado);
        $this->assertTrue($resultado);
        $this->assertNotTrue(errores::$error);
        errores::$error = false;
    }

    public function test_cod_3_letras_mayusc()
    {

        errores::$error = false;
        $validacion = new validacion();
        $data_boton = '';
        $resultado = $validacion->cod_3_letras_mayusc($data_boton);
        $this->assertIsBool( $resultado);
        $this->assertNotTrue($resultado);
        $this->assertNotTrue(errores::$error);

        errores::$error = false;

        $data_boton = 'ADD';
        $resultado = $validacion->cod_3_letras_mayusc($data_boton);
        $this->assertIsBool( $resultado);
        $this->assertTrue($resultado);
        $this->assertNotTrue(errores::$error);
        errores::$error = false;
    }

    public function test_cod_int_0_numbers()
    {

        errores::$error = false;
        $validacion = new validacion();

        $txt = '0145874';
        $resultado = $validacion->cod_int_0_numbers($txt);
        $this->assertIsBool( $resultado);
        $this->assertTrue($resultado);
        $this->assertNotTrue(errores::$error);
        errores::$error = false;
    }

    public function test_cod_int_0_2_numbers(): void{
        errores::$error = false;
        $val = new validacion();
        //$val = new liberator($val);


        $txt = '22';
        $resultado = $val->cod_int_0_2_numbers($txt);

        $this->assertIsBool( $resultado);
        $this->assertTrue($resultado);
        $this->assertNotTrue(errores::$error);
        errores::$error = false;

        $txt = '00';
        $resultado = $val->cod_int_0_2_numbers($txt);
        $this->assertIsBool( $resultado);
        $this->assertTrue($resultado);
        $this->assertNotTrue(errores::$error);
        errores::$error = false;



        $txt = '21';
        $resultado = $val->cod_int_0_2_numbers($txt);
        $this->assertIsBool( $resultado);
        $this->assertTrue($resultado);
        $this->assertNotTrue(errores::$error);

        errores::$error = false;
    }

    public function test_cod_int_0_3_numbers()
    {

        errores::$error = false;
        $validacion = new validacion();

        $txt = '';
        $resultado = $validacion->cod_int_0_3_numbers($txt);
        $this->assertIsBool( $resultado);
        $this->assertNotTrue($resultado);
        $this->assertNotTrue(errores::$error);

        errores::$error = false;


        $txt = '0';
        $resultado = $validacion->cod_int_0_3_numbers($txt);
        $this->assertIsBool( $resultado);
        $this->assertNotTrue($resultado);
        $this->assertNotTrue(errores::$error);

        errores::$error = false;


        $txt = '00';
        $resultado = $validacion->cod_int_0_3_numbers($txt);
        $this->assertIsBool( $resultado);
        $this->assertNotTrue($resultado);
        $this->assertNotTrue(errores::$error);

        errores::$error = false;


        $txt = '000';
        $resultado = $validacion->cod_int_0_3_numbers($txt);

        $this->assertIsBool( $resultado);
        $this->assertTrue($resultado);
        $this->assertNotTrue(errores::$error);

        errores::$error = false;


        $txt = '199';
        $resultado = $validacion->cod_int_0_3_numbers($txt);
        $this->assertIsBool( $resultado);
        $this->assertTrue($resultado);
        $this->assertNotTrue(errores::$error);

        errores::$error = false;
    }

    public function test_cod_int_0_5_numbers(): void{
        errores::$error = false;
        $val = new validacion();
        //$val = new liberator($val);

        $txt = '';
        $resultado = $val->cod_int_0_5_numbers($txt);
        $this->assertIsBool( $resultado);
        $this->assertNotTrue($resultado);
        $this->assertNotTrue(errores::$error);

        errores::$error = false;

        $txt = '1';
        $resultado = $val->cod_int_0_5_numbers($txt);
        $this->assertIsBool( $resultado);
        $this->assertNotTrue($resultado);
        $this->assertNotTrue(errores::$error);

        errores::$error = false;

        $txt = '01';
        $resultado = $val->cod_int_0_5_numbers($txt);
        $this->assertIsBool( $resultado);
        $this->assertNotTrue($resultado);
        $this->assertNotTrue(errores::$error);

        errores::$error = false;

        $txt = '013';
        $resultado = $val->cod_int_0_5_numbers($txt);
        $this->assertIsBool( $resultado);
        $this->assertNotTrue($resultado);
        $this->assertNotTrue(errores::$error);

        errores::$error = false;

        $txt = '01345';
        $resultado = $val->cod_int_0_5_numbers($txt);
        $this->assertIsBool( $resultado);
        $this->assertTrue($resultado);
        $this->assertNotTrue(errores::$error);

        errores::$error = false;

        $txt = '013435';
        $resultado = $val->cod_int_0_5_numbers($txt);
        $this->assertIsBool( $resultado);
        $this->assertNotTrue($resultado);
        $this->assertNotTrue(errores::$error);

        errores::$error = false;

        $txt = '013d5';
        $resultado = $val->cod_int_0_5_numbers($txt);
        $this->assertIsBool( $resultado);
        $this->assertNotTrue($resultado);
        $this->assertNotTrue(errores::$error);

        errores::$error = false;
    }

    public function test_cod_int_0_6_numbers(): void{
        errores::$error = false;
        $val = new validacion();
        //$val = new liberator($val);

        $txt = '';
        $resultado = $val->cod_int_0_6_numbers($txt);
        $this->assertIsBool( $resultado);
        $this->assertNotTrue($resultado);
        $this->assertNotTrue(errores::$error);

        errores::$error = false;

        $txt = '1';
        $resultado = $val->cod_int_0_6_numbers($txt);
        $this->assertIsBool( $resultado);
        $this->assertNotTrue($resultado);
        $this->assertNotTrue(errores::$error);

        errores::$error = false;

        $txt = '01';
        $resultado = $val->cod_int_0_6_numbers($txt);
        $this->assertIsBool( $resultado);
        $this->assertNotTrue($resultado);
        $this->assertNotTrue(errores::$error);

        errores::$error = false;

        $txt = '013';
        $resultado = $val->cod_int_0_6_numbers($txt);
        $this->assertIsBool( $resultado);
        $this->assertNotTrue($resultado);
        $this->assertNotTrue(errores::$error);

        errores::$error = false;

        $txt = '01345';
        $resultado = $val->cod_int_0_6_numbers($txt);
        $this->assertIsBool( $resultado);
        $this->assertNotTrue($resultado);
        $this->assertNotTrue(errores::$error);

        errores::$error = false;

        $txt = '013435';
        $resultado = $val->cod_int_0_6_numbers($txt);
        $this->assertIsBool( $resultado);
        $this->assertTrue($resultado);
        $this->assertNotTrue(errores::$error);

        errores::$error = false;

        $txt = '013d5';
        $resultado = $val->cod_int_0_6_numbers($txt);
        $this->assertIsBool( $resultado);
        $this->assertNotTrue($resultado);
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

    public function test_keys_documentos()
    {

        errores::$error = false;
        $validacion = new validacion();
        $validacion = new liberator($validacion);

        $resultado = $validacion->keys_documentos();
        $this->assertIsArray( $resultado);
        $this->assertNotTrue($resultado);
        $this->assertEquals('ruta', $resultado[0]);
        $this->assertEquals('ruta_relativa', $resultado[1]);
        $this->assertEquals('ruta_absoluta', $resultado[2]);
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

    public function test_cod_int_0_n_numbers(): void{
        errores::$error = false;
        $val = new validacion();
        //$val = new liberator($val);

        $longitud = 1;
        $txt = 'a';
        $resultado = $val->cod_int_0_n_numbers($longitud, $txt);
        $this->assertIsBool( $resultado);
        $this->assertNotTrue($resultado);
        $this->assertNotTrue(errores::$error);

        errores::$error = false;
        $longitud = 1;
        $txt = '0';
        $resultado = $val->cod_int_0_n_numbers($longitud, $txt);
        $this->assertIsBool( $resultado);
        $this->assertTrue($resultado);
        $this->assertNotTrue(errores::$error);

        errores::$error = false;
    }

    public function test_fechas_in_array(): void
    {
        errores::$error = false;
        $val = new validacion();
        //$val = new liberator($val);
        $class = '';
        $data = new stdClass();
        $keys = array();
        $keys[] = 'a';
        $data->a = '2020-01-01';
        $resultado = $val->fechas_in_array($data, $keys);
        $this->assertIsBool( $resultado);
        $this->assertTrue($resultado);
        $this->assertNotTrue(errores::$error);
        errores::$error = false;
    }

    public function test_key_id(): void
    {
        errores::$error = false;
        $val = new validacion();
        $txt = '';
        $resultado = $val->key_id($txt);
        //print_r($resultado);exit;
        $this->assertNotTrue(errores::$error);
        $this->assertNotTrue($resultado);

        $txt = 'a';
        $resultado = $val->key_id($txt);
        $this->assertNotTrue(errores::$error);
        $this->assertNotTrue($resultado);

        $txt = 'a_a_id';
        $resultado = $val->key_id($txt);
        $this->assertNotTrue(errores::$error);
        $this->assertTrue($resultado);
        errores::$error = false;

    }

    public function test_rfc(): void{
        errores::$error = false;
        $val = new validacion();
        //$val = new liberator($val);

        $txt = 'a';
        $resultado = $val->rfc($txt);
        $this->assertNotTrue(errores::$error);
        $this->assertNotTrue($resultado);

        errores::$error = false;
        $txt = 'AAAA830930A45';
        $resultado = $val->rfc($txt);
        $this->assertNotTrue(errores::$error);
        $this->assertTrue($resultado);

        errores::$error = false;
        $txt = 'AAA010101AAA';
        $resultado = $val->rfc($txt);
        $this->assertNotTrue(errores::$error);
        $this->assertTrue($resultado);
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

    public function test_upload()
    {

        errores::$error = false;
        $validacion = new validacion();

        $codigo = '';
        $resultado = $validacion->upload($codigo);
        $this->assertIsArray( $resultado);
        $this->assertEquals('Error sin identificar.', $resultado['mensaje_limpio']);
        $this->assertTrue(errores::$error);

        errores::$error = false;
        $codigo = UPLOAD_ERR_INI_SIZE;
        $resultado = $validacion->upload($codigo);
        $this->assertIsArray( $resultado);
        $this->assertEquals('El archivo que se ha intentado subir sobrepasa el límite de tamaño permitido. Revisar la directiva de php.ini UPLOAD_MAX_FILSIZE.', $resultado['mensaje_limpio']);
        $this->assertTrue(errores::$error);
        errores::$error = false;
    }

    public function test_url(): void{
        errores::$error = false;
        $validacion = new validacion();
        $validacion = new liberator($validacion);

        $url = '';
        $resultado = $validacion->url($url);
        $this->assertIsArray( $resultado);
        $this->assertStringContainsStringIgnoringCase('Error la url esta vacia', $resultado['mensaje']);
        $this->assertTrue(errores::$error);

        errores::$error = false;

        $url = 'abc';
        $resultado = $validacion->url($url);
        $this->assertIsBool( $resultado);
        $this->assertNotTrue($resultado);
        $this->assertNotTrue(errores::$error);

        errores::$error = false;

        $url = 'https://www.abc.com.mx';
        $resultado = $validacion->url($url);
        $this->assertIsBool( $resultado);
        $this->assertTrue($resultado);
        $this->assertNotTrue(errores::$error);

        errores::$error = false;

        $url = 'http://www.abc.com.mx';
        $resultado = $validacion->url($url);
        $this->assertIsBool( $resultado);
        $this->assertTrue($resultado);
        $this->assertNotTrue(errores::$error);

        errores::$error = false;
    }

    public function test_valida_array(): void
    {
        errores::$error = false;
        $val = new validacion();
        //$val = new liberator($val);


        $value = '';
        $resultado = $val->valida_array($value);
        $this->assertIsArray( $resultado);
        $this->assertNotTrue($resultado);
        $this->assertTrue(errores::$error);

        errores::$error = false;

        $value = array();
        $resultado = $val->valida_array($value);
        $this->assertIsBool( $resultado);
        $this->assertTrue($resultado);
        $this->assertNotTrue(errores::$error);
        errores::$error = false;
    }

    public function test_valida_arrays(): void{
        errores::$error = false;
        $val = new validacion();
        //$val = new liberator($val);
        $row = array();
        $keys = array();
        $keys[] = 'a';
        $row['a'] = array();
        $resultado = $val->valida_arrays($keys, $row);
        $this->assertIsBool( $resultado);
        $this->assertTrue($resultado);
        $this->assertNotTrue(errores::$error);
        errores::$error = false;
    }

    public function test_valida_base(): void{
        errores::$error = false;
        $val = new validacion();
        $val = new liberator($val);

        $key = '';
        $registro = array();
        $resultado = $val->valida_base($key, $registro);
        $this->assertIsArray( $resultado);
        $this->assertStringContainsStringIgnoringCase('Error key no puede venir vacio', $resultado['mensaje']);
        $this->assertTrue(errores::$error);

        errores::$error = false;
        $val = new validacion();
        $val = new liberator($val);

        $key = 'a';
        $registro = new stdClass();

        $resultado = $val->valida_base($key, $registro);
        $this->assertIsArray( $resultado);
        $this->assertStringContainsStringIgnoringCase('Error no existe en registro el key a', $resultado['mensaje']);
        $this->assertTrue(errores::$error);

        errores::$error = false;


        $key = 'a';
        $registro = new stdClass();
        $registro->a = 'a';

        $resultado = $val->valida_base($key, $registro, false);
        $this->assertIsBool( $resultado);
        $this->assertNotTrue(errores::$error);

        errores::$error = false;
    }

    public function test_valida_bool(): void{
        errores::$error = false;
        $val = new validacion();
        //$val = new liberator($val);

        $value = '';
        $resultado = $val->valida_bool($value);
        $this->assertIsArray( $resultado);
        $this->assertEquals('Error el valor no es un booleano',$resultado['mensaje_limpio']);
        $this->assertTrue(errores::$error);
        errores::$error = false;


        $value = 1;
        $resultado = $val->valida_bool($value);
        $this->assertIsArray( $resultado);
        $this->assertEquals('Error el valor no es un booleano',$resultado['mensaje_limpio']);
        $this->assertTrue(errores::$error);
        errores::$error = false;

        $value = -1;
        $resultado = $val->valida_bool($value);
        $this->assertIsArray( $resultado);
        $this->assertEquals('Error el valor no es un booleano',$resultado['mensaje_limpio']);
        $this->assertTrue(errores::$error);
        errores::$error = false;

        $value = null;
        $resultado = $val->valida_bool($value);
        $this->assertIsArray( $resultado);
        $this->assertEquals('Error el valor no es un booleano',$resultado['mensaje_limpio']);
        $this->assertTrue(errores::$error);
        errores::$error = false;

        $value = false;
        $resultado = $val->valida_bool($value);
        $this->assertIsBool( $resultado);
        $this->assertNotTrue(errores::$error);
        $this->assertTrue($resultado);

        errores::$error = false;
    }

    public function test_valida_bools(): void{
        errores::$error = false;
        $val = new validacion();
        //$val = new liberator($val);

        $keys = array();
        $row = array();
        $resultado = $val->valida_bools($keys, $row);
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

    public function test_valida_cod_int_0_6_numbers(): void
    {
        errores::$error = false;
        $val = new validacion();
        //$val = new liberator($val);

        $key = 'a';
        $registro = array();
        $resultado = $val->valida_cod_int_0_6_numbers($key, $registro);
        $this->assertIsArray( $resultado);
        $this->assertEquals('Error al validar a', $resultado['mensaje_limpio']);
        $this->assertTrue(errores::$error);

        errores::$error = false;

        $key = 'a';
        $registro = array();
        $registro['a'] = 'as';
        $resultado = $val->valida_cod_int_0_6_numbers($key, $registro);
        $this->assertIsArray( $resultado);
        $this->assertEquals('Error al validar a', $resultado['mensaje_limpio']);
        $this->assertTrue(errores::$error);

        errores::$error = false;

        $key = 'a';
        $registro = array();
        $registro['a'] = '0';
        $resultado = $val->valida_cod_int_0_6_numbers($key, $registro);
        $this->assertIsArray( $resultado);
        $this->assertEquals('Error al validar a', $resultado['mensaje_limpio']);
        $this->assertTrue(errores::$error);

        errores::$error = false;

        $key = 'a';
        $registro = array();
        $registro['a'] = '0125456';
        $resultado = $val->valida_cod_int_0_6_numbers($key, $registro);
        $this->assertIsArray( $resultado);
        $this->assertEquals('Error el a es invalido', $resultado['mensaje_limpio']);
        $this->assertTrue(errores::$error);

        errores::$error = false;

        $key = 'a';
        $registro = array();
        $registro['a'] = '000254';
        $resultado = $val->valida_cod_int_0_6_numbers($key, $registro);
        $this->assertIsBool( $resultado);
        $this->assertTrue($resultado);
        $this->assertNotTrue(errores::$error);
        errores::$error = false;
    }

    public function test_valida_cod_1_letras_mayusc(): void
    {
        errores::$error = false;
        $val = new validacion();
        //$val = new liberator($val);

        $registro = array();
        $key = 'a';
        $registro['a'] = 'Z';
        $resultado = $val->valida_cod_1_letras_mayusc($key, $registro);
        $this->assertIsBool( $resultado);
        $this->assertNotTrue(errores::$error);
        $this->assertTrue($resultado);
        errores::$error = false;
    }

    public function test_valida_cod_3_letras_mayusc(): void{
        errores::$error = false;
        $val = new validacion();
        //$val = new liberator($val);
        $key = 'a';
        $registro = array();
        $registro['a'] = 'AAA';
        $resultado = $val->valida_cod_3_letras_mayusc($key, $registro);
        $this->assertIsBool( $resultado);
        $this->assertNotTrue(errores::$error);
        errores::$error = false;
    }

    public function test_valida_codigos_int_0_2_numbers(): void{
        errores::$error = false;
        $val = new validacion();
        //$val = new liberator($val);


        $keys = array();
        $registro = array();
        $keys[] = 'a';
        $registro['a'] = '10';
        $resultado = $val->valida_codigos_int_0_2_numbers($keys, $registro);
        $this->assertIsArray( $resultado);
        $this->assertNotTrue(errores::$error);
        errores::$error = false;

    }

    public function test_valida_cols_css(): void{
        errores::$error = false;
        $val = new validacion();
        //$val = new liberator($val);

        $cols = -1;
        $resultado = $val->valida_cols_css($cols);
        $this->assertIsArray( $resultado);
        $this->assertEquals('Error cols debe ser mayor a 0', $resultado['mensaje_limpio']);
        $this->assertTrue(errores::$error);

        errores::$error = false;

        $cols = 13;
        $resultado = $val->valida_cols_css($cols);
        $this->assertIsArray( $resultado);
        $this->assertEquals('Error cols debe ser menor a 13', $resultado['mensaje_limpio']);
        $this->assertTrue(errores::$error);

        errores::$error = false;

        $cols = 7;
        $resultado = $val->valida_cols_css($cols);
        $this->assertIsBool( $resultado);
        $this->assertTrue($resultado);
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
        $this->assertStringContainsStringIgnoringCase('Error $class no puede venir vacia', $resultado['mensaje']);

        $this->assertTrue(errores::$error);

        errores::$error = false;
        $class = 'a';
        $tabla = 'a';
        $resultado = $val->valida_class(class: $class, tabla: $tabla);

        $this->assertIsBool( $resultado);
        $this->assertTrue($resultado);
        $this->assertNotTrue(errores::$error);

        errores::$error = false;
        $class = 'a';
        $tabla = 'seccion';
        $resultado = $val->valida_class(class: $class, tabla: $tabla);
        $this->assertIsBool( $resultado);
        $this->assertTrue($resultado);
        $this->assertNotTrue(errores::$error);

        errores::$error = false;
        $class = 'seccion';
        $tabla = 'seccion';
        $resultado = $val->valida_class(class: $class, tabla: $tabla);
        $this->assertIsBool( $resultado);
        $this->assertTrue($resultado);
        $this->assertNotTrue(errores::$error);
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
        $this->assertIsBool( $resultado);
        $this->assertNotTrue(errores::$error);

        errores::$error = false;
        $name_modelo = 'prueba';
        $resultado = $val->valida_data_modelo($name_modelo);
        $this->assertIsBool( $resultado);
        $this->assertNotTrue(errores::$error);
        $this->assertTrue($resultado);

    }

    public function test_valida_double_mayor_0(): void{
        errores::$error = false;
        $val = new validacion();
        //$val = new liberator($val);

        $value = '0.0001';
        $resultado = $val->valida_double_mayor_0($value);
        $this->assertIsBool( $resultado);
        $this->assertNotTrue(errores::$error);
        $this->assertTrue($resultado);

        errores::$error = false;

        $value = '0.000';
        $resultado = $val->valida_double_mayor_0($value);
        $this->assertIsArray( $resultado);
        $this->assertTrue(errores::$error);

        errores::$error = false;
    }

    public function test_valida_double_mayor_igual_0(): void{
        errores::$error = false;
        $val = new validacion();
        //$val = new liberator($val);

        $value = '';

        $resultado = $val->valida_double_mayor_igual_0($value);
        $this->assertIsArray( $resultado);
        $this->assertStringContainsStringIgnoringCase('Error value vacio', $resultado['mensaje']);
        $this->assertTrue(errores::$error);

        errores::$error = false;

        $value = 'x';

        $resultado = $val->valida_double_mayor_igual_0($value);
        $this->assertIsArray( $resultado);
        $this->assertStringContainsStringIgnoringCase('Error el x debe ser un numero', $resultado['mensaje']);
        $this->assertTrue(errores::$error);

        errores::$error = false;

        $value = '0.0000';

        $resultado = $val->valida_double_mayor_igual_0($value);
        $this->assertIsBool( $resultado);
        $this->assertTrue($resultado);
        $this->assertNotTrue(errores::$error);

        errores::$error = false;
    }

    public function test_valida_double_mayores_0(): void{
        errores::$error = false;
        $val = new validacion();
        //$val = new liberator($val);

        $keys = array();
        $registro = array();

        $resultado = $val->valida_double_mayores_0($keys, $registro);
        $this->assertIsBool( $resultado);
        $this->assertNotTrue(errores::$error);
        $this->assertTrue($resultado);

        errores::$error = false;

        $keys = array();
        $registro = array();

        $keys[] = 'a';
        $resultado = $val->valida_double_mayores_0($keys, $registro);
        $this->assertIsArray( $resultado);
        $this->assertTrue(errores::$error);

        errores::$error = false;

        $keys = array();
        $registro = array();

        $keys[] = 'a';
        $registro['a'] = '0';
        $resultado = $val->valida_double_mayores_0($keys, $registro);
        $this->assertIsArray( $resultado);
        $this->assertTrue(errores::$error);

        errores::$error = false;

        $keys = array();
        $registro = array();

        $keys[] = 'a';
        $registro['a'] = 'x';
        $resultado = $val->valida_double_mayores_0($keys, $registro);
        $this->assertIsArray( $resultado);
        $this->assertTrue(errores::$error);

        errores::$error = false;

        $keys = array();
        $registro = array();

        $keys[] = 'a';
        $registro['a'] = '1';
        $resultado = $val->valida_double_mayores_0($keys, $registro);
        $this->assertIsBool( $resultado);
        $this->assertNotTrue(errores::$error);
        $this->assertTrue($resultado);

        errores::$error = false;

        $keys = array();
        $registro = new stdClass();

        $keys[] = 'a';
        $registro->a = '1';
        $resultado = $val->valida_double_mayores_0($keys, $registro);
        $this->assertIsBool( $resultado);
        $this->assertNotTrue(errores::$error);
        $this->assertTrue($resultado);


        errores::$error = false;
    }

    public function test_valida_double_mayores_igual_0(): void{
        errores::$error = false;
        $val = new validacion();
        //$val = new liberator($val);

        $keys = array();
        $registro = array();

        $resultado = $val->valida_double_mayores_igual_0($keys, $registro);
        $this->assertIsBool( $resultado);
        $this->assertNotTrue(errores::$error);
        $this->assertTrue($resultado);

        errores::$error = false;

        $keys = array();
        $registro = array();
        $keys[] = 'a';
        $registro['a'] = '1';

        $resultado = $val->valida_double_mayores_igual_0($keys, $registro);
        $this->assertIsBool( $resultado);
        $this->assertNotTrue(errores::$error);
        $this->assertTrue($resultado);

        errores::$error = false;

        $keys = array();
        $registro = new stdClass();
        $keys[] = 'a';
        $registro->a = '1';

        $resultado = $val->valida_double_mayores_igual_0($keys, $registro);
        $this->assertIsBool( $resultado);
        $this->assertNotTrue(errores::$error);
        $this->assertTrue($resultado);

        errores::$error = false;
    }

    public function test_valida_estilo_css(): void
    {
        errores::$error = false;
        $val = new validacion();
        //$val = new liberator($val);


        $value = '';
        $resultado = $val->valida_estilo_css($value);
        $this->assertIsArray( $resultado);
        $this->assertStringContainsStringIgnoringCase('Error style esta vacio', $resultado['mensaje_limpio']);
        $this->assertTrue(errores::$error);

        errores::$error = false;

        $value = 'a';
        $resultado = $val->valida_estilo_css($value);
        $this->assertIsArray( $resultado);
        $this->assertStringContainsStringIgnoringCase('Error style invalido a', $resultado['mensaje_limpio']);
        $this->assertTrue(errores::$error);

        errores::$error = false;

        $value = 'success';
        $resultado = $val->valida_estilo_css($value);
        $this->assertIsBool( $resultado);
        $this->assertNotTrue(errores::$error);
        $this->assertTrue($resultado);

        errores::$error = false;
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

    public function test_valida_estructura_menu()
    {

        errores::$error = false;
        $validacion = new validacion();
        $menu_id = 1;
        $_SESSION['grupo_id'] = 2;
        $resultado = $validacion->valida_estructura_menu($menu_id);
        $this->assertIsBool( $resultado);
        $this->assertTrue($resultado);
        $this->assertNotTrue(errores::$error);
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

    public function test_valida_extension_doc(): void
    {
        errores::$error = false;
        $val = new validacion();
        //$val = new liberator($val);

        $path = 'a.a';
        $resultado = $val->valida_extension_doc($path);
        $this->assertIsBool( $resultado);
        $this->assertNotTrue(errores::$error);
        $this->assertTrue($resultado);
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
        $this->assertStringContainsStringIgnoringCase('Error al validar', $resultado['mensaje']);
        $this->assertTrue(errores::$error);

        errores::$error = false;
        $key = 'a';
        $registro = array();
        $resultado = $val->valida_id(key: $key, registro: $registro);
        $this->assertIsArray( $resultado);
        $this->assertStringContainsStringIgnoringCase('Error al validar', $resultado['mensaje']);

        errores::$error = false;
        $key = 'a';
        $registro = array();
        $registro['a'] = 'z';
        $resultado = $val->valida_id(key: $key, registro: $registro);
        $this->assertIsArray( $resultado);
        $this->assertStringContainsStringIgnoringCase('Error al validar', $resultado['mensaje']);
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

    public function test_valida_keys_documento(): void{
        errores::$error = false;
        $val = new validacion();
        $val = new liberator($val);
        $registro = array();
        $resultado = $val->valida_keys_documento($registro);
        $this->assertTrue(errores::$error);
        $this->assertIsArray($resultado);
        $this->assertEquals('Error al validar registro',$resultado['mensaje_limpio']);
        errores::$error = false;

        $registro = array();
        $registro['ruta'] = 'a';

        $resultado = $val->valida_keys_documento($registro);
        $this->assertTrue(errores::$error);
        $this->assertIsArray($resultado);
        $this->assertEquals('Error al validar registro',$resultado['mensaje_limpio']);
        errores::$error = false;



        $registro = array();
        $registro['ruta'] = 'a';
        $registro['ruta_relativa'] = 'a';

        $resultado = $val->valida_keys_documento($registro);
        $this->assertTrue(errores::$error);
        $this->assertIsArray($resultado);
        $this->assertEquals('Error al validar registro',$resultado['mensaje_limpio']);
        errores::$error = false;

        $registro = array();
        $registro['ruta'] = 'a';
        $registro['ruta_relativa'] = 'a';
        $registro['ruta_absoluta'] = 'a';

        $resultado = $val->valida_keys_documento($registro);
        $this->assertNotTrue(errores::$error);
        $this->assertIsBool($resultado);

        errores::$error = false;

    }

    public function test_valida_lada(): void{
        errores::$error = false;
        $val = new validacion();
        //$val = new liberator($val);


        $lada = '012';
        $resultado = $val->valida_lada($lada);
        $this->assertNotTrue(errores::$error);
        $this->assertIsBool($resultado);
        $this->assertTrue($resultado);
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

        $this->assertNotTrue(errores::$error);
        $this->assertIsBool($resultado);

        errores::$error = false;


        $tabla = 'prueba';
        $resultado = $validacion->valida_modelo($tabla);
        $this->assertNotTrue(errores::$error);
        $this->assertIsBool($resultado);
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
        $this->assertNotTrue(errores::$error);
        $this->assertIsBool($resultado);

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

    public function test_valida_numerics(){
        errores::$error = false;
        $val = new validacion();
        $keys = array();
        $row = array();
        $resultado = $val->valida_numerics($keys, $row);
        $this->assertIsBool( $resultado);
        $this->assertTrue($resultado);
        $this->assertNotTrue(errores::$error);

        errores::$error = false;

        $keys = array();
        $row = array();
        $keys[] = 'a';
        $resultado = $val->valida_numerics($keys, $row);
        $this->assertTrue(errores::$error);
        $this->assertIsArray($resultado);
        $this->assertArrayHasKey('data',$resultado);
        $this->assertStringContainsStringIgnoringCase('Error al validar registro',$resultado['mensaje']);

        errores::$error = false;

        $keys = array();
        $row = array();
        $keys[] = 'a';
        $row['a'] = 'x';
        $resultado = $val->valida_numerics($keys, $row);
        $this->assertTrue(errores::$error);
        $this->assertIsArray($resultado);
        $this->assertArrayHasKey('data',$resultado);
        $this->assertStringContainsStringIgnoringCase('Error al validar registro[a]',$resultado['mensaje']);

        errores::$error = false;

        $keys = array();
        $row = array();
        $keys[] = 'a';
        $row['a'] = '1';
        $resultado = $val->valida_numerics($keys, $row);
        $this->assertIsBool( $resultado);
        $this->assertTrue($resultado);
        $this->assertNotTrue(errores::$error);
        errores::$error = false;
    }

    public function test_valida_numero_sin_lada(): void{
        errores::$error = false;
        $val = new validacion();
        //$val = new liberator($val);
        $tel = '12345678';
        $resultado = $val->valida_numero_sin_lada($tel);
        $this->assertIsBool( $resultado);
        $this->assertTrue($resultado);
        $this->assertNotTrue(errores::$error);
        errores::$error = false;
    }

    public function test_valida_params_json_parentesis(): void{
        errores::$error = false;
        $val = new validacion();
        $txt = '{a_a_h_jikjkjkj_l:a_l}';
        $resultado = $val->valida_params_json_parentesis($txt);
        $this->assertIsBool( $resultado);
        $this->assertTrue($resultado);
        $this->assertNotTrue(errores::$error);
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
        $key = 'texto_pep_8';
        $txt = 'a_';
        $resultado = $val->valida_pattern($key, $txt);
        $this->assertIsBool( $resultado);
        $this->assertNotTrue($resultado);
        $this->assertNotTrue(errores::$error);

        errores::$error = false;
        $key = 'texto_pep_8';
        $txt = 'a_a';
        $resultado = $val->valida_pattern($key, $txt);
        $this->assertIsBool( $resultado);
        $this->assertTrue($resultado);
        $this->assertNotTrue(errores::$error);

        errores::$error = false;
        $key = 'params_json';
        $txt = 'a_a:a';
        $resultado = $val->valida_pattern($key, $txt);
        $this->assertIsBool( $resultado);
        $this->assertTrue($resultado);
        $this->assertNotTrue(errores::$error);

        errores::$error = false;
        $key = 'params_json';
        $txt = 'a_a:a_a';
        $resultado = $val->valida_pattern($key, $txt);
        $this->assertIsBool( $resultado);
        $this->assertTrue($resultado);
        $this->assertNotTrue(errores::$error);

        errores::$error = false;
        $key = 'params_json';
        $txt = 'aa:a_a';
        $resultado = $val->valida_pattern($key, $txt);
        $this->assertIsBool( $resultado);
        $this->assertTrue($resultado);
        $this->assertNotTrue(errores::$error);

        errores::$error = false;
        $key = 'params_json';
        $txt = 'aa :   a_a';
        $resultado = $val->valida_pattern($key, $txt);
        $this->assertIsBool( $resultado);
        $this->assertTrue($resultado);
        $this->assertNotTrue(errores::$error);

        errores::$error = false;
        $key = 'params_json';
        $txt = 'aa :   a_a,a:s';
        $resultado = $val->valida_pattern($key, $txt);
        $this->assertIsBool( $resultado);
        $this->assertTrue($resultado);
        $this->assertNotTrue(errores::$error);

        errores::$error = false;
        $key = 'params_json';
        $txt = 'aa :   a_a,a:s  ,a:  a_k';
        $resultado = $val->valida_pattern($key, $txt);
        $this->assertIsBool( $resultado);
        $this->assertTrue($resultado);
        $this->assertNotTrue(errores::$error);

        errores::$error = false;
        $key = 'params_json_parentesis';
        $txt = '{ aa:a_a,a:s,a:a_k }';
        $resultado = $val->valida_pattern($key, $txt);
        $this->assertIsBool( $resultado);
        $this->assertTrue($resultado);
        $this->assertNotTrue(errores::$error);

        errores::$error = false;
        $key = 'params_json_parentesis';
        $txt = '  { aa:a_a, a: s, a:  a_k }';
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

    public function test_valida_rfc(): void
    {
        errores::$error = false;
        $val = new validacion();
        //$val = new liberator($val);
        $key = 'a';
        $registro = array();
        $registro['a']  ='AAA010101BBB';
        $resultado = $val->valida_rfc($key, $registro);
        $this->assertNotTrue(errores::$error);
        $this->assertIsBool($resultado);
        $this->assertTrue($resultado);
        errores::$error = false;
    }

    public function test_valida_rfcs(): void
    {
        errores::$error = false;
        $val = new validacion();
        //$val = new liberator($val);
        $keys = array('a');
        $registro = array();
        $registro['a'] = 'ACDD120987265';

        $resultado = $val->valida_rfcs($keys, $registro);
        $this->assertNotTrue(errores::$error);
        $this->assertIsBool($resultado);
        $this->assertTrue($resultado);
        errores::$error = false;
    }



    public function test_valida_statuses()
    {

        errores::$error = false;
        $validacion = new validacion();
        $keys = array();
        $registro = array();
        $resultado = $validacion->valida_statuses($keys, $registro);
        $this->assertNotTrue(errores::$error);

        errores::$error = false;
        $keys = array();
        $registro = array();
        $keys[] = 'a';
        $resultado = $validacion->valida_statuses($keys, $registro);
        $this->assertTrue(errores::$error);
        $this->assertIsArray($resultado);
        $this->assertArrayHasKey('data',$resultado);
        $this->assertStringContainsStringIgnoringCase('Error status invalido',$resultado['mensaje']);

        errores::$error = false;
        $keys = array();
        $registro = array();
        $keys[] = 'a';
        $registro['a'] = 'a';
        $resultado = $validacion->valida_statuses($keys, $registro);
        $this->assertTrue(errores::$error);
        $this->assertIsArray($resultado);
        $this->assertArrayHasKey('data',$resultado);
        $this->assertStringContainsStringIgnoringCase('Error a debe ser activo o inactivo',$resultado['mensaje']);

        errores::$error = false;
        $keys = array();
        $registro = array();
        $keys[] = 'a';
        $registro['a'] = 'activo';
        $resultado = $validacion->valida_statuses($keys, $registro);
        $this->assertNotTrue(errores::$error);

        errores::$error = false;
    }

    public function test_valida_texto_pep_8(): void{
        errores::$error = false;
        $val = new validacion();
        $txt = 'a_a_h_jikjkjkj_l';
        $resultado = $val->valida_texto_pep_8($txt);
        $this->assertNotTrue(errores::$error);
        $this->assertTrue($resultado);
        errores::$error = false;
    }



    public function test_valida_url(){

        errores::$error = false;
        $validacion = new validacion();

        $url = 'http://a.com';
        $resultado = $validacion->valida_url($url);
        $this->assertNotTrue(errores::$error);
        $this->assertIsBool($resultado);
        $this->assertTrue($resultado);
    }



}