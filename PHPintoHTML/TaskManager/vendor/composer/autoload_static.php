<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit6c1bfb67dda05858273bea488bea601a
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'MH\\TaskManager\\' => 15,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'MH\\TaskManager\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit6c1bfb67dda05858273bea488bea601a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit6c1bfb67dda05858273bea488bea601a::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit6c1bfb67dda05858273bea488bea601a::$classMap;

        }, null, ClassLoader::class);
    }
}
