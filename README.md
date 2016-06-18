# Bright Nucleus Namespace Backtracer

[![Scrutinizer Code Quality](https://img.shields.io/scrutinizer/g/brightnucleus/namespace-backtracer.svg)](https://scrutinizer-ci.com/g/brightnucleus/namespace-backtracer/?branch=master)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/brightnucleus/namespace-backtracer.svg)](https://scrutinizer-ci.com/g/brightnucleus/namespace-backtracer/?branch=master)
[![Build Status](https://img.shields.io/scrutinizer/build/g/brightnucleus/namespace-backtracer.svg)](https://scrutinizer-ci.com/g/brightnucleus/namespace-backtracer/build-status/master)
[![Codacy Badge](https://img.shields.io/codacy/f6cbee5a1adb4e2995aa5e42d8531fce.svg)](https://www.codacy.com/app/BrightNucleus/namespace-backtracer)
[![Code Climate](https://img.shields.io/codeclimate/github/brightnucleus/namespace-backtracer.svg)](https://codeclimate.com/github/brightnucleus/namespace-backtracer)

[![Latest Stable Version](https://img.shields.io/packagist/v/brightnucleus/namespace-backtracer.svg)](https://packagist.org/packages/brightnucleus/namespace-backtracer)
[![Total Downloads](https://img.shields.io/packagist/dt/brightnucleus/namespace-backtracer.svg)](https://packagist.org/packages/brightnucleus/namespace-backtracer)
[![Latest Unstable Version](https://img.shields.io/packagist/vpre/brightnucleus/namespace-backtracer.svg)](https://packagist.org/packages/brightnucleus/namespace-backtracer)
[![License](https://img.shields.io/packagist/l/brightnucleus/namespace-backtracer.svg)](https://packagist.org/packages/brightnucleus/namespace-backtracer)

Get the namespace of the calling object, by scanning the debug backtrace, skipping a known set of namespaces & functions in the process.

## Table Of Contents

* [Overview](#overview)
* [Installation](#installation)
* [Basic Usage](#basic-usage)
    * [Setting Things Up](#setting-things-up)
    * [Making The Call](#making-the-call)
* [Contributing](#contributing)
* [License](#license)

## Overview

This class/trait allows you to traverse the `debug_backtrace()` to find out what the calling class/function or the calling namespace is. This is useful in cases where you need to find out at runtime in what context a given method was called.

## Installation

The best way to install this package is through Composer:

```BASH
composer require brightnucleus/namespace-backtracer
```

## Basic Usage

### Setting Things Up

To create a new class that can fetch the caller's name or namespace, you can either extend the `BrightNucleus\NamespaceBacktracer\NamespaceBacktracerClass` class or, should you already have a class you need to extend, you can import the `BrightNucleus\NamespaceBacktracer\NamespaceBacktracerTrait` trait.

In both cases you'll want to override one or more of the three methods that allow you to adapt the behavior to your environment:

* __`getIgnoredInterfaces()`__

This gets the list of interfaces/classes to ignore while traversing the backtrace.

* __`getIgnoredFunctions()`__

This gets the list of functions to ignore while traversing the backtrace.

* __`getGlobalNamespace()`__

This defines by what string the global namespace is represented.

### Making The Call

To get the caller's namespace for a specific call, you pass the output of `debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS)` that was executed from within the callee to the `getCallingNamespace()` method. If you don't provide a `debug_backtrace` output, it will get fetched within the trait (which might be a different context than the one you want to check).

__Example:__

```PHP
<?php

namespace CalleeNamespace {

    use BrightNucleus\NamespaceBacktracer\NamespaceBacktracerTrait;

    class Callee {

        use NamespaceBacktracerTrait;

        protected function getIgnoredInterfaces() {
            return [
                'CalleeNamespace\Callee',
            ];
        }

        public function calledFunctionGetCaller() {
            echo $this->getCaller();
        }

        public function calledFunctionGetNamespace() {
            echo $this->getCallingNamespace();
        }
    }

}

namespace CallerNamespace {

    use CalleeNamespace\Callee;

    class Caller {

        public function callingFunctionGetCaller() {
            $callee = new Callee();
            $callee->calledFunctionGetCaller();
        }

        public function callingFunctionGetNamespace() {
            $callee = new Callee();
            $callee->calledFunctionGetNamespace();
        }
    }
}

$caller = new CallerNamespace\Caller();

// This will echo "CallerNamespace\Caller" from within the
// CalleeNamespace\Callee\calledFunction() method.
$caller->callingFunctionGetCaller();

// This will echo "CallerNamespace" from within the
// CalleeNamespace\Callee\calledFunction() method.
$caller->callingFunctionGetNamespace();
```

## Contributing

All feedback / bug reports / pull requests are welcome.

## License

Copyright (c) 2016 Alain Schlesser, Bright Nucleus

This code is licensed under the [MIT License](LICENSE).
