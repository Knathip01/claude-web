@extends('admin.layout')

@section('admin-content')

<div class="max-w-6xl mx-auto">

    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <p class="text-[10px] uppercase tracking-[0.4em] text-gold/60 font-semibold mb-1">Admin Panel</p>
            <h1 class="font-serif text-3xl font-bold gradient-gold">จัดการสินค้า</h1>
        </div>
        <a href="{{ route('admin.products.create') }}" class="btn-gold">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            เพิ่มสินค้าใหม่
        </a>
    </div>

    <!-- Flash -->
    @if (session('success'))
    <div class="mb-6 p-4 border border-gold/25 bg-gold/5 text-gold text-sm">
        ◆ {{ session('success') }}
    </div>
    @endif

    <!-- Table -->
    <div class="glass-card overflow-hidden">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-white/5">
                    <th class="text-left px-5 py-4 text-[10px] uppercase tracking-[0.3em] text-gray-500 font-semibold w-16">รูป</th>
                    <th class="text-left px-5 py-4 text-[10px] uppercase tracking-[0.3em] text-gray-500 font-semibold">ชื่อสินค้า</th>
                    <th class="text-left px-5 py-4 text-[10px] uppercase tracking-[0.3em] text-gray-500 font-semibold hidden md:table-cell">รายละเอียด</th>
                    <th class="text-right px-5 py-4 text-[10px] uppercase tracking-[0.3em] text-gray-500 font-semibold">ราคา</th>
                    <th class="text-right px-5 py-4 text-[10px] uppercase tracking-[0.3em] text-gray-500 font-semibold">จัดการ</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                @forelse ($products as $product)
                <tr class="hover:bg-white/2 transition-colors duration-150">
                    <!-- Image -->
                    <td class="px-5 py-4">
                        @if ($product->image_path)
                        <div class="w-12 h-16 overflow-hidden border border-white/10 flex-shrink-0">
                            <img src="{{ $product->image_path }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                        </div>
                        @else
                        <div class="w-12 h-16 border border-white/10 flex items-center justify-center text-gray-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        @endif
                    </td>

                    <!-- Name -->
                    <td class="px-5 py-4">
                        <p class="font-serif text-base font-semibold text-white">{{ $product->name }}</p>
                        @if ($product->features)
                        <p class="text-[10px] text-gray-600 mt-0.5">{{ count($product->features) }} specifications</p>
                        @endif
                    </td>

                    <!-- Description -->
                    <td class="px-5 py-4 hidden md:table-cell">
                        <p class="text-xs text-gray-500 font-light line-clamp-2 max-w-xs">{{ $product->description ?? '—' }}</p>
                    </td>

                    <!-- Price -->
                    <td class="px-5 py-4 text-right">
                        <span class="font-serif text-base font-bold text-gold">${{ number_format($product->price, 2) }}</span>
                        <p class="text-[10px] text-green-500/70 mt-0.5">สมาชิก ${{ number_format($product->price * 0.9, 2) }}</p>
                    </td>

                    <!-- Actions -->
                    <td class="px-5 py-4 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.products.edit', $product) }}" class="btn-ghost text-[10px] py-2 px-3">
                                แก้ไข
                            </a>
                            <form method="POST" action="{{ route('admin.products.destroy', $product) }}"
                                  onsubmit="return confirm('ยืนยันการลบ {{ addslashes($product->name) }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-danger text-[10px] py-2 px-3">ลบ</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-5 py-16 text-center text-gray-600">
                        <svg class="w-10 h-10 mx-auto mb-3 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                        <p class="text-sm">ยังไม่มีสินค้า</p>
                        <a href="{{ route('admin.products.create') }}" class="btn-gold mt-4 text-[10px]">เพิ่มสินค้าแรก</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Summary -->
    <p class="text-[11px] text-gray-600 mt-4 text-right">ทั้งหมด {{ $products->count() }} รายการ</p>
</div>

@endsection
