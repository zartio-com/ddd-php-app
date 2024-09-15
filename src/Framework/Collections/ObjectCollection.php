<?php

namespace Framework\Collections;

use Doctrine\Common\Collections\Collection;
use Framework\Interfaces\ComparableInterface;

/**
 * @template TKey
 * @template TValue of ComparableInterface
 */
class ObjectCollection implements \ArrayAccess
{

    public function __construct(
        /** @var TValue[] $elements */
        private array $elements = [],
    )
    {

    }

    /**
     * @param TKey $offset
     */
    public function offsetExists(mixed $offset): bool
    {
        return array_key_exists($offset, $this->elements);
    }

    /**
     * @param TKey $offset
     * @return ?TValue
     */
    public function offsetGet(mixed $offset): mixed
    {
        return $this->offsetExists($offset) ? $this->elements[$offset] : null;
    }

    /**
     * @param TKey $offset
     * @param TValue $value
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->elements[$offset] = $value;
    }

    /**
     * @param TKey|Collection $offset
     */
    public function offsetUnset(mixed $offset): void
    {
        if ($this->offsetExists($offset) === false) {
            return;
        }

        unset($this->elements[$offset]);
    }

    /**
     * @param TValue $search
     * @return ?TValue
     */
    public function find(mixed $search): mixed
    {
        foreach ($this->elements as $element) {
            if ($element->equals($search)) {
                return $element;
            }
        }

        return null;
    }
}