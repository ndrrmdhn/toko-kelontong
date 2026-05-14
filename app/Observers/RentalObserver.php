<?php

namespace App\Observers;

use App\Models\Rental;
use App\Services\FileUploadService;

class RentalObserver
{
    private FileUploadService $fileService;

    public function __construct(FileUploadService $fileService)
    {
        $this->fileService = $fileService;
    }

    /**
     * Handle the Rental "deleting" event.
     */
    public function deleting(Rental $rental): void
    {
        // Delete associated images when rental is deleted
        if ($rental->image) {
            $this->fileService->delete($rental->image);
        }

        // Handle multiple images
        if ($rental->images) {
            $images = is_array($rental->images) ? $rental->images : json_decode($rental->images, true);
            if (is_array($images)) {
                foreach ($images as $image) {
                    $this->fileService->delete($image);
                }
            }
        }
    }
}
