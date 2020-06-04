<?php

namespace easyAmazonAdv\BaseService\OAuth;

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
     * authorizationURL 生成授权亚马逊url.
     *
     * @param array
     *
     * @return string
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2020-06-04 21:32
     */
    public function authorizationURL(array $params): string
    {
        return $this->getOAuthUrl($params);
    }

    /**
     * token 根据亚马逊生成code，获取亚马逊授权refresh_token.
     *
     * @param array $params
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2020-06-04 21:32
     */
    public function token(array $params): array
    {
        return $this->OAuth($params);
    }
}
