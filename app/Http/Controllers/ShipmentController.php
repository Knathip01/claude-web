<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ShipmentController extends Controller
{
    public function index()
    {
        return view('track.index');
    }

    public function show(Request $request)
    {
        $trackingNumber = $request->input('tracking_number');
        $shipment = Shipment::where('tracking_number', $trackingNumber)->first();

        if (!$shipment) {
            return back()->with('error', 'Tracking number not found.');
        }

        $logs = $this->simulateLogs($shipment);

        return view('track.show', compact('shipment', 'logs'));
    }

    private function simulateLogs($shipment)
    {
        $startDate = $shipment->created_at;
        $now = Carbon::now();
        
        $stages = [
            ['days' => 0, 'status' => 'Order Received', 'location' => 'System', 'desc' => 'Your order has been placed and is awaiting processing.'],
            ['days' => 1, 'status' => 'Quality Inspection', 'location' => 'Warehouse A', 'desc' => 'Bottles are undergoing rigorous quality checks.'],
            ['days' => 3, 'status' => 'Documentation', 'location' => 'Export Office', 'desc' => 'Export licenses and customs documents prepared.'],
            ['days' => 5, 'status' => 'Shipped', 'location' => 'Bangkok Port', 'desc' => 'Shipment has departed the port of origin.'],
            ['days' => 8, 'status' => 'In Transit', 'location' => 'International Waters', 'desc' => 'Package is currently in transit to destination country.'],
            ['days' => 12, 'status' => 'Arrived', 'location' => $shipment->destination, 'desc' => 'Shipment arrived at destination hub.'],
            ['days' => 14, 'status' => 'Customs', 'location' => $shipment->destination, 'desc' => 'Processing through local customs.'],
            ['days' => 15, 'status' => 'Out for Delivery', 'location' => $shipment->destination, 'desc' => 'Entrusted to local courier for final delivery.'],
            ['days' => 16, 'status' => 'Delivered', 'location' => $shipment->destination, 'desc' => 'Package successfully delivered to recipient.'],
        ];

        $simulatedLogs = [];
        foreach ($stages as $stage) {
            $logDate = (clone $startDate)->addDays($stage['days']);
            
            if ($logDate->lte($now)) {
                $simulatedLogs[] = (object)[
                    'status' => $stage['status'],
                    'location' => $stage['location'],
                    'description' => $stage['desc'],
                    'date' => $logDate
                ];
            }
        }

        return array_reverse($simulatedLogs);
    }
}
