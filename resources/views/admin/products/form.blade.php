@extends('admin.layout')

@section('admin-content')

<div class="max-w-2xl mx-auto">

    <!-- Header -->
    <div class="mb-8">
        <a href="{{ route('admin.products.index') }}" class="inline-flex items-center gap-2 text-xs text-gray-500 hover:text-gold transition-colors duration-200 mb-4">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            กลับ
        </a>
        <p class="text-[10px] uppercase tracking-[0.4em] text-gold/60 font-semibold mb-1">Admin Panel</p>
        <h1 class="font-serif text-3xl font-bold gradient-gold">
            {{ $isEdit ? 'แก้ไขสินค้า' : 'เพิ่มสินค้าใหม่' }}
        </h1>
    </div>

    <!-- Errors -->
    @if ($errors->any())
    <div class="mb-6 p-4 border border-red-500/20 bg-red-500/5 text-red-400 text-sm space-y-1">
        @foreach ($errors->all() as $error)
        <div>• {{ $error }}</div>
        @endforeach
    </div>
    @endif

    <!-- Form -->
    <div class="glass-card p-8">
        <form method="POST"
              action="{{ $isEdit ? route('admin.products.update', $product) : route('admin.products.store') }}">
            @csrf
            @if ($isEdit) @method('PUT') @endif

            <div class="space-y-6">

                <!-- Name -->
                <div>
                    <label class="block text-[10px] uppercase tracking-[0.3em] text-gray-400 font-semibold mb-2">ชื่อสินค้า *</label>
                    <input type="text" name="name" value="{{ old('name', $product->name) }}" required
                           class="w-full px-4 py-3 text-sm"
                           placeholder="e.g. Midnight Sapphire Gin">
                </div>

                <!-- Description -->
                <div>
                    <label class="block text-[10px] uppercase tracking-[0.3em] text-gray-400 font-semibold mb-2">รายละเอียด</label>
                    <textarea name="description" rows="3"
                              class="w-full px-4 py-3 text-sm resize-none"
                              placeholder="รายละเอียดสินค้า...">{{ old('description', $product->description) }}</textarea>
                </div>

                <!-- Price -->
                <div>
                    <label class="block text-[10px] uppercase tracking-[0.3em] text-gray-400 font-semibold mb-2">ราคา (USD) *</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 text-sm font-medium">$</span>
                        <input type="number" name="price" value="{{ old('price', $product->price) }}"
                               min="0" step="0.01" required
                               class="w-full pl-8 pr-4 py-3 text-sm"
                               placeholder="0.00">
                    </div>
                    @if ($isEdit)
                    <p class="text-[11px] text-green-500/60 mt-1.5">ราคาสมาชิก: ${{ number_format(old('price', $product->price ?? 0) * 0.9, 2) }}</p>
                    @endif
                </div>

                <!-- Image URL -->
                <div>
                    <label class="block text-[10px] uppercase tracking-[0.3em] text-gray-400 font-semibold mb-2">URL รูปภาพ</label>
                    <input type="text" name="image_path" value="{{ old('image_path', $product->image_path) }}"
                           class="w-full px-4 py-3 text-sm"
                           placeholder="https://...">
                    @if ($isEdit && $product->image_path)
                    <div class="mt-3 flex items-start gap-4">
                        <img src="{{ $product->image_path }}" alt="preview"
                             class="w-16 h-20 object-cover border border-white/10">
                        <p class="text-[11px] text-gray-600 mt-2">รูปปัจจุบัน</p>
                    </div>
                    @endif
                </div>

                <!-- Features -->
                <div>
                    <label class="block text-[10px] uppercase tracking-[0.3em] text-gray-400 font-semibold mb-2">
                        Specifications
                        <span class="text-gray-600 normal-case tracking-normal font-normal ml-1">(key: value บรรทัดละรายการ)</span>
                    </label>
                    <textarea name="features_text" rows="5"
                              class="w-full px-4 py-3 text-sm font-mono resize-none"
                              placeholder="Type: Gin&#10;Volume: 700ml&#10;Origin: Scotland&#10;ABV: 43%">{{ old('features_text', $isEdit && $product->features ? collect($product->features)->map(fn($v, $k) => "$k: $v")->implode("\n") : '') }}</textarea>
                    <p class="text-[11px] text-gray-600 mt-1.5">ตัวอย่าง: <span class="text-gray-500">Volume: 700ml</span></p>
                </div>

            </div>

            <!-- Actions -->
            <div class="flex items-center gap-3 mt-8 pt-6 border-t border-white/5">
                <button type="submit" class="btn-gold">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    {{ $isEdit ? 'บันทึกการแก้ไข' : 'เพิ่มสินค้า' }}
                </button>
                <a href="{{ route('admin.products.index') }}" class="btn-ghost">ยกเลิก</a>
            </div>
        </form>
    </div>
</div>

@if ($isEdit)
<script>
    // Live preview member price
    document.querySelector('input[name="price"]')?.addEventListener('input', function () {
        const p = document.querySelector('.text-green-500\\/60');
        if (p) p.textContent = 'ราคาสมาชิก: $' + (this.value * 0.9).toFixed(2);
    });
</script>
@endif

@endsection
