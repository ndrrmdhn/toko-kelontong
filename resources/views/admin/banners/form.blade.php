<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                @include('admin.components.form-text', [
                    'name' => 'title',
                    'label' => 'Judul Banner',
                    'value' => old('title', optional($banner)->title),
                    'required' => true,
                ])

                @include('admin.components.form-textarea', [
                    'name' => 'description',
                    'label' => 'Deskripsi / Subtitle',
                    'value' => old('description', optional($banner)->description),
                    'placeholder' => 'Deskripsi singkat banner',
                    'rows' => 3,
                ])

                <div class="row g-3">
                    <div class="col-md-6">
                        @include('admin.components.form-text', [
                            'name' => 'button_text',
                            'label' => 'Teks Tombol',
                            'value' => old('button_text', optional($banner)->button_text),
                            'placeholder' => 'Contoh: Belanja Sekarang',
                        ])
                    </div>
                    <div class="col-md-6">
                        @include('admin.components.form-text', [
                            'name' => 'button_link',
                            'label' => 'Link Tombol',
                            'type' => 'url',
                            'value' => old('button_link', optional($banner)->button_link),
                            'placeholder' => 'https://example.com',
                        ])
                    </div>
                </div>

                @include('admin.components.form-text', [
                    'name' => 'sort_order',
                    'label' => 'Urutan Tampil',
                    'type' => 'number',
                    'step' => '1',
                    'min' => '0',
                    'value' => old('sort_order', optional($banner)->sort_order ?? 0),
                ])

                @include('admin.components.form-checkbox', [
                    'name' => 'is_active',
                    'label' => 'Aktifkan Banner',
                    'value' => old('is_active', optional($banner)->is_active ?? true),
                ])

                @include('admin.components.form-file', [
                    'name' => 'image',
                    'label' => 'Gambar Banner',
                    'value' => optional($banner)->image,
                    'accept' => 'image/*',
                ])
            </div>
        </div>
    </div>
</div>
