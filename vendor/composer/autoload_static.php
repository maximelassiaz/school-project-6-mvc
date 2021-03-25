<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitdd8079e8f199fb6bd7dd5fe8b9cbddcc
{
    public static $prefixLengthsPsr4 = array (
        'a' => 
        array (
            'app\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'app\\' => 
        array (
            0 => __DIR__ . '/../..' . '/',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitdd8079e8f199fb6bd7dd5fe8b9cbddcc::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitdd8079e8f199fb6bd7dd5fe8b9cbddcc::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitdd8079e8f199fb6bd7dd5fe8b9cbddcc::$classMap;

        }, null, ClassLoader::class);
    }
}
