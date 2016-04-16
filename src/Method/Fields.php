<?php

namespace PicodiLab\Expertsender\Method;


class Fields extends AbstractMethod
{

    const METHOD_Fields = 'Fields';

    protected $mapperName = 'Field';


    public function get()
    {
        $requestUrl = $this->buildApiUrl(self::METHOD_Fields);
        $response = $this->connection->get($requestUrl, []);
        $this->connection->isResponseValid($response);

        return $this->formatResponse($response);
    }


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
     * converting XML response from the (/Fields request) into Array
     * @param string $input
     * @return mixed
     */
    public function asArray($input)
    {
        $rXmlFields = simplexml_load_string($input);
        $fieldsArray = json_decode(json_encode((array)$rXmlFields->Data->Fields), true)['Field'];

        foreach ($fieldsArray as &$aField) {
            foreach ($aField as $k => &$v) {
                if (empty($v) && is_array($v)) {
                    $v = '';
                }
            }
            unset($v);
        }
        unset($aField);
        return $fieldsArray;
    }


}