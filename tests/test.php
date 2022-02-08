<?php
namespace tests;

use gamboamartin\errores\errores;
use gamboamartin\validacion\validacion;
use PHPUnit\Framework\TestCase;


class test extends TestCase{

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

    }

    public function test_btn_base(){
        errores::$error = false;
        $validacion = new validacion();
        $data_boton = array();
        $resultado = $validacion->btn_base($data_boton);
        $this->assertArrayHasKey('error', $resultado);
        $this->assertArrayHasKey('mensaje', $resultado);
        $this->assertIsArray( $resultado);
        $this->assertStringContainsStringIgnoringCase("Error",$resultado["mensaje"]);
        $this->assertTrue(errores::$error);


        errores::$error = false;
        $data_boton = array();
        $data_boton['filtro'] = array();
        $data_boton['id'] = 1;
        $data_boton['etiqueta'] = 1;
        $resultado = $validacion->btn_base($data_boton);
        $this->assertNotTrue(errores::$error);
        $this->assertIsBool($resultado);
        $this->assertTrue($resultado);

        errores::$error = false;

        unset($_POST, $_GET['seccion'], $_GET['accion'], $_GET['registro_id']);
    }

    public function test_btn_second(){
        errores::$error = false;
        $validacion = new validacion();
        $data_boton = array();
        $resultado = $validacion->btn_second($data_boton);
        $this->assertArrayHasKey('error', $resultado);
        $this->assertArrayHasKey('mensaje', $resultado);
        $this->assertIsArray( $resultado);
        $this->assertStringContainsStringIgnoringCase("Error",$resultado["mensaje"]);
        $this->assertTrue(errores::$error);

        errores::$error = false;
        $validacion = new validacion();
        $data_boton = array();
        $data_boton["etiqueta"] = "x";
        $data_boton["class"] = "x";
        $resultado = $validacion->btn_second($data_boton);
        $this->assertNotTrue(errores::$error);
        $this->assertIsBool($resultado);
        $this->assertTrue($resultado);

        errores::$error = false;


        errores::$error = false;

        unset($_POST, $_GET['seccion'], $_GET['accion'], $_GET['registro_id']);
    }

}
