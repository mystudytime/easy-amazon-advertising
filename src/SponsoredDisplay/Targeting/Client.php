<?php

namespace easyAmazonAdv\SponsoredDisplay\Targeting;

use easyAmazonAdv\Kernel\BaseClient;

/**
 * Class Client.
 *
 * @author  baihe <b_aihe@163.com>
 * @date    2020-02-17 14:50
 */
class Client extends BaseClient
{
    /**
     * listTargetingClauses.
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-14 19:50
     */
    public function listTargetingClauses(array $params = [])
    {
        return $this->httpGet('/sd/targets', $params, false);
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
        return $this->httpPut('/sd/targets', $params, [], false);
    }

    /**
     * createTargetingClauses.
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-14 19:50
     */
    public function createTargetingClauses(array $params)
    {
        return $this->httpPost('/sd/targets', $params, [], false);
    }

    /**
     * getTargetingClause.
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-14 19:50
     */
    public function getTargetingClause(string $targetId)
    {
        return $this->httpGet('/sd/targets/'.$targetId, [], false);
    }

    /**
     * deleteTargetingClause.
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2020-02-17 14:48
     */
    public function deleteTargetingClause(string $targetId)
    {
        return $this->httpDelete('/sd/targets/'.$targetId, [], [], false);
    }

    /**
     * listTargetingClausesEx.
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-14 19:50
     */
    public function listTargetingClausesEx(array $params = [])
    {
        return $this->httpGet('/sd/targets/extended', $params, false);
    }

    /**
     * getTargetingClauseEx.
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-14 19:50
     */
    public function getTargetingClauseEx(string $targetId)
    {
        return $this->httpGet('/sd/targets/extended/'.$targetId, [], false);
    }
}
