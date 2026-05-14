<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileUploadService
{
    /**
     * Allowed image MIME types
     */
    private const ALLOWED_MIME_TYPES = [
        'image/jpeg',
        'image/jpg',
        'image/png',
        'image/webp',
        'image/gif',
    ];

    /**
     * Maximum file size in KB (5MB default)
     */
    private const MAX_FILE_SIZE_KB = 5120;

    /**
     * Upload a new file
     *
     * @param UploadedFile $file
     * @param string $directory
     * @param string|null $oldPath Path to old file to replace (optional)
     * @return string|null New file path or null if failed
     * @throws \Exception
     */
    public function upload(UploadedFile $file, string $directory, ?string $oldPath = null): ?string
    {
        // Validate file
        $this->validateFile($file);

        // Generate unique filename
        $filename = $this->generateUniqueFilename($file);

        // Store file temporarily
        $tempPath = $file->storeAs('temp', $filename, 'public');

        if (!$tempPath) {
            throw new \Exception('Failed to store temporary file');
        }

        // Move to final directory
        $finalPath = $this->moveToDirectory($tempPath, $directory, $filename);

        if (!$finalPath) {
            // Cleanup temp file
            Storage::disk('public')->delete($tempPath);
            throw new \Exception('Failed to move file to final directory');
        }

        return $finalPath;
    }

    /**
     * Replace existing file safely
     *
     * @param UploadedFile $file
     * @param string $directory
     * @param string|null $oldPath
     * @return string|null New file path or null if failed
     */
    public function replace(UploadedFile $file, string $directory, ?string $oldPath = null): ?string
    {
        try {
            // Upload new file first
            $newPath = $this->upload($file, $directory);

            if ($newPath && $oldPath) {
                // Delete old file only after successful upload
                $this->delete($oldPath);
            }

            return $newPath;
        } catch (\Exception $e) {
            // If upload failed, old file remains intact
            return null;
        }
    }

    /**
     * Delete file from storage
     *
     * @param string|null $path
     * @return bool
     */
    public function delete(?string $path): bool
    {
        if (!$path) {
            return true;
        }

        if (Storage::disk('public')->exists($path)) {
            return Storage::disk('public')->delete($path);
        }

        return true; // File doesn't exist, consider as success
    }

    /**
     * Clean up unused/orphan files
     *
     * @param string $directory
     * @param array $usedPaths Array of paths that are still in use
     * @param bool $dryRun If true, only report what would be deleted
     * @return array Summary of cleanup operation
     */
    public function cleanupUnused(string $directory, array $usedPaths, bool $dryRun = false): array
    {
        $summary = [
            'total_checked' => 0,
            'total_deleted' => 0,
            'total_size_freed' => 0,
            'skipped' => [],
            'errors' => [],
        ];

        $files = Storage::disk('public')->files($directory);

        foreach ($files as $file) {
            $summary['total_checked']++;

            // Skip if file is still in use
            if (in_array($file, $usedPaths)) {
                $summary['skipped'][] = $file;
                continue;
            }

            try {
                $fileSize = Storage::disk('public')->size($file);

                if (!$dryRun) {
                    if (Storage::disk('public')->delete($file)) {
                        $summary['total_deleted']++;
                        $summary['total_size_freed'] += $fileSize;
                    } else {
                        $summary['errors'][] = "Failed to delete: {$file}";
                    }
                } else {
                    $summary['total_deleted']++;
                    $summary['total_size_freed'] += $fileSize;
                }
            } catch (\Exception $e) {
                $summary['errors'][] = "Error processing {$file}: {$e->getMessage()}";
            }
        }

        return $summary;
    }

    /**
     * Validate uploaded file
     *
     * @param UploadedFile $file
     * @throws \Exception
     */
    private function validateFile(UploadedFile $file): void
    {
        // Check MIME type
        if (!in_array($file->getMimeType(), self::ALLOWED_MIME_TYPES)) {
            throw new \Exception('Invalid file type. Only JPG, PNG, WebP, and GIF are allowed.');
        }

        // Check file size
        if ($file->getSize() > self::MAX_FILE_SIZE_KB * 1024) {
            throw new \Exception("File size too large. Maximum size is " . (self::MAX_FILE_SIZE_KB / 1024) . "MB.");
        }

        // Additional security checks
        if (!$file->isValid()) {
            throw new \Exception('Invalid file upload.');
        }
    }

    /**
     * Generate unique filename
     *
     * @param UploadedFile $file
     * @return string
     */
    private function generateUniqueFilename(UploadedFile $file): string
    {
        $extension = $file->getClientOriginalExtension();
        $basename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

        // Sanitize filename
        $basename = preg_replace('/[^a-zA-Z0-9\-_\.]/', '', $basename);
        $basename = substr($basename, 0, 50); // Limit length

        return $basename . '_' . Str::random(8) . '_' . time() . '.' . $extension;
    }

    /**
     * Move file from temp to final directory
     *
     * @param string $tempPath
     * @param string $directory
     * @param string $filename
     * @return string|null
     */
    private function moveToDirectory(string $tempPath, string $directory, string $filename): ?string
    {
        $finalPath = $directory . '/' . $filename;

        // Move file
        $tempFullPath = Storage::disk('public')->path($tempPath);
        $finalFullPath = Storage::disk('public')->path($finalPath);

        // Ensure directory exists
        $directoryPath = dirname($finalFullPath);
        if (!is_dir($directoryPath)) {
            mkdir($directoryPath, 0755, true);
        }

        if (rename($tempFullPath, $finalFullPath)) {
            // Clean up temp directory if empty
            $tempDir = dirname($tempFullPath);
            if (is_dir($tempDir) && count(scandir($tempDir)) <= 2) { // Only . and ..
                rmdir($tempDir);
            }

            return $finalPath;
        }

        return null;
    }

    /**
     * Get file size in human readable format
     *
     * @param int $bytes
     * @return string
     */
    public static function formatBytes(int $bytes): string
    {
        $units = ['B', 'KB', 'MB', 'GB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        $bytes /= pow(1024, $pow);

        return round($bytes, 2) . ' ' . $units[$pow];
    }
}
