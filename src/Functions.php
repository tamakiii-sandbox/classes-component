<?php

namespace Concretehouse\Component\Classes;

/**
 * Functions class inject to AliasLoader for test.
 */
class Functions implements FunctionsInterface
{
    /**
     * @param string $original
     * @param string $alias
     * @return boolean $autoload
     * @return boolean
     */
    public function classAlias($original, $alias, $autoload = true)
    {
        return class_alias($original, $alias, $autoload);
    }

    /**
     * @param callable $callable
     * @param boolean $throw
     * @param boolean $prepend
     * @return boolean
     */
    public function splAutoloadRegister($callable, $throw = true, $prepend = false)
    {
        return spl_autoload_register($callable, $throw, $prepend);
    }
}
