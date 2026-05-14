<?php

use Illuminate\Support\Facades\Storage;

if (! function_exists('whatsapp_number')) {
    function whatsapp_number(): string
    {
        return setting('whatsapp', config('settings.whatsapp', env('WHATSAPP_NUMBER', '')));
    }
}

if (! function_exists('whatsapp_text')) {
    function whatsapp_text(string $message): string
    {
        return rawurlencode($message);
    }
}

if (! function_exists('whatsapp_link')) {
    function whatsapp_link(string $message): string
    {
        $number = whatsapp_number();

        if (! $number) {
            return '#';
        }

        return 'https://wa.me/' . preg_replace('/[^0-9]/', '', $number) . '?text=' . whatsapp_text($message);
    }
}

if (! function_exists('image_url')) {
    function image_url(?string $path): ?string
    {
        if (! $path) {
            return null;
        }

        if (Storage::disk('public')->exists($path)) {
            return asset('storage/' . $path);
        }

        if (file_exists(public_path($path))) {
            return asset($path);
        }

        return null;
    }
}

if (! function_exists('setting')) {
    function setting(string $key, $default = null)
    {
        return cache()->remember('setting:' . $key, 3600, function () use ($key, $default) {
            return \App\Models\Setting::get($key, $default);
        });
    }
}
