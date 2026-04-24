@extends('layouts.app')

@section('content')

<!-- ═══════════════════════════ HERO ═══════════════════════════ -->
<style>
@keyframes bottleBob {
    0%, 100% { transform: translateY(0px);   }
    50%       { transform: translateY(-20px); }
}
.bottle-floater         { will-change: transform; }
.bottle-floater-inner   { animation: bottleBob 6s ease-in-out infinite; }
</style>

<section class="relative min-h-screen flex items-center justify-center overflow-hidden">

    <!-- Background -->
    <div class="absolute inset-0 bg-[#080808]"></div>
    <div class="absolute inset-0" style="background: radial-gradient(ellipse 70% 70% at 50% 50%, rgba(212,175,55,0.05) 0%, transparent 65%);"></div>

    <!-- Grid pattern -->
    <div class="absolute inset-0 opacity-[0.015]" style="background-image: linear-gradient(rgba(255,255,255,0.5) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.5) 1px, transparent 1px); background-size: 60px 60px;"></div>

    <!-- ── Scattered Bottles ── -->
    @php
    $heroSlots = [
        ['top'=>'3%',  'left'=>'2%',  'rot'=>-18, 'w'=>92,  'op'=>0.22, 'delay'=>0.0, 'depth'=>0.25],
        ['top'=>'7%',  'left'=>'19%', 'rot'=> 10, 'w'=>112, 'op'=>0.28, 'delay'=>1.4, 'depth'=>0.45],
        ['top'=>'1%',  'left'=>'42%', 'rot'=> -5, 'w'=>86,  'op'=>0.18, 'delay'=>2.8, 'depth'=>0.20],
        ['top'=>'5%',  'left'=>'64%', 'rot'=> 14, 'w'=>100, 'op'=>0.25, 'delay'=>0.7, 'depth'=>0.38],
        ['top'=>'2%',  'left'=>'82%', 'rot'=>-22, 'w'=>88,  'op'=>0.20, 'delay'=>2.1, 'depth'=>0.28],
        ['top'=>'32%', 'left'=>'-1%', 'rot'=> 20, 'w'=>124, 'op'=>0.30, 'delay'=>1.0, 'depth'=>0.55],
        ['top'=>'28%', 'left'=>'90%', 'rot'=> -9, 'w'=>108, 'op'=>0.26, 'delay'=>2.5, 'depth'=>0.42],
        ['top'=>'60%', 'left'=>'1%',  'rot'=>-14, 'w'=>96,  'op'=>0.22, 'delay'=>0.4, 'depth'=>0.32],
        ['top'=>'63%', 'left'=>'18%', 'rot'=> 18, 'w'=>88,  'op'=>0.20, 'delay'=>3.3, 'depth'=>0.24],
        ['top'=>'65%', 'left'=>'77%', 'rot'=>-11, 'w'=>104, 'op'=>0.26, 'delay'=>1.7, 'depth'=>0.40],
        ['top'=>'70%', 'left'=>'87%', 'rot'=> 13, 'w'=>92,  'op'=>0.22, 'delay'=>2.4, 'depth'=>0.30],
        ['top'=>'78%', 'left'=>'44%', 'rot'=> -7, 'w'=>118, 'op'=>0.28, 'delay'=>0.2, 'depth'=>0.48],
        ['top'=>'82%', 'left'=>'4%',  'rot'=> 25, 'w'=>82,  'op'=>0.18, 'delay'=>1.6, 'depth'=>0.22],
        ['top'=>'80%', 'left'=>'69%', 'rot'=>-19, 'w'=>94,  'op'=>0.22, 'delay'=>3.0, 'depth'=>0.28],
    ];
    $pArr   = $products->values()->all();
    $pTotal = count($pArr);
    @endphp

    @if ($pTotal > 0)
    <div class="absolute inset-0 pointer-events-none overflow-hidden" id="bottleField">
        @foreach ($heroSlots as $i => $s)
        @php $p = $pArr[$i % $pTotal]; @endphp
        @if (!empty($p->image_path))
        <div class="bottle-floater absolute"
             data-depth="{{ $s['depth'] }}"
             style="top:{{ $s['top'] }}; left:{{ $s['left'] }};">
            <div class="bottle-floater-inner" style="animation-delay:-{{ $s['delay'] }}s;">
                <img src="{{ $p->image_path }}" alt="" loading="lazy"
                     class="pointer-events-none select-none block"
                     style="width:{{ $s['w'] }}px; transform:rotate({{ $s['rot'] }}deg); opacity:{{ $s['op'] }};
                            filter:drop-shadow(0 10px 30px rgba(212,175,55,0.12));">
            </div>
        </div>
        @endif
        @endforeach
    </div>
    <!-- Vignette: fade bottles at edges & center -->
    <div class="absolute inset-0 pointer-events-none"
         style="background: radial-gradient(ellipse 58% 58% at 50% 50%, transparent 20%, rgba(8,8,8,0.55) 62%, rgba(8,8,8,0.96) 100%);"></div>
    @endif

    <!-- Hero content -->
    <div class="relative z-10 text-center px-6 max-w-5xl mx-auto">
        <div class="animate-fade-up delay-100 opacity-0 mb-6 flex items-center justify-center gap-4">
            <div class="h-px w-12 bg-gold/50"></div>
            <span class="text-gold text-[10px] uppercase tracking-[0.5em] font-semibold">Exquisite Craftsmanship Since 1997</span>
            <div class="h-px w-12 bg-gold/50"></div>
        </div>

        <h1 class="animate-fade-up delay-200 opacity-0 font-serif font-bold leading-[0.95] mb-8">
            <span class="block text-7xl md:text-9xl text-white">The Art of</span>
            <span class="block text-7xl md:text-9xl gradient-gold gold-glow italic">The Bottle</span>
        </h1>

        <p class="animate-fade-up delay-300 opacity-0 max-w-xl mx-auto text-gray-400 text-base mb-12 font-light leading-relaxed">
            Curated artisanal glass containers, crafted with precision and exported to the world's most discerning clients.
        </p>

        <div class="animate-fade-up delay-500 opacity-0 flex flex-wrap justify-center gap-4">
            <a href="#collection" class="btn-gold">
                View Collection
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
            <a href="/track" class="btn-ghost">
                Track Shipment
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/></svg>
            </a>
        </div>

        <!-- Scroll indicator -->
        <div class="animate-fade-in delay-700 opacity-0 absolute bottom-10 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2">
            <span class="text-[9px] uppercase tracking-[0.4em] text-gray-600">Scroll</span>
            <div class="w-px h-10 bg-gradient-to-b from-gold/50 to-transparent animate-pulse"></div>
        </div>
    </div>
