<?php
namespace config;
class generales{

    public string $path_base = '/var/www/html/organigrama/';
    public string $session_id = '';
    public bool $muestra_index;
    public string $sistema = 'organigrama';
    public bool $aplica_seguridad = true;
    public bool $encripta_md5 = false;
    public array $secciones = array('org_empresa','org_sucursal','org_ejecuta','org_dependencia','org_actividad','org_representante_legal','org_representante_asignado','org_porcentaje_act_economica');
    public string $url_base = 'http://localhost/organigrama/';


    public function __construct(){
        $this->muestra_index = true;
        if(isset($_GET['session_id'])){
            $this->session_id = $_GET['session_id'];
        }
    }
}