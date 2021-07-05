<?php

namespace easyAmazonAdv\SponsoredDisplay\Report;

use easyAmazonAdv\Kernel\BaseClient;

class Client extends BaseClient
{
    /**
     * requestReport.
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-14 16:23
     */
    public function requestReport(string $recordType, array $params)
    {
        return $this->httpPost("/sd/{$recordType}/report", $params, [], false);
    }

    /**
     * getReport.
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-14 16:23
     */
    public function getReport(string $reportId)
    {
        return $this->httpGet("/reports/{$reportId}");
    }

    /**
     * downloadReportData.
     *
     * @param $params
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-14 19:45
     */
    public function downloadReportData(string $reportId, $params)
    {
        return $this->httpDownload("/reports/{$reportId}/download", $params);
    }
}
