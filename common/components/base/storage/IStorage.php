<?php namespace common\components\base\storage;

interface IStorage
{
    public function buildPath($internalPath);
}