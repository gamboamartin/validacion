<?php
namespace gamboamartin\test\src;

use gamboamartin\errores\errores;
use gamboamartin\test\test;
use gamboamartin\validacion\_codigos;

class _codigosTest extends test {
    public errores $errores;
    public function __construct(?string $name = null)
    {
        parent::__construct($name);
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