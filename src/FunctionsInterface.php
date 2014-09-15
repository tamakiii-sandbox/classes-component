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
     * @return boolean $autoload
     * @return boolean
     */
    public function classAlias($original, $alias, $autoload = true);
}
