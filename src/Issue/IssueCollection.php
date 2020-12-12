<?php

namespace Phare\Issue;

use Doctrine\Common\Collections\ArrayCollection;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @method IssueCollection|Issue[] current()
 */
class IssueCollection extends ArrayCollection
{
    public function groupByFile(): array
    {
        $files = [];

        foreach ($this as $issue) {
            $filePath = $issue->getFile()->getRealPath();

            if (!isset($files[$filePath])) {
                $files[$filePath] = [];
            }

            $files[$filePath][] = $issue;
        }

        return $files;
    }
}
