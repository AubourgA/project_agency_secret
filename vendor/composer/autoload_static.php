<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit3e4490420f25d16bd82275d37b675444
{
    public static $prefixLengthsPsr4 = array (
        'D' => 
        array (
            'DB\\' => 3,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'DB\\' => 
        array (
            0 => __DIR__ . '/../..' . '/lib',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit3e4490420f25d16bd82275d37b675444::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit3e4490420f25d16bd82275d37b675444::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit3e4490420f25d16bd82275d37b675444::$classMap;

        }, null, ClassLoader::class);
    }
}
