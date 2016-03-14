<?php namespace common\components\base\traits;

trait InternalClassCacheTrait
{
    private $_cachedFragments = [];

    public function cacheFragment($name, callable $value, $reload = false)
    {
        if (!isset($this->_cachedFragments[$name]) || $reload) {
            return $this->_cachedFragments[$name] = call_user_func($value);
        }

        return $this->_cachedFragments[$name];
    }

    public function hasCachedFragment($name)
    {
        return isset($this->_cachedFragments[$name]);
    }

    public function clearCachedFragment($name)
    {
        unset($this->_cachedFragments[$name]);
    }

}