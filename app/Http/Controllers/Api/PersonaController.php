<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Persona;
use App\Models\PersonaKnowledge;
use Illuminate\Http\Request;

class PersonaController extends Controller
{
    public function show($id)
    {
        $persona = Persona::with(['settings', 'knowledge', 'whatsappAccount'])->find($id);

        if (!$persona) {
            return response()->json([
                'success' => false,
                'message' => 'Persona tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $persona
        ]);
    }

    public function storeKnowledgeBatch(Request $request, $id)
    {
        $persona = Persona::find($id);

        if (!$persona) {
            return response()->json([
                'success' => false,
                'message' => 'Persona tidak ditemukan',
            ], 404);
        }

        $request->validate([
            '*.type' => 'required|in:bio,experience,opinion,faq,story,content',
            '*.content' => 'required|string',
            '*.source' => 'nullable|string',
            '*.is_active' => 'nullable|boolean',
        ]);

        $items = $request->all();
        $saved = [];

        foreach ($items as $item) {
            $saved[] = $persona->knowledge()->create([
                'type' => $item['type'],
                'content' => $item['content'],
                'source' => $item['source'] ?? null,
                'is_active' => $item['is_active'] ?? true,
            ]);
        }

        return response()->json([
            'success' => true,
            'saved_count' => count($saved),
        ]);
    }
}
