<?php

namespace PicodiLab\Expertsender\Formatter;


class CsvFormatter extends AbstractFormatter
{


    function format($input){
        // csv is default by ExpertSender Api. No change needed;
        return $output = $input;
    }

}