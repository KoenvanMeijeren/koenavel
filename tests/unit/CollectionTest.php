<?php
declare(strict_types=1);


use PHPUnit\Framework\TestCase;

class CollectionTest extends TestCase
{
    public function test_empty_instantiated_collection_returns_no_items()
    {
        $collection = new \App\support\Collection;

        $this->assertEmpty($collection->get());
    }

    public function test_count_is_correct_for_items_passed_in()
    {
        $collection = new \App\support\Collection([
            'one',
            'two',
            'three'
        ]);

        $this->assertEquals(3, $collection->count());
    }

    public function test_items_returned_match_items_passed_in()
    {
        $collection = new \App\support\Collection([
            'one',
            'two'
        ]);

        $this->assertCount(2, $collection->get());
        $this->assertEquals($collection->get()[0], 'one');
        $this->assertEquals($collection->get()[1], 'two');
    }

    public function test_collection_is_instance_of_iterator_aggregate()
    {
        $collection = new \App\support\Collection();

        $this->assertInstanceOf(IteratorAggregate::class, $collection);
    }

    public function test_collection_can_be_iterated()
    {
        $collection = new \App\support\Collection([
            'one',
            'two',
            'three'
        ]);

        $items = [];

        foreach ($collection as $item) {
            $items[] = $item;
        }

        $this->assertCount(3, $items);
        $this->assertInstanceOf(ArrayIterator::class, $collection->getIterator());
    }

    public function test_collection_can_be_merged_with_another_collection()
    {
        $collection1 = new \App\support\Collection([
            'one',
            'two',
            'three'
        ]);

        $collection2 = new \App\support\Collection([
            'four',
            'five',
            'six'
        ]);

        $collection1->merge($collection2);

        $this->assertCount(6, $collection1->get());
        $this->assertEquals(6, $collection1->count());
    }

    public function test_can_add_to_existing_collection()
    {
        $collection = new \App\support\Collection(['one', 'two']);
        $collection->add(['three']);

        $this->assertEquals(3, $collection->count());
        $this->assertCount(3, $collection->get());
    }
}
