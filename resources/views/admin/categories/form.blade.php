<div class="card">
    <div class="card-body">
        @include('admin.components.form-text', [
            'name' => 'name',
            'label' => 'Nama Kategori',
            'value' => old('name', optional($category)->name),
            'required' => true,
        ])

        @include('admin.components.form-textarea', [
            'name' => 'description',
            'label' => 'Deskripsi',
            'value' => old('description', optional($category)->description),
            'placeholder' => 'Deskripsi singkat kategori',
        ])

        @include('admin.components.form-file', [
            'name' => 'image',
            'label' => 'Gambar Kategori',
            'value' => optional($category)->image,
        ])
    </div>
</div>
