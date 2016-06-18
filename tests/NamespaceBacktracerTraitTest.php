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
 * Class NamespaceBacktracerTraitTest.
 *
 * @since  0.1.0
 *
 * @author Alain Schlesser <alain.schlesser@gmail.com>
 */
class NamespaceBacktracerTraitTest extends \PHPUnit_Framework_TestCase
{

    use NamespaceBacktracerTrait;

    /** @var array */
    protected $ignoredInterfaces;
    /** @var array */
    protected $ignoredFunctions;
    /** @var string */
    protected $globalNamespace;

    public function testIgnoredInterfacesOverride()
    {
        $this->setupOverrides(['Test\Namespace\Interface'], [], '');
        $this->assertEquals(['Test\Namespace\Interface'], $this->getIgnoredInterfaces());
    }

    public function testIgnoredFunctionsOverride()
    {
        $this->setupOverrides([], ['printf'], '');
        $this->assertEquals(['printf'], $this->getIgnoredFunctions());
    }

    public function testGlobalNamespaceOverride()
    {
        $this->setupOverrides([], [], '(GN)');
        $this->assertEquals('(GN)', $this->getGlobalNamespace());
    }

    /** @dataProvider dataProviderTestGetCallingNamespace */
    public function testGetCallingNamespace(
        $debugInfo,
        $ignoredInterfaces,
        $ignoredFunctions,
        $globalNamespace,
        $result
    ) {
        $this->setupOverrides($ignoredInterfaces, $ignoredFunctions, $globalNamespace);
        $this->assertEquals($result, $this->getCallingNamespace($debugInfo));
    }

    public function dataProviderTestGetCallingNamespace()
    {
        // $debugInfo, $ignoredInterfaces, $ignoredFunctions, $globalNamespace, $result
        return [
            [
                null,
                [],
                [],
                '(global)',
                'BrightNucleus\NamespaceBacktracer',
            ],
            [
                null,
                [
                    'BrightNucleus\NamespaceBacktracer\NamespaceBacktracerTraitTest',
                ],
                [],
                '(global)',
                '(global)',
            ],
            [
                null,
                [
                    'BrightNucleus\NamespaceBacktracer\NamespaceBacktracerTraitTest',
                    'ReflectionMethod',
                ],
                [],
                '(global)',
                '(global)',
            ],
            [
                debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS),
                [],
                [],
                '(global)',
                'BrightNucleus\NamespaceBacktracer',
            ],
        ];
    }

    /**
     * @return array
     */
    protected function getIgnoredInterfaces()
    {
        return $this->ignoredInterfaces;
    }

    /**
     * @return array
     */
    protected function getIgnoredFunctions()
    {
        return $this->ignoredFunctions;
    }

    /**
     * @return string
     */
    protected function getGlobalNamespace()
    {
        return $this->globalNamespace;
    }

    protected function setupOverrides($ignoredInterfaces, $ignoredFunctions, $globalNamespace)
    {
        $this->ignoredInterfaces = $ignoredInterfaces;
        $this->ignoredFunctions  = $ignoredFunctions;
        $this->globalNamespace   = $globalNamespace;
    }
}
