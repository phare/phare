<?php

namespace Phare\Issue;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @method IssueCollection|Issue[] current()
 */
class IssueCollection extends ArrayCollection
{
    public function merge(IssueCollection $issueCollection): IssueCollection
    {
        return new self($this->toArray() + $issueCollection->toArray());
    }
}
