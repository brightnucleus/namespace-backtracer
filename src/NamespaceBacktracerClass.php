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

/**
 * Abstract class NamespaceBacktracerClass.
 *
 * @since  0.1.0
 *
 * @author Alain Schlesser <alain.schlesser@gmail.com>
 */
abstract class NamespaceBacktracerClass
{

    // Abstract class uses trait to keep code DRY.
    // Use trait directly when you need to override an existing class.
    use NamespaceBacktracerTrait;
}
