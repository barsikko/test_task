<?php 

$rss = simplexml_load_file('https://lenta.ru/rss');

interface Collectable
{
    public function add($value, $offset=null);
    
    public function get($offset, $default=null);
    
    public function remove($offset);
}

class Collection implements IteratorAggregate, ArrayAccess, Countable, Collectable
{
    protected $container = [];
    
    public function getIterator()
    {
        return new ArrayIterator($this->container);
    }
    
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }
    
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        }
        else {
            $this->container[$offset] = $value;
        }
    }
    
    public function offsetUnset($offset)
    {
        unset($this->collection[$offset]);
    }
 
    public function offsetGet($offset)
    {
        return $this->container[$offset] ?? null;
    }
    
    public function count()
    {
        return count($this->container);
    }
    
    public function clear()
    {
        $this->container = [];
    }
    
    public function isEmpty()
    {
        return empty($this->container);
    }
    
    public function toArray()
    {
        return $this->container;
    }
    
    public function add($value, $offset=null)
    {
        $this->offsetSet($offset, $value);
    }
    
    public function get($key, $default=null)
    {
        return $this->container[$key] ?? $default;
    }
    
    public function remove($offset)
    {
        return $this->offsetUnset($offset);
    }
}

$obj = new Collection;

$gen = generator($rss);


foreach ($gen as $g){
	$obj->add($g);
}

print_r($obj->toArray());

function generator($rss)
{
	foreach($rss  as $val){
		foreach ($val->item as $item){
			yield $item;
		}
	}
}
