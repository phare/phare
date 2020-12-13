<?php declare(strict_types=1);

namespace Phare\Tests\Rules\Structure;

use Phare\Rules\Rule;
use Phare\Rules\FileExtension;
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
            ['tests/stubs/public/css'],
            [new FileExtension(['php'])]
        );

        var_dump($scope->getFileCollection());die;
    }
}
