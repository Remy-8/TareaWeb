<?php


class personaje{
    public $idx = '';
    public $identificacion = '';
    public $nombre  = '';
    public $apellido = '';
    public $fecha_nacimiento = '';
    public $foto = '';
    public $profesion = '';
    public $nivel_experiencia = 0;



    public function edad() {
        if (empty($this->fecha_nacimiento)) {
            return 0;
        }
        $fecha_Nacimiento = strtotime($this->fecha_nacimiento);
        $fecha_Actual = time();
        $edad = date('Y', $fecha_Actual) - date('Y', $fecha_Nacimiento);
        if (date('md', $fecha_Actual) < date('md', $fecha_Nacimiento)) {
            $edad--;
        }
        return $edad;
    }

    public function __construct($data = []) {
        if(is_object($data)) {
            $data = (array)$data;
        }

        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }
}


class profesion{
    public $idx = '';
    public $codigo = '';
    public $nombre = '';
    public $categoria = '';
    public $salario_mensual = 0;

    public function __construct($data = []) {
        if(is_object($data)) {
            $data = (array)$data;
        }

        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }

    public function __toString() {
        return "$this->nombre - Salario: {$this->salario_mensual}";
    }
}