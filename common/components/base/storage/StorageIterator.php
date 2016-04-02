<?php namespace common\components\base\storage;


class StorageIterator
{
    const FOLDER = 1;
    const FILE = 2;


    public static function iterate($folder, $notDot = true)
    {
        $directoryIterator = new \RecursiveDirectoryIterator($folder);
        foreach ($directoryIterator as $item) {
            if ($notDot && $directoryIterator->isDot()) {
                continue;
            }
            yield new StorageItem($item);
        }
    }

    public static function ordered($folder, $first = self::FOLDER, $notDot = true)
    {
        $directoryIterator = new \RecursiveDirectoryIterator($folder);

        foreach ($directoryIterator as $item) {
            if ($first == self::FOLDER && $item->isDir()) {
                if ($notDot && $directoryIterator->isDot()) {
                    continue;
                }
                yield new StorageItem($item);
            } elseif ($first == self::FILE && $item->isFile()) {
                yield new StorageItem($item);
            }
        }

        foreach ($directoryIterator as $item) {
            if ($first == self::FOLDER && $item->isFile()) {
                yield new StorageItem($item);
            } elseif ($first == self::FILE && $item->isDir()) {
                if ($notDot && $directoryIterator->isDot()) {
                    continue;
                }
                yield new StorageItem($item);
            }
        }
    }

}