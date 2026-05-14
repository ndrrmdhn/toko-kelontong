<?php

namespace App\Observers;

use App\Models\Banner;
use App\Services\FileUploadService;

class BannerObserver
{
    private FileUploadService $fileService;

    public function __construct(FileUploadService $fileService)
    {
        $this->fileService = $fileService;
    }

    /**
     * Handle the Banner "deleting" event.
     */
    public function deleting(Banner $banner): void
    {
        // Delete associated image when banner is deleted
        if ($banner->image) {
            $this->fileService->delete($banner->image);
        }
    }
}
