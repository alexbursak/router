<?php
namespace ABRouterTest\Unit\ArrayCollection;


use ABRouter\ArrayCollection\ArrayCollection;
use ABRouterTest\BaseTestCase;

class ArrayCollectionTest extends BaseTestCase
{
    /** @var ArrayCollection */
    public $collection;

    /**
     * @var array
     */
    public $arrayOfDummyObjects;

    public function setUp()
    {
        $this->collection = new ArrayCollection();
        $this->arrayOfDummyObjects = $this->getArrayOfDummyObjects();
    }

    /**
     * @test
     */
    public function AddElementMethod()
    {
        $dummyObj = $this->arrayOfDummyObjects[0];

        $this->collection->addElement($dummyObj);

        $this->assertNotEmpty($this->collection->elements);
        $this->assertInstanceOf(\StdClass::class, $this->collection->elements[0]);
        $this->assertObjectHasAttribute('text', $this->collection->elements[0]);
        $this->assertEquals(123, $this->collection->elements[0]->id);
    }

    /**
     * @test
     */
    public function AddElementsMethod()
    {
        $objArray = $this->arrayOfDummyObjects;

        $this->collection->addElements($objArray);

        $this->assertNotEmpty($this->collection->elements);
        $this->assertInstanceOf(\StdClass::class, $this->collection->elements[1]);
        $this->assertObjectHasAttribute('text', $this->collection->elements[0]);
        $this->assertEquals(123, $this->collection->elements[0]->id);
        $this->assertObjectHasAttribute('text', $this->collection->elements[1]);
        $this->assertAttributeContains('Dummy', 'text', $this->collection->elements[1]);
        $this->assertEquals(989, $this->collection->elements[1]->id);
    }

    /**
     * @test
     */
    public function GetElementsMethod()
    {
        $objArray = $this->arrayOfDummyObjects;

        $this->collection->addElements($objArray);

        $elements = $this->collection->getElements();

        $this->assertInstanceOf(\StdClass::class, $this->collection->elements[1]);
        $this->assertEquals(123, $elements[0]->id);
        $this->assertEquals('Dummy', $elements[1]->text);
    }

    /**
     * @return array
     */
    private function getArrayOfDummyObjects()
    {
        $dummyObj1 = new \StdClass();
        $dummyObj1->id = 123;
        $dummyObj1->text = 'text';

        $dummyObj2 = new \StdClass();
        $dummyObj2->id = 989;
        $dummyObj2->text = 'Dummy';

        $objArray = [
            $dummyObj1,
            $dummyObj2
        ];

        return $objArray;
    }

}