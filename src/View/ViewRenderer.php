<?php

namespace App\View;

use Symfony\Component\HttpFoundation\Response;

class ViewRenderer
{
    private $pathTemplates;

    public function __construct($pathTemplates)
    {
        $this->pathTemplates = $pathTemplates;
    }

    public function render($name, array $data = [])
    {
        ob_start();
        include $this->pathTemplates . "/$name.phtml";
        $response = ob_get_clean();
        return new Response($response);
    }
}