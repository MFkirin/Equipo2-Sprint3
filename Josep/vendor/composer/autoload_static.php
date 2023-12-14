<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit6c0aee3eb548be96eb30de61cdcba9e7
{
    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Fpdf\\' => 5,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Fpdf\\' => 
        array (
            0 => __DIR__ . '/..' . '/fpdf/fpdf/src/Fpdf',
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit6c0aee3eb548be96eb30de61cdcba9e7::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit6c0aee3eb548be96eb30de61cdcba9e7::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit6c0aee3eb548be96eb30de61cdcba9e7::$classMap;

        }, null, ClassLoader::class);
    }
}
