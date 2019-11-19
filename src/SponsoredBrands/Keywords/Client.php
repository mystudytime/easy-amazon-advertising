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
    public function listKeywords(array $Keyword)
    {
        return $this->httpGet('/sb/keywords', $Keyword);
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
        return $this->httpPut('/sb/keywords', $Keyword);
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
        return $this->httpPost('/sb/keywords', $Keyword);
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
        return $this->httpGet("/sb/keywords/{$keywordId}");
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
        return $this->httpDelete("/sb/keywords/{$Keyword}");
    }
}
