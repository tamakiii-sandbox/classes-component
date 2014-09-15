<?php

namespace Concretehouse\Component\Classes;

/**
 * Interface of Functions.
 */
interface FunctionsInterface
{
    /**
     * @param string $original
     * @param string $alias
     * @param boolean $autoload
     * @return boolean
     */
    public function classAlias($original, $alias, $autoload = true);

    /**
     * @param callable $callable
     * @param boolean $throw
     * @param boolean $prepend
     * @return boolean
     */
    public function splAutoloadRegister($callable, $throw = true, $prepend = false);
}
