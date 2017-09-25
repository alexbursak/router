<?php

namespace ABRouter\ArrayCollection;

/**
 * Class ArrayCollection
 */
class ArrayCollection implements ArrayCollectionInterface
{
    /** @var array */
    public $elements = [];

    /**
     * @param mixed $element
     *
     * @return $this
     */
    public function addElement($element)
    {
        array_push($this->elements, $element);

        return $this;
    }

    /**
     * @param array $elements
     *
     * @return $this
     */
    public function addElements(array $elements)
    {
        foreach ($elements as $element) {
            array_push($this->elements, $element);
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getElements()
    {
        return $this->elements;
    }
}