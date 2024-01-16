<?php
namespace gamboamartin\test\src;

use gamboamartin\errores\errores;
use gamboamartin\test\liberator;
use gamboamartin\test\test;
use gamboamartin\validacion\_codigos;
use gamboamartin\validacion\validacion;
use stdClass;

class _codigosTest extends test {
    public errores $errores;
    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->errores = new errores();
    }


    public function test_init_cod_int_0_n_numbers(): void{
        errores::$error = false;
        $val = new _codigos();
        //$val = new liberator($val);

        $longitud = 1;
        $resultado = $val->init_cod_int_0_n_numbers($longitud,array());
        $this->assertIsString( $resultado);
        $this->assertEquals("/^[0-9]{1}$/", $resultado);
        $this->assertNotTrue(errores::$error);
        errores::$error = false;
    }



}