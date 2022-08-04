<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite6d8b1d22cd9cc941964c70d9ee9c005
{
    public static $files = array (
        'a4a119a56e50fbb293281d9a48007e0e' => __DIR__ . '/..' . '/symfony/polyfill-php80/bootstrap.php',
    );

    public static $prefixLengthsPsr4 = array (
        'X' => 
        array (
            'XmlResourceRetriever\\' => 21,
        ),
        'S' => 
        array (
            'Symfony\\Polyfill\\Php80\\' => 23,
            'Symfony\\Component\\Process\\' => 26,
        ),
        'E' => 
        array (
            'Eclipxe\\XmlSchemaValidator\\' => 27,
        ),
        'C' => 
        array (
            'CfdiUtils\\' => 10,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'XmlResourceRetriever\\' => 
        array (
            0 => __DIR__ . '/..' . '/eclipxe/xmlresourceretriever/src/XmlResourceRetriever',
        ),
        'Symfony\\Polyfill\\Php80\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-php80',
        ),
        'Symfony\\Component\\Process\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/process',
        ),
        'Eclipxe\\XmlSchemaValidator\\' => 
        array (
            0 => __DIR__ . '/..' . '/eclipxe/xmlschemavalidator/src',
        ),
        'CfdiUtils\\' => 
        array (
            0 => __DIR__ . '/..' . '/eclipxe/cfdiutils/src/CfdiUtils',
        ),
    );

    public static $classMap = array (
        'Attribute' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/Attribute.php',
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'PhpToken' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/PhpToken.php',
        'Stringable' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/Stringable.php',
        'UnhandledMatchError' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/UnhandledMatchError.php',
        'ValueError' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/ValueError.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInite6d8b1d22cd9cc941964c70d9ee9c005::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInite6d8b1d22cd9cc941964c70d9ee9c005::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInite6d8b1d22cd9cc941964c70d9ee9c005::$classMap;

        }, null, ClassLoader::class);
    }
}
