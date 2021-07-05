<?php

namespace easyAmazonAdv\BaseService\Profiles;

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
     * listProfiles.
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-19 23:49
     */
    public function listProfiles()
    {
        return $this->httpGet('/profiles');
    }

    /**
     * getProfile.
     *
     * @return mixed
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-12 15:40
     */
    public function getProfile(int $profileId)
    {
        return $this->httpGet('/profiles/'.$profileId);
    }

    /**
     * updateProfiles.
     *
     * @return mixed
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-12 15:40
     */
    public function updateProfiles(array $profile)
    {
        return $this->httpPut('/profiles', $profile);
    }
}
