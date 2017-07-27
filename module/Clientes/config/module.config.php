<?php
  namespace Clientes;

  use Zend\ServiceManager\Factory\InvokableFactory;

  return [
      'controllers' => [
          'factories' => [
              Controller\ClientesController::class => InvokableFactory::class
          ]
      ],

      'router' => [
           'routes'=> [
               'clientes' => [
                   'type' => 'literal',
                   'options' => [
                       'route' => '/clientes',
                       'defaults' => [
                           'controller' => Controller\ClientesController::class,
                           'action'=> 'index'
                       ]
                   ]
               ]
           ]
      ],

      'view_manager' => [
          'template_path_stack' => [
              'clientes'=>__DIR__."/../view"
          ]
      ]
  ];