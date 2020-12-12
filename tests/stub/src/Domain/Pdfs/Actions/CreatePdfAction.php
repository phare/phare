<?php

namespace Stub\Domain\Pdfs\Actions;

use Stub\Domain\Pdfs\DataTransferObjects\Pdf;
use Stub\Domain\Pdfs\ToPdf;

class CreatePdfAction
{
    public function __invoke(ToPdf $pdf): Pdf
    {
        return new Pdf([
            'path' => 'dummy.pdf'
        ]);
    }
}
