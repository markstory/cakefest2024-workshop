<?php
/**
 * Routes configuration.
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * It's loaded within the context of `Application::routes()` method which
 * receives a `RouteBuilder` instance `$routes` as method argument.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;

/*
 * This file is loaded in the context of the `Application` class.
  * So you can use  `$this` to reference the application class instance
  * if required.
 */
return function (RouteBuilder $routes): void {
    /*
     * The default class to use for all routes
     *
     * The following route classes are supplied with CakePHP and are appropriate
     * to set as the default:
     *
     * - Route
     * - InflectedRoute
     * - DashedRoute
     *
     * If no call is made to `Router::defaultRouteClass()`, the class used is
     * `Route` (`Cake\Routing\Route\Route`)
     *
     * Note that `Route` does not do any inflections on URLs which will result in
     * inconsistently cased URLs when used with `{plugin}`, `{controller}` and
     * `{action}` markers.
     */
    $routes->setRouteClass(DashedRoute::class);

    $routes->scope('/', function (RouteBuilder $builder): void {
        $builder->connect('/login', 'Users::login', ['_name' => 'users:login']);

        $builder->connect('/orgs/', 'Organizations::index', ['_name' => 'orgs:index']);
        $builder->connect('/orgs/add', 'Organizations::add', ['_name' => 'orgs:add']);

        $builder->scope('/orgs/{orgslug}', function (RouteBuilder $builder): void {
            $builder->connect('/', 'Organizations::view', ['_name' => 'orgs:view']);
            $builder->connect('/edit', 'Organizations::edit', ['_name' => 'orgs:edit']);
            $builder->connect('/delete', 'Organizations::delete', ['_name' => 'orgs:delete']);
            $builder->connect('/invites/add', 'OrganizationInvites::add', ['_name' => 'orginvites:add']);
        });

        $builder->scope('/orgs/{orgslug}/teams', ['controller' => 'Teams'], function (RouteBuilder $builder): void {
            $builder->connect('/', 'Teams::index', ['_name' => 'teams:index']);
            $builder->connect('/add', 'Teams::add', ['_name' => 'teams:add']);
            $builder->connect('/edit/*', 'Teams::edit', ['_name' => 'teams:edit']);
            $builder->connect('/view/*', 'Teams::view', ['_name' => 'teams:view']);
            $builder->connect('/delete/*', 'Teams::delete', ['_name' => 'teams:delete']);
        });

        $builder->scope('/orgs/{orgslug}/projects', ['controller' => 'Projects'], function (RouteBuilder $builder): void {
            $builder->connect('/', 'Projects::index', ['_name' => 'projects:index']);
            $builder->connect('/add', 'Projects::add', ['_name' => 'projects:add']);
            $builder->connect('/edit/*', 'Projects::edit', ['_name' => 'projects:edit']);
            $builder->connect('/view/*', 'Projects::view', ['_name' => 'projects:view']);
            $builder->connect('/delete/*', 'Projects::delete', ['_name' => 'projects:delete']);
        });

        $builder->scope('/orgs/{orgslug}/members', ['controller' => 'OrganizationMembers'], function (RouteBuilder $builder): void {
            $builder->connect('/', 'OrganizationMembers::index', ['_name' => 'orgmembers:index']);
            $builder->connect('/add', 'OrganizationMembers::add', ['_name' => 'orgmembers:add']);
            $builder->connect('/edit/*', 'OrganizationMembers::edit', ['_name' => 'orgmembers:edit']);
            $builder->connect('/view/*', 'OrganizationMembers::view', ['_name' => 'orgmembers:view']);
            $builder->connect('/delete/*', 'OrganizationMembers::delete', ['_name' => 'orgmembers:delete']);
        });

        $builder->scope('/orgs/{orgslug}/team-members', ['controller' => 'TeamMembers'], function (RouteBuilder $builder): void {
            $builder->connect('/delete/*', 'TeamMembers::delete', ['_name' => 'teammembers:delete']);
        });

        $builder->scope('/users', ['controller' => 'Users'], function (RouteBuilder $builder): void {
            $builder->connect('/view/*', 'Users::view', ['_name' => 'users:view']);
            $builder->connect('/edit/*', 'Users::edit', ['_name' => 'users:edit']);
        });

        /*
         * Here, we are connecting '/' (base path) to a controller called 'Pages',
         * its action called 'display', and we pass a param to select the view file
         * to use (in this case, templates/Pages/home.php)...
         */
        $builder->connect('/', ['controller' => 'Pages', 'action' => 'display', 'home']);

        /*
         * ...and connect the rest of 'Pages' controller's URLs.
         */
        $builder->connect('/pages/*', 'Pages::display');
    });
};
