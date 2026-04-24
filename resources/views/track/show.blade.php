@extends('layouts.app')

@section('content')
<section class="pt-32 pb-24 min-h-screen">
    <div class="max-w-4xl mx-auto px-6">
        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-12 border-b border-white/10 pb-8">
            <div>
                <h3 class="text-gold font-serif text-xl italic mb-2">Shipment Details</h3>
                <h2 class="text-4xl font-serif font-bold tracking-wider uppercase">{{ $shipment->tracking_number }}</h2>
            </div>
            <div class="mt-6 md:mt-0 text-right">
                <p class="text-gray-500 text-xs uppercase tracking-widest mb-1">Destination</p>
                <p class="text-white font-bold">{{ $shipment->destination }}</p>
            </div>
        </div>

        <!-- Current Status -->
        <div class="glass p-8 rounded-lg mb-12 flex items-center justify-between border-l-4 border-l-gold">
            <div>
                <p class="text-gold text-xs uppercase tracking-[0.2em] font-bold mb-2">Current Status</p>
                <h4 class="text-2xl font-serif font-bold">{{ $logs[0]->status ?? 'Processing' }}</h4>
            </div>
            <div class="text-right">
                <p class="text-gray-500 text-xs uppercase tracking-widest mb-1">Last Updated</p>
                <p class="text-white">{{ $logs[0]->date->format('M d, Y - H:i') }}</p>
            </div>
        </div>

        <!-- Timeline -->
        <div class="relative pl-8">
            <!-- Vertical Line -->
            <div class="absolute left-[11px] top-2 bottom-2 w-px bg-white/10"></div>

            @foreach($logs as $index => $log)
            <div class="relative mb-12 last:mb-0">
                <!-- Dot -->
                <div class="absolute left-[-21px] top-1.5 w-3 h-3 rounded-full {{ $index === 0 ? 'bg-gold shadow-[0_0_10px_rgba(212,175,55,0.8)]' : 'bg-gray-800' }}"></div>
                
                <div class="flex flex-col md:flex-row md:items-start">
                    <div class="md:w-48 mb-2 md:mb-0">
                        <p class="text-xs {{ $index === 0 ? 'text-gold' : 'text-gray-500' }} font-bold tracking-widest uppercase">
                            {{ $log->date->format('M d, Y') }}
                        </p>
                        <p class="text-[10px] text-gray-600 uppercase">{{ $log->date->format('H:i') }}</p>
                    </div>
                    <div class="flex-1">
                        <h5 class="text-lg font-serif font-bold {{ $index === 0 ? 'text-white' : 'text-gray-400' }} mb-1">
                            {{ $log->status }}
                        </h5>
                        <p class="text-gold text-[10px] uppercase tracking-widest mb-2">{{ $log->location }}</p>
                        <p class="text-gray-500 text-sm font-light leading-relaxed max-w-lg">
                            {{ $log->description }}
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-20 pt-12 border-t border-white/5 flex justify-center">
            <a href="/track" class="text-gray-500 text-xs uppercase tracking-widest hover:text-gold transition">← Back to Tracking</a>
        </div>
    </div>
</section>
@endsection
