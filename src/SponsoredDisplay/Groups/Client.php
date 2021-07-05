<?php

namespace easyAmazonAdv\SponsoredDisplay\Groups;

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
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-14 00:47
     */
    public function getAdGroup(int $adGroupId)
    {
        return $this->httpGet('/sd/adGroups/'.$adGroupId, [], false);
    }

    /**
     * getAdGroupEx.
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-14 00:47
     */
    public function getAdGroupEx(int $adGroupId)
    {
        return $this->httpGet('/sd/adGroups/extended/'.$adGroupId, [], false);
    }

    /**
     * createAdGroups.
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-14 00:47
     */
    public function createAdGroups(array $params)
    {
        return $this->httpPost('/sd/adGroups', $params, [], false);
    }

    /**
     * updateAdGroups.
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-14 00:47
     */
    public function updateAdGroups(array $params)
    {
        return $this->httpPut('/sd/adGroups', $params, [], false);
    }

    /**
     * archiveAdGroup.
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-14 00:47
     */
    public function archiveAdGroup(int $adGroupId)
    {
        return $this->httpDelete('/sd/adGroups/'.$adGroupId, [], [], false);
    }

    /**
     * listAdGroups.
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-14 00:47
     */
    public function listAdGroups(array $params = [])
    {
        return $this->httpGet('/sd/adGroups/', $params, false);
    }

    /**
     * listAdGroupsEx.
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-14 00:47
     */
    public function listAdGroupsEx(array $params = [])
    {
        return $this->httpGet('/sd/adGroups/extended', $params, false);
    }
}
