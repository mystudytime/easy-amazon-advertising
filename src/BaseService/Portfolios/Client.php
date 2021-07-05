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
     * listPortfolios.
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-19 23:48
     */
    public function listPortfolios(array $data = [])
    {
        return $this->httpGet('/portfolios');
    }

    /**
     * listPortfoliosEx.
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-19 23:48
     */
    public function listPortfoliosEx(array $data = [])
    {
        return $this->httpGet('/portfolios/extended');
    }

    /**
     * getPortfolio.
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-19 23:48
     */
    public function getPortfolio(string $portfolioId)
    {
        return $this->httpGet('/portfolios/'.$portfolioId);
    }

    /**
     * getPortfolioEx.
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-19 23:48
     */
    public function getPortfolioEx(string $portfolioId)
    {
        return $this->httpGet('/portfolios/extended/'.$portfolioId);
    }

    /**
     * createPortfolios.
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-19 23:48
     */
    public function createPortfolios(array $params)
    {
        return $this->httpPost('/portfolios/', $params);
    }

    /**
     * updatePortfolios.
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-19 23:48
     */
    public function updatePortfolios(array $params)
    {
        return $this->httpPut('/portfolios/', $params);
    }
}
