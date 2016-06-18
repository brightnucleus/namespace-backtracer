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
 * Trait NamespaceBacktracerTrait.
 *
 * @since  0.1.0
 *
 * @author Alain Schlesser <alain.schlesser@gmail.com>
 */
trait NamespaceBacktracerTrait
{

    /**
     * Get the caller from debug_backtrace() info.
     *
     * This traverses the call stack until it finds the first function that is
     * not a method of an ignored class/interface.
     * You should pass in the output of
     * `debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS)`.
     *
     * @since 0.1.0
     *
     * @param array|null $debugInfo Optional. Output of `debug_backtrace()` function.
     *
     * @return string Fully qualified name of the calling object/function.
     */
    protected function getCaller($debugInfo = null)
    {
        // Fetch the debugInfo if none was passed in.
        if ($debugInfo === null) {
            $debugInfo = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
        }

        $ignoredInterfaces = $this->getIgnoredInterfaces();
        $ignoredFunctions  = $this->getIgnoredFunctions();

        foreach ($debugInfo as $entry) {
            $found = false;

            // Are we dealing with a class method or a function?
            if (isset($entry['class']) && ! empty($entry['class'])) {
                $class = $entry['class'];

                $ignored = false;
                foreach ($ignoredInterfaces as $ignoredInterface) {
                    if ($class === $ignoredInterface) {
                        $ignored = true;
                        break;
                    }
                    if (is_subclass_of($class, $ignoredInterface)) {
                        $ignored = true;
                        break;
                    }
                }
                if (! $ignored) {
                    $found = $class;
                }
            } else {
                $function = $entry['function'];
                if (! in_array($function, $ignoredFunctions, true)) {
                    $found = $function;
                }
            }

            if (false !== $found) {
                return $found;
            }
        }

        return '';
    }

    /**
     * Get the caller's namespace from debug_backtrace() info.
     *
     * This traverses the call stack until it finds the first function that is
     * not a method of an ignored class/interface.
     * You should pass in the output of
     * `debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS)`.
     *
     * @since 0.1.0
     *
     * @param array|null $debugInfo Optional. Output of `debug_backtrace()` function.
     *
     * @return string Namespace of the calling object.
     */
    protected function getCallingNamespace($debugInfo = null)
    {
        // Fetch the debugInfo if none was passed in.
        if ($debugInfo === null) {
            $debugInfo = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
        }

        $namespace = $this->extractNamespace($this->getCaller($debugInfo));

        return '' !== $namespace
            ? $namespace
            : $this->getGlobalNamespace();
    }

    /**
     * Extract the namespace from a fully qualified class name.
     *
     * @since 0.1.0
     *
     * @param string $class Fully qualified class name.
     *
     * @return string Namespace of the class. Empty string if none.
     */
    protected function extractNamespace($class)
    {
        $pos = strrpos($class, '\\');
        if (false === $pos) {
            return '';
        }

        return substr($class, 0, $pos);
    }

    /**
     * Get an array of interfaces/classes to ignore while fetching a namespace.
     *
     * Override this method to adapt the output to your specific environment.
     *
     * @since 0.1.0
     *
     * @return array Array of interface/class names.
     */
    protected function getIgnoredInterfaces()
    {
        return [];
    }

    /**
     * Get an array of functions to ignore while fetching a namespace.
     *
     * Override this method to adapt the output to your specific environment.
     *
     * @since 0.1.0
     *
     * @return array Array of function names.
     */
    protected function getIgnoredFunctions()
    {
        return [
            'call_user_func',
        ];
    }

    /**
     * Get the string that is returned when the global namespace was hit.
     *
     * Override this method to adapt the output to your specific environment.
     *
     * @since 0.1.0
     *
     * @return string String that represents the global namespace.
     */
    protected function getGlobalNamespace()
    {
        return '(global)';
    }
}
