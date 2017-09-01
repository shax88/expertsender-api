<?php

namespace PicodiLab\Expertsender\Method;

use PicodiLab\Expertsender\Exception\InvalidExpertsenderApiRequestException;
use PicodiLab\Expertsender\Mapper;
use PicodiLab\Expertsender\ResponseFormatter\XmlBased;

/**
 *
 */
class Exports extends AbstractMethod
{
    use XmlBased;

    const FIELD_FIRST_NAME        = 'FirstName';
    const FIELD_LAST_NAME         = 'LastName';
    const FIELD_EMAIL             = 'Email';
    const FIELD_EMAIL_MD5         = 'EmailMd5';
    const FIELD_IP                = 'IP';
    const FIELD_VENDOR            = 'Vendor';
    const FIELD_TRACKING_CODE     = 'TrackingCode';
    const FIELD_GEO_COUNTRY       = 'GeoCountry';
    const FIELD_GEO_STATE         = 'GeoState';
    const FIELD_GEO_CITY          = 'GeoCity';
    const FIELD_GEO_ZIPCODE       = 'GeoZipCode';
    const FIELD_LAST_ACTIVITY     = 'LastActivity';
    const FIELD_LAST_MESSAGE      = 'LastMessage';
    const FIELD_SUBSCRIPTION_DATE = 'SubscriptionDate';


    const METHOD_LISTS_EXPORTS = 'Exports';

    protected $mapperName = 'ExportStatus';

    /**
     * Request for export list of subscribers.
     *
     * @param int $listId
     * @param string[] $fields
     *
     * @return int - ID of export
     */
    public function exportRequest($listId, $fields)
    {
        $requestUrl = $this->buildApiUrl(self::METHOD_LISTS_EXPORTS);
        $params = [
            'Type'   => 'List',
            'Fields' => $fields,
            'apiKey' => $this->connection->getKey(),
            'ListId' => $listId,
        ];
        $requestBody = $this->renderRequestBody(
            'Lists/Exports',
            $params
        );

        $response = $this->connection->post($requestUrl, $requestBody);

        $valid = $this->connection->isResponseValid($response);

        if (!$valid) {
            $this->invalidRequestException();
        }

        $formattedResponse = $this->connection->prepareResponse($response);

        return (int)$formattedResponse->Data[0];
    }

    /**
     * Check export status by id. If status Completed status will have downloadUrl
     *
     * @param $id
     *
     * @return \PicodiLab\Expertsender\Mapper\ExportStatus
     */
    public function exportStatus($id)
    {
        $requestUrl = $this->buildApiUrl(self::METHOD_LISTS_EXPORTS);
        $requestUrl .= '/' . $id;

        $params = [
            'apiKey'      => $this->connection->getKey(),
            'http_errors' => false,
            'query'       => [],
        ];

        $response = $this->connection->get($requestUrl, $params);

        $valid = $this->connection->isResponseValid($response);

        if (!$valid) {
            $this->invalidRequestException();
        }

        $formattedResponse = $this->connection->prepareResponse($response);

        $mapper = new \PicodiLab\Expertsender\Mapper\ExportStatus();
        $mapper->setStatus((string)$formattedResponse->Data->Status);
        $mapper->setDownloadUrl((string)$formattedResponse->Data->DownloadUrl);
        return $mapper;
    }

}