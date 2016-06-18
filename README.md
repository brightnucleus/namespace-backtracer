# Bright Nucleus Namespace Backtracer

[![Scrutinizer Code Quality](https://img.shields.io/scrutinizer/g/brightnucleus/namespace-backtracer.svg)](https://scrutinizer-ci.com/g/brightnucleus/namespace-backtracer/?branch=master)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/brightnucleus/namespace-backtracer.svg)](https://scrutinizer-ci.com/g/brightnucleus/namespace-backtracer/?branch=master)
[![Build Status](https://img.shields.io/scrutinizer/build/g/brightnucleus/namespace-backtracer.svg)](https://scrutinizer-ci.com/g/brightnucleus/namespace-backtracer/build-status/master)
[![Codacy Badge](https://img.shields.io/codacy/00000000000000000000000000000000.svg)](https://www.codacy.com/app/BrightNucleus/namespace-backtracer)
[![Code Climate](https://img.shields.io/codeclimate/github/brightnucleus/namespace-backtracer.svg)](https://codeclimate.com/github/brightnucleus/namespace-backtracer)

[![Latest Stable Version](https://img.shields.io/packagist/v/brightnucleus/namespace-backtracer.svg)](https://packagist.org/packages/brightnucleus/namespace-backtracer)
[![Total Downloads](https://img.shields.io/packagist/dt/brightnucleus/namespace-backtracer.svg)](https://packagist.org/packages/brightnucleus/namespace-backtracer)
[![Latest Unstable Version](https://img.shields.io/packagist/vpre/brightnucleus/namespace-backtracer.svg)](https://packagist.org/packages/brightnucleus/namespace-backtracer)
[![License](https://img.shields.io/packagist/l/brightnucleus/namespace-backtracer.svg)](https://packagist.org/packages/brightnucleus/namespace-backtracer)

Get the namespace of the calling object, by scanning the debug backtrace, skipping a known set of namespaces & functions in the process.

## Table Of Contents

* [Installation](#installation)
* [Basic Usage](#basic-usage)
* [Contributing](#contributing)
* [License](#license)

## Installation

The best way to install this package is through Composer:

```BASH
composer require brightnucleus/namespace-backtracer
```

## Basic Usage

To create a new class that can fetch the caller's namespace, you can either extend the `BrightNucleus\NamespaceBacktracer\NamespaceBacktracerClass` class or, should you already have a class you need to extend, you can import the `BrightNucleus\NamespaceBacktracer\NamespaceBacktracerTrait` trait.

In both cases you'll want to override one or more of the three methods that allow you to adapt the behavior to your environment:

* **`getIgnoredInterfaces()`**

This gets the list of interfaces/classes to ignore while traversing the backtrace.

* **`getIgnoredFunctions()`**

This gets the list of functions to ignore while traversing the backtrace.

* **`getGlobalNamespace()`**

This defines by what string the global namespace is represented.

## Contributing

All feedback / bug reports / pull requests are welcome.

## License

Copyright (c) 2016 Alain Schlesser, Bright Nucleus

This code is licensed under the [MIT License](LICENSE).
