<?php

namespace easyAmazonAdv\SponsoredProducts\Report;

use Pimple\ServiceProviderInterface;
use Pimple\Container;

class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        $pimple['productTargeting'] = function ($app) {
            return new Client($app);
        };
    }
}
