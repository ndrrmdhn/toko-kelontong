<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                @include('admin.components.form-text', [
                    'name' => 'name',
                    'label' => 'Nama Layanan',
                    'value' => old('name', optional($service)->name),
                    'required' => true,
                    'placeholder' => 'Contoh: Pengiriman Cepat',
                ])

                @include('admin.components.form-text', [
                    'name' => 'icon',
                    'label' => 'Icon (Bootstrap Icon)',
                    'value' => old('icon', optional($service)->icon),
                    'required' => true,
                    'placeholder' => 'Contoh: bi-truck, bi-shield-check, bi-telephone',
                ])
                <small class="form-text text-muted d-block mb-3">
                    Lihat daftar icon di: <a href="https://icons.getbootstrap.com/" target="_blank">Bootstrap Icons</a>
                </small>

                @include('admin.components.form-textarea', [
                    'name' => 'description',
                    'label' => 'Deskripsi Layanan',
                    'value' => old('description', optional($service)->description),
                    'placeholder' => 'Deskripsi singkat layanan',
                    'rows' => 4,
                ])

                @include('admin.components.form-checkbox', [
                    'name' => 'is_active',
                    'label' => 'Aktifkan Layanan',
                    'value' => old('is_active', optional($service)->is_active ?? true),
                ])
            </div>
        </div>
    </div>
</div>
