<?php

namespace App\View;

class ViewRenderer
{
    private $pathTemplates;

    private $templateName;

    public function __construct($pathTemplates)
    {
        $this->pathTemplates = $pathTemplates;
    }

    public function render($name, array $data = [])
    {
        $content = $this->getOutput($name, $data);
        return $this->getOutput(__DIR__ . '/../../templates/layouts/layout.phtml', ['content' => $content]);
    }

    private function getOutput($name, array $data)
    {
        $this->templateName = $name;
        extract($data);

        ob_start();
 
        if (!file_exists($this->templateName)) {
            include $this->pathTemplates . "/$this->templateName.phtml";
        } else {
            include $this->templateName;
        }

        
        $response = ob_get_clean();
        return $response;
    }
}