</section>

<script>
(function () {
    const floaters = document.querySelectorAll('.bottle-floater');
    if (!floaters.length) return;
    let raf = null, mx = 0, my = 0;

    document.addEventListener('mousemove', function (e) {
        mx = e.clientX - window.innerWidth  / 2;
        my = e.clientY - window.innerHeight / 2;
        if (!raf) raf = requestAnimationFrame(applyParallax);
    }, { passive: true });

    function applyParallax() {
        floaters.forEach(function (el) {
            var d  = parseFloat(el.dataset.depth) || 0.3;
            var tx = (mx * d * 0.05).toFixed(2);
            var ty = (my * d * 0.035).toFixed(2);
            el.style.transform = 'translate(' + tx + 'px,' + ty + 'px)';
        });
        raf = null;
    }
})();
</script>

<!-- ═══════════════════════════ STATS ═══════════════════════════ -->
<section class="py-20 relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-b from-black via-[#0d0d0d] to-black"></div>
    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-0 divide-x divide-y md:divide-y-0 divide-white/5">
            <div class="reveal text-center px-8 py-10">
                <div class="font-serif text-5xl font-bold gradient-gold mb-3">
                    <span data-target="28" data-suffix="+">0+</span>
                </div>
                <div class="text-[10px] uppercase tracking-[0.3em] text-gray-500 font-medium">Years Experience</div>
            </div>
            <div class="reveal text-center px-8 py-10" style="transition-delay: 0.1s">
                <div class="font-serif text-5xl font-bold gradient-gold mb-3">
                    <span data-target="64" data-suffix="+">0+</span>
                </div>
                <div class="text-[10px] uppercase tracking-[0.3em] text-gray-500 font-medium">Countries Served</div>
            </div>
            <div class="reveal text-center px-8 py-10" style="transition-delay: 0.2s">
                <div class="font-serif text-5xl font-bold gradient-gold mb-3">
                    <span data-target="1200" data-suffix="+">0+</span>
                </div>
                <div class="text-[10px] uppercase tracking-[0.3em] text-gray-500 font-medium">Products Shipped</div>
            </div>
            <div class="reveal text-center px-8 py-10" style="transition-delay: 0.3s">
                <div class="font-serif text-5xl font-bold gradient-gold mb-3">
                    <span data-target="99" data-suffix="%">0%</span>
                </div>
                <div class="text-[10px] uppercase tracking-[0.3em] text-gray-500 font-medium">Client Satisfaction</div>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════════════════ COLLECTION — 3D SHOWCASE ═══════════════════════════ -->
