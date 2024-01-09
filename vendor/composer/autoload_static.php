<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd3ce01a3c781cf0272e898d6259f9398
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'MattForms\\App\\Trait\\' => 20,
            'MattForms\\App\\Resource\\Front\\' => 29,
            'MattForms\\App\\Resource\\Admin\\' => 29,
            'MattForms\\App\\Model\\' => 20,
            'MattForms\\App\\Controller\\Front\\' => 31,
            'MattForms\\App\\Controller\\Admin\\' => 31,
            'MattForms\\App\\Abstract\\' => 23,
            'MattForms\\App\\' => 14,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'MattForms\\App\\Trait\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app/Traits',
        ),
        'MattForms\\App\\Resource\\Front\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app/Resources/Front',
        ),
        'MattForms\\App\\Resource\\Admin\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app/Resources/Admin',
        ),
        'MattForms\\App\\Model\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app/Models',
        ),
        'MattForms\\App\\Controller\\Front\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app/Controllers/Front',
        ),
        'MattForms\\App\\Controller\\Admin\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app/Controllers/Admin',
        ),
        'MattForms\\App\\Abstract\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app/Abstracts',
        ),
        'MattForms\\App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'MattForms\\App\\Abstract\\Controller' => __DIR__ . '/../..' . '/app/Abstracts/Controller.php',
        'MattForms\\App\\Abstract\\Model' => __DIR__ . '/../..' . '/app/Abstracts/Model.php',
        'MattForms\\App\\Controller\\Admin\\AllForms' => __DIR__ . '/../..' . '/app/Controllers/Admin/AllForms.php',
        'MattForms\\App\\Controller\\Admin\\EditForm' => __DIR__ . '/../..' . '/app/Controllers/Admin/EditForm.php',
        'MattForms\\App\\Controller\\Admin\\Settings' => __DIR__ . '/../..' . '/app/Controllers/Admin/Settings.php',
        'MattForms\\App\\Controller\\Front\\Hello' => __DIR__ . '/../..' . '/app/Controllers/Front/Hello.php',
        'MattForms\\App\\Kernel' => __DIR__ . '/../..' . '/app/Kernel.php',
        'MattForms\\App\\Model\\Form' => __DIR__ . '/../..' . '/app/Models/Form.php',
        'MattForms\\App\\Resource\\Admin\\AllFormsTable' => __DIR__ . '/../..' . '/app/Resources/Admin/AllFormsTable.php',
        'MattForms\\App\\Trait\\Classes' => __DIR__ . '/../..' . '/app/Traits/Classes.php',
        'MattForms\\App\\Trait\\FormDB' => __DIR__ . '/../..' . '/app/Traits/FormDB.php',
        'MattForms\\App\\Trait\\TemplateRenderer' => __DIR__ . '/../..' . '/app/Traits/TemplateRenderer.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitd3ce01a3c781cf0272e898d6259f9398::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd3ce01a3c781cf0272e898d6259f9398::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitd3ce01a3c781cf0272e898d6259f9398::$classMap;

        }, null, ClassLoader::class);
    }
}