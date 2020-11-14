<?php

namespace NicolasBeauvais\Warden\File;

use Symfony\Component\Finder\Finder;

class FileCollection implements \ArrayAccess, \IteratorAggregate
{
    /**
     * @var File[] $files
     */
    private array $files = [];

    public function __construct(Finder $files)
    {
        foreach ($files as $file) {
            $this->files[] = new File($file);
        }
    }

    public function offsetExists($offset): bool
    {
        return array_key_exists($offset, $this->files);
    }

    public function offsetGet($offset): File
    {
        return $this->files[$offset];
    }

    public function offsetSet($offset, $value): void
    {
        $this->files[$offset] = $value;
    }

    public function offsetUnset($offset): void
    {
        unset($this->files[$offset]);
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->files);
    }
}