<style>
/* ── Stage ── */
.showcase-outer {
    position: relative;
    overflow: hidden;
    padding: 20px 0 48px;
}
.showcase-wrapper {
    position: relative;
    height: 580px;
    perspective: 1400px;
    perspective-origin: 50% 40%;
}
.showcase-stage {
    width: 100%;
    height: 100%;
    position: relative;
}

/* ── Card ── */
.bottle-card {
    position: absolute;
    width: 265px;
    left: 50%;
    top: 50%;
    margin-left: -132px;
    margin-top: -228px;
    transition: transform 0.85s cubic-bezier(0.23, 1, 0.32, 1),
                opacity  0.85s cubic-bezier(0.23, 1, 0.32, 1);
    cursor: pointer;
    user-select: none;
    will-change: transform, opacity;
}
.bottle-card-inner {
    transition: transform 0.2s ease;
    background: rgba(255,255,255,0.025);
    border: 1px solid rgba(255,255,255,0.07);
    overflow: hidden;
    position: relative;
}
.bottle-card[data-active="true"] .bottle-card-inner {
    border-color: rgba(212,175,55,0.22);
    box-shadow:
        0 50px 120px rgba(0,0,0,0.95),
        0 0 70px rgba(212,175,55,0.07),
        inset 0 1px 0 rgba(212,175,55,0.12);
}

/* ── Image ── */
.bottle-card-image {
    position: relative;
    width: 100%;
    aspect-ratio: 3 / 4;
    overflow: hidden;
    background: linear-gradient(180deg, #0d0d0d 0%, #111 100%);
}
.bottle-card-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform 1.2s ease;
}
.bottle-card[data-active="true"] .bottle-card-image img {
    animation: bottleBreathe 5s ease-in-out infinite;
}
@keyframes bottleBreathe {
    0%, 100% { transform: scale(1)    translateY(0px);  }
    50%       { transform: scale(1.04) translateY(-7px); }
}

/* Pedestal glow */
.bottle-pedestal {
    position: absolute;
    bottom: -2px;
    left: 50%;
    transform: translateX(-50%);
    width: 72%;
    height: 32px;
    background: radial-gradient(ellipse at center, rgba(212,175,55,0.2) 0%, transparent 70%);
    filter: blur(14px);
    pointer-events: none;
    opacity: 0;
    transition: opacity 0.6s ease;
}
.bottle-card[data-active="true"] .bottle-pedestal { opacity: 1; }

/* Shine sweep */
.bottle-shine {
    position: absolute;
    inset: 0;
    background: linear-gradient(
        110deg,
        transparent 30%,
        rgba(255,255,255,0.04) 44%,
        rgba(255,255,255,0.13) 50%,
        rgba(255,255,255,0.04) 56%,
        transparent 70%
    );
    transform: translateX(-160%);
    pointer-events: none;
}
.bottle-card[data-active="true"] .bottle-shine {
    animation: shinePass 4.5s ease-in-out 0.3s infinite;
}
@keyframes shinePass {
    0%, 55% { transform: translateX(-160%); }
    100%     { transform: translateX(220%);  }
}

