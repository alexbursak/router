<?php

namespace ABRouter\ArrayCollection;


interface ArrayCollectionInterface
{
    public function addElement($element);

    public function addElements(array $elements);

    public function getElements();
}