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
}
