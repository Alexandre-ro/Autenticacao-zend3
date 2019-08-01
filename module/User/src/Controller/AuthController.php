<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace User\Controller;

use User\Form\LoginForm;
use Zend\Authentication\AuthenticationServiceInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Authentication\Adapter\DbTable\CallbackCheckAdapter;

/**
 * Class AuthController
 * @package User\Controller
 */
class AuthController extends AbstractActionController
{
    private $authenticationService;

    /**
     * AuthController constructor.
     * @param AuthenticationServiceInterface $authenticationService
     */
    public function __construct(AuthenticationServiceInterface $authenticationService)
    {
        $this->authenticationService = $authenticationService;
    }

    public function loginAction()
    {
        if ($this->authenticationService->hasIdentity()) {
            return "logado";
        }
        $loginForm = new LoginForm();
        $messageError = null;
        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPost();
            $loginForm->setData($data);
            if ($loginForm->isValid()) {
                $formData = $loginForm->getData();
                /**@var CallbackCheckAdapter $authAdapter */
                $authAdapter = $this->authenticationService->getAdapter();
                $authAdapter->setIdentity($formData['email']);
                $authAdapter->setCredential($formData['password']);
                $result = $this->authenticationService->authenticate();
                if ($result->isValid()) {
                    $messageError = 'Logado';
                } else {
                    $messageError = 'Login inválido';
                    var_dump($result);
                }
            }
        }
        return new ViewModel(['form' => $loginForm, 'messageError' => $messageError]);
    }

    public function logoutAction()
    {
        $this->authenticationService->clearIdentity();

        return $this->redirect()->toRoute('login');
    }
}






















