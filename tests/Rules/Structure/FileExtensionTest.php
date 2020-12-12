<?php declare(strict_types=1);

namespace Phare\Tests\Rules\Structure;

use Phare\Rule\Rule;
use Phare\Rule\Structure\FileExtension;
use Phare\Tests\Traits\CreateScopes;
use PHPUnit\Framework\TestCase;

final class FileExtensionTest extends TestCase
{
    use CreateScopes;

    /**
     * @covers FileExtension::isType
     */
    public function testTypeIsFilter(): void
    {
        self::assertTrue(
            (new FileExtension([]))->isType(Rule::TYPE_FILTER)
        );
    }

      /**
     * @covers FileExtension::isType
     */
    public function testHandle(): void
    {
        $scope = $this->makeScope(
            ['tests/stub/public/css'],
            [new FileExtension(['php'])]
        );

        var_dump($scope->getFileCollection());die;
    }
}
