<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                @include('admin.components.form-text', [
                    'name' => 'name',
                    'label' => 'Nama Kontrakan',
                    'value' => old('name', optional($rental)->name),
                    'required' => true,
                ])

                <div class="row g-3">
                    <div class="col-md-6">
                        @include('admin.components.form-text', [
                            'name' => 'price_monthly',
                            'label' => 'Harga Sewa Bulanan (Rp)',
                            'type' => 'number',
                            'step' => '0.01',
                            'min' => '0',
                            'value' => old('price_monthly', optional($rental)->price_monthly),
                            'placeholder' => '0',
                        ])
                    </div>
                    <div class="col-md-6">
                        @include('admin.components.form-text', [
                            'name' => 'price_yearly',
                            'label' => 'Harga Sewa Tahunan (Rp)',
                            'type' => 'number',
                            'step' => '0.01',
                            'min' => '0',
                            'value' => old('price_yearly', optional($rental)->price_yearly),
                            'placeholder' => '0',
                        ])
                    </div>
                </div>

                @include('admin.components.form-select', [
                    'name' => 'status',
                    'label' => 'Status Ketersediaan',
                    'options' => ['available' => 'Tersedia', 'rented' => 'Disewa'],
                    'selected' => old('status', optional($rental)->status ?? 'available'),
                    'required' => true,
                ])

                @include('admin.components.form-textarea', [
                    'name' => 'description',
                    'label' => 'Deskripsi Kontrakan',
                    'value' => old('description', optional($rental)->description),
                    'placeholder' => 'Deskripsi lengkap kontrakan, lokasi, ukuran, dll.',
                    'rows' => 4,
                ])

                <div class="mb-3">
                    <label class="form-label">Fasilitas Kontrakan</label>
                    <div id="facilities-container">
                        @if (old('facilities', optional($rental)->facilities))
                            @foreach (old('facilities', optional($rental)->facilities) as $index => $facility)
                                <div class="input-group facility-item mb-2">
                                    <input type="text" name="facilities[]" class="form-control"
                                        value="{{ $facility }}" placeholder="Contoh: AC, WiFi, Parkir">
                                    <button type="button" class="btn btn-outline-danger remove-facility">
                                        <span>🗑️</span>
                                    </button>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <button type="button" id="add-facility" class="btn btn-outline-primary btn-sm">
                        <span>➕ Tambah Fasilitas</span>
                    </button>
                    <div class="form-text">Tambahkan fasilitas yang tersedia di kontrakan ini.</div>
                </div>

                @include('admin.components.form-textarea', [
                    'name' => 'whatsapp_message',
                    'label' => 'Pesan WhatsApp',
                    'value' => old('whatsapp_message', optional($rental)->whatsapp_message),
                    'placeholder' => 'Contoh: Saya ingin menanyakan kontrakan ini...',
                    'rows' => 3,
                ])

                <div class="mb-3">
                    <label class="form-label">Galeri Foto Kontrakan</label>
                    <input type="file" name="images[]" class="form-control" multiple accept="image/*"
                        onchange="previewImages(this)">
                    <div class="form-text">
                        Pilih multiple gambar (maksimal 10 gambar). Format: JPG, PNG, GIF. Maksimal 2MB per gambar.
                    </div>
                    <div id="image-preview" class="mt-3">
                        @if (isset($rental) && $rental->images)
                            @foreach ($rental->images as $image)
                                @php $previewUrl = image_url($image); @endphp
                                <div class="d-inline-block position-relative mb-2 me-2">
                                    @if ($previewUrl)
                                        <img src="{{ $previewUrl }}" alt="Existing image" class="rounded"
                                            style="width: 100px; height: 100px; object-fit: cover;">
                                    @else
                                        <div class="bg-light rounded"
                                            style="width: 100px; height: 100px; display:flex; align-items:center; justify-content:center;">
                                            <small class="text-muted">No Image</small>
                                        </div>
                                    @endif
                                    <span class="badge bg-secondary position-absolute end-0 top-0">Existing</span>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function previewImages(input) {
        const preview = document.getElementById('image-preview');
        preview.innerHTML = '';

        if (input.files) {
            Array.from(input.files).forEach(file => {
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.className = 'rounded me-2 mb-2';
                        img.style.width = '100px';
                        img.style.height = '100px';
                        img.style.objectFit = 'cover';
                        preview.appendChild(img);
                    };
                    reader.readAsDataURL(file);
                }
            });
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('facilities-container');
        const addButton = document.getElementById('add-facility');

        addButton.addEventListener('click', function() {
            const facilityItem = document.createElement('div');
            facilityItem.className = 'input-group mb-2 facility-item';
            facilityItem.innerHTML = `
            <input type="text" name="facilities[]" class="form-control" placeholder="Contoh: AC, WiFi, Parkir">
            <button type="button" class="btn btn-outline-danger remove-facility">
                <span>🗑️</span>
            </button>
        `;
            container.appendChild(facilityItem);
        });

        container.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-facility') || e.target.parentElement.classList
                .contains('remove-facility')) {
                e.target.closest('.facility-item').remove();
            }
        });

        // Add one empty facility input if none exist
        if (container.children.length === 0) {
            addButton.click();
        }
    });
</script>
