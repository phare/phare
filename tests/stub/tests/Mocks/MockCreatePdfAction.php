<?php

namespace Tests\Mocks;

use Domain\Pdfs\Actions\CreatePdfAction;
use Domain\Pdfs\DataTransferObjects\Pdf;
use Domain\Pdfs\ToPdf;

class MockCreatePdfAction extends CreatePdfAction
{
    public function __invoke(ToPdf $pdf): Pdf
    {
        return new Pdf([
            'path' => 'dummy.pdf',
        ]);
    }
}
