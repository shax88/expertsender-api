<?php

namespace PicodiLab\Expertsender\Mapper;

/**
 * Export Status Mapper
 */
class DataTableImportStatus extends MapperAbstract
{
    const INPROGRESS = 'InProgress';
    const COMPLETED  = 'Completed';
    const ERROR      = 'Error';

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $url;

    /**
     * @var DataTableImportStatusHistory
     */
    protected $history;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url)
    {
        $this->url = $url;
    }

    /**
     * @return DataTableImportStatusHistory
     */
    public function getHistory(): DataTableImportStatusHistory
    {
        return $this->history;
    }

    /**
     * @param DataTableImportStatusHistory $history
     */
    public function setHistory(DataTableImportStatusHistory $history)
    {
        $this->history = $history;
    }
}