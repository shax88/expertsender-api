<?php

namespace PicodiLab\Expertsender\Method;

use PicodiLab\Expertsender\ExpertSenderApiConnection;

abstract class AbstractMethod
{
    /** @var ExpertSenderApiConnection */
    protected $connection;

    const FORMAT_CSV = 'CSV';
    const FORMAT_JSON = 'JSON';
    const FORMAT_XML = 'XML';

    public function __construct($connection)
    {
        $this->connection = $connection;
    }


    /**
     * builds the proper request url
     * @param $method
     * @return string
     * @throws MethodInMapperNotFoundException
     */
    public function buildApiUrl($method)
    {
        $ref = new \ReflectionClass(get_class($this));
        $availableMethods = preg_grep('/^METHOD_/', array_flip($ref->getConstants()));

        $const = null;
        if (!array_key_exists($method, $availableMethods)) {
            throw new MethodInMapperNotFoundException('Method ' . $method . ' not found in \Mapper\*');
        } else {
            $apiRequestUrl = $this->connection->getUrl() . $method;
        }

        return $apiRequestUrl;
    }

    /**
     * rendering proper template
     * @param $template
     * @param $params
     * @return string
     */
    public function render($template, Array $params)
    {
        $twig = new \Twig_Environment(new \Twig_Loader_String(), array(
            'autoescape' => false,
        ));

        $templatePath = dirname(dirname(__FILE__)) . '/Template/' . $template . '.xml.twig';
        $templateOutput = file_get_contents($templatePath);

        $output = $twig->render($templateOutput, $params);

        return $output;
    }

}