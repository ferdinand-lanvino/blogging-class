<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Biodata;

class BiodataController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        //Mengambil data user yang sedang login
        $user = Auth::user();
        //Jika biodata user belum ada, maka buat biodata baru
        if (!$user->biodata) {
            $user->biodata()->create();
        }
        return view('biodata.show', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('biodata.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone_number' => 'required|string|max:15',
            'date_of_birth' => 'required|date',

            'about_me' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'website' => 'required|string|max:255',
            'instagram' => 'required|string|max:100',
        ]);
        //Mengambil data user yang sedang login
        $user = Auth::user();

        //Update data user
        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone_number' => $validated['phone_number'],
            'date_of_birth' => $validated['date_of_birth'],
        ]);

        $user->biodata()->update([
            'about_me' => $validated['about_me'],
            'address' => $validated['address'],
            'website' => $validated['website'],
            'instagram' => $validated['instagram'],
        ]);

        return redirect()->route('biodata.show')->with('success', 'Biodata berhasil diupdate');
    }
}
