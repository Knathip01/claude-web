@extends('layouts.app')

@section('content')
<section class="min-h-screen flex items-center justify-center relative overflow-hidden pt-20 pb-10">

    <!-- Background -->
    <div class="absolute inset-0 bg-[#080808]"></div>
    <div class="absolute inset-0" style="background: radial-gradient(ellipse 70% 60% at 50% 40%, rgba(212,175,55,0.05) 0%, transparent 70%);"></div>
    <div class="absolute top-1/4 -left-32 w-80 h-80 rounded-full animate-float" style="background: radial-gradient(circle, rgba(212,175,55,0.06) 0%, transparent 70%);"></div>
    <div class="absolute bottom-1/4 -right-32 w-64 h-64 rounded-full animate-float" style="background: radial-gradient(circle, rgba(212,175,55,0.05) 0%, transparent 70%); animation-delay: -3s;"></div>

    <div class="relative z-10 w-full max-w-md px-6 animate-fade-up">

        <!-- Card -->
        <div class="glass-card p-10">

            <!-- Logo -->
            <div class="text-center mb-10">
                <a href="/" class="inline-flex items-center gap-3 group mb-8">
                    <div class="w-7 h-7 border border-gold/50 rotate-45 group-hover:rotate-0 group-hover:bg-gold/10 transition-all duration-500"></div>
                    <span class="font-serif text-lg tracking-[0.25em] font-bold">LUXE <span class="text-gold">BOTTLES</span></span>
                </a>
                <h1 class="font-serif text-3xl font-bold gradient-gold gold-glow mb-2">ยินดีต้อนรับ</h1>
                <p class="text-gray-500 text-sm font-light">เข้าสู่ระบบเพื่อดำเนินการต่อ</p>
            </div>

            <!-- Errors -->
            @if ($errors->any())
            <div class="mb-6 p-4 border border-red-500/20 bg-red-500/5 text-red-400 text-sm rounded">
                {{ $errors->first() }}
            </div>
            @endif

            <!-- Success -->
            @if (session('success'))
            <div class="mb-6 p-4 border border-gold/20 bg-gold/5 text-gold text-sm rounded">
                {{ session('success') }}
            </div>
            @endif

            <form method="POST" action="/login" class="space-y-5">
                @csrf

                <!-- Email -->
                <div>
                    <label class="block text-[10px] uppercase tracking-[0.3em] text-gray-400 font-semibold mb-2">อีเมล</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                           class="w-full bg-white/3 border border-white/10 text-white text-sm px-4 py-3 outline-none focus:border-gold/50 transition-colors duration-200 placeholder-gray-600"
                           placeholder="your@email.com">
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-[10px] uppercase tracking-[0.3em] text-gray-400 font-semibold mb-2">รหัสผ่าน</label>
                    <input type="password" name="password" required
                           class="w-full bg-white/3 border border-white/10 text-white text-sm px-4 py-3 outline-none focus:border-gold/50 transition-colors duration-200 placeholder-gray-600"
                           placeholder="••••••••">
                </div>

                <!-- Remember -->
                <div class="flex items-center gap-2">
                    <input type="checkbox" name="remember" id="remember"
                           class="w-4 h-4 accent-yellow-500">
                    <label for="remember" class="text-xs text-gray-500 cursor-pointer">จดจำฉัน</label>
                </div>

                <!-- Submit -->
                <button type="submit" class="btn-gold w-full justify-center py-4 mt-2">
                    เข้าสู่ระบบ
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </button>
            </form>

            <!-- Divider -->
            <div class="divider-gold my-7">
                <span class="text-gold/40 text-xs">◆</span>
            </div>

            <!-- Register link -->
            <p class="text-center text-sm text-gray-500">
                ยังไม่มีบัญชี?
                <a href="/register" class="text-gold hover:text-gold-light transition-colors duration-200 font-medium ml-1">สมัครสมาชิก</a>
                <span class="text-gold/40 ml-1">— รับส่วนลด 10%</span>
            </p>
        </div>
    </div>
</section>
@endsection
