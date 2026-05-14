<?php

namespace App\Console\Commands;

use App\Models\Banner;
use App\Models\Product;
use App\Models\Rental;
use App\Models\Setting;
use App\Models\User;
use App\Services\FileUploadService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CleanupStorageCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'storage:cleanup
                            {--dry-run : Show what would be deleted without actually deleting}
                            {--force : Skip confirmation prompt}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean up orphan files in storage that are no longer referenced in database';

    /**
     * File upload service instance
     *
     * @var FileUploadService
     */
    private FileUploadService $fileService;

    /**
     * Create a new command instance.
     */
    public function __construct(FileUploadService $fileService)
    {
        parent::__construct();
        $this->fileService = $fileService;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $dryRun = $this->option('dry-run');
        $force = $this->option('force');

        if (!$force && !$dryRun) {
            if (!$this->confirm('This will permanently delete unused files. Are you sure?')) {
                $this->info('Operation cancelled.');
                return;
            }
        }

        $this->info($dryRun ? '🔍 DRY RUN MODE - No files will be deleted' : '🧹 Starting storage cleanup...');
        $this->newLine();

        $totalSummary = [
            'total_checked' => 0,
            'total_deleted' => 0,
            'total_size_freed' => 0,
            'errors' => [],
        ];

        // Clean up products images
        $this->info('📦 Cleaning up product images...');
        $productSummary = $this->cleanupProducts($dryRun);
        $this->displaySummary('Products', $productSummary);
        $this->mergeSummaries($totalSummary, $productSummary);

        // Clean up banner images
        $this->info('🎯 Cleaning up banner images...');
        $bannerSummary = $this->cleanupBanners($dryRun);
        $this->displaySummary('Banners', $bannerSummary);
        $this->mergeSummaries($totalSummary, $bannerSummary);

        // Clean up rental images
        $this->info('🏠 Cleaning up rental images...');
        $rentalSummary = $this->cleanupRentals($dryRun);
        $this->displaySummary('Rentals', $rentalSummary);
        $this->mergeSummaries($totalSummary, $rentalSummary);

        // Clean up user avatars
        $this->info('👤 Cleaning up user avatars...');
        $avatarSummary = $this->cleanupAvatars($dryRun);
        $this->displaySummary('Avatars', $avatarSummary);
        $this->mergeSummaries($totalSummary, $avatarSummary);

        // Clean up settings files (logo, favicon)
        $this->info('⚙️ Cleaning up settings files...');
        $settingsSummary = $this->cleanupSettings($dryRun);
        $this->displaySummary('Settings', $settingsSummary);
        $this->mergeSummaries($totalSummary, $settingsSummary);

        // Display final summary
        $this->newLine();
        $this->info('📊 FINAL SUMMARY');
        $this->line('─' . str_repeat('─', 50));

        $this->line("Total files checked: <comment>{$totalSummary['total_checked']}</comment>");
        $this->line("Total files " . ($dryRun ? 'would be ' : '') . "deleted: <comment>{$totalSummary['total_deleted']}</comment>");
        $this->line("Total space " . ($dryRun ? 'would be ' : '') . "freed: <comment>" . FileUploadService::formatBytes($totalSummary['total_size_freed']) . "</comment>");

        if (!empty($totalSummary['errors'])) {
            $this->newLine();
            $this->error('❌ ERRORS ENCOUNTERED:');
            foreach ($totalSummary['errors'] as $error) {
                $this->line("  • {$error}");
            }
        }

        $this->newLine();
        $this->info($dryRun ? '✅ Dry run completed!' : '✅ Storage cleanup completed!');

        return Command::SUCCESS;
    }

    /**
     * Clean up product images
     */
    private function cleanupProducts(bool $dryRun): array
    {
        $usedPaths = Product::whereNotNull('image')->pluck('image')->toArray();
        return $this->fileService->cleanupUnused('products', $usedPaths, $dryRun);
    }

    /**
     * Clean up banner images
     */
    private function cleanupBanners(bool $dryRun): array
    {
        $usedPaths = Banner::whereNotNull('image')->pluck('image')->toArray();
        return $this->fileService->cleanupUnused('banners', $usedPaths, $dryRun);
    }

    /**
     * Clean up rental images
     */
    private function cleanupRentals(bool $dryRun): array
    {
        $usedPaths = [];

        // Handle single image rentals
        $singleImages = Rental::whereNotNull('image')->pluck('image')->toArray();
        $usedPaths = array_merge($usedPaths, $singleImages);

        // Handle multiple images (JSON format)
        $multiImages = Rental::whereNotNull('images')
            ->get()
            ->pluck('images')
            ->map(function ($images) {
                $decoded = is_array($images) ? $images : json_decode($images, true);
                return is_array($decoded) ? $decoded : [];
            })
            ->flatten()
            ->filter()
            ->toArray();

        $usedPaths = array_merge($usedPaths, $multiImages);

        return $this->fileService->cleanupUnused('rentals', $usedPaths, $dryRun);
    }

    /**
     * Clean up user avatars
     */
    private function cleanupAvatars(bool $dryRun): array
    {
        $usedPaths = User::whereNotNull('avatar')->pluck('avatar')->toArray();
        return $this->fileService->cleanupUnused('avatars', $usedPaths, $dryRun);
    }

    /**
     * Clean up settings files
     */
    private function cleanupSettings(bool $dryRun): array
    {
        $usedPaths = [];

        // Get logo and favicon from settings
        $logo = Setting::get('logo');
        if ($logo) {
            $usedPaths[] = $logo;
        }

        $favicon = Setting::get('favicon');
        if ($favicon) {
            $usedPaths[] = $favicon;
        }

        return $this->fileService->cleanupUnused('settings', $usedPaths, $dryRun);
    }

    /**
     * Display summary for a specific section
     */
    private function displaySummary(string $section, array $summary): void
    {
        $this->line("  Checked: <comment>{$summary['total_checked']}</comment> files");
        $this->line("  Deleted: <comment>{$summary['total_deleted']}</comment> files");
        $this->line("  Space freed: <comment>" . FileUploadService::formatBytes($summary['total_size_freed']) . "</comment>");

        if (!empty($summary['errors'])) {
            $this->line("  Errors: <error>" . count($summary['errors']) . "</error>");
        }

        $this->newLine();
    }

    /**
     * Merge summaries
     */
    private function mergeSummaries(array &$total, array $current): void
    {
        $total['total_checked'] += $current['total_checked'];
        $total['total_deleted'] += $current['total_deleted'];
        $total['total_size_freed'] += $current['total_size_freed'];
        $total['errors'] = array_merge($total['errors'], $current['errors']);
    }
}
