<?php

namespace easyAmazonAdv\SponsoredBrands\Groups;

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
        return $this->httpGet('/sb/adGroups/'.$adGroupId);
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
        return $this->httpGet('/sb/adGroups/', $params);
    }
}
