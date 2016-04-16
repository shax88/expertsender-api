<?php

namespace PicodiLab\Expertsender\ResponseFormatter;


/**
 * Used for switching formats of the ExpertSender API responce for those requests that comes in XML by default
 * Trait XmlBased
 * @package PicodiLab\Expertsender\ResponseFormatter
 */
trait XmlBased
{
    /**
     * converts fields array to CSV
     * @param $input
     */
    public function asCSV($input)
    {
        $aInput = $this->asArray($input);

        $o = fopen("php://output", 'w');
        $labelsDone = false;

        foreach ($aInput as $v) {
            if (!$labelsDone) {
                fputcsv($o, array_keys($v));
                $labelsDone = true;
            }
            fputcsv($o, array_values($v));
        }
    }

    /**
     * converting XML response into Array
     * @param string $input
     * @return mixed
     */
    public function asArray($input)
    {
        $rXmlFields = simplexml_load_string($input);
        $ref = new \ReflectionClass($this);
        $aOutput = json_decode(json_encode((array)$rXmlFields->Data->{$ref->getShortName()}), true);
        $aOutput = $aOutput[key($aOutput)];

        foreach ($aOutput as &$aElement) {
            foreach ($aElement as $k => &$v) {
                if (empty($v) && is_array($v)) {
                    $v = '';
                }
            }
            unset($v);
        }
        unset($aElement);

        return $aOutput;
    }

}