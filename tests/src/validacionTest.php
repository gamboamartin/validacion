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

    public function test_class(): void
    {
        errores::$error = false;
        $val = new validacion();
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
        $this->assertIsArray( $resultado);
        $this->assertStringContainsStringIgnoringCase('Error modelo no existe', $resultado['mensaje']);
        $this->assertTrue(errores::$error);

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

    public function test_valida_pattern(): void{
        errores::$error = false;
        $val = new validacion();
        $val = new liberator($val);
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

        $key = 'id';
        $txt = '10';
        $resultado = $val->valida_pattern($key, $txt);
        $this->assertIsBool( $resultado);
        $this->assertTrue($resultado);
        $this->assertNotTrue(errores::$error);

    }



}