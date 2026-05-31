<?php

namespace App\Http\Controllers;

use App\Models\Participation;
use Illuminate\Http\Request;

class VoteVerificationController extends Controller
{
    public function create()
    {
        return view('votes.verify');
    }

    public function check(Request $request)
    {
        $validated = $request->validate([
            'verification_code' => ['required', 'string', 'max:255'],
        ]);

        $participation = Participation::with(['election', 'category'])
            ->where('verification_code', strtoupper($validated['verification_code']))
            ->first();

        if (! $participation) {
            return back()
                ->withInput()
                ->with('error', 'No se ha encontrado ningún voto registrado con ese código de verificación.');
        }

        return view('votes.verify-result', compact('participation'));
    }
}