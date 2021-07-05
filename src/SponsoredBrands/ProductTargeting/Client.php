<?php

namespace easyAmazonAdv\SponsoredBrands\ProductTargeting;

use easyAmazonAdv\Kernel\BaseClient;

/**
 * Class Client.
 *
 * @author  baihe <b_aihe@163.com>
 * @date    2020-02-18 15:37
 */
class Client extends BaseClient
{
    /**
     * listTargeting.
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2020-02-18 15:38
     */
    public function listTargetingClauses(array $params)
    {
        return $this->httpPost('/sb/targets/list', $params, [], false);
    }

    /**
     * updateTargetingClauses.
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-14 19:50
     */
    public function updateTargetingClauses(array $params)
    {
        return $this->httpPut('/sb/targets', $params, [], false);
    }

    /**
     * createTargetingClauses.
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2020-02-18 16:03
     */
    public function createTargetingClauses(array $params)
    {
        return $this->httpPost('/sb/targets', $params, [], false);
    }

    /**
     * getTargetingClause.
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2020-02-18 15:46
     */
    public function getTargetingClause(string $targetId)
    {
        return $this->httpGet('/sb/targets/'.$targetId, [], false);
    }

    /**
     * archiveTargetingClauses.
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2020-02-18 15:47
     */
    public function archiveTargetingClauses(string $targetId)
    {
        return $this->httpDelete('/sb/targets/'.$targetId, [], [], false);
    }

    /**
     * batchGetTargetingClauses.
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2020-02-18 15:49
     */
    public function batchGetTargetingClauses(array $targetIds)
    {
        return $this->httpPost('/sb/targets/batchGet', ['targetIds' => $targetIds], [], false);
    }

    /**
     * listNegativeTargetingClauses.
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2020-02-18 16:01
     */
    public function listNegativeTargetingClauses(array $params)
    {
        return $this->httpPost('/sb/negativeTargets/list', $params, [], false);
    }

    /**
     * updateNegativeTargetingClauses.
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2020-02-18 16:01
     */
    public function updateNegativeTargetingClauses(array $params)
    {
        return $this->httpPut('/sb/negativeTargets', $params, [], false);
    }

    /**
     * createNegativeTargetingClauses.
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2020-02-18 16:03
     */
    public function createNegativeTargetingClauses(array $params)
    {
        return $this->httpPost('/sb/negativeTargets', $params, [], false);
    }

    /**
     * getNegativeTargetingClause.
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2020-02-18 16:04
     */
    public function getNegativeTargetingClause(string $targetId)
    {
        return $this->httpGet('/sb/negativeTargets/'.$targetId, [], false);
    }

    /**
     * archiveNegativeTargetingClauses.
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2020-02-18 16:04
     */
    public function archiveNegativeTargetingClauses(string $targetId)
    {
        return $this->httpDelete('/sb/negativeTargets/'.$targetId, [], [], false);
    }

    /**
     * batchGetTargetingClauses.
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2020-02-18 15:49
     */
    public function batchGetNegativeTargetingClauses(array $targetIds)
    {
        return $this->httpPost('/sb/negativeTargets/batchGet', ['targetIds' => $targetIds], [], false);
    }

    /**
     * listProductTargetRecommendations.
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2020-02-18 16:22
     */
    public function listProductTargetRecommendations(array $params)
    {
        return $this->httpPost('/sb/recommendations/targets/product/list', $params, [], false);
    }

    /**
     * listCategoryTargetRecommendations.
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2020-02-18 16:23
     */
    public function listCategoryTargetRecommendations(array $params)
    {
        return $this->httpPost('/sb/recommendations/targets/category', $params, [], false);
    }

    /**
     * listBrandTargetRecommendations.
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2020-02-18 16:23
     */
    public function listBrandTargetRecommendations(array $params)
    {
        return $this->httpPost('/sb/recommendations/targets/brand', $params, [], false);
    }
}
