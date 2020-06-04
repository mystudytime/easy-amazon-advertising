<?php

namespace easyAmazonAdv\SponsoredBrands\Bid;

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
     * bidRecommendations.
     *
     * @param array $params
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2020-02-18 16:28
     */
    public function bidRecommendations(array $params)
    {
        return $this->httpPost('/sb/recommendations/bids', $params, [], false);
    }
}
