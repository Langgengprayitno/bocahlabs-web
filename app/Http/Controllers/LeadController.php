<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLeadRequest;
use App\Models\Lead;
use App\Models\MarketingCode;
use Illuminate\Http\JsonResponse;

class LeadController extends Controller
{
    /**
     * Menyimpan data konsultasi pengunjung (termasuk kode marketing) ke tabel leads.
     */
    public function store(StoreLeadRequest $request): JsonResponse
    {
        if ($request->filled('website')) {
            return response()->json([
                'saved' => false,
                'ignored' => true,
            ], 200);
        }

        $validated = $request->validated();

        $rawCode = isset($validated['promo_code']) ? strtoupper(trim($validated['promo_code'])) : '';
        $promoCode = $rawCode !== '' ? $rawCode : null;
        $marketingCode = $promoCode
            ? MarketingCode::active()->where('code', $promoCode)->first()
            : null;

        $lead = Lead::create([
            'brand_name' => $validated['brand_name'] ?? null,
            'package_id' => $validated['package_id'] ?? null,
            'marketing_code_id' => $marketingCode?->id,
            'promo_code' => $promoCode,
            'addon_ids' => $validated['addon_ids'] ?? [],
            'lang' => $validated['lang'],
            'message' => $validated['message'],
            'ip_address' => $request->ip(),
            'user_agent' => substr((string) $request->userAgent(), 0, 500),
            'status' => 'baru',
        ]);

        return response()->json([
            'saved' => true,
            'id' => $lead->id,
        ], 201);
    }
}