<?php

namespace Phare\File;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @method FileCollection|File[] current()
 */
class FileCollection extends ArrayCollection
{
    /**
     * @return File[]
     */
    public function getUnfilteredFiles(): array
    {
        return array_filter($this->toArray(), static function (File $file) {
            return !$file->isFiltered();
        });
    }
}
