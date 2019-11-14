<?php

namespace easyAmazonAdv\BaseService\AccessToken;

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
     * RefreshToken.
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-14 21:32
     */
    public function refreshToken()
    {
        return $this->doRefreshToken();
    }
}
