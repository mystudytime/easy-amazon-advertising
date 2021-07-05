<?php

namespace easyAmazonAdv\SponsoredProducts\Bidding;

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
     * getAdGroupBidRecommendations.
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-14 20:02
     */
    public function getAdGroupBidRecommendations(int $adGroupId)
    {
        return $this->httpGet("/sp/adGroups/{$adGroupId}/bidRecommendations");
    }

    /**
     * getKeywordBidRecommendations.
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-14 20:02
     */
    public function getKeywordBidRecommendations(int $keywordId)
    {
        return $this->httpGet("/sp/keywords/{$keywordId}/bidRecommendations");
    }

    /**
     * createKeywordBidRecommendations.
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-14 20:02
     */
    public function createKeywordBidRecommendations(array $params)
    {
        return $this->httpPost('/keywords/bidRecommendations', $params);
    }

    /**
     * getBidRecommendations.
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-14 20:03
     */
    public function getBidRecommendations(array $params)
    {
        return $this->httpPost(' /sp/targets/bidRecommendations', $params);
    }
}
