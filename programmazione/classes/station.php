<?php
if (!isset($_SESSION))
session_start();
class station
{
    public $nome;
    public $lat;
    public $long;
    public function __construct($nome, $lat, $lon)
    {
        $this->nome = $nome;
        $this->lat = $lat;
        $this->long = $lon;
    }

    
}
?>