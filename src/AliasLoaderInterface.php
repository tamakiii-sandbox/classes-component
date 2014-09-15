<?php

namespace Concretehouse\Component\Classes;

/**
 * Class alias loader interface.
 */
interface AliasLoaderInterface
{
    /**
     * @param FunctionsInterface $functions
     * @param array $aliases
     */
    public function __construct(FunctionsInterface $functions, array $aliases = array());

    /**
     * @param string $name
     * @return boolean|null
     */
    public function resolve($name);

    /**
     * @param array $aliases
     */
    public function adds(array $aliases);

    /**
     * @param string $name
     * @param string $alias
     * @param boolean $autoload
     */
    public function add($name, $alias, $autoload = true);

    /**
     * Register class with spl_autoload_register()
     */
    public function register();
}
