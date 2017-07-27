<?php
  namespace Clientes;

  use Zend\ServiceManager\Factory\InvokableFactory;

  return [
      'controllers' => [
          'factories' => [
              #Controller\ClientesController::class => InvokableFactory::class
          ]
      ],

      'router' => [
          'routes' => [
              'clientes' => [
                  'type' => 'segment',
                  'options' => [
                      'route' => '/clientes[/:action[/:idclientes]]',
                      'constraints' => [
                          'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                          'id' => '[0-9]+',
                      ],
                      'defaults' => [
                          'controller' => Controller\ClientesController::class,
                          'action' => 'index'
                      ]
                  ]
              ],
          ]
      ],

      'view_manager' => [
          'template_path_stack' => [
              'clientes'=>__DIR__."/../view"
          ]
      ]
  ];