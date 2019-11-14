<?php

namespace easyAmazonAdv\SponsoredProducts\Report;

use easyAmazonAdv\Kernel\BaseClient;

class Client extends BaseClient
{
    public function requestReport(string $recordType, array $params)
    {
        return $this->httpPost("/sp/{$recordType}/report", $params);
    }

    public function getReport(int $reportId)
    {
        return $this->httpGet("/reports/{$reportId}");
    }
}
