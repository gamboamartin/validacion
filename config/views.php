<?php
namespace config;

class views
{
    public int $reg_x_pagina = 15; //Registros a mostrar en listas
    public string $ruta_templates = '';
    public string $url_assets = '';
    public string $titulo_sistema = 'organigrama'; //Titulo de sistema
    public string $ruta_templates_css;
    public string $ruta_templates_js;
    public string $ruta_template_base = '';

    public function __construct(){
        $url = (new generales())->url_base;
        $this->ruta_template_base = (new generales())->path_base;
        $this->ruta_template_base .= 'vendor/gamboa.martin/template_1/';
        $this->ruta_templates = (new generales())->path_base;
        $this->ruta_templates .= 'vendor/gamboa.martin/template_1/template/';
        $this->url_assets = $url.'vendor/gamboa.martin/template_1/assets/';
    }
}