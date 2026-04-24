@extends('layouts.app')

@section('content')
<section class="min-h-screen flex items-center justify-center relative overflow-hidden pt-20 pb-10">

    <!-- Background -->
    <div class="absolute inset-0 bg-[#080808]"></div>
    <div class="absolute inset-0" style="background: radial-gradient(ellipse 70% 60% at 50% 40%, rgba(212,175,55,0.05) 0%, transparent 70%);"></div>
    <div class="absolute top-1/4 -left-32 w-80 h-80 rounded-full animate-float" style="background: radial-gradient(circle, rgba(212,175,55,0.06) 0%, transparent 70%);"></div>
    <div class="absolute bottom-1/4 -right-32 w-64 h-64 rounded-full animate-float" style="background: radial-gradient(circle, rgba(212,175,55,0.05) 0%, transparent 70%); animation-delay: -3s;"></div>

    <div class="relative z-10 w-full max-w-md px-6 animate-fade-up">

        <!-- Member benefit banner -->
        <div class="mb-5 p-4 border border-gold/30 bg-gold/5 text-center">
            <span class="text-[9px] uppercase tracking-[0.4em] text-gold/70 font-semibold block mb-1">สิทธิพิเศษสมาชิก</span>
            <p class="text-gold font-serif text-xl font-bold">ส่วนลด 10% ทันที</p>
            <p class="text-gray-400 text-xs mt-1 font-light">สำหรับสินค้าทุกชิ้นในคอลเลกชั่น</p>
        </div>

        <!-- Card -->
        <div class="glass-card p-10">

            <!-- Logo -->
            <div class="text-center mb-8">
                <a href="/" class="inline-flex items-center gap-3 group mb-6">
                    <div class="w-7 h-7 border border-gold/50 rotate-45 group-hover:rotate-0 group-hover:bg-gold/10 transition-all duration-500"></div>
                    <span class="font-serif text-lg tracking-[0.25em] font-bold">LUXE <span class="text-gold">BOTTLES</span></span>
                </a>
                <h1 class="font-serif text-3xl font-bold gradient-gold gold-glow mb-2">สมัครสมาชิก</h1>
                <p class="text-gray-500 text-sm font-light">เข้าร่วมชุมชนผู้รักของพรีเมียม</p>
            </div>

            <!-- Errors -->
            @if ($errors->any())
            <div class="mb-6 p-4 border border-red-500/20 bg-red-500/5 text-red-400 text-sm space-y-1">
                @foreach ($errors->all() as $error)
                <div>• {{ $error }}</div>
                @endforeach
            </div>
            @endif

            <form method="POST" action="/register" class="space-y-5">
                @csrf

                <!-- Name -->
                <div>
                    <label class="block text-[10px] uppercase tracking-[0.3em] text-gray-400 font-semibold mb-2">ชื่อ-นามสกุล</label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                           class="w-full bg-white/3 border border-white/10 text-white text-sm px-4 py-3 outline-none focus:border-gold/50 transition-colors duration-200 placeholder-gray-600"
                           placeholder="Your Full Name">
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-[10px] uppercase tracking-[0.3em] text-gray-400 font-semibold mb-2">อีเมล</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                           class="w-full bg-white/3 border border-white/10 text-white text-sm px-4 py-3 outline-none focus:border-gold/50 transition-colors duration-200 placeholder-gray-600"
                           placeholder="your@email.com">
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-[10px] uppercase tracking-[0.3em] text-gray-400 font-semibold mb-2">รหัสผ่าน <span class="text-gray-600 normal-case tracking-normal">(อย่างน้อย 8 ตัวอักษร)</span></label>
                    <input type="password" name="password" required
                           class="w-full bg-white/3 border border-white/10 text-white text-sm px-4 py-3 outline-none focus:border-gold/50 transition-colors duration-200 placeholder-gray-600"
                           placeholder="••••••••">
                </div>

                <!-- Confirm Password -->
                <div>
                    <label class="block text-[10px] uppercase tracking-[0.3em] text-gray-400 font-semibold mb-2">ยืนยันรหัสผ่าน</label>
                    <input type="password" name="password_confirmation" required
                           class="w-full bg-white/3 border border-white/10 text-white text-sm px-4 py-3 outline-none focus:border-gold/50 transition-colors duration-200 placeholder-gray-600"
                           placeholder="••••••••">
                </div>

                <!-- Submit -->
                <button type="submit" class="btn-gold w-full justify-center py-4 mt-2">
                    สมัครสมาชิกและรับส่วนลด 10%
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </button>
            </form>

            <!-- Divider -->
            <div class="divider-gold my-7">
                <span class="text-gold/40 text-xs">◆</span>
            </div>

            <!-- Login link -->
            <p class="text-center text-sm text-gray-500">
                มีบัญชีอยู่แล้ว?
                <a href="/login" class="text-gold hover:text-gold-light transition-colors duration-200 font-medium ml-1">เข้าสู่ระบบ</a>
            </p>
        </div>
    </div>
</section>
@endsection
