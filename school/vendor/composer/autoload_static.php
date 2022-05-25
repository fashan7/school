<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf59d197464e6f410ea5b193cbb04c3a8
{
    public static $classMap = array (
        'App' => __DIR__ . '/../..' . '/core/App.php',
        'ComposerAutoloaderInitf59d197464e6f410ea5b193cbb04c3a8' => __DIR__ . '/..' . '/composer/autoload_real.php',
        'Composer\\Autoload\\ClassLoader' => __DIR__ . '/..' . '/composer/ClassLoader.php',
        'Composer\\Autoload\\ComposerStaticInitf59d197464e6f410ea5b193cbb04c3a8' => __DIR__ . '/..' . '/composer/autoload_static.php',
        'Connection' => __DIR__ . '/../..' . '/core/database/connection.php',
        'QueryBuilder' => __DIR__ . '/../..' . '/core/database/QueryBuilder.php',
        'Request' => __DIR__ . '/../..' . '/core/Request.php',
        'Router' => __DIR__ . '/../..' . '/core/Router.php',
        'ShowController' => __DIR__ . '/../..' . '/controller/ShowController.php',
        'View' => __DIR__ . '/../..' . '/core/view.php',
        'commonSql' => __DIR__ . '/../..' . '/modal/common.modal.php',
        'deleteController' => __DIR__ . '/../..' . '/controller/deleteController.php',
        'detailsController' => __DIR__ . '/../..' . '/controller/detailsController.php',
        'loginController' => __DIR__ . '/../..' . '/controller/loginController.php',
        'mail' => __DIR__ . '/../..' . '/controller/mailController.php',
        'materialController' => __DIR__ . '/../..' . '/controller/materialController.php',
        'pageController' => __DIR__ . '/../..' . '/controller/pageController.php',
        'privilegeController' => __DIR__ . '/../..' . '/controller/privilegeController.php',
        'questionController' => __DIR__ . '/../..' . '/controller/questionController.php',
        'registerController' => __DIR__ . '/../..' . '/controller/registerController.php',
        'searchController' => __DIR__ . '/../..' . '/controller/searchController.php',
        'updateController' => __DIR__ . '/../..' . '/controller/updateController.php',
        'validationController' => __DIR__ . '/../..' . '/controller/validationController.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInitf59d197464e6f410ea5b193cbb04c3a8::$classMap;

        }, null, ClassLoader::class);
    }
}