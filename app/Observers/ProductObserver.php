<?php

namespace App\Observers;

use App\Models\Product;
use App\Services\FileUploadService;

class ProductObserver
{
    private FileUploadService $fileService;

    public function __construct(FileUploadService $fileService)
    {
        $this->fileService = $fileService;
    }

    /**
     * Handle the Product "deleting" event.
     */
    public function deleting(Product $product): void
    {
        // Delete associated image when product is deleted
        if ($product->image) {
            $this->fileService->delete($product->image);
        }
    }
}
