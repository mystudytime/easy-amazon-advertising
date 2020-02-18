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
     * @param array $Keyword
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
     * @param array $Keyword
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
     * @param array $Keyword
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
     * @param string $keywordId
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
     * @param string $Keyword
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
     * @param array $Keyword
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
     * @param array $Keyword
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
     * @param string $keywordId
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
     * @param string $Keyword
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
     * @param array $params
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
