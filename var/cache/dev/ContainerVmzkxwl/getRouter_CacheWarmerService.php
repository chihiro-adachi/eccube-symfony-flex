<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private 'router.cache_warmer' shared service.

require_once $this->targetDirs[3].'/vendor/symfony/dependency-injection/ServiceLocator.php';
require_once $this->targetDirs[3].'/vendor/symfony/http-kernel/CacheWarmer/CacheWarmerInterface.php';
require_once $this->targetDirs[3].'/vendor/symfony/framework-bundle/CacheWarmer/RouterCacheWarmer.php';

return $this->services['router.cache_warmer'] = new \Symfony\Bundle\FrameworkBundle\CacheWarmer\RouterCacheWarmer(new \Symfony\Component\DependencyInjection\ServiceLocator(array('router' => function () {
    return ${($_ = isset($this->services['router']) ? $this->services['router'] : $this->getRouterService()) && false ?: '_'};
})));
