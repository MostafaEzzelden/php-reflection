<?php
namespace App;

class Request
{
    private $getVars;

    public function __construct()
    {
        $this->getVars = $_GET;
    }

    public function all()
    {
        return $this->getVars;
    }
}
