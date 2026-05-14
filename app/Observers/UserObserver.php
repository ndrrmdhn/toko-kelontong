<?php

namespace App\Observers;

use App\Models\User;
use App\Services\FileUploadService;

class UserObserver
{
    private FileUploadService $fileService;

    public function __construct(FileUploadService $fileService)
    {
        $this->fileService = $fileService;
    }

    /**
     * Handle the User "deleting" event.
     */
    public function deleting(User $user): void
    {
        // Delete associated avatar when user is deleted
        if ($user->avatar) {
            $this->fileService->delete($user->avatar);
        }
    }
}
