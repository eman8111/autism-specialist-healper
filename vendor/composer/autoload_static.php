<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit38386a0bbeafba62c4b148ca1db2c6a9
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Project\\Classes\\' => 16,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Project\\Classes\\' => 
        array (
            0 => __DIR__ . '/../..' . '/classes',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit38386a0bbeafba62c4b148ca1db2c6a9::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit38386a0bbeafba62c4b148ca1db2c6a9::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit38386a0bbeafba62c4b148ca1db2c6a9::$classMap;

        }, null, ClassLoader::class);
    }
}
