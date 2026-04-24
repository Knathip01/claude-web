<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ mobileOpen: false, scrolled: false }" x-init="window.addEventListener('scroll', () => scrolled = window.scrollY > 60)">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Luxe Bottles Export | Premium Quality</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;0,700;1,400;1,600&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --gold: #d4af37;
            --gold-light: #e8cb5a;
            --gold-dark: #aa8a2e;
            --black: #080808;
            --dark: #111111;
            --dark-2: #181818;
        }

        *, *::before, *::after { box-sizing: border-box; }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--black);
            color: #e8e8e8;
            overflow-x: hidden;
        }

        h1, h2, h3, h4, h5, .font-serif { font-family: 'Cormorant Garamond', serif; }

        .text-gold { color: var(--gold); }
        .bg-gold { background-color: var(--gold); }
        .border-gold { border-color: var(--gold); }

        /* Glassmorphism */
        .glass {
            background: rgba(8, 8, 8, 0.85);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(212, 175, 55, 0.1);
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.07);
        }

        /* Gold glow */
        .gold-glow { text-shadow: 0 0 30px rgba(212, 175, 55, 0.4); }
        .gold-glow-sm { text-shadow: 0 0 12px rgba(212, 175, 55, 0.3); }

        /* Gradient text */
        .gradient-gold {
            background: linear-gradient(135deg, var(--gold-light) 0%, var(--gold) 50%, var(--gold-dark) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Scrolling ticker */
        @keyframes ticker {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
        .ticker-track { animation: ticker 30s linear infinite; white-space: nowrap; }

        /* Fade in up */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(30px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to   { opacity: 1; }
        }
        @keyframes floatY {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50%       { transform: translateY(-20px) rotate(2deg); }
        }
        @keyframes pulseGold {
            0%, 100% { box-shadow: 0 0 0 0 rgba(212, 175, 55, 0); }
            50%       { box-shadow: 0 0 40px 10px rgba(212, 175, 55, 0.12); }
        }
        @keyframes spin-slow {
            to { transform: rotate(360deg); }
        }

        .animate-fade-up   { animation: fadeUp 0.9s ease forwards; }
        .animate-fade-in   { animation: fadeIn 1.2s ease forwards; }
        .animate-float     { animation: floatY 6s ease-in-out infinite; }
        .animate-pulse-gold { animation: pulseGold 4s ease-in-out infinite; }
        .animate-spin-slow  { animation: spin-slow 20s linear infinite; }

        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; }
        .delay-500 { animation-delay: 0.5s; }
        .delay-700 { animation-delay: 0.7s; }

        /* Intersection observer fade */
        .reveal { opacity: 0; transform: translateY(40px); transition: opacity 0.8s ease, transform 0.8s ease; }
        .reveal.visible { opacity: 1; transform: translateY(0); }

        /* Nav link underline slide */
        .nav-link {
            position: relative;
            padding-bottom: 4px;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0; left: 0;
            width: 0; height: 1px;
            background: var(--gold);
            transition: width 0.3s ease;
        }
        .nav-link:hover::after { width: 100%; }

        /* Button styles */
        .btn-gold {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: linear-gradient(135deg, var(--gold-light), var(--gold-dark));
            color: #000;
            padding: 0.875rem 2.5rem;
            font-weight: 700;
            font-size: 0.7rem;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
        }
        .btn-gold::before {
            content: '';
            position: absolute;
            inset: 0;
            background: white;
            opacity: 0;
            transition: opacity 0.3s;
        }
        .btn-gold:hover::before { opacity: 0.1; }
        .btn-ghost {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            border: 1px solid rgba(255,255,255,0.2);
            color: #fff;
            padding: 0.875rem 2.5rem;
            font-weight: 600;
            font-size: 0.7rem;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            transition: all 0.4s ease;
        }
        .btn-ghost:hover {
            border-color: var(--gold);
            color: var(--gold);
        }

        /* Divider line */
        .divider-gold {
            display: flex;
            align-items: center;
            gap: 1rem;
            color: var(--gold);
        }
        .divider-gold::before, .divider-gold::after {
            content: '';
            flex: 1;
            height: 1px;
            background: linear-gradient(to right, transparent, rgba(212,175,55,0.4));
        }
        .divider-gold::after {
            background: linear-gradient(to left, transparent, rgba(212,175,55,0.4));
        }

        /* Mobile menu */
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="antialiased">

    <!-- Navbar -->
    <nav class="fixed w-full z-50 transition-all duration-500"
         :class="scrolled ? 'glass py-3 shadow-2xl' : 'py-6'">
        <div class="max-w-7xl mx-auto px-6 flex justify-between items-center">

            <!-- Logo -->
            <a href="/" class="flex items-center gap-3 group">
                <div class="w-8 h-8 border border-gold/50 rotate-45 group-hover:rotate-0 group-hover:bg-gold/10 transition-all duration-500"></div>
                <span class="text-xl font-serif font-bold tracking-[0.25em] text-white">LUXE <span class="text-gold">BOTTLES</span></span>
            </a>

            <!-- Desktop Nav -->
            <div class="hidden md:flex items-center space-x-8 text-xs uppercase tracking-[0.2em] font-medium">
                <a href="/" class="nav-link hover:text-gold transition-colors duration-300">Showcase</a>
                <a href="/track" class="nav-link hover:text-gold transition-colors duration-300">Tracking</a>
                <a href="#collection" class="nav-link hover:text-gold transition-colors duration-300">Collection</a>

                <!-- Cart -->
                <a href="{{ route('cart.index') }}" class="relative group p-2">
                    <svg class="w-5 h-5 text-white group-hover:text-gold transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    @if(session('cart') && count(session('cart')) > 0)
                        <span class="absolute -top-1 -right-1 w-4 h-4 bg-gold text-[9px] font-bold text-black flex items-center justify-center rounded-full border border-black">
                            {{ count(session('cart')) }}
                        </span>
                    @endif
                </a>

                @auth
                    @if (auth()->user()->is_admin)
                        <a href="{{ route('admin.products.index') }}" class="nav-link hover:text-gold transition-colors duration-300 text-gold/80">Admin</a>
                    @endif

                    <div class="flex items-center gap-3">
                        <span class="text-gray-500 text-[10px] normal-case tracking-normal font-light">
                            {{ auth()->user()->name }}
                            @if (auth()->user()->is_member)
                                <span class="ml-1 px-1.5 py-0.5 border border-gold/40 text-gold text-[8px] tracking-widest uppercase font-semibold">Member</span>
                            @endif
                        </span>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="nav-link hover:text-gold transition-colors duration-300 text-gray-400">Logout</button>
                        </form>
                    </div>
                @else
                    <a href="/login" class="nav-link hover:text-gold transition-colors duration-300">Login</a>
                    <a href="/register" class="btn-gold text-[10px] px-5 py-3">
                        สมัครสมาชิก
                        <span class="text-[8px] opacity-70 ml-0.5">−10%</span>
                    </a>
                @endauth

                <a href="#contact" class="btn-ghost text-[10px] px-5 py-3">Contact</a>
            </div>

            <!-- Mobile Hamburger -->
            <button class="md:hidden w-10 h-10 flex flex-col justify-center items-center gap-1.5 group"
                    @click="mobileOpen = !mobileOpen">
                <span class="block w-6 h-0.5 bg-white transition-all duration-300"
                      :class="mobileOpen ? 'rotate-45 translate-y-2' : ''"></span>
                <span class="block w-6 h-0.5 bg-white transition-all duration-300"
                      :class="mobileOpen ? 'opacity-0' : ''"></span>
                <span class="block w-6 h-0.5 bg-white transition-all duration-300"
                      :class="mobileOpen ? '-rotate-45 -translate-y-2' : ''"></span>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div x-show="mobileOpen" x-cloak
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 -translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             class="md:hidden glass border-t border-white/5 px-6 py-8 space-y-6 text-sm uppercase tracking-widest font-medium">
            <a href="/" class="block hover:text-gold transition" @click="mobileOpen = false">Showcase</a>
            <a href="/track" class="block hover:text-gold transition" @click="mobileOpen = false">Tracking</a>
            <a href="#collection" class="block hover:text-gold transition" @click="mobileOpen = false">Collection</a>
            <a href="{{ route('cart.index') }}" class="flex items-center justify-between hover:text-gold transition" @click="mobileOpen = false">
                <span>Your Cart</span>
                @if(session('cart') && count(session('cart')) > 0)
                    <span class="px-2 py-0.5 bg-gold text-black text-[10px] font-bold rounded-full">{{ count(session('cart')) }}</span>
                @endif
            </a>
            <a href="#contact" class="block hover:text-gold transition" @click="mobileOpen = false">Contact</a>

            @auth
                @if (auth()->user()->is_admin)
                    <a href="{{ route('admin.products.index') }}" class="block text-gold/80 hover:text-gold transition" @click="mobileOpen = false">Admin Panel</a>
                @endif
                <div class="flex items-center justify-between pt-2 border-t border-white/5">
                    <span class="text-gray-400 text-[11px] normal-case tracking-normal font-light">
                        {{ auth()->user()->name }}
                        @if (auth()->user()->is_member)
                            <span class="ml-1 px-1.5 py-0.5 border border-gold/40 text-gold text-[8px]">Member</span>
                        @endif
                    </span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-gray-500 hover:text-gold transition text-[11px]">Logout</button>
                    </form>
                </div>
            @else
                <a href="/login" class="block hover:text-gold transition" @click="mobileOpen = false">Login</a>
                <a href="/register" class="block text-gold" @click="mobileOpen = false">สมัครสมาชิก — รับส่วนลด 10%</a>
            @endauth
        </div>
    </nav>

    <!-- Ticker Strip -->
    <div class="fixed bottom-0 left-0 right-0 z-40 overflow-hidden py-2 border-t border-white/5 bg-black/80 backdrop-blur-sm">
        <div class="ticker-track inline-flex gap-12 text-[10px] uppercase tracking-[0.3em] text-gray-600 font-medium">
            @for ($i = 0; $i < 6; $i++)
                <span>Premium Artisanal Glass</span>
                <span class="text-gold/40">◆</span>
                <span>Global Export Network</span>
                <span class="text-gold/40">◆</span>
                <span>Luxury Packaging</span>
                <span class="text-gold/40">◆</span>
                <span>Real-Time Shipment Tracking</span>
                <span class="text-gold/40">◆</span>
            @endfor
        </div>
    </div>

    <main>
        @if (session('success'))
        <div x-data="{ show: true }" x-show="show" x-cloak
             x-init="setTimeout(() => show = false, 5000)"
             class="fixed top-20 right-6 z-50 max-w-sm p-4 border border-gold/30 bg-[#111] text-gold text-sm shadow-2xl animate-fade-in">
            <div class="flex items-start gap-3">
                <span class="text-gold/70 shrink-0 mt-0.5">◆</span>
                <span>{{ session('success') }}</span>
                <button @click="show = false" class="ml-auto text-gold/40 hover:text-gold transition shrink-0">✕</button>
            </div>
        </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer id="contact" class="pt-20 pb-16 border-t border-white/5 bg-[#050505]">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 mb-16">
                <!-- Brand -->
                <div>
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-6 h-6 border border-gold/50 rotate-45"></div>
                        <span class="font-serif text-lg tracking-[0.25em] font-bold">LUXE <span class="text-gold">BOTTLES</span></span>
                    </div>
                    <p class="text-gray-500 text-sm leading-relaxed font-light max-w-xs">
                        Crafting the world's finest artisanal glass containers, exported to discerning clients across the globe.
                    </p>
                </div>
                <!-- Links -->
                <div>
                    <h6 class="text-xs uppercase tracking-[0.3em] text-gray-400 font-semibold mb-6">Navigation</h6>
                    <div class="space-y-3 text-sm text-gray-500">
                        <div><a href="/" class="hover:text-gold transition">Showcase</a></div>
                        <div><a href="#collection" class="hover:text-gold transition">Collection</a></div>
                        <div><a href="/track" class="hover:text-gold transition">Track Shipment</a></div>
                    </div>
                </div>
                <!-- Contact -->
                <div>
                    <h6 class="text-xs uppercase tracking-[0.3em] text-gray-400 font-semibold mb-6">Get In Touch</h6>
                    <div class="space-y-3 text-sm text-gray-500">
                        <div class="flex items-center gap-3">
                            <span class="text-gold">◆</span>
                            <span>Global Inquiries Welcome</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="text-gold">◆</span>
                            <span>Custom Orders Available</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="text-gold">◆</span>
                            <span>Export Consultation</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="border-t border-white/5 pt-8 flex flex-col md:flex-row justify-between items-center gap-4 text-xs text-gray-700 tracking-widest uppercase">
                <span>&copy; {{ date('Y') }} Luxe Bottles Export Co. All rights reserved.</span>
                <span class="text-gold/30">◆ ◆ ◆</span>
                <span>Premium Standards • Artisanal Quality</span>
            </div>
        </div>
    </footer>

    <!-- AI Chat Widget -->
    <div x-data="chatWidget()" x-init="init()" class="fixed bottom-12 right-6 z-50">

        <!-- Toggle Button -->
        <button @click="open = !open"
                class="relative w-12 h-12 flex items-center justify-center shadow-lg transition-all duration-300 hover:scale-110"
                style="background: linear-gradient(135deg, #e8cb5a, #aa8a2e); clip-path: polygon(50% 0%, 100% 50%, 50% 100%, 0% 50%);">
            <svg x-show="!open" class="w-5 h-5 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
            </svg>
            <svg x-show="open" class="w-4 h-4 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>

        <!-- Chat Panel -->
        <div x-show="open" x-cloak
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 translate-y-3 scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0 scale-100"
             x-transition:leave-end="opacity-0 translate-y-3 scale-95"
             class="absolute bottom-16 right-0 w-80 sm:w-96 flex flex-col shadow-2xl"
             style="height: 480px; background: rgba(10,10,10,0.96); border: 1px solid rgba(212,175,55,0.2); backdrop-filter: blur(20px);">

            <!-- Header -->
            <div class="flex items-center justify-between px-4 py-3" style="border-bottom: 1px solid rgba(255,255,255,0.05);">
                <div class="flex items-center gap-2">
                    <span class="text-gold text-xs">◆</span>
                    <span class="font-serif text-sm font-semibold tracking-wide text-white">Luxe Assistant</span>
                    <span class="w-1.5 h-1.5 rounded-full bg-green-400" style="animation: pulse 2s infinite;"></span>
                </div>
                <div class="flex items-center gap-3">
                    <button @click="clearChat()" class="text-gray-600 hover:text-gray-400 transition text-[10px] uppercase tracking-widest">Clear</button>
                    <button @click="open = false" class="text-gray-500 hover:text-white transition text-xs leading-none">✕</button>
                </div>
            </div>

            <!-- Messages -->
            <div class="flex-1 overflow-y-auto px-4 py-3 space-y-3" x-ref="messages"
                 style="scrollbar-width: thin; scrollbar-color: rgba(212,175,55,0.2) transparent;">

                <template x-if="messages.length === 0">
                    <div class="flex flex-col items-center justify-center h-full text-center pb-4">
                        <p class="text-gold/30 text-3xl mb-3">◆</p>
                        <p class="text-gray-500 text-xs leading-relaxed">สวัสดีครับ ยินดีให้บริการ<br>ถามเกี่ยวกับสินค้าและราคาได้เลย</p>
                    </div>
                </template>

                <template x-for="(msg, i) in messages" :key="i">
                    <div :class="msg.role === 'user' ? 'flex justify-end' : 'flex justify-start'">
                        <div class="max-w-[82%] px-3 py-2 text-xs leading-relaxed"
                             :style="msg.role === 'user'
                                ? 'background:rgba(212,175,55,0.08); border:1px solid rgba(212,175,55,0.18); border-radius:12px 4px 12px 12px; color:#e8e8e8;'
                                : 'background:rgba(255,255,255,0.04); border:1px solid rgba(255,255,255,0.08); border-radius:4px 12px 12px 12px; color:#b0b0b0;'">
                            <span x-html="formatMessage(msg.content)"></span>
                        </div>
                    </div>
                </template>

                <template x-if="loading">
                    <div class="flex justify-start">
                        <div class="px-4 py-3" style="background:rgba(255,255,255,0.04); border:1px solid rgba(255,255,255,0.08); border-radius:4px 12px 12px 12px;">
                            <div class="flex gap-1.5 items-center">
                                <span class="w-1.5 h-1.5 rounded-full bg-gold/50 animate-bounce" style="animation-delay:0ms"></span>
                                <span class="w-1.5 h-1.5 rounded-full bg-gold/50 animate-bounce" style="animation-delay:150ms"></span>
                                <span class="w-1.5 h-1.5 rounded-full bg-gold/50 animate-bounce" style="animation-delay:300ms"></span>
                            </div>
                        </div>
                    </div>
                </template>
            </div>

            <!-- Input -->
            <div class="px-4 py-3" style="border-top: 1px solid rgba(255,255,255,0.05);">
                <div class="flex gap-2">
                    <input type="text" x-model="input"
                           @keydown.enter.prevent="send()"
                           :disabled="loading"
                           placeholder="ถามเกี่ยวกับสินค้า..."
                           class="flex-1 text-xs px-3 py-2 text-white placeholder-gray-600 focus:outline-none transition-colors disabled:opacity-50"
                           style="background:rgba(255,255,255,0.04); border:1px solid rgba(255,255,255,0.1);">
                    <button @click="send()" :disabled="loading || !input.trim()"
                            class="w-9 h-9 flex items-center justify-center text-gold transition-colors disabled:opacity-30"
                            style="background:rgba(212,175,55,0.08); border:1px solid rgba(212,175,55,0.25);"
                            @mouseenter="$el.style.background='rgba(212,175,55,0.18)'"
                            @mouseleave="$el.style.background='rgba(212,175,55,0.08)'">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
    function chatWidget() {
        return {
            open: false,
            input: '',
            loading: false,
            messages: [],

            init() {
                try {
                    const saved = sessionStorage.getItem('luxe_chat');
                    if (saved) this.messages = JSON.parse(saved);
                } catch(e) {}
            },

            async send() {
                const text = this.input.trim();
                if (!text || this.loading) return;

                this.messages.push({ role: 'user', content: text });
                this.input = '';
                this.loading = true;
                this.scrollToBottom();

                try {
                    const res = await fetch('/chat', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        },
                        body: JSON.stringify({ messages: this.messages.slice(-10) }),
                    });
                    const data = await res.json();
                    if (data.reply) {
                        this.messages.push({ role: 'assistant', content: data.reply });
                    } else {
                        this.messages.push({ role: 'assistant', content: '⚠️ ' + (data.error || 'เกิดข้อผิดพลาด') });
                    }
                } catch(e) {
                    this.messages.push({ role: 'assistant', content: '⚠️ ไม่สามารถเชื่อมต่อได้ กรุณาลองใหม่' });
                } finally {
                    this.loading = false;
                    this.$nextTick(() => this.scrollToBottom());
                    try {
                        sessionStorage.setItem('luxe_chat', JSON.stringify(this.messages.slice(-20)));
                    } catch(e) {}
                }
            },

            clearChat() {
                this.messages = [];
                try { sessionStorage.removeItem('luxe_chat'); } catch(e) {}
            },

            scrollToBottom() {
                this.$nextTick(() => {
                    const el = this.$refs.messages;
                    if (el) el.scrollTop = el.scrollHeight;
                });
            },

            formatMessage(text) {
                return text
                    .replace(/&/g, '&amp;')
                    .replace(/</g, '&lt;')
                    .replace(/>/g, '&gt;')
                    .replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>')
                    .replace(/\n/g, '<br>');
            }
        };
    }
    </script>

    <script>
        // Intersection Observer for reveal animations
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry, i) => {
                if (entry.isIntersecting) {
                    setTimeout(() => {
                        entry.target.classList.add('visible');
                    }, i * 80);
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

        // Animated counters
        function animateCounter(el) {
            const target = +el.dataset.target;
            const duration = 2000;
            const step = target / (duration / 16);
            let current = 0;
            const timer = setInterval(() => {
                current += step;
                if (current >= target) {
                    el.textContent = el.dataset.suffix
                        ? target + el.dataset.suffix
                        : target;
                    clearInterval(timer);
                } else {
                    el.textContent = el.dataset.suffix
                        ? Math.floor(current) + el.dataset.suffix
                        : Math.floor(current);
                }
            }, 16);
        }

        const counterObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounter(entry.target);
                    counterObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });

        document.querySelectorAll('[data-target]').forEach(el => counterObserver.observe(el));
    </script>
    @stack('scripts')
</body>
</html>
