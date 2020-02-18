<?php

namespace easyAmazonAdv\SponsoredDisplay\NegativeTargeting;

use easyAmazonAdv\Kernel\BaseClient;

/**
 * Class Client.
 *
 * @author  baihe <b_aihe@163.com>
 * @date    2020-02-17 14:59
 */
class Client extends BaseClient
{
    /**
     * listNegativeTargetingClauses.
     *
     * @param array $params
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2020-02-17 15:01
     */
    public function listTargetingClauses(array $params = [])
    {
        return $this->httpGet('/sd/negativeTargets', $params, false);
    }

    /**
     * updateNegativeTargetingClauses.
     *
     * @param array $params
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2020-02-17 15:01
     */
    public function updateNegativeTargetingClauses(array $params)
    {
        return $this->httpPut('/sd/negativeTargets', $params, [], false);
    }

    /**
     * createNegativeTargetingClauses.
     *
     * @param array $params
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2020-02-17 15:02
     */
    public function createNegativeTargetingClauses(array $params)
    {
        return $this->httpPost('/sd/negativeTargets', $params, [], false);
    }

    /**
     * getNegativeTargetingClause.
     *
     * @param string $targetId
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-14 19:50
     */
    public function getNegativeTargetingClause(string $targetId)
    {
        return $this->httpGet('/sd/negativeTargets/'.$targetId, [], false);
    }

    /**
     * deleteNegativeTargetingClause.
     *
     * @param string $targetId
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2020-02-17 14:48
     */
    public function deleteNegativeTargetingClause(string $targetId)
    {
        return $this->httpDelete('/sd/negativeTargets/'.$targetId, [], [], false);
    }

    /**
     * listNegativeTargetingClausesEx.
     *
     * @param array $params
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-14 19:50
     */
    public function listNegativeTargetingClausesEx(array $params = [])
    {
        return $this->httpGet('/sd/negativeTargets/extended', $params, false);
    }

    /**
     * getNegativeTargetingClauseEx.
     *
     * @param string $targetId
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-14 19:50
     */
    public function getNegativeTargetingClauseEx(string $targetId)
    {
        return $this->httpGet('/sd/negativeTargets/extended/'.$targetId, [], false);
    }
}
