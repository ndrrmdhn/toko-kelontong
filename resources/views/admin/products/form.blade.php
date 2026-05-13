<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                @include('admin.components.form-text', [
                    'name' => 'name',
                    'label' => 'Nama Produk',
                    'value' => old('name', optional($product)->name),
                    'required' => true,
                ])

                @include('admin.components.form-select', [
                    'name' => 'category_id',
                    'label' => 'Kategori',
                    'options' => $categories,
                    'selected' => old('category_id', optional($product)->category_id),
                    'placeholder' => 'Pilih kategori',
                    'required' => true,
                ])

                <div class="row g-3">
                    <div class="col-md-6">
                        @include('admin.components.form-text', [
                            'name' => 'price',
                            'label' => 'Harga (Rp)',
                            'type' => 'number',
                            'step' => '0.01',
                            'min' => '0',
                            'value' => old('price', optional($product)->price),
                            'required' => true,
                        ])
                    </div>
                    <div class="col-md-6">
                        @include('admin.components.form-text', [
                            'name' => 'stock',
                            'label' => 'Stok',
                            'type' => 'number',
                            'step' => '1',
                            'min' => '0',
                            'value' => old('stock', optional($product)->stock),
                            'required' => true,
                        ])
                    </div>
                </div>

                @include('admin.components.form-checkbox', [
                    'name' => 'active',
                    'label' => 'Aktifkan Produk',
                    'value' => old('active', optional($product)->active ?? true),
                ])

                @include('admin.components.form-text', [
                    'name' => 'expired_date',
                    'label' => 'Tanggal Kadaluarsa',
                    'type' => 'date',
                    'value' => old('expired_date', optional($product)->expired_date?->format('Y-m-d')),
                ])

                @include('admin.components.form-textarea', [
                    'name' => 'description',
                    'label' => 'Deskripsi Produk',
                    'value' => old('description', optional($product)->description),
                    'placeholder' => 'Deskripsi singkat produk',
                    'rows' => 4,
                ])

                @include('admin.components.form-textarea', [
                    'name' => 'whatsapp_message',
                    'label' => 'Pesan WhatsApp',
                    'value' => old('whatsapp_message', optional($product)->whatsapp_message),
                    'placeholder' => 'Contoh: Saya ingin memesan...',
                    'rows' => 3,
                ])

                @include('admin.components.form-file', [
                    'name' => 'image',
                    'label' => 'Gambar Produk',
                    'value' => optional($product)->image,
                ])
            </div>
        </div>
    </div>
</div>
