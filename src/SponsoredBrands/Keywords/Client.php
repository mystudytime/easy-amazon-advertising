<?php

namespace easyAmazonAdv\SponsoredBrands\Keywords;

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
     * listKeywords.
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-19 19:44
     */
    public function listKeywords(array $Keyword = [])
    {
        return $this->httpGet('/sb/keywords', $Keyword, false);
    }

    /**
     * updateKeywords.
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-19 19:43
     */
    public function updateKeywords(array $Keyword)
    {
        return $this->httpPut('/sb/keywords', $Keyword, [], false);
    }

    /**
     * createKeywords.
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-19 19:43
     */
    public function createKeywords(array $Keyword)
    {
        return $this->httpPost('/sb/keywords', $Keyword, [], false);
    }

    /**
     * getBiddableKeyword.
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-19 19:42
     */
    public function getKeyword(string $keywordId)
    {
        return $this->httpGet("/sb/keywords/{$keywordId}", [], false);
    }

    /**
     * archiveKeyword.
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-19 19:44
     */
    public function archiveKeyword(string $Keyword)
    {
        return $this->httpDelete("/sb/keywords/{$Keyword}", [], [], false);
    }

    /**
     * updateNegativeKeywords.
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-19 19:43
     */
    public function updateNegativeKeywords(array $Keyword)
    {
        return $this->httpPut('/sb/negativeKeywords', $Keyword, [], false);
    }

    /**
     * createNegativeKeywords.
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-19 19:43
     */
    public function createNegativeKeywords(array $Keyword)
    {
        return $this->httpPost('/sb/negativeKeywords', $Keyword, [], false);
    }

    /**
     * getNegativeKeyword.
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-19 19:42
     */
    public function getNegativeKeyword(string $keywordId)
    {
        return $this->httpGet("/sb/negativeKeywords/{$keywordId}", [], false);
    }

    /**
     * archiveNegativeKeyword.
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-19 19:44
     */
    public function archiveNegativeKeyword(string $Keyword)
    {
        return $this->httpDelete("/sb/negativeKeywords/{$Keyword}", [], [], false);
    }

    /**
     * keywordRecommendations.
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2020-02-18 15:13
     */
    public function keywordRecommendations(array $params)
    {
        return $this->httpPost('/sb/recommendations/keyword', $params, [], false);
    }
}
