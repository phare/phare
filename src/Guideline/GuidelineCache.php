<?php

namespace NicolasBeauvais\Warden\Guideline;

use Symfony\Component\Cache\Adapter\FilesystemAdapter;

class GuidelineCache
{
    private FilesystemAdapter $adapter;

    public function __construct()
    {
        $this->adapter = new FilesystemAdapter('Warden');
    }

    public function exist(array $values): bool
    {
        return $this->adapter->hasItem(
            $this->hash($values)
        );
    }

    public function load(array $values): ?Guideline
    {
        return $this->adapter->getItem(
            $this->hash($values)
        );
    }

    private function hash(array $values): string
    {
        return md5(json_encode($values, JSON_THROW_ON_ERROR));
    }
}
