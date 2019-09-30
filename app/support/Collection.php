<?php
declare(strict_types=1);


namespace App\support;

use ArrayIterator;
use IteratorAggregate;
use Traversable;

class Collection implements IteratorAggregate
{
    protected $items = [];

    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    public function get()
    {
        return $this->items;
    }

    public function count()
    {
        return count($this->items);
    }

    public function add(array $items)
    {
        $this->items = array_merge($this->items, $items);
    }

    public function merge(Collection $collection)
    {
        return $this->add($collection->get());
    }

    /**
     * Retrieve an external iterator
     *
     * @link   https://php.net/manual/en/iteratoraggregate.getiterator.php
     * @return Traversable An instance of an object implementing <b>Iterator</b> or
     * <b>Traversable</b>
     * @since  5.0.0
     */
    public function getIterator()
    {
        return new ArrayIterator($this->items);
    }
}
