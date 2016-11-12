<?php

namespace Application\Factory;

use Interop\Container\ContainerInterface;
use Zend\Db\Adapter\Adapter as ZendAdapter;

class UserTableGateway
{
    public function __invoke(ContainerInterface $container)
    {
        $adapter = $container->get('Application\Factory\DbAdapter');

        return new \Zend\Db\TableGateway\TableGateway('users', $adapter);
    }
}
