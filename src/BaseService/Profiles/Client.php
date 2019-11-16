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
     * @return mixed
     *
     * @example [{"profileId":3753569985456409,"countryCode":"US","currencyCode":"USD","dailyBudget":9.99999999E8,"timezone":"America/Los_Angeles","accountInfo":{"marketplaceStringId":"ATVPDKIKX0DER","id":"A2REBULWX98LHD","type":"seller"}},{"profileId":952708443898026,"countryCode":"CA","currencyCode":"CAD","dailyBudget":9.99999999E8,"timezone":"America/Los_Angeles","accountInfo":{"marketplaceStringId":"A2EUQ1WTGCTBG2","id":"A2REBULWX98LHD","type":"seller"}}]
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-12 15:07
     */
    public function listProfiles()
    {
        return $this->httpGet('/profiles');
    }

    /**
     * getProfile.
     *
     * @param int $profileId
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
     * @param array $profile
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
