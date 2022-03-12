<?php
namespace tests\src;

use gamboamartin\errores\errores;
use gamboamartin\validacion\validacion;
use tests\test;


class validacionTest extends test {
    public errores $errores;
    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->errores = new errores();
    }

    public function test_valida_existencia_key(): void
    {
        errores::$error = false;
        $val = new validacion();
        $registro = array();
        $keys = array();
        $resultado = $val->valida_existencia_keys($registro, $keys);
        $this->assertIsBool( $resultado);
        $this->assertTrue($resultado);
        $this->assertNotTrue(errores::$error);


        errores::$error = false;
        $registro = array();
        $keys = array();
        $keys[] = '';
        $resultado = $val->valida_existencia_keys($registro, $keys);
        $this->assertIsArray( $resultado);
        $this->assertStringContainsStringIgnoringCase('Error  no puede venir vacio', $resultado['mensaje']);
        $this->assertTrue(errores::$error);

        errores::$error = false;
        $registro = array();
        $keys = array();
        $keys[] = 'a';
        $registro['a'] = 'a';
        $resultado = $val->valida_existencia_keys($registro, $keys);
        $this->assertIsBool( $resultado);
        $this->assertTrue($resultado);
        $this->assertNotTrue(errores::$error);
        errores::$error = false;

    }



}