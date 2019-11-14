<?php

namespace easyAmazonAdv\SponsoredProducts\ProductTargeting;

use easyAmazonAdv\Kernel\BaseClient;

/**
 * Class Client.
 *
 * @author  baihe <baihe@guahao.com>
 * @date    2019-11-12 09:43
 */
class Client extends BaseClient
{
    public function getTargetingClause(string $targetId)
    {
        return $this->httpGet('/sp/targets/'.$targetId);
    }

    public function listTargetingClauses(array $params = [])
    {
        return $this->httpGet('/sp/targets', $params);
    }

    public function getTargetingClauseEx(string $targetId)
    {
        return $this->httpGet('/sp/targets/extended/'.$targetId);
    }

    public function listTargetingClausesEx(array $params = [])
    {
        return $this->httpGet('/sp/targets/extended', $params);
    }

    /**
     * createTargetingClauses 创建一个或多个目标.
     *
     * @param array $params
     *                      'targetId:int'          =>  '目标id'
     *                      'campaignId:int'        =>  '活动id'
     *                      'adGroupId:int'         =>  '组id'
     *                      'state:string'          =>  '状态["enabled", "paused", "archived"]'
     *                      'expression:array'      =>  '扩展'
     *                      'type:string'   =>  ''
     *                      'value:string'  =>  ''
     *                      'expressionType:int'    =>  '类型["auto", "manual"]'
     *                      'bid:float'             =>  '广告出价'
     *
     * @return mixed
     *
     * @throws \easyAmazonAdv\Kernel\Exceptions\HttpException
     *
     * @author  baihe <baihe@guahao.com>
     * @date    2019-11-12 14:11
     */
    public function createTargetingClauses(array $params)
    {
        return $this->httpPost('/sp/targets', $params);
    }

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
     * @throws \easyAmazonAdv\Kernel\Exceptions\HttpException
     *
     * @author  baihe <baihe@guahao.com>
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
     * @throws \easyAmazonAdv\Kernel\Exceptions\HttpException
     *
     * @example [{"id":2335752011,"name":"Cell Phones & Accessories","path":"/Cell Phones & Accessories","isTargetable":true},{"id":2407774011,"name":"Cell Phone Cables","path":"/Cell Phones & Accessories/Cell Phone Accessories/Cell Phone Cables","isTargetable":true},{"id":2407755011,"name":"Cell Phone Accessories","path":"/Cell Phones & Accessories/Cell Phone Accessories","isTargetable":true}]
     *
     * @author  baihe <baihe@guahao.com>
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
     * @throws \easyAmazonAdv\Kernel\Exceptions\HttpException
     *
     * @example {"categoryId":2407755011,"brands":[{"id":20710054011,"name":"APPLE"},{"id":2528944011,"name":"Apple"},{"id":7637061011,"name":"amFilm"},{"id":19838852011,"name":"INIU"},{"id":2528919011,"name":"AmazonBasics"},{"id":20051359011,"name":"Spigen"},{"id":8886508011,"name":"Mpow"}],"ageRanges":[]}
     *
     * @author  baihe <baihe@guahao.com>
     * @date    2019-11-12 11:52
     */
    public function getRefinementsForCategory(int $categoryId)
    {
        return $this->httpGet('/sp/targets/categories/refinements', ['categoryId' => $categoryId]);
    }

    /**
     * getBrandRecommendations 根据关键字或者分类id查询对应的推荐品牌.
     *
     * @param string $type    keyword categoryId
     * @param string $content
     *
     * @return mixed
     *
     * @throws \easyAmazonAdv\Kernel\Exceptions\HttpException
     *
     * @author  baihe <baihe@guahao.com>
     * @date    2019-11-12 11:59
     */
    public function getBrandRecommendations(string $type, string $content)
    {
        $params = [$type => $content];

        return $this->httpGet('/sp/targets/brands', $params);
    }
}
