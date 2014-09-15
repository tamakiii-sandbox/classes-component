<?php

namespace Concretehouse\Component\Classes;

/**
 * Class alias loader class.
 */
class AliasLoader implements AliasLoaderInterface
{
    /**
     * @var FunctionsInterface
     */
    private $functions;

    /**
     * @var array
     */
    private $aliases = array();

    /**
     * @var boolean
     */
    private $registered = false;


    /**
     * @param FunctionsInterface $functions
     * @param array $aliases
     */
    public function __construct(
        FunctionsInterface $functions,
        array $aliases = array()
    ) {
        $this->functions = $functions;
        $this->adds($aliases);
    }

    /**
     * @param string $name
     * @return boolean|null
     */
    public function resolve($name)
    {
        if ($alias = $this->get($name)) {
            return $this->functions->classAlias($alias[0], $name, $alias[1]);
        }
    }

    /**
     * @param array $aliases
     */
    public function adds(array $aliases)
    {
        foreach ($aliases as $name => $alias) {
            if (!is_array($alias)) {
                $this->add($name, $alias);
            } else {
                if (!isset($alias[0])) {
                    throw new \UnexpectedValueException('Alias must have least one parameter.');
                }
                $this->add($name, $alias[0], isset($alias[1]) ? $alias[1] : true);
            }
        }
    }

    /**
     * @param string $name
     * @param string $alias
     * @param boolean $autoload
     * @return string|null
     */
    private function get($name)
    {
        if (isset($this->aliases[$name])) {
            return end($this->aliases[$name]);
        }
    }

    /**
     * @param string $name
     * @param string $alias
     * @param boolean $autoload
     */
    public function add($name, $alias, $autoload = true)
    {
        if (!is_string($alias)) {
            throw new \InvalidArgumentException('$alias must be string.');
        }
        if (!isset($this->aliases[$name])) {
            $this->aliases[$name] = array();
        }
        $this->aliases[$name][] = array($alias, $autoload);
    }

    /**
     * Register class with spl_autoload_register()
     */
    public function register()
    {
        if ($this->registered === false) {
            $callback = array($this, 'resolve');
            $this->functions->splAutoloadRegister($callback, true, true);
            $this->registered = true;
        }
    }
}
