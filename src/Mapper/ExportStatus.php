<?php

namespace PicodiLab\Expertsender\Mapper;

/**
 * Export Status Mapper
 */
class ExportStatus extends MapperAbstract
{
    const QUEUED     = 'Queued';
    const INPROGRESS = 'InProgress';
    const COMPLETED  = 'Completed';
    const ERROR      = 'Error';

    protected $status;
    protected $downloadUrl;

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getDownloadUrl()
    {
        return $this->downloadUrl;
    }

    /**
     * @param string $downloadUrl
     */
    public function setDownloadUrl($downloadUrl)
    {
        $this->downloadUrl = $downloadUrl;
    }


}