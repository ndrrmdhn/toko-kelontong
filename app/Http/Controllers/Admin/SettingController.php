<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:super_admin');
    }

    public function index()
    {
        $settings = Setting::all()->keyBy('key')->toArray();

        $breadcrumbs = [
            ['title' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['title' => 'Pengaturan']
        ];

        return view('admin.settings.index', compact('settings', 'breadcrumbs'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'site_name' => 'nullable|string|max:255',
            'site_description' => 'nullable|string|max:500',
            'hero_title' => 'nullable|string|max:255',
            'hero_subtitle' => 'nullable|string|max:500',
            'footer_text' => 'nullable|string|max:500',
            'whatsapp' => 'nullable|string|max:20',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string|max:500',
            'maps_embed' => 'nullable|string',
            'instagram' => 'nullable|url|max:500',
            'facebook' => 'nullable|url|max:500',
            'youtube' => 'nullable|url|max:500',
            'tiktok' => 'nullable|url|max:500',
            'operational_hours' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
            'favicon' => 'nullable|image|mimes:png,ico|max:512',
        ]);

        $data = $request->only([
            'site_name',
            'site_description',
            'hero_title',
            'hero_subtitle',
            'footer_text',
            'whatsapp',
            'phone',
            'email',
            'address',
            'maps_embed',
            'instagram',
            'facebook',
            'youtube',
            'tiktok',
            'operational_hours',
        ]);

        // Handle file uploads
        if ($request->hasFile('logo')) {
            // Delete old logo
            $oldLogo = Setting::get('logo');
            if ($oldLogo && Storage::disk('public')->exists($oldLogo)) {
                Storage::disk('public')->delete($oldLogo);
            }
            $data['logo'] = $request->file('logo')->store('settings', 'public');
        }

        if ($request->hasFile('favicon')) {
            // Delete old favicon
            $oldFavicon = Setting::get('favicon');
            if ($oldFavicon && Storage::disk('public')->exists($oldFavicon)) {
                Storage::disk('public')->delete($oldFavicon);
            }
            $data['favicon'] = $request->file('favicon')->store('settings', 'public');
        }

        // Update or create settings
        foreach ($data as $key => $value) {
            Setting::set($key, $value);
            Cache::forget('setting:' . $key);
        }

        return redirect()->route('admin.settings.index')
            ->with('success', '✅ Pengaturan website berhasil disimpan!');
    }
}
