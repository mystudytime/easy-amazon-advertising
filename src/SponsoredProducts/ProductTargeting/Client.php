<?php

namespace easyAmazonAdv\SponsoredProducts\ProductTargeting;

use easyAmazonAdv\Kernel\BaseClient;

/**
 * Class Client.
 *
 * @author  baihe <b_aihe@163.com>
 * @date    2019-11-12 09:43
 */
class Client extends BaseClient
{
    /**
     * getTargetingClause.
     *
     * @param string $targetId
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-14 19:50
     */
    public function getTargetingClause(string $targetId)
    {
        return $this->httpGet('/sp/targets/'.$targetId);
    }

    /**
     * listTargetingClauses.
     *
     * @param array $params
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-14 19:50
     */
    public function listTargetingClauses(array $params = [])
    {
        return $this->httpGet('/sp/targets', $params);
    }

    /**
     * getTargetingClauseEx.
     *
     * @param string $targetId
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-14 19:50
     */
    public function getTargetingClauseEx(string $targetId)
    {
        return $this->httpGet('/sp/targets/extended/'.$targetId);
    }

    /**
     * listTargetingClausesEx.
     *
     * @param array $params
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-14 19:50
     */
    public function listTargetingClausesEx(array $params = [])
    {
        return $this->httpGet('/sp/targets/extended', $params);
    }

    /**
     * createTargetingClauses.
     *
     * @param array $params
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-14 19:50
     */
    public function createTargetingClauses(array $params)
    {
        return $this->httpPost('/sp/targets', $params);
    }

    /**
     * updateTargetingClauses.
     *
     * @param array $params
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-14 19:50
     */
    public function updateTargetingClauses(array $params)
    {
        return $this->httpPut('/sp/targets', $params);
    }

    /**
     * createTargetRecommendations.
     *
     * @param array $asins
     * @param int   $pageNumber
     * @param int   $pageSize
     *
     * @return mixed
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-12 15:08
     */
    public function createTargetRecommendations(array $asins, int $pageNumber, int $pageSize = 50)
    {
        return $this->httpPost('/sp/targets/productRecommendations', compact('asins', 'pageNumber', 'pageSize'));
    }

    /**
     * getTargetingCategories 根据传入的ains返回推荐的分类列表.
     *
     * @param array $asins
     *
     * @return mixed
     *
     * @example [{"id":2335752011,"name":"Cell Phones & Accessories","path":"/Cell Phones & Accessories","isTargetable":true},{"id":2407774011,"name":"Cell Phone Cables","path":"/Cell Phones & Accessories/Cell Phone Accessories/Cell Phone Cables","isTargetable":true},{"id":2407755011,"name":"Cell Phone Accessories","path":"/Cell Phones & Accessories/Cell Phone Accessories","isTargetable":true}]
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-12 11:48
     */
    public function getTargetingCategories(array $asins)
    {
        return $this->httpGet('/sp/targets/categories', ['asins' => implode(',', $asins)]);
    }

    /**
     * getRefinementsForCategory 返回单个分类$categoryId对应的细化选项.
     *
     * @param int $categoryId
     *
     * @return mixed
     *
     * @example {"categoryId":2407755011,"brands":[{"id":20710054011,"name":"APPLE"},{"id":2528944011,"name":"Apple"},{"id":7637061011,"name":"amFilm"},{"id":19838852011,"name":"INIU"},{"id":2528919011,"name":"AmazonBasics"},{"id":20051359011,"name":"Spigen"},{"id":8886508011,"name":"Mpow"}],"ageRanges":[]}
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-12 11:52
     */
    public function getRefinementsForCategory(int $categoryId)
    {
        return $this->httpGet('/sp/targets/categories/refinements', ['categoryId' => $categoryId]);
    }

    /**
     * getBrandRecommendations.
     *
     * @param string $type
     * @param string $content
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2020-02-10 14:39
     */
    public function getBrandRecommendations(string $type, string $content)
    {
        $params = [$type => $content];

        return $this->httpGet('/sp/targets/brands', $params);
    }
}
