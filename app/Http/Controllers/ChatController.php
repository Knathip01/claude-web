<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatController extends Controller
{
    public function chat(Request $request)
    {
        $request->validate([
            'messages'           => ['required', 'array', 'max:20'],
            'messages.*.role'    => ['required', 'in:user,assistant'],
            'messages.*.content' => ['required', 'string', 'max:2000'],
        ]);

        $apiKey = config('services.groq.key');
        if (!$apiKey) {
            return response()->json(['error' => 'AI service not configured'], 503);
        }

        $products = Product::all(['name', 'description', 'price', 'features']);

        $productList = $products->map(function ($p) {
            $price       = '$' . number_format($p->price, 2);
            $memberPrice = '$' . number_format($p->price * 0.9, 2);
            $line = "- **{$p->name}**: {$price} (member price: {$memberPrice})";
            if ($p->description) {
                $line .= "\n  {$p->description}";
            }
            if ($p->features) {
                foreach ($p->features as $k => $v) {
                    $line .= "\n  {$k}: {$v}";
                }
            }
            return $line;
        })->implode("\n\n");

        $systemPrompt = "You are a helpful luxury sales assistant for Luxe Bottles Export Co., a premium artisanal glass bottle company. "
            . "Answer customer questions about our products, pricing, and services in a warm, professional, and concise manner. Keep responses brief and elegant.\n\n"
            . "Current product catalogue:\n\n{$productList}\n\n"
            . "Key information:\n"
            . "- Members receive a 10% discount on all products (register at /register)\n"
            . "- We offer global export and custom orders\n"
            . "- For complex inquiries, invite customers to contact us\n\n"
            . "Reply in the same language the customer uses (Thai or English).";

        $messages = array_merge(
            [['role' => 'system', 'content' => $systemPrompt]],
            $request->messages
        );

        $response = Http::timeout(30)
            ->withHeaders([
                'Authorization' => "Bearer {$apiKey}",
                'Content-Type'  => 'application/json',
            ])
            ->post('https://api.groq.com/openai/v1/chat/completions', [
                'model'      => 'llama-3.3-70b-versatile',
                'messages'   => $messages,
                'max_tokens' => 512,
            ]);

        if (!$response->successful()) {
            $detail = $response->json('error.message', 'AI service error');
            return response()->json(['error' => $detail], 502);
        }

        $text = $response->json('choices.0.message.content', '');

        return response()->json(['reply' => $text]);
    }
}
