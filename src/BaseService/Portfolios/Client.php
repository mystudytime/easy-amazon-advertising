<?php

namespace easyAmazonAdv\BaseService\Portfolios;

use easyAmazonAdv\Kernel\BaseClient;

/**
 * Class Client.
 *
 * @author  baihe <b_aihe@163.com>
 * @date    2019-11-12 14:56
 */
class Client extends BaseClient
{
    /**
     * listPortfolios 广告活动列表.
     *
     * @param array $data
     *                    'portfolioIdFilter:string'
     *                    'portfolioNameFilter:string'
     *                    'portfolioStateFilter:string'
     *
     * @return mixed
     *
     * @throws \easyAmazonAdv\Kernel\Exceptions\HttpException
     *
     * @example [{"portfolioId":1234567890,"name":"My Portfolio One","budget":{"amount":100.0,"currencyCode":"USD","policy":"dateRange""startDate":"20181001","endDate":"20181229"},"inBudget":true,"state":"enabled",},{"portfolioId":0123456789,"name":"My Portfolio Two","budget":{"amount":50.0,"currencyCode":"USD","policy":"dateRange","startDate":"20181001","endDate":"20181229"},"inBudget":true,"state":"enabled",}]
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-12 00:12
     */
    public function listPortfolios(array $data = [])
    {
        return $this->httpGet('/portfolios');
    }

    /**
     * listPortfoliosEx 广告活动列表扩展（字段更详细）.
     *
     * @param array $data
     *                    'portfolioIdFilter:string'
     *                    'portfolioNameFilter:string'
     *                    'portfolioStateFilter:string'
     *
     * @return mixed
     *
     * @throws \easyAmazonAdv\Kernel\Exceptions\HttpException
     *
     * @example [{"portfolioId":1234567890,"name":"My Portfolio One","budget":{"amount":100.0,"currencyCode":"USD","policy":"dateRange""startDate":"20181001","endDate":"20181229"},"inBudget":true,"state":"enabled","creationDate":1526510030,"lastUpdatedDate":1526510030,"servingStatus":"PENDING_START_DATE"},{"portfolioId":0123456789,"name":"My Portfolio Two","budget":{"amount":50.0,"currencyCode":"USD","policy":"dateRange","startDate":"20181001","endDate":"20181229"},"inBudget":true,"state":"enabled","creationDate":1526510030,"lastUpdatedDate":1526510030,"servingStatus":"PENDING_START_DATE"}]
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-12 00:13
     */
    public function listPortfoliosEx(array $data = [])
    {
        return $this->httpGet('/portfolios/extended');
    }

    /**
     * getPortfolio 根据组合id返回组合详情.
     *
     * @param string $portfolioId 组合id
     *
     * @return mixed
     *               'portfolioId:int'   =>  '组合id'
     *               'name:string'       =>  '组合名称'
     *               'inBudget:bool'     =>  '是否在预算内'
     *               'state:string'      =>  '状态[]'
     *
     * @throws \easyAmazonAdv\Kernel\Exceptions\HttpException
     *
     * @example {"portfolioId":1234567890,"name":"My Portfolio One","budget":{"amount":100.0,"currencyCode":"USD","policy":"dateRange""startDate":"20181231""endDate":"null"},"inBudget":true,"state":"enabled"}
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-12 00:15
     */
    public function getPortfolio(string $portfolioId)
    {
        return $this->httpGet('/portfolios/'.$portfolioId);
    }

    /**
     * getPortfoliosExtended.
     *
     * @param string $portfolioId
     *
     * @return mixed
     *
     * @throws \easyAmazonAdv\Kernel\Exceptions\HttpException
     *
     * @example {"portfolioId":149317040707859,"name":"ARUS-Hub","inBudget":true,"state":"enabled","creationDate":1545206235644,"lastUpdatedDate":1545206235644,"servingStatus":"PORTFOLIO_STATUS_ENABLED"}
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-12 00:28
     */
    public function getPortfolioEx(string $portfolioId)
    {
        return $this->httpGet('/portfolios/extended/'.$portfolioId);
    }

    /**
     * createPortfolios 批量创建活动组合.
     *
     * @param array $params
     *
     * @return mixed
     *
     * @throws \easyAmazonAdv\Kernel\Exceptions\HttpException
     *
     * @example request [{"name":"My Portfolio One","budget":{"amount":100.0,"policy":"dateRange","startDate":"20181201","endDate":"20190131",},"state":"enabled"},{"name":"My Portfolio Two","budget":{"amount":50.0,"policy":"dateRange","startDate":"20181001","endDate":null},"state":"enabled"}]
     * @example response [{"code":"SUCCESS","portfolioId":1234567890},{"code":"SUCCESS","portfolioId":0123456789}]
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-12 15:50
     */
    public function createPortfolios(array $params)
    {
        return $this->httpPost('/portfolios/', $params);
    }

    /**
     * updatePortfolios.
     *
     * @param array $params
     *
     * @return mixed
     *
     * @throws \easyAmazonAdv\Kernel\Exceptions\HttpException
     *
     * @example request [{"portfolioId":0123456789,"name":"My Portfolio New Name","budget":{"amount":200.0,}},{"portfolioId":1234567890,"budget":{"amount":900.0,"policy":"dateRange""startDate":"20181201","endDate":"20190131",}}]
     * @example response [{"code":"SUCCESS","portfolioId":0123456789},{"code":"SUCCESS","portfolioId":1234567890}]
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-12 15:53
     */
    public function updatePortfolios(array $params)
    {
        return $this->httpPut('/portfolios/', $params);
    }
}
