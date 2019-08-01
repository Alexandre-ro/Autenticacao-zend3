<?php
/**
 * Created by PhpStorm.
 * User: alexandre
 * Date: 01/08/19
 * Time: 11:01
 */

namespace User\Service\Factory;

use Interop\Container\ContainerInterface;
use Zend\Authentication\Adapter\DbTable\CallbackCheckAdapter;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Storage\Session;
use Zend\Db\Adapter\AdapterInterface;

/**
 * Class AuthenticationServiceFactory
 * @package User\Service\Factory
 */
class AuthenticationServiceFactory
{

    public function __invoke(ContainerInterface $container)
    {
        $passwordCallBackVerify = function ($passwordInDatabase, $passwordSent) {

            return password_verify($passwordSent, $passwordInDatabase);

        };

        $dbadapter = $container->get(AdapterInterface::class);
        $authAdapter = new CallbackCheckAdapter($dbadapter, 'usuario', 'email','senha', $passwordCallBackVerify);
        $storage = new Session();

        return new AuthenticationService($storage, $authAdapter);
    }
}