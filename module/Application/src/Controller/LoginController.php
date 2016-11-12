<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class LoginController extends AbstractActionController
{

    public $tableGateway;
    public $cache;

    public function __construct($tableGateway, $cache)
    {
        $this->tableGateway = $tableGateway;
        $this->cache = $cache;
    }

    public function indexAction()
    {

        $form = $this->getForm();

        $form->setAttribute('action', '/login');

        $request = $this->getRequest();

        if ($request->isPost()) {
            $user = new \Application\Model\User;
            $form->setInputFilter($user->getInputFilter());
            $form->setData($request->getPost());
            if ($form->isValid()) {

                $data = $form->getData();

                $user = $this->tableGateway->select([
                    'email' => $data['email'],
                    'password' => $data['password']
                ]);

                if ( count($user) > 0 ) {
                    return $this->redirect()->toUrl('/beer');
                }

                $error = "Login invalid.";
                $form->get('email')->setValue($data['email']);

            }
        }

        $view = new ViewModel([
            'form' => $form,
            'error' => isset($error) ? $error : null
        ]);
        $view->setTemplate('application/login/index.phtml');

        return $view;
    }


    private function getForm()
    {
        $form = new \Application\Form\Login;
        foreach ($form->getElements() as $element) {
            if (! $element instanceof \Zend\Form\Element\Submit) {
                $element->setAttributes([
                    'class' => 'form-control'
                ]);
            }
        }
        return $form;
    }

}
