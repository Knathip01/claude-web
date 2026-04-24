@extends('layouts.app')

@section('content')
<section class="min-h-screen pt-32 pb-20 bg-[#080808] relative overflow-hidden">
    <!-- Background accents -->
    <div class="absolute inset-0" style="background: radial-gradient(ellipse 70% 70% at 50% 10%, rgba(212,175,55,0.05) 0%, transparent 60%);"></div>
    
    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="reveal mb-12">
            <h1 class="font-serif text-5xl font-bold text-white mb-4">Your <span class="italic text-gold">Cart</span></h1>
            <div class="h-px w-20 bg-gold/50"></div>
        </div>

        @if(session('success'))
            <div class="mb-8 p-4 bg-gold/10 border border-gold/20 text-gold text-sm reveal">
                {{ session('success') }}
            </div>
        @endif

        @if(count($cart) > 0)
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                <!-- Cart Items -->
                <div class="lg:col-span-2 space-y-6">
                    @foreach($cart as $id => $details)
                        <div class="glass-card p-6 flex items-center gap-6 reveal" data-id="{{ $id }}">
                            <div class="w-24 h-32 shrink-0 bg-[#0a0a0a] border border-white/5 overflow-hidden">
                                <img src="{{ $details['image'] }}" alt="{{ $details['name'] }}" class="w-full h-full object-cover opacity-80">
                            </div>
                            
                            <div class="flex-grow">
                                <div class="flex justify-between items-start mb-2">
                                    <h3 class="font-serif text-xl font-bold text-white">{{ $details['name'] }}</h3>
                                    <button class="text-gray-500 hover:text-red-500 transition-colors remove-from-cart">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </div>
                                <p class="text-gold font-serif text-lg mb-4">${{ number_format($details['price'], 2) }}</p>
                                
                                <div class="flex items-center gap-4">
                                    <div class="flex items-center border border-white/10 bg-black/40">
                                        <button class="px-3 py-1 text-gray-400 hover:text-gold transition-colors update-cart-dec" data-id="{{ $id }}">-</button>
                                        <input type="number" value="{{ $details['quantity'] }}" class="w-12 bg-transparent text-center text-sm text-white border-none focus:ring-0 cart-quantity" readonly>
                                        <button class="px-3 py-1 text-gray-400 hover:text-gold transition-colors update-cart-inc" data-id="{{ $id }}">+</button>
                                    </div>
                                    <span class="text-[10px] uppercase tracking-widest text-gray-600">Subtotal: ${{ number_format($details['price'] * $details['quantity'], 2) }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="pt-6">
                        <a href="/#collection" class="btn-ghost inline-flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                            Continue Shopping
                        </a>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="lg:col-span-1">
                    <div class="glass-card p-8 sticky top-32">
                        <h2 class="font-serif text-2xl font-bold text-white mb-8 border-b border-white/5 pb-4">Order Summary</h2>
                        
                        <div class="space-y-4 mb-8">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Subtotal</span>
                                <span class="text-white">${{ number_format($total, 2) }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Shipping</span>
                                <span class="text-green-500/70">Complimentary</span>
                            </div>
                            <div class="h-px bg-white/5 my-4"></div>
                            <div class="flex justify-between items-end">
                                <span class="text-[10px] uppercase tracking-[0.3em] text-gray-400 font-semibold mb-1">Total Amount</span>
                                <span class="font-serif text-3xl font-bold text-gold">${{ number_format($total, 2) }}</span>
                            </div>
                        </div>

                        <button class="w-full btn-gold py-4 text-sm tracking-[0.2em] uppercase font-bold">
                            Proceed to Checkout
                        </button>
                        
                        <div class="mt-6 flex items-center justify-center gap-4 opacity-30">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/5/5e/Visa_Inc._logo.svg" alt="Visa" class="h-3">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/2/2a/Mastercard-logo.svg" alt="Mastercard" class="h-5">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/b/b5/PayPal.svg" alt="PayPal" class="h-4">
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-20 glass-card reveal">
                <div class="mb-6 flex justify-center">
                    <div class="w-20 h-20 rounded-full border border-gold/20 flex items-center justify-center">
                        <svg class="w-8 h-8 text-gold/40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                    </div>
                </div>
                <h2 class="font-serif text-2xl text-white mb-4">Your cart is currently empty</h2>
                <p class="text-gray-500 text-sm mb-10 max-w-xs mx-auto">Explore our collection of artisanal glass bottles and find the perfect piece for your needs.</p>
                <a href="/#collection" class="btn-gold inline-block">Browse Collection</a>
            </div>
        @endif
    </div>
</section>

@push('scripts')
<script type="module">
    document.querySelectorAll('.update-cart-inc').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            const input = this.parentElement.querySelector('input');
            const qty = parseInt(input.value) + 1;
            updateCart(id, qty);
        });
    });

    document.querySelectorAll('.update-cart-dec').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            const input = this.parentElement.querySelector('input');
            const qty = parseInt(input.value) - 1;
            if (qty > 0) updateCart(id, qty);
        });
    });

    function updateCart(id, quantity) {
        fetch('{{ route("update.cart") }}', {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ id, quantity })
        }).then(() => window.location.reload());
    }

    document.querySelectorAll('.remove-from-cart').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.closest('[data-id]').dataset.id;
            if (confirm('Are you sure you want to remove this item?')) {
                fetch('{{ route("remove.from.cart") }}', {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ id })
                }).then(() => window.location.reload());
            }
        });
    });
</script>
@endpush
@endsection
