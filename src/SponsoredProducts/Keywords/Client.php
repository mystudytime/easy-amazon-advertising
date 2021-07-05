<?php

namespace easyAmazonAdv\SponsoredProducts\Keywords;

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
     * getBiddableKeyword.
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-19 19:42
     */
    public function getBiddableKeyword(string $keywordId)
    {
        return $this->httpGet("/sp/keywords/{$keywordId}");
    }

    /**
     * getBiddableKeywordEx.
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-19 19:43
     */
    public function getBiddableKeywordEx(string $keywordId)
    {
        return $this->httpGet("/sp/keywords/extended/{$keywordId}");
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
        return $this->httpPost('/sp/keywords', $Keyword);
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
        return $this->httpPut('/sp/keywords', $Keyword);
    }

    /**
     * archiveBiddableKeyword.
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-19 19:44
     */
    public function archiveBiddableKeyword(string $Keyword)
    {
        return $this->httpDelete("/sp/keywords/{$Keyword}");
    }

    /**
     * listBiddableKeywords.
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-19 19:44
     */
    public function listBiddableKeywords(array $Keyword)
    {
        return $this->httpGet('/sp/keywords', $Keyword);
    }

    /**
     * listBiddableKeywordsEx.
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-19 19:45
     */
    public function listBiddableKeywordsEx(array $Keyword)
    {
        return $this->httpGet('/sp/keywords/extended', $Keyword);
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
        return $this->httpGet("/sp/negativeKeywords/{$keywordId}");
    }

    /**
     * getNegativeKeywordEx.
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-19 19:43
     */
    public function getNegativeKeywordEx(string $keywordId)
    {
        return $this->httpGet("/sp/negativeKeywords/extended/{$keywordId}");
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
        return $this->httpPost('/sp/negativeKeywords', $Keyword);
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
        return $this->httpPut('/sp/negativeKeywords', $Keyword);
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
        return $this->httpDelete("/sp/negativeKeywords/{$Keyword}");
    }

    /**
     * listNegativeKeywords.
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-19 19:44
     */
    public function listNegativeKeywords(array $Keyword)
    {
        return $this->httpGet('/sp/negativeKeywords', $Keyword);
    }

    /**
     * listNegativeKeywordsEx.
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-19 19:45
     */
    public function listNegativeKeywordsEx(array $Keyword)
    {
        return $this->httpGet('/sp/negativeKeywords/extended', $Keyword);
    }

    /**
     * getCampaignNegativeKeyword.
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-19 19:42
     */
    public function getCampaignNegativeKeyword(string $keywordId)
    {
        return $this->httpGet("/sp/campaignNegativeKeywords/{$keywordId}");
    }

    /**
     * getCampaignNegativeKeywordEx.
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-19 19:43
     */
    public function getCampaignNegativeKeywordEx(string $keywordId)
    {
        return $this->httpGet("/sp/campaignNegativeKeywords/extended/{$keywordId}");
    }

    /**
     * createCampaignNegativeKeywords.
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-19 19:43
     */
    public function createCampaignNegativeKeywords(array $Keyword)
    {
        return $this->httpPost('/sp/campaignNegativeKeywords', $Keyword);
    }

    /**
     * updateCampaignNegativeKeywords.
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-19 19:43
     */
    public function updateCampaignNegativeKeywords(array $Keyword)
    {
        return $this->httpPut('/sp/campaignNegativeKeywords', $Keyword);
    }

    /**
     * archiveCampaignNegativeKeyword.
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-19 19:44
     */
    public function archiveCampaignNegativeKeyword(string $Keyword)
    {
        return $this->httpDelete("/sp/campaignNegativeKeywords/{$Keyword}");
    }

    /**
     * listCampaignNegativeKeywords.
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-19 19:44
     */
    public function listCampaignNegativeKeywords(array $Keyword)
    {
        return $this->httpGet('/sp/campaignNegativeKeywords', $Keyword);
    }

    /**
     * listCampaignNegativeKeywordsEx.
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-19 19:45
     */
    public function listCampaignNegativeKeywordsEx(array $Keyword)
    {
        return $this->httpGet('/sp/campaignNegativeKeywords/extended', $Keyword);
    }

    /**
     * getAdGroupSuggestedKeywords.
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-29 22:04
     */
    public function getAdGroupSuggestedKeywords(int $adGroupId, array $params = [])
    {
        return $this->httpGet("/sp/adGroups/{$adGroupId}/suggested/keywords", $params);
    }

    /**
     * getAdGroupSuggestedKeywordsEx.
     *
     * @param array $params
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-19 19:55
     */
    public function getAdGroupSuggestedKeywordsEx(int $adGroupId, $params = [])
    {
        return $this->httpGet("/sp/adGroups/{$adGroupId}/suggested/keywords/extended", $params);
    }

    /**
     * getAsinSuggestedKeywords.
     *
     * @param array $params
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-19 19:56
     */
    public function getAsinSuggestedKeywords(string $asinValue, $params = [])
    {
        return $this->httpGet("/sp/asins/{$asinValue}/suggested/keywords", $params);
    }

    /**
     * bulkGetAsinSuggestedKeywords.
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-19 19:57
     */
    public function bulkGetAsinSuggestedKeywords(array $params)
    {
        return $this->httpPost('/v2/sp/asins/suggested/keywords', $params);
    }
}
