<?php

namespace easyAmazonAdv\SponsoredProducts\Groups;

use easyAmazonAdv\Kernel\BaseClient;

/**
 * Class Client.
 *
 * @author  baihe <b_aihe@163.com>
 * @date    2019-11-12 17:50
 */
class Client extends BaseClient
{
    /**
     * getAdGroup.
     *
     * @param int $adGroupId
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-14 00:47
     */
    public function getAdGroup(int $adGroupId)
    {
        return $this->httpGet('/sp/adGroups/'.$adGroupId);
    }

    /**
     * getAdGroupEx.
     *
     * @param int $adGroupId
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-14 00:47
     */
    public function getAdGroupEx(int $adGroupId)
    {
        return $this->httpGet('/sp/adGroups/extended/'.$adGroupId);
    }

    /**
     * createAdGroups.
     *
     * @param array $params
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-14 00:47
     */
    public function createAdGroups(array $params)
    {
        return $this->httpPost('/sp/adGroups', $params);
    }

    /**
     * updateAdGroups.
     *
     * @param array $params
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-14 00:47
     */
    public function updateAdGroups(array $params)
    {
        return $this->httpPut('/sp/adGroups', $params);
    }

    /**
     * archiveAdGroup.
     *
     * @param int $adGroupId
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-14 00:47
     */
    public function archiveAdGroup(int $adGroupId)
    {
        return $this->httpDelete('/sp/adGroups/'.$adGroupId);
    }

    /**
     * listAdGroups.
     *
     * @param array $params
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-14 00:47
     */
    public function listAdGroups(array $params = [])
    {
        return $this->httpGet('/sp/adGroups/', $params);
    }

    /**
     * listAdGroupsEx.
     *
     * @param array $params
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-14 00:47
     */
    public function listAdGroupsEx(array $params = [])
    {
        return $this->httpGet('/sp/adGroups/extended', $params);
    }
}