/* Hover specs overlay (only on active card) */
.bottle-specs-overlay {
    position: absolute;
    inset: 0;
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    padding: 20px;
    background: linear-gradient(to top, rgba(0,0,0,0.96) 0%, rgba(0,0,0,0.4) 60%, transparent 100%);
    opacity: 0;
    transition: opacity 0.4s ease;
    pointer-events: none;
}
.bottle-card[data-active="true"]:hover .bottle-specs-overlay { opacity: 1; }

/* Corner accents — active only */
.bottle-card[data-active="true"] .bottle-card-inner::before,
.bottle-card[data-active="true"] .bottle-card-inner::after {
    content: '';
    position: absolute;
    z-index: 3;
    pointer-events: none;
    width: 20px;
    height: 20px;
}
.bottle-card[data-active="true"] .bottle-card-inner::before {
    top: 0; left: 0;
    border-top: 1px solid rgba(212,175,55,0.55);
    border-left: 1px solid rgba(212,175,55,0.55);
}
.bottle-card[data-active="true"] .bottle-card-inner::after {
    bottom: 0; right: 0;
    border-bottom: 1px solid rgba(212,175,55,0.55);
    border-right: 1px solid rgba(212,175,55,0.55);
}

/* ── Card Info Bar ── */
.bottle-card-info {
    padding: 14px 18px 18px;
    background: linear-gradient(135deg, #0f0f0f, #111);
    position: relative;
}
.bottle-card-info::before {
    content: '';
    display: block;
    height: 1px;
    background: linear-gradient(to right, rgba(212,175,55,0.45), transparent);
    margin-bottom: 11px;
}
.bottle-card-name {
    font-family: 'Cormorant Garamond', serif;
    font-size: 1.05rem;
    font-weight: 700;
    color: #e0e0e0;
    margin-bottom: 3px;
    transition: color 0.35s ease;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.bottle-card[data-active="true"] .bottle-card-name { color: #d4af37; }
.bottle-card-price {
    font-family: 'Cormorant Garamond', serif;
    font-size: 0.82rem;
    font-weight: 600;
    background: linear-gradient(135deg, #e8cb5a, #d4af37, #aa8a2e);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

/* ── Nav Buttons ── */
.showcase-nav-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 48px;
    height: 48px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(8,8,8,0.8);
    backdrop-filter: blur(14px);
    border: 1px solid rgba(212,175,55,0.25);
    color: #d4af37;
    cursor: pointer;
    z-index: 20;
    transition: all 0.3s ease;
}
.showcase-nav-btn:hover {
    background: rgba(212,175,55,0.1);
    border-color: #d4af37;
    box-shadow: 0 0 28px rgba(212,175,55,0.22);
}
.showcase-prev { left: 20px; }
.showcase-next { right: 20px; }

/* ── Dots ── */
.showcase-dots {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 8px;
    margin-top: 28px;
}
.showcase-dot {
    height: 2px;
    width: 18px;
    background: rgba(255,255,255,0.12);
    transition: all 0.4s ease;
    cursor: pointer;
}
.showcase-dot.active {
    width: 38px;
    background: #d4af37;
    box-shadow: 0 0 10px rgba(212,175,55,0.55);
}

/* ── Detail Panel ── */
.bottle-detail-slide { display: none; }
.bottle-detail-slide.active {
    display: block;
    animation: detailFade 0.55s ease forwards;
}
@keyframes detailFade {
    from { opacity: 0; transform: translateY(16px); }
    to   { opacity: 1; transform: translateY(0);    }
}

/* ── Gold Particles ── */
@keyframes particleRise {
    0%   { transform: translateY(0)    translateX(var(--dx, 0px)) scale(1); opacity: 0.9; }
    100% { transform: translateY(-80px) translateX(var(--dx, 0px)) scale(0); opacity: 0;   }
}
.showcase-particle {
    position: absolute;
    width: 2px;
    height: 2px;
    background: #d4af37;
    border-radius: 50%;
    pointer-events: none;
    animation: particleRise var(--dur, 1.4s) ease-out forwards;
    box-shadow: 0 0 5px rgba(212,175,55,0.9);
}

/* ── Responsive ── */
@media (max-width: 768px) {
    .showcase-wrapper { height: 420px; }
    .bottle-card { width: 200px; margin-left: -100px; margin-top: -174px; }
    .showcase-prev { left: 4px; }
    .showcase-next { right: 4px; }
}
</style>

<section id="collection" class="py-28 bg-[#0a0a0a]">
    <div class="max-w-7xl mx-auto px-6">
        <!-- Section header -->
        <div class="reveal text-center mb-20">
            <span class="text-[10px] uppercase tracking-[0.5em] text-gold/70 font-semibold block mb-4">Handpicked for Excellence</span>
            <h2 class="font-serif text-5xl md:text-6xl font-bold mb-6">
                Premium <span class="italic text-gold">Selection</span>
            </h2>
            <div class="divider-gold max-w-xs mx-auto">
                <span class="text-gold/50 text-xs">◆</span>
            </div>
            <p class="mt-6 text-gray-500 max-w-lg mx-auto text-sm leading-relaxed font-light">
                Each piece is a testament to master glassblowers' skill, designed to preserve and protect with elegance.
            </p>
        </div>
    </div>

    <!-- 3D Showcase -->
    <div class="showcase-outer">
        <div class="showcase-wrapper">
            <div class="showcase-stage" id="showcaseStage">
                @foreach($products as $i => $product)
                <div class="bottle-card" data-index="{{ $i }}">
                    <div class="bottle-card-inner">
                        <div class="bottle-card-image">
                            <img src="{{ $product->image_path }}"
                                 alt="{{ $product->name }}"
                                 loading="lazy">
                            <div class="bottle-pedestal"></div>
                            <div class="bottle-shine"></div>
                            <!-- Hover specs overlay -->
                            <div class="bottle-specs-overlay">
                                <p class="text-gold text-[8px] tracking-[0.4em] uppercase mb-2 font-semibold">Specifications</p>
                                @if($product->features)
                                    @foreach($product->features as $key => $value)
                                    <div class="flex justify-between text-[10px] text-gray-300 border-b border-white/10 py-1.5">
                                        <span class="text-gray-400">{{ $key }}</span>
                                        <span class="font-medium">{{ $value }}</span>
                                    </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="bottle-card-info">
                            <div class="bottle-card-name">{{ $product->name }}</div>
                            <div class="bottle-card-price">
                                @auth
                                    @if (auth()->user()->is_member)
                                        <span style="-webkit-text-fill-color:#6b7280;text-decoration:line-through;font-size:.75rem;">${{ number_format($product->price, 2) }}</span>
                                        <span class="ml-1">${{ number_format($product->price * 0.9, 2) }}</span>
                                    @else
                                        ${{ number_format($product->price, 2) }}
                                    @endif
                                @else
                                    ${{ number_format($product->price, 2) }}
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Prev / Next -->
            <button class="showcase-nav-btn showcase-prev" aria-label="Previous">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>
            <button class="showcase-nav-btn showcase-next" aria-label="Next">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </button>
        </div>

        <!-- Dot indicators -->
        <div class="showcase-dots">
            @foreach($products as $i => $product)
            <div class="showcase-dot {{ $i === 0 ? 'active' : '' }}" data-go="{{ $i }}"></div>
            @endforeach
        </div>
    </div>

    <!-- Detail panel below carousel -->
    <div class="max-w-4xl mx-auto px-6 mt-16">
        @foreach($products as $i => $product)
        <div class="bottle-detail-slide {{ $i === 0 ? 'active' : '' }}" data-detail="{{ $i }}">
            <div class="glass-card p-8 md:p-10 grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
                <!-- Left: Name, desc, price, CTA -->
                <div>
                    <div class="flex items-center gap-3 mb-4">
                        <div class="h-px w-8 bg-gold/40"></div>
                        <span class="text-[9px] uppercase tracking-[0.45em] text-gold/60 font-semibold">Signature Collection</span>
                    </div>
                    <h3 class="font-serif text-3xl font-bold mb-4 gradient-gold">{{ $product->name }}</h3>
                    <p class="text-gray-400 text-sm leading-relaxed font-light mb-7">{{ $product->description }}</p>
                    <div class="flex items-center gap-6 flex-wrap">
                        <div>
                            @auth
                                @if (auth()->user()->is_member)
                                    <span class="text-[9px] uppercase tracking-widest text-gray-600 block mb-1">ราคาปกติ</span>
                                    <span class="font-serif text-lg font-bold text-gray-500 line-through">${{ number_format($product->price, 2) }}</span>
                                    <span class="text-[9px] uppercase tracking-widest text-green-500/70 block mt-2 mb-1">ราคาสมาชิก (ลด 10%)</span>
                                    <span class="font-serif text-2xl font-bold text-gold">${{ number_format($product->price * 0.9, 2) }}</span>
                                @else
                                    <span class="text-[9px] uppercase tracking-widest text-gray-600 block mb-1">Starting at</span>
                                    <span class="font-serif text-2xl font-bold text-gold">${{ number_format($product->price, 2) }}</span>
                                    <a href="/register" class="block text-[9px] text-gold/60 hover:text-gold mt-1 transition-colors">สมัครสมาชิกรับส่วนลด 10% →</a>
                                @endif
                            @else
                                <span class="text-[9px] uppercase tracking-widest text-gray-600 block mb-1">Starting at</span>
                                <span class="font-serif text-2xl font-bold text-gold">${{ number_format($product->price, 2) }}</span>
                                <a href="/register" class="block text-[9px] text-gold/60 hover:text-gold mt-1 transition-colors">สมัครสมาชิกรับส่วนลด 10% →</a>
                            @endauth
                        </div>
                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn-gold text-[10px] px-8 py-4">
                                Add to Cart
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
                <!-- Right: Specs table -->
                <div>
                    @if($product->features)
                    <p class="text-[9px] uppercase tracking-[0.4em] text-gold/60 font-semibold mb-5">Specifications</p>
                    <div class="space-y-0">
                        @foreach($product->features as $key => $value)
                        <div class="flex justify-between items-center border-b border-white/5 py-3">
                            <span class="text-xs text-gray-500 font-light">{{ $key }}</span>
                            <span class="text-xs text-gray-200 font-medium">{{ $value }}</span>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>

<script>
(function () {
    const stage   = document.getElementById('showcaseStage');
    if (!stage) return;

    const cards   = [...document.querySelectorAll('.bottle-card')];
    const dots    = [...document.querySelectorAll('.showcase-dot')];
    const details = [...document.querySelectorAll('.bottle-detail-slide')];
    const total   = cards.length;

    let current  = 0;
    let autoTimer = null;
    let dragStartX = 0;

    // ── Card position table ──
    const POS = [
        { rY:  0, tX:    0, tZ:    0, sc: 1.00, op: 1.00, zi: 10 },
        { rY: 30, tX:  258, tZ: -170, sc: 0.77, op: 0.78, zi:  8 },
        { rY: 50, tX:  440, tZ: -310, sc: 0.57, op: 0.42, zi:  6 },
        { rY: 62, tX:  575, tZ: -410, sc: 0.42, op: 0.00, zi:  4 },
    ];

    function layout() {
        cards.forEach((card, i) => {
            let off = ((i - current) % total + total) % total;
            if (off > total / 2) off -= total;

            const a = Math.abs(off);
            const s = Math.sign(off) || 1;
            const p = POS[Math.min(a, POS.length - 1)];

            card.style.transform =
                `translateX(calc(-50% + ${p.tX * s}px)) ` +
                `translateY(-50%) ` +
                `translateZ(${p.tZ}px) ` +
                `rotateY(${p.rY * s}deg) ` +
                `scale(${p.sc})`;
            card.style.opacity = p.op;
            card.style.zIndex  = p.zi;
            card.dataset.active = (a === 0) ? 'true' : 'false';
            card.style.pointerEvents = (a <= 1) ? 'auto' : 'none';
        });

        dots.forEach((d, i) => d.classList.toggle('active', i === current));

        details.forEach((d, i) => {
            const isActive = i === current;
            if (isActive && !d.classList.contains('active')) {
                d.classList.remove('active');
                void d.offsetWidth; // reflow for re-animation
            }
            d.classList.toggle('active', isActive);
        });
    }

    function goTo(idx) {
        current = ((idx % total) + total) % total;
        layout();
        resetAuto();
        spawnParticles();
    }

    function next() { goTo(current + 1); }
    function prev() { goTo(current - 1); }

    function startAuto() { autoTimer = setInterval(next, 4200); }
    function resetAuto()  { clearInterval(autoTimer); startAuto(); }

    // ── Gold particles ──
    function spawnParticles() {
        const active = cards.find(c => c.dataset.active === 'true');
        if (!active) return;
        const container = active.querySelector('.bottle-card-image');
        if (!container) return;

        for (let i = 0; i < 12; i++) {
            const p = document.createElement('div');
            p.className = 'showcase-particle';
            const dur = (1.1 + Math.random() * 0.9).toFixed(2) + 's';
            const dx  = ((Math.random() - 0.5) * 60).toFixed(1) + 'px';
            p.style.cssText =
                `left:${12 + Math.random() * 76}%;` +
                `bottom:${4 + Math.random() * 28}%;` +
                `--dx:${dx};` +
                `--dur:${dur};` +
                `animation-delay:${(Math.random() * 0.55).toFixed(2)}s;`;
            container.appendChild(p);
            setTimeout(() => p.remove(), 2400);
        }
    }

    // ── Mouse tilt on active card ──
    cards.forEach(card => {
        const inner = card.querySelector('.bottle-card-inner');

        card.addEventListener('mousemove', e => {
            if (card.dataset.active !== 'true') return;
            const r = card.getBoundingClientRect();
            const x = ((e.clientX - r.left) / r.width  - 0.5) * 2;
            const y = ((e.clientY - r.top)  / r.height - 0.5) * 2;
            inner.style.transform = `rotateY(${x * 13}deg) rotateX(${-y * 8}deg)`;
        });

        card.addEventListener('mouseleave', () => {
            inner.style.transform = '';
        });

        card.addEventListener('click', () => {
            if (card.dataset.active !== 'true') goTo(parseInt(card.dataset.index));
        });
    });

    // ── Controls ──
    document.querySelector('.showcase-prev')?.addEventListener('click', prev);
    document.querySelector('.showcase-next')?.addEventListener('click', next);
    dots.forEach((d, i) => d.addEventListener('click', () => goTo(i)));

    // Keyboard
    document.addEventListener('keydown', e => {
        if (e.key === 'ArrowLeft')  prev();
        if (e.key === 'ArrowRight') next();
    });

    // Touch swipe
    stage.addEventListener('touchstart', e => { dragStartX = e.touches[0].clientX; }, { passive: true });
    stage.addEventListener('touchend',   e => {
        const dx = e.changedTouches[0].clientX - dragStartX;
        if (Math.abs(dx) > 40) dx > 0 ? prev() : next();
    }, { passive: true });

    // ── Init ──
    layout();
    startAuto();
})();
</script>

<!-- ═══════════════════════════ PROCESS ═══════════════════════════ -->
<section class="py-28 relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-[#0d0d0d] to-[#080808]"></div>
    <div class="absolute right-0 top-0 w-1/2 h-full opacity-[0.03]" style="background: radial-gradient(ellipse at right, rgba(212,175,55,1) 0%, transparent 70%);"></div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="reveal text-center mb-16">
            <span class="text-[10px] uppercase tracking-[0.5em] text-gold/70 font-semibold block mb-4">How We Work</span>
            <h2 class="font-serif text-4xl md:text-5xl font-bold">
                From Craft to <span class="italic text-gold">Destination</span>
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-0 relative">
            <!-- Connecting line desktop -->
            <div class="hidden md:block absolute top-14 left-[12.5%] right-[12.5%] h-px bg-gradient-to-r from-transparent via-gold/20 to-transparent"></div>

            @php
                $steps = [
                    ['num' => '01', 'title' => 'Design',     'desc' => 'Collaborate with our master craftsmen to define your vision.'],
                    ['num' => '02', 'title' => 'Craft',      'desc' => 'Each bottle is hand-blown and inspected for perfection.'],
                    ['num' => '03', 'title' => 'Package',    'desc' => 'Luxury packaging ensures safe transit to any destination.'],
                    ['num' => '04', 'title' => 'Deliver',    'desc' => 'Real-time tracking keeps you informed every step of the way.'],
                ];
            @endphp

            @foreach($steps as $i => $step)
            <div class="reveal text-center px-6 py-8" style="transition-delay: {{ $i * 0.15 }}s">
                <div class="w-28 h-28 mx-auto mb-6 relative animate-pulse-gold">
                    <div class="absolute inset-0 border border-gold/20 rotate-45 group-hover:rotate-0 transition-transform duration-500"></div>
                    <div class="absolute inset-3 border border-gold/10 rotate-45"></div>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <span class="font-serif text-4xl font-bold gradient-gold">{{ $step['num'] }}</span>
                    </div>
                </div>
                <h4 class="font-serif text-xl font-bold mb-3">{{ $step['title'] }}</h4>
                <p class="text-gray-500 text-xs leading-relaxed font-light">{{ $step['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ═══════════════════════════ WHY US ═══════════════════════════ -->
<section class="py-24 bg-[#0a0a0a] border-y border-white/5">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
            <!-- Left: Text -->
            <div class="reveal">
                <span class="text-[10px] uppercase tracking-[0.5em] text-gold/70 font-semibold block mb-4">Why Choose Us</span>
                <h2 class="font-serif text-4xl md:text-5xl font-bold mb-8 leading-tight">
                    Uncompromising<br>
                    <span class="italic text-gold">Quality & Trust</span>
                </h2>
                <div class="space-y-5">
                    @php
                        $features = [
                            ['icon' => '◆', 'title' => 'Global Export Network',    'desc' => 'Seamless logistics to over 64 countries with full compliance.'],
                            ['icon' => '◆', 'title' => 'Artisanal Glass Production','desc' => 'Every bottle is hand-crafted by certified master glassblowers.'],
                            ['icon' => '◆', 'title' => 'Real-Time Shipment Tracking','desc' => 'Monitor your order from factory floor to your front door.'],
                        ];
                    @endphp
                    @foreach($features as $f)
                    <div class="flex gap-4 group">
                        <span class="text-gold mt-1 text-xs shrink-0">{{ $f['icon'] }}</span>
                        <div>
                            <h5 class="font-semibold text-sm mb-1 group-hover:text-gold transition-colors duration-300">{{ $f['title'] }}</h5>
                            <p class="text-gray-500 text-xs leading-relaxed font-light">{{ $f['desc'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <!-- Right: Visual -->
            <div class="reveal relative flex items-center justify-center" style="transition-delay: 0.2s">
                <div class="relative w-72 h-72">
                    <div class="absolute inset-0 border border-gold/10 rounded-full animate-spin-slow"></div>
                    <div class="absolute inset-8 border border-gold/10 rounded-full animate-spin-slow" style="animation-direction: reverse;"></div>
                    <div class="absolute inset-16 border border-gold/20 rounded-full"></div>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="text-center animate-float">
                            <div class="font-serif text-6xl font-bold gradient-gold gold-glow">28</div>
                            <div class="text-[10px] uppercase tracking-[0.3em] text-gray-500 font-medium mt-2">Years of Excellence</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════════════════ CTA ═══════════════════════════ -->
<section class="py-28 relative overflow-hidden bg-[#080808]">
    <div class="absolute inset-0" style="background: radial-gradient(ellipse 70% 50% at 50% 50%, rgba(212,175,55,0.07) 0%, transparent 70%);"></div>

    <div class="max-w-3xl mx-auto px-6 text-center relative z-10">
        <div class="reveal">
            <span class="text-[10px] uppercase tracking-[0.5em] text-gold/70 font-semibold block mb-6">Ready to Order?</span>
            <h2 class="font-serif text-5xl md:text-6xl font-bold mb-6">
                Begin Your<br>
                <span class="italic text-gold">Bespoke Journey</span>
            </h2>
            <p class="text-gray-400 text-sm leading-relaxed font-light mb-10 max-w-md mx-auto">
                Whether you need one bottle or ten thousand, our team is ready to bring your vision to life with precision and elegance.
            </p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="#contact" class="btn-gold text-sm px-12 py-5">
                    Start a Conversation
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
                <a href="/track" class="btn-ghost text-sm px-12 py-5">Track Order</a>
            </div>
        </div>
    </div>
</section>

@endsection
