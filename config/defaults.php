<?php
/**
 * Bright Nucleus Namespace Backtracer.
 *
 * Get the namespace of the calling object.
 *
 * @package   BrightNucleus\NamespaceBacktracer
 * @author    Alain Schlesser <alain.schlesser@gmail.com>
 * @license   MIT
 * @link      https://www.brightnucleus.com/
 * @copyright 2016 Alain Schlesser, Bright Nucleus
 */

namespace BrightNucleus\NamespaceBacktracer;

/*
 * Configuration for Bright Nucleus Namespace Backtracer.
 */
$configuration = [
];

/*
 * Return the configuration with a vendor/package prefix.
 */
return [
    'BrightNucleus' => [
        'NamespaceBacktracer' => $configuration,
    ],
];
