<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Models\PersonaKnowledge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $personas = Auth::user()->personas;
        return view("personas.index", compact("personas"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->personas()->count() >= 1) {
            return redirect()->route('personas.index')->with('error', 'Anda hanya dapat memiliki 1 persona untuk saat ini.');
        }
        return view("personas.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Auth::user()->personas()->count() >= 1) {
            return redirect()->route('personas.index')->with('error', 'Anda hanya dapat memiliki 1 persona untuk saat ini.');
        }

        $request->validate([
            "persona_name" => "required|string|max:255",
            "persona_description" => "nullable|string",
            "role_summary" => "nullable|string",
            "default_language" => "required|string|max:10",
            // Settings validation
            "verbosity" => "nullable|in:short,normal,long",
            "tone_style" => "nullable|string",
            "audience_default" => "nullable|string",
            "guardrails" => "nullable|string",
        ]);

        $persona = Auth::user()->personas()->create($request->only([
            "persona_name", 
            "persona_description", 
            "role_summary", 
            "default_language"
        ]));

        // Create settings
        $settingsData = [
            "verbosity" => $request->verbosity ?? "normal",
        ];

        if ($request->filled("tone_style")) {
            $settingsData["tone_style"] = $this->processCommaSeparated($request->tone_style);
        }
        if ($request->filled("audience_default")) {
            $settingsData["audience_default"] = $this->processCommaSeparated($request->audience_default);
        }
        if ($request->filled("guardrails")) {
            $settingsData["guardrails"] = $this->processNewlineSeparated($request->guardrails);
        }

        $persona->settings()->create($settingsData);

        return redirect()->route("personas.index")->with("success", "Persona berhasil dibuat.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Persona $persona)
    {
        $this->authorizeUser($persona);
        $persona->load(["settings"]);
        $knowledge = $persona->knowledge()->latest()->paginate(5);
        return view("personas.show", compact("persona", "knowledge"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Persona $persona)
    {
        $this->authorizeUser($persona);
        $persona->load(["settings"]);
        return view("personas.edit", compact("persona"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Persona $persona)
    {
        $this->authorizeUser($persona);

        $request->validate([
            "persona_name" => "required|string|max:255",
            "persona_description" => "nullable|string",
            "role_summary" => "nullable|string",
            "default_language" => "required|string|max:10",
            // Settings validation
            "verbosity" => "nullable|in:short,normal,long",
            "tone_style" => "nullable|string",
            "audience_default" => "nullable|string",
            "guardrails" => "nullable|string",
        ]);

        $persona->update($request->only([
            "persona_name", 
            "persona_description", 
            "role_summary", 
            "default_language"
        ]));

        // Update Settings
        $settingsData = [
            "verbosity" => $request->verbosity ?? "normal",
        ];

        if ($request->has("tone_style")) {
            $settingsData["tone_style"] = $this->processCommaSeparated($request->tone_style);
        }
        if ($request->has("audience_default")) {
            $settingsData["audience_default"] = $this->processCommaSeparated($request->audience_default);
        }
        if ($request->has("guardrails")) {
            $settingsData["guardrails"] = $this->processNewlineSeparated($request->guardrails);
        }

        if ($persona->settings) {
            $persona->settings->update($settingsData);
        } else {
             $persona->settings()->create($settingsData);
        }

        return redirect()->route("personas.index")->with("success", "Persona berhasil diperbarui.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Persona $persona)
    {
        $this->authorizeUser($persona);
        $persona->delete();
        return redirect()->route("personas.index")->with("success", "Persona berhasil dihapus.");
    }

    /**
     * Store Knowledge for a persona.
     */
    public function storeKnowledge(Request $request, Persona $persona)
    {
        $this->authorizeUser($persona);

        $request->validate([
            "type" => "required|in:bio,experience,opinion,faq,story,content",
            "content" => "required|string",
            "source" => "nullable|string",
        ]);

        $persona->knowledge()->create($request->all());

        return redirect()->route("personas.show", $persona)->with("success", "Knowledge berhasil ditambahkan.");
    }

    public function destroyKnowledge(Persona $persona, PersonaKnowledge $knowledge)
    {
        $this->authorizeUser($persona);
        // Ensure knowledge belongs to persona
        if($knowledge->persona_id !== $persona->id) {
            abort(403);
        }
        
        $knowledge->delete();
        
        return back()->with("success", "Knowledge berhasil dihapus.");
    }

    private function processCommaSeparated(?string $input): ?array
    {
        if (!$input) return null;
        return array_values(array_filter(array_map("trim", explode(",", $input))));
    }

    private function processNewlineSeparated(?string $input): ?array
    {
        if (!$input) return null;
        return array_values(array_filter(array_map("trim", explode("\n", $input))));
    }

    private function authorizeUser(Persona $persona)
    {
        if ($persona->user_id !== Auth::id()) {
            abort(403, "Tindakan tidak diizinkan.");
        }
    }
}
