<?php
namespace PicodiLab\Expertsender\Method\Messages;

/**
 * Attachment for message
 */
class Attachment
{
    public $mimeType = null;
    
    public $fileName = null;
    
    public $content = null;
    /**
     * 
     * @param string $fileName
     * @param string $mimeType
     * @param string $content
     */
    public function __construct($fileName, $mimeType, $content)
    {
        $this->fileName = $fileName;
        $this->mimeType = $mimeType;
        $this->content = $content;
    }
}
