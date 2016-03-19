<?php namespace common\components\base\traits;

trait InternalClassCacheTrait
{
    private $_cachedFragments = [];

    public function cacheFragment($name, callable $value, $reload = false)
    {
        if (!isset($this->_cachedFragments[$name]) || $reload) {
            $oldValue = isset($this->_cachedFragments[$name]) ? $this->_cachedFragments[$name] : null;
            return $this->_cachedFragments[$name] = call_user_func_array($value, [$oldValue]);
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