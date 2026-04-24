@extends('layouts.app')

@section('content')
<section class="min-h-screen flex items-center justify-center pt-24 pb-12">
    <div class="max-w-xl w-full px-6">
        <div class="text-center mb-12">
            <h3 class="text-gold font-serif text-xl italic mb-2">Global Logistics</h3>
            <h2 class="text-4xl font-serif font-bold tracking-wider mb-4">Track Your Shipment</h2>
            <p class="text-gray-500 font-light">Enter your unique tracking number to see the real-time status of your premium bottles.</p>
        </div>

        @if(session('error'))
            <div class="bg-red-900/20 border border-red-900/50 text-red-200 px-4 py-3 rounded mb-6 text-sm">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('track.search') }}" method="GET" class="glass p-8 rounded-lg">
            <div class="mb-6">
                <label for="tracking_number" class="block text-[10px] uppercase tracking-[0.2em] font-bold text-gold mb-3">Tracking Number</label>
                <input type="text" name="tracking_number" id="tracking_number" 
                    placeholder="EXP-2026-XXXX" 
                    class="w-full bg-black/50 border border-white/10 px-4 py-4 text-white focus:border-gold outline-none transition duration-300 tracking-widest uppercase"
                    required>
            </div>
            <button type="submit" class="w-full bg-gold text-black py-4 font-bold tracking-widest hover:bg-white transition duration-500 uppercase text-xs">
                Track Status
            </button>
        </form>

        <div class="mt-12 text-center text-xs text-gray-600 tracking-widest uppercase">
            Need help? Contact our <a href="#" class="text-gold border-b border-gold/30">concierge service</a>
        </div>
    </div>
</section>
@endsection
