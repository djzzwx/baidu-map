<?php

namespace RrEarring\BaiduMap\Kernel\Support;

/**
 * Class Collection
 * @package RrEarring\BaiduMap\Kernel\Support
 */
class Collection implements \Countable, \ArrayAccess, \Serializable, \JsonSerializable
{
    /**
     * @var array
     */
    protected $items = [];

    public function __construct(array $items)
    {
        foreach ($items as $key => $value) {
            $this->set($key, $value);
        }
    }

    /**
     * @param $key
     * @param $value
     */
    public function set(string $key, $value): void
    {
        Arr::set($this->items, $key, $value);
    }

    /**
     * @param string $key
     * @param null $default
     * @return mixed
     */
    public function get(string $key, $default = null)
    {
        return Arr::get($this->items, $key, $default);
    }

    /**
     * @param string|array $keys
     */
    public function forget($keys): void
    {
        Arr::forget($this->items, is_array($keys) ? $keys : func_get_args());
    }

    /**
     * @return array
     */
    public function all(): array
    {
        return $this->items;
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return count($this->all());
    }

    /**
     * @param $keys
     * @return bool
     */
    public function has($keys): bool
    {
        return Arr::has($this->all(), is_array($keys) ? $keys : func_get_args());
    }

    /**
     * @param int $option
     * @return false|string
     */
    public function toJson($option = JSON_UNESCAPED_UNICODE)
    {
        return \json_encode($this->all(), $option);
    }

    /**
     * Whether a offset exists
     * @link https://php.net/manual/en/arrayaccess.offsetexists.php
     * @param mixed $offset <p>
     * An offset to check for.
     * </p>
     * @return boolean true on success or false on failure.
     * </p>
     * <p>
     * The return value will be casted to boolean if non-boolean was returned.
     * @since 5.0.0
     *
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists($offset): bool
    {
        return $this->has($offset);
    }

    /**
     * Offset to retrieve
     * @link https://php.net/manual/en/arrayaccess.offsetget.php
     * @param mixed $offset <p>
     * The offset to retrieve.
     * </p>
     * @return mixed Can return all value types.
     * @since 5.0.0
     *
     * @param mixed $offset
     * @return mixed|null
     */
    public function offsetGet($offset)
    {
        return $this->offsetExists($offset) ? $this->get($offset) : null;
    }

    /**
     * Offset to set
     * @link https://php.net/manual/en/arrayaccess.offsetset.php
     * @param mixed $offset <p>
     * The offset to assign the value to.
     * </p>
     * @param mixed $value <p>
     * The value to set.
     * </p>
     * @since 5.0.0
     *
     * @param mixed $offset
     * @param mixed $value
     * @return void
     */
    public function offsetSet($offset, $value): void
    {
        $this->set($offset, $value);
    }

    /**
     * Offset to unset
     * @link https://php.net/manual/en/arrayaccess.offsetunset.php
     * @param mixed $offset <p>
     * The offset to unset.
     * </p>
     * @since 5.0.0
     *
     * @param mixed $offset
     * @return void
     */
    public function offsetUnset($offset): void
    {
        $this->offsetExists($offset) && $this->forget($offset);
    }

    /**
     * String representation of object
     * @link https://php.net/manual/en/serializable.serialize.php
     * @return string the string representation of the object or null
     * @since 5.1.0
     *
     * @return string
     */
    public function serialize(): string
    {
        return serialize($this->all());
    }

    /**
     * Constructs the object
     * @link https://php.net/manual/en/serializable.unserialize.php
     * @param string $serialized <p>
     * The string representation of the object.
     * </p>
     * @since 5.1.0
     *
     * @param string $serialized
     * @return array
     */
    public function unserialize($serialized): array
    {
        return $this->items = unserialize($serialized);
    }

    /**
     * Specify data which should be serialized to JSON
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     *
     * @return array
     */
    public function jsonSerialize(): array
    {
        return $this->all();
    }

    /**
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->get($name);
    }

    /**
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        $this->set($name, $value);
    }

    /**
     * @param $name
     * @return bool
     */
    public function __isset($name)
    {
        return $this->has($name);
    }

    /**
     * @param $name
     */
    public function __unset($name)
    {
        $this->forget($name);
    }

    /**
     * @return false|string
     */
    public function __toString()
    {
        return $this->toJson();
    }
}