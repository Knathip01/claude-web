<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin — Luxe Bottles</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root { --gold: #d4af37; --gold-light: #e8cb5a; --gold-dark: #aa8a2e; --black: #080808; }
        *, *::before, *::after { box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: #0a0a0a; color: #e8e8e8; min-height: 100vh; }
        h1,h2,h3,h4,.font-serif { font-family: 'Cormorant Garamond', serif; }
        .text-gold { color: var(--gold); }
        .bg-gold { background: var(--gold); }
        .border-gold { border-color: var(--gold); }
        .gradient-gold { background: linear-gradient(135deg, #e8cb5a, #d4af37, #aa8a2e); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
        .glass-card { background: rgba(255,255,255,0.03); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.07); }
        .btn-gold { display: inline-flex; align-items: center; gap: .5rem; background: linear-gradient(135deg, var(--gold-light), var(--gold-dark)); color: #000; padding: .7rem 1.5rem; font-weight: 700; font-size: .7rem; letter-spacing: .15em; text-transform: uppercase; transition: all .3s ease; }
        .btn-gold:hover { opacity: .88; }
        .btn-ghost { display: inline-flex; align-items: center; gap: .5rem; border: 1px solid rgba(255,255,255,.15); color: #ccc; padding: .7rem 1.5rem; font-size: .7rem; letter-spacing: .15em; text-transform: uppercase; transition: all .3s ease; }
        .btn-ghost:hover { border-color: var(--gold); color: var(--gold); }
        .btn-danger { display: inline-flex; align-items: center; gap: .5rem; border: 1px solid rgba(239,68,68,.3); color: #f87171; padding: .5rem 1rem; font-size: .7rem; letter-spacing: .1em; text-transform: uppercase; transition: all .3s ease; }
        .btn-danger:hover { border-color: #ef4444; background: rgba(239,68,68,.08); }
        input, textarea, select {
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.1);
            color: #e8e8e8;
            outline: none;
            transition: border-color .2s;
        }
        input:focus, textarea:focus, select:focus { border-color: rgba(212,175,55,0.5); }
        .sidebar-link { display: flex; align-items: center; gap: .75rem; padding: .65rem 1rem; font-size: .75rem; letter-spacing: .12em; text-transform: uppercase; color: #777; transition: all .25s ease; border-left: 2px solid transparent; }
        .sidebar-link:hover { color: var(--gold); border-left-color: rgba(212,175,55,.4); background: rgba(212,175,55,.04); }
        .sidebar-link.active { color: var(--gold); border-left-color: var(--gold); background: rgba(212,175,55,.06); }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body x-data="{ sidebarOpen: false }">

<div class="flex min-h-screen">

    <!-- Sidebar -->
    <aside class="hidden md:flex w-64 flex-col border-r border-white/5 bg-[#080808]">
        <!-- Brand -->
        <div class="p-6 border-b border-white/5">
            <a href="/" class="flex items-center gap-3 group">
                <div class="w-6 h-6 border border-gold/50 rotate-45 group-hover:rotate-0 group-hover:bg-gold/10 transition-all duration-400"></div>
                <span class="font-serif text-base tracking-[0.2em] font-bold">LUXE <span class="text-gold">ADMIN</span></span>
            </a>
        </div>

        <!-- Nav -->
        <nav class="flex-1 py-6 space-y-1 px-3">
            <p class="text-[9px] uppercase tracking-[0.4em] text-gray-600 font-semibold px-3 mb-3">จัดการสินค้า</p>
            <a href="{{ route('admin.products.index') }}"
               class="sidebar-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
                สินค้าทั้งหมด
            </a>
            <a href="{{ route('admin.products.create') }}"
               class="sidebar-link {{ request()->routeIs('admin.products.create') ? 'active' : '' }}">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v16m8-8H4"/>
                </svg>
                เพิ่มสินค้าใหม่
            </a>
        </nav>

        <!-- Footer -->
        <div class="p-4 border-t border-white/5">
            <div class="flex items-center gap-3 mb-4 px-1">
                <div class="w-8 h-8 border border-gold/30 flex items-center justify-center text-gold text-xs font-bold">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div>
                    <p class="text-xs text-white/80 font-medium leading-tight">{{ auth()->user()->name }}</p>
                    <p class="text-[10px] text-gold/60">Administrator</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-ghost w-full justify-center text-[10px] py-2">
                    ออกจากระบบ
                </button>
            </form>
        </div>
    </aside>

    <!-- Main -->
    <div class="flex-1 flex flex-col min-w-0">

        <!-- Top bar (mobile) -->
        <header class="md:hidden flex items-center justify-between px-5 py-4 border-b border-white/5 bg-[#080808]">
            <a href="/" class="font-serif text-sm tracking-[0.2em] font-bold">LUXE <span class="text-gold">ADMIN</span></a>
            <button @click="sidebarOpen = !sidebarOpen" class="p-2 text-gray-400 hover:text-gold transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </header>

        <!-- Mobile sidebar overlay -->
        <div x-show="sidebarOpen" x-cloak @click="sidebarOpen = false"
             class="md:hidden fixed inset-0 z-40 bg-black/70 backdrop-blur-sm"></div>

        <!-- Mobile sidebar panel -->
        <div x-show="sidebarOpen" x-cloak
             x-transition:enter="transition ease-out duration-250" x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
             x-transition:leave="transition ease-in duration-200" x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full"
             class="md:hidden fixed inset-y-0 left-0 z-50 w-64 flex flex-col border-r border-white/5 bg-[#080808]">
            <div class="p-6 border-b border-white/5 flex justify-between items-center">
                <span class="font-serif text-base tracking-[0.2em] font-bold">LUXE <span class="text-gold">ADMIN</span></span>
                <button @click="sidebarOpen = false" class="text-gray-400 hover:text-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <nav class="flex-1 py-6 space-y-1 px-3">
                <a href="{{ route('admin.products.index') }}" class="sidebar-link" @click="sidebarOpen = false">สินค้าทั้งหมด</a>
                <a href="{{ route('admin.products.create') }}" class="sidebar-link" @click="sidebarOpen = false">เพิ่มสินค้าใหม่</a>
            </nav>
            <div class="p-4 border-t border-white/5">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-ghost w-full justify-center text-[10px] py-2">ออกจากระบบ</button>
                </form>
            </div>
        </div>

        <!-- Page content -->
        <main class="flex-1 p-6 md:p-8 overflow-y-auto">
            @yield('admin-content')
        </main>
    </div>
</div>

</body>
</html>
