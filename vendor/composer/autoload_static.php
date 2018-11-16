<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitcb741e99a74b02bb43c109b8ce5ab64e
{
    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Firebase\\JWT\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Firebase\\JWT\\' => 
        array (
            0 => __DIR__ . '/..' . '/firebase/php-jwt/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitcb741e99a74b02bb43c109b8ce5ab64e::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitcb741e99a74b02bb43c109b8ce5ab64e::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
