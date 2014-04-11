<?php namespace spec\Belt;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CollectionsSpec extends ObjectBehavior {

    function it_is_initializable()
    {
        $this->shouldHaveType('Belt\Collections');
    }

    function it_can_transform_a_value_to_an_array()
    {
        $this->toArray(['foo'])->shouldBe(['foo']);

        $instance = new \stdClass;

        $instance->foo = 'bar';

        $this->toArray($instance)->shouldBe(['foo' => 'bar']);
    }

    function it_returns_true_if_any_value_passes_the_truth_test()
    {
        $collection = [17, 83, 61, 57, 14, 95];

        $iterator = function($number)
        {
            return 0 == ($number % 2);
        };

        $this->any($collection, $iterator)->shouldReturn(true);

        $this->any([67, 45], $iterator)->shouldReturn(false);
    }

    function it_can_extract_an_array_of_values_associated_with_a_given_key()
    {
        $collection = [
            ['name' => 'Jack'], ['name' => 'Ian'], ['name' => 'Glen'],
        ];

        $this->pluck($collection, 'name')->shouldBe(['Jack', 'Ian', 'Glen']);

        $collection[1] = []; // break the structure

        $this->pluck($collection, 'name')->shouldBe(['Jack', 'Glen']);
    }

}
