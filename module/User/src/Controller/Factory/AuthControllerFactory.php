<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace User\Controller\Factory;

use Interop\Container\ContainerInterface;
use User\Controller\AuthController;
use Zend\Authentication\AuthenticationServiceInterface;

/**
 * Class AuthControllerFactory
 * @package User\Controller\Factory
 */
class AuthControllerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $authService = $container->get(AuthenticationServiceInterface::class);

        return new AuthController($authService);
    }
}
