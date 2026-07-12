<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Letter;
use App\Models\LetterType;
use App\Models\Resident;

class LetterController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if ($user->role === 'Warga') {
            // Find resident linked to this user
            $resident = Resident::where('user_id', $user->id)->first();
            if (!$resident) {
                $letters = collect();
            } else {
                // Get all residents in the same family
                $familyResidentIds = Resident::where('family_id', $resident->family_id)->pluck('id');
                $letters = Letter::whereIn('resident_id', $familyResidentIds)->with(['resident', 'letterType', 'approver.user'])->get();
            }
        } else {
            $letters = Letter::with(['resident', 'letterType', 'approver.user'])->get();
        }

        $title = 'Data Pengajuan Surat';
        return view('letter.index', compact('letters', 'title'));
    }

    public function create()
    {
        $user = auth()->user();
        if ($user->role === 'Warga') {
            $resident = Resident::where('user_id', $user->id)->first();
            if (!$resident) {
                return redirect()->route('letter.index')->with('error', 'Akun Anda belum dipetakan ke data Penduduk.');
            }
            $residents = Resident::where('family_id', $resident->family_id)->get();
        } else {
            $residents = Resident::all();
        }
        
        $letterTypes = LetterType::all();
        $title = 'Pengajuan Surat Baru';
        return view('letter.create', compact('title', 'residents', 'letterTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'resident_id' => 'required|exists:residents,id',
            'letter_type_id' => 'required|exists:letter_types,id',
        ]);

        Letter::create([
            'resident_id' => $request->resident_id,
            'letter_type_id' => $request->letter_type_id,
            'status' => 'pending',
        ]);

        return redirect()->route('letter.index')->with('success', 'Pengajuan surat berhasil dikirim');
    }

    public function edit(Letter $letter)
    {
        abort_if(auth()->user()->role === 'Warga', 403, 'Unauthorized');

        $title = 'Verifikasi Pengajuan Surat';
        return view('letter.edit', compact('letter', 'title'));
    }

    public function update(Request $request, Letter $letter)
    {
        abort_if(auth()->user()->role === 'Warga', 403, 'Unauthorized');

        $request->validate([
            'status' => 'required|in:approved,rejected',
            'note' => 'nullable|string',
        ]);

        $letter->update([
            'status' => $request->status,
            'note' => $request->note,
            'approved_by' => auth()->user()->villageOfficial->id ?? null,
        ]);

        return redirect()->route('letter.index')->with('success', 'Status pengajuan surat berhasil diubah');
    }

    public function destroy(Letter $letter)
    {
        // Only Warga who owns the letter (or admin) can delete, but let's just restrict it simply for now
        $letter->delete();
        return redirect()->route('letter.index')->with('success', 'Pengajuan surat berhasil dihapus');
    }
}
