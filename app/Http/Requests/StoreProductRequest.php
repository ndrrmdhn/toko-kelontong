<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && in_array(auth()->user()->role, ['super_admin', 'admin_toko']);
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:products,name',
            'description' => 'nullable|string|max:2000',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'expired_date' => 'nullable|date',
            'whatsapp_message' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'active' => 'nullable|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama produk harus diisi',
            'name.max' => 'Nama produk maksimal 255 karakter',
            'name.unique' => 'Nama produk sudah terdaftar',
            'price.required' => 'Harga produk harus diisi',
            'price.numeric' => 'Harga harus berupa angka',
            'price.min' => 'Harga tidak boleh negatif',
            'stock.required' => 'Stok produk harus diisi',
            'stock.integer' => 'Stok harus berupa angka bulat',
            'stock.min' => 'Stok tidak boleh negatif',
            'category_id.required' => 'Kategori produk harus dipilih',
            'category_id.exists' => 'Kategori tidak ditemukan',
            'expired_date.date' => 'Format tanggal kadaluarsa tidak valid',
            'whatsapp_message.max' => 'Pesan WhatsApp maksimal 1000 karakter',
            'image.image' => 'File harus berupa gambar',
            'image.mimes' => 'Format gambar harus JPEG, PNG, JPG, atau GIF',
            'image.max' => 'Ukuran gambar maksimal 2MB',
        ];
    }
}
