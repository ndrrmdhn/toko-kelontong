@extends('admin.layout')

@section('title', 'Pengaturan Website')

@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <h3 class="fw-bold">Pengaturan Website</h3>
            <p class="text-muted">Kelola konfigurasi website, kontak, media sosial, dan branding.</p>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <!-- Nav Tabs -->
                    <ul class="nav nav-tabs nav-fill mb-4" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active text-success" id="general-tab" data-bs-toggle="tab" data-bs-target="#general"
                                type="button" role="tab" aria-controls="general" aria-selected="true">
                                <i class="bi bi-gear"></i> Umum
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link text-success" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact"
                                type="button" role="tab" aria-controls="contact" aria-selected="false">
                                <i class="bi bi-telephone"></i> Kontak
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link text-success" id="social-tab" data-bs-toggle="tab" data-bs-target="#social"
                                type="button" role="tab" aria-controls="social" aria-selected="false">
                                <i class="bi bi-share"></i> Media Sosial
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link text-success" id="branding-tab" data-bs-toggle="tab" data-bs-target="#branding"
                                type="button" role="tab" aria-controls="branding" aria-selected="false">
                                <i class="bi bi-palette"></i> Branding
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link text-success" id="operational-tab" data-bs-toggle="tab" data-bs-target="#operational"
                                type="button" role="tab" aria-controls="operational" aria-selected="false">
                                <i class="bi bi-clock"></i> Operasional
                            </button>
                        </li>
                    </ul>

                    <!-- Tab Content -->
                    <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="tab-content">
                            <!-- General Tab -->
                            <div class="tab-pane fade show active" id="general" role="tabpanel"
                                aria-labelledby="general-tab">
                                <div class="mb-3">
                                    <label class="form-label">Nama Website</label>
                                    <input type="text" name="site_name"
                                        class="form-control @error('site_name') is-invalid @enderror"
                                        value="{{ old('site_name', $settings['site_name']['value'] ?? '') }}"
                                        placeholder="Contoh: Toko Kelontong">
                                    @error('site_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Deskripsi Website</label>
                                    <textarea name="site_description" class="form-control @error('site_description') is-invalid @enderror" rows="4"
                                        placeholder="Deskripsi singkat website Anda">{{ old('site_description', $settings['site_description']['value'] ?? '') }}</textarea>
                                    @error('site_description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Judul Hero</label>
                                    <input type="text" name="hero_title"
                                        class="form-control @error('hero_title') is-invalid @enderror"
                                        value="{{ old('hero_title', $settings['hero_title']['value'] ?? '') }}"
                                        placeholder="Contoh: Belanja dan Sewa Mudah di Sini">
                                    @error('hero_title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Subjudul Hero</label>
                                    <textarea name="hero_subtitle" class="form-control @error('hero_subtitle') is-invalid @enderror" rows="3"
                                        placeholder="Contoh: Solusi toko kelontong dan kontrakan cepat dan terjangkau">{{ old('hero_subtitle', $settings['hero_subtitle']['value'] ?? '') }}</textarea>
                                    @error('hero_subtitle')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Teks Footer</label>
                                    <textarea name="footer_text" class="form-control @error('footer_text') is-invalid @enderror" rows="3"
                                        placeholder="Teks yang muncul di footer website Anda">{{ old('footer_text', $settings['footer_text']['value'] ?? '') }}</textarea>
                                    @error('footer_text')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Contact Tab -->
                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                <div class="mb-3">
                                    <label class="form-label">Nomor WhatsApp</label>
                                    <input type="text" name="whatsapp"
                                        class="form-control @error('whatsapp') is-invalid @enderror"
                                        value="{{ old('whatsapp', $settings['whatsapp']['value'] ?? '') }}"
                                        placeholder="62xxxxxxxxxx">
                                    @error('whatsapp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Nomor Telepon</label>
                                    <input type="text" name="phone"
                                        class="form-control @error('phone') is-invalid @enderror"
                                        value="{{ old('phone', $settings['phone']['value'] ?? '') }}"
                                        placeholder="Contoh: (021) 1234 5678">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email', $settings['email']['value'] ?? '') }}"
                                        placeholder="info@example.com">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Alamat</label>
                                    <textarea name="address" class="form-control @error('address') is-invalid @enderror" rows="3"
                                        placeholder="Alamat lengkap bisnis Anda">{{ old('address', $settings['address']['value'] ?? '') }}</textarea>
                                    @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Embed Google Maps</label>
                                    <textarea name="maps_embed" class="form-control @error('maps_embed') is-invalid @enderror" rows="3"
                                        placeholder="Paste iframe Google Maps">{{ old('maps_embed', $settings['maps_embed']['value'] ?? '') }}</textarea>
                                    <small class="form-text text-muted">Dapatkan dari Google Maps → Bagikan → Embed a
                                        map</small>
                                    @error('maps_embed')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Social Media Tab -->
                            <div class="tab-pane fade" id="social" role="tabpanel" aria-labelledby="social-tab">
                                <div class="mb-3">
                                    <label class="form-label">Instagram</label>
                                    <input type="url" name="instagram"
                                        class="form-control @error('instagram') is-invalid @enderror"
                                        value="{{ old('instagram', $settings['instagram']['value'] ?? '') }}"
                                        placeholder="https://instagram.com/username">
                                    @error('instagram')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Facebook</label>
                                    <input type="url" name="facebook"
                                        class="form-control @error('facebook') is-invalid @enderror"
                                        value="{{ old('facebook', $settings['facebook']['value'] ?? '') }}"
                                        placeholder="https://facebook.com/username">
                                    @error('facebook')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">TikTok</label>
                                    <input type="url" name="tiktok"
                                        class="form-control @error('tiktok') is-invalid @enderror"
                                        value="{{ old('tiktok', $settings['tiktok']['value'] ?? '') }}"
                                        placeholder="https://tiktok.com/@username">
                                    @error('tiktok')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">YouTube</label>
                                    <input type="url" name="youtube"
                                        class="form-control @error('youtube') is-invalid @enderror"
                                        value="{{ old('youtube', $settings['youtube']['value'] ?? '') }}"
                                        placeholder="https://youtube.com/channel/...">
                                    @error('youtube')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Branding Tab -->
                            <div class="tab-pane fade" id="branding" role="tabpanel" aria-labelledby="branding-tab">
                                <div class="mb-3">
                                    <label class="form-label">Logo Website</label>
                                    <input type="file" name="logo"
                                        class="form-control @error('logo') is-invalid @enderror"
                                        accept="image/png,image/jpeg,image/jpg,image/webp">
                                    <small class="form-text text-muted">Format: PNG, JPG, JPEG, WebP. Maksimal 2MB.
                                        Rekomendasi: 250x100px</small>
                                    @if (($logo = $settings['logo']['value'] ?? null) && image_url($logo))
                                        <div class="mt-2">
                                            <img src="{{ image_url($logo) }}" alt="Current logo" class="rounded"
                                                style="max-height: 80px; max-width: 200px;">
                                            <small class="d-block text-muted">Logo saat ini</small>
                                        </div>
                                    @endif
                                    @error('logo')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Favicon Website</label>
                                    <input type="file" name="favicon"
                                        class="form-control @error('favicon') is-invalid @enderror"
                                        accept="image/png,image/x-icon">
                                    <small class="form-text text-muted">Format: PNG, ICO. Maksimal 512KB. Rekomendasi:
                                        32x32px</small>
                                    @if (($favicon = $settings['favicon']['value'] ?? null) && image_url($favicon))
                                        <div class="mt-2">
                                            <img src="{{ image_url($favicon) }}" alt="Current favicon" class="rounded"
                                                style="max-height: 40px; max-width: 40px;">
                                            <small class="d-block text-muted">Favicon saat ini</small>
                                        </div>
                                    @endif
                                    @error('favicon')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Operational Tab -->
                            <div class="tab-pane fade" id="operational" role="tabpanel"
                                aria-labelledby="operational-tab">
                                <div class="mb-3">
                                    <label class="form-label">Jam Operasional</label>
                                    <input type="text" name="operational_hours"
                                        class="form-control @error('operational_hours') is-invalid @enderror"
                                        value="{{ old('operational_hours', $settings['operational_hours']['value'] ?? '') }}"
                                        placeholder="Contoh: Senin - Jumat: 09:00 - 18:00, Sabtu: 09:00 - 16:00">
                                    @error('operational_hours')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="d-grid d-md-flex justify-content-md-end gap-2">
                            <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Simpan Pengaturan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
