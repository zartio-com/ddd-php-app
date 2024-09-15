<?php

namespace Framework\Interfaces;

/**
 * @template T
 */
interface ComparableInterface
{

    /**
     * @param T $other
     */
    public function equals(mixed $other): bool;
}