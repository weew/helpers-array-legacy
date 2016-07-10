<?php

class ArrayTest extends PHPUnit_Framework_TestCase {
    public function array_has_provider() {
        return array(
            array(true, array('foo' => 'bar'), 'foo'),
            array(false, array('foo' => 'bar'), 'bar'),
            array(true, array('foo' => array('bar' => 'baz')), 'foo.bar'),
            array(false, array('foo' => array('bar' => 'baz')), 'foo.baz'),
            array(true, array('foo' => array('bar' => array('baz' => 'yolo'))), 'foo.bar.baz'),
            array(false, array('foo' => array('bar' => array('baz' => 'yolo'))), 'foo.bar.yolo'),
        );
    }

    public function array_get_provider() {
        return array(
            array(null, array('foo' => 'bar'), null, null),
            array('bar', array('foo' => 'bar'), 'foo', null),
            array('foo', array('foo' => 'bar'), 'bar', 'foo'),
            array('baz', array('foo' => array('bar' => 'baz')), 'foo.bar', null),
            array('bar', array('foo' => array('bar' => 'baz')), 'foo.baz', 'bar'),
            array('yolo', array('foo' => array('bar' => array('baz' => 'yolo'))), 'foo.bar.baz', null),
            array('baz', array('foo' => array('bar' => array('baz' => 'yolo'))), 'foo.bar.yolo', 'baz'),
        );
    }

    public function array_set_provider() {
        return array(
            array(null, null, 'foo'),
            array('foo', 'foo', 'foo'),
            array('bar', 'foo.bar', 'bar'),
            array('baz', 'foo.bar.baz', 'baz'),
        );
    }

    public function array_remove_provider() {
        return array(
            array('foo'),
            array('foo.bar'),
            array('foo.bar.baz')
        );
    }

    public function array_dot_provider() {
        return array(
            array(array('foo' => 'bar'), array('foo' => 'bar')),
            array(array('foo.bar' => 'baz'), array('foo' => array('bar' => 'baz'))),
            array(array('foo.bar.baz' => 'yolo'), array('foo' => array('bar' => array('baz' => 'yolo')))),
        );
    }

    public function array_extend_provider() {
        return array(
            array(
                array('foo' => 'bar', 'bar' => 'bar', array(1, 2, 3)),
                array('foo' => 'foo', array(1, 2, 3)),
                array('foo' => 'bar', 'bar' => 'bar')
            ),
            array(
                array('foo' => array('bar' => 'baz'), array(1, 2, 3, 'foo' => 'bar', 'yolo' => 'swag')),
                array('foo' => array('bar' => array('baz' => 'yolo')), array(1, 'yolo' => 'swag')),
                array('foo' => array('bar' => 'baz'), array(1, 2, 3, 'foo' => 'bar')),
            ),
            array(
                array(0 => 'yolo', 1 => 'bar', 'bar' => array('bar' => array('baz' => 'swag')), 'baz' => array('foo' => 'bar'), 2 => array(1, 3)),
                array(0 => 'foo', 1 => 'bar', 'baz' => array('foo' => 'bar'), 2 => array(2, 3)),
                array(0 => 'yolo', 'bar' => array('bar' => array('baz' => 'swag')), 2 => array(1)),
            ),
        );
    }

    public function array_extend_distinct_provider() {
        return array(
            array(
                array('foo' => 'bar', 'bar' => 'bar', array(1, 2, 3)),
                array('foo' => 'foo', array(1, 2, 3)),
                array('foo' => 'bar', 'bar' => 'bar')
            ),
            array(
                array('foo' => array('bar' => 'baz'), array(1, 2, 3, 'foo' => 'bar', 'yolo' => 'swag')),
                array('foo' => array('bar' => array('baz' => 'yolo')), array(1, 'yolo' => 'swag')),
                array('foo' => array('bar' => 'baz'), array(1, 2, 3, 'foo' => 'bar')),
            ),
            array(
                array(0 => 'yolo', 1 => 'bar', 'bar' => array('bar' => array('baz' => 'swag')), 'baz' => array('foo' => 'bar'), 2 => array(1)),
                array(0 => 'foo', 1 => 'bar', 'baz' => array('foo' => 'bar'), 2 => array(2, 3)),
                array(0 => 'yolo', 'bar' => array('bar' => array('baz' => 'swag')), 2 => array(1)),
            ),
            array(
                array('foo' => array('bar' => array(5))),
                array('foo' => array('bar' => array(1, 2, 3,))),
                array('foo' => array('bar' => array(5))),
            ),
        );
    }

    public function array_is_associative_provider() {
        return array(
            array(false, array(0, '1', 2)),
            array(false, array(99 => 0, 5 => 1, 2 => 2)),
            array(true, array('foo' => 'bar', 1, 2)),
            array(true, array('foo' => 'bar', 'bar' => 'baz')),
            array(true, array()),
        );
    }

    public function array_is_index_provider() {
        return array(
            array(false, array(1, 2, 3, 'a' => 'foo')),
            array(false, array(0 => 3, 'a' => 'foo')),
            array(true, array(1, 2, 3)),
            array(true, array(0 => 1, '3' => 2)),
            array(true, array()),
        );
    }

    public function array_reset_provider() {
        return array(
            array(
                array(0 => 'foo', 'baz' => 'yolo', 1 => 'bar'),
                array(10 => 'foo', 'baz' => 'yolo', '199' => 'bar'),
                false
            ),
            array(
                array(0 => array(10 => 'foo', 'baz' => 'yolo', '199' => 'bar'), 'baz' => 'yolo', 1 => 'bar'),
                array(10 => array(10 => 'foo', 'baz' => 'yolo', '199' => 'bar'), 'baz' => 'yolo', '199' => 'bar'),
                false,
            ),
            array(
                array(0 => array(0 => 'foo', 'baz' => 'yolo', 1 => 'bar'), 'baz' => 'yolo', 1 => 'bar'),
                array(10 => array(10 => 'foo', 'baz' => 'yolo', '199' => 'bar'), 'baz' => 'yolo', '199' => 'bar'),
                true,
            ),
        );
    }

    public function array_add_provider() {
        return array(
            array(array('list' => array(1, 2, 3)), array('list' => array(1, 2)), 'list', 3,),
            array(array('value' => array(1, 2)), array('value' => 1), 'value', 2,),
            array(array('nested' => array('value' => array(1, 2))), array('nested' => array('value' => 1)), 'nested.value', 2,),
            array(array('nested' => array('value' => array(1, 2))), array('nested' => array('value' => array(1))), 'nested.value', 2,),
        );
    }

    /**
     * @dataProvider array_has_provider
     */
    public function test_array_has($expected, $array, $path) {
        $this->assertEquals($expected, array_has($array, $path));
    }

    /**
     * @dataProvider array_get_provider
     */
    public function test_array_get($expected, $array, $path, $default) {
        $this->assertEquals($expected, array_get($array, $path, $default));
    }

    /**
     * @dataProvider array_set_provider
     */
    public function test_array_set($expected, $path, $value) {
        $array = array();
        $this->assertFalse(array_has($array, $path));
        array_set($array, $path, $value);
        $this->assertEquals($expected, array_get($array, $path));
    }

    /**
     * @dataProvider array_remove_provider
     */
    public function test_array_remove($path) {
        $array = array();
        array_set($array, $path, 'foo');
        $this->assertTrue(array_has($array, $path));
        array_remove($array, $path);
        $this->assertFalse(array_has($array, $path));
    }

    /**
     * @dataProvider array_dot_provider
     */
    public function test_array_dot($expected, $array) {
        $this->assertEquals($expected, array_dot($array));
    }

    /**
     * @dataProvider array_extend_provider
     */
    public function test_array_extend($expected, $array1, $array2) {
        $this->assertEquals($expected, array_extend($array1, $array2));
    }

    public function test_array_extend_many() {
        $expected = array(
            'foo' => 'bar', 'bar' => 'foo', 'baz' => 'foo', 'yolo' => 'swag'
        );

        $array1 = array('foo' => 'bar');
        $array2 = array('bar' => 'foo');
        $array3 = array('baz' => 'foo');
        $array4 = array('yolo' => 'swag');

        $this->assertEquals($expected, array_extend($array1, $array2, $array3, $array4));
    }

    /**
     * @dataProvider array_extend_distinct_provider
     */
    public function test_array_extend_distinct($expected, $array1, $array2) {
        $this->assertEquals($expected, array_extend_distinct($array1, $array2));
    }

    /**
     * @dataProvider array_is_associative_provider
     */
    public function test_array_is_associative($expected, $array) {
        $this->assertEquals($expected, array_is_associative($array));
    }

    /**
     * @dataProvider array_is_index_provider
     */
    public function test_array_is_indexed($expected, $array) {
        $this->assertEquals($expected, array_is_indexed($array));
    }

    /**
     * @dataProvider array_reset_provider
     */
    public function test_array_reset($expected, $array, $deep) {
        $this->assertEquals($expected, array_reset($array, $deep), $deep);
    }

    /**
     * @dataProvider array_add_provider
     */
    public function test_array_add($expected, $array, $key, $value) {
        $this->assertEquals($expected, array_add($array, $key, $value));
    }

    public function test_array_take() {
        $array = array('foo' => array('bar' => 'baz'));
        $this->assertEquals('baz', array_take($array, 'foo.bar'));
        $this->assertEquals(array('foo' => array()), $array);
    }

    public function test_array_first() {
        $array = array('foo', 'bar', 'baz');
        $this->assertEquals('foo', array_first($array));
    }

    public function test_array_first_returns_default_value() {
        $this->assertEquals('foo', array_first(array(), 'foo'));
    }

    public function test_array_last() {
        $array = array('foo', 'bat', 'baz');
        $this->assertEquals('baz', array_last($array));
    }

    public function test_array_last_returns_default_value() {
        $this->assertEquals('baz', array_last(array(), 'baz'));
    }

    public function test_array_contains() {
        $this->assertTrue(array_contains(array('foo', 'bar'), 'bar'));
        $this->assertFalse(array_contains(array('foo', 'bar'), true));
        $this->assertFalse(array_contains(array(true, 'bar'), 'foo'));
        $this->assertTrue(array_contains(array(true, 'bar'), true));
        $this->assertFalse(array_contains(array(true, 'bar'), 'true'));
    }
}
