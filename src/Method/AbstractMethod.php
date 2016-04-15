<?php

namespace PicodiLab\Expertsender\Method;

use PicodiLab\Expertsender\ExpertSenderApiConnection;

abstract class AbstractMethod
{
    /** @var ExpertSenderApiConnection */
    protected $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    /**
     * rendering proper template
     * @param $template
     * @param $params
     * @return string
     */
    public function render($template, Array $params){
        $twig = new \Twig_Environment(new \Twig_Loader_String(), array(
            'autoescape' => false,
        ));

        $templatePath = dirname(dirname(__FILE__)) . '/Template/' . $template . '.xml.twig';
        $templateOutput = file_get_contents($templatePath);

        $output = $twig->render($templateOutput, $params);

        return $output;
    }

    abstract function buildApiUrl($method);

}