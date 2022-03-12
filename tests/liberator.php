<?php
namespace tests;
use gamboamartin\errores\errores;
use ReflectionClass;
use Throwable;

class liberator {
    private object $originalObject;
    private ReflectionClass $class;
    private errores $error;


    public function __construct(object $originalObject) {
        $this->originalObject = $originalObject;
        $this->class = new ReflectionClass($originalObject);
        $this->error = new errores();
    }

    public function __get($name) {
        try {
            $property = $this->class->getProperty($name);
            $property->setAccessible(true);
            return $property->getValue($this->originalObject);
        }
        catch (Throwable $e){
            return $this->error->error('Error al obtener datos', $e);
        }

    }

    public function __set($name, $value) {
        try {
            $property = $this->class->getProperty($name);
            $property->setAccessible(true);
            $property->setValue($this->originalObject, $value);
            return $property;
        }
        catch (Throwable $e){
            return $this->error->error('Error al setear datos', $e);
        }
    }

    public function __call($name, $args) {
        try {
            $method = $this->class->getMethod($name);
            $method->setAccessible(true);
            return $method->invokeArgs($this->originalObject, $args);
        }
        catch (Throwable $e){
            return $this->error->error('Error al llamar datos', $e);
        }
    }

}
