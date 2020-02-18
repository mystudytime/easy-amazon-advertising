<?php

namespace easyAmazonAdv\SponsoredBrands\Bid;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        $pimple['bid'] = function ($app) {
            return new Client($app);
        };
    }
}
