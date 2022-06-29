<?php

namespace App\Container;

use App\Container\Exceptions\ContainerException;
use Psr\Container\ContainerInterface;

class Container implements ContainerInterface
{
    private array $entries = [];

    public function get(string $id)
    {
        if ($this->has($id)) {
            $entry = $this->entries[$id];

            if (is_callable($id)) {
                return $entry($this);
            }

            $id = $entry;
        }

        return $this->resolve($id);
    }

    public function has(string $id): bool
    {
        return isset($this->entries[$id]);
    }

    public function set(string $id, callable|string $concrete): void
    {
        $this->entries[$id] = $concrete;
    }

    public function resolve(string $id)
    {
        //1. inspect the class that we are trying to get from the container
        $reflectionClass = new \ReflectionClass($id);

        if (!$reflectionClass->isInstantiable()){
            throw new ContainerException("Class ".$id. " is not instantiable.");
        }

        //2. inspect the constructor of the class
        $constructor = $reflectionClass->getConstructor();

        if (!$constructor) {
            return new $id;
        }

        //3. inspect the constructor parameters (dependencies)
        $parameters = $constructor->getParameters();

        if (!$parameters) {
            return new $id;
        }

        //4. if the constructor parameter is a class then try to resolve the class using the container
        $dependencies = array_map(
            function (\ReflectionParameter $param) use ($id) {
                $name = $param->getName();
                $type = $param->getType();

                if (!$type) {
                    throw new ContainerException("Failed to resolve class ".$id." because param ".$name. " is missing a type hint");
                }

                if ($type instanceof \ReflectionUnionType) {
                    throw new ContainerException("Failed to resolve class ".$id." because of union type for param ".$name. " is missing a type hint");
                }

                if ($type instanceof \ReflectionNamedType && !$type->isBuiltin()) {
                    return $this->get($type->getName());
                }

                throw new ContainerException("Failed to resolve class ".$id." because invalid param ".$name);
            },
            $parameters
        );

        return $reflectionClass->newInstanceArgs($dependencies);
    }
}