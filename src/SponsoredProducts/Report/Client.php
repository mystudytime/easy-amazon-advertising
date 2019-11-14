<?php

namespace easyAmazonAdv\SponsoredProducts\Report;

use easyAmazonAdv\Kernel\BaseClient;

class Client extends BaseClient
{
    /**
     * requestReport.
     *
     * @param string $recordType
     * @param array  $params
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-14 16:23
     */
    public function requestReport(string $recordType, array $params)
    {
        return $this->httpPost("/sp/{$recordType}/report", $params);
    }

    /**
     * getReport.
     *
     * @param string $reportId
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-14 16:23
     */
    public function getReport(string $reportId)
    {
        $result = $this->httpGet("/reports/{$reportId}");
        if ($result['success'] && 'SUCCESS' == $result['response']['status']) {
            return $this->httpDownload($result['response']['location']);
        }

        return $result;
    }
}
