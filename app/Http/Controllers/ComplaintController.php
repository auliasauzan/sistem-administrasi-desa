<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Complaint;
use App\Models\Resident;
use Illuminate\Support\Facades\Storage;

class ComplaintController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if ($user->role === 'Warga') {
            $resident = Resident::where('user_id', $user->id)->first();
            $complaints = $resident ? Complaint::where('resident_id', $resident->id)->with('handler.user')->latest()->get() : collect();
        } else {
            $complaints = Complaint::with(['resident', 'handler.user'])->latest()->get();
        }

        $title = 'Data Pengaduan';
        return view('complaint.index', compact('complaints', 'title'));
    }

    public function create()
    {
        $user = auth()->user();
        abort_if($user->role !== 'Warga', 403, 'Hanya Warga yang dapat membuat pengaduan');
        
        $resident = Resident::where('user_id', $user->id)->first();
        if (!$resident) {
            return redirect()->route('complaint.index')->with('error', 'Akun Anda belum dipetakan ke data Penduduk.');
        }

        $title = 'Buat Pengaduan Baru';
        return view('complaint.create', compact('title'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        abort_if($user->role !== 'Warga', 403, 'Unauthorized');

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'photo_url' => 'nullable|url', // Using URL for photo simulation
        ]);

        $resident = Resident::where('user_id', $user->id)->firstOrFail();

        Complaint::create([
            'resident_id' => $resident->id,
            'title' => $request->title,
            'description' => $request->description,
            'photo_url' => $request->photo_url,
            'status' => 'open',
        ]);

        return redirect()->route('complaint.index')->with('success', 'Pengaduan berhasil dikirim');
    }

    public function edit(Complaint $complaint)
    {
        abort_if(auth()->user()->role === 'Warga', 403, 'Unauthorized');

        $title = 'Tindak Lanjut Pengaduan';
        return view('complaint.edit', compact('complaint', 'title'));
    }

    public function update(Request $request, Complaint $complaint)
    {
        abort_if(auth()->user()->role === 'Warga', 403, 'Unauthorized');

        $request->validate([
            'status' => 'required|in:open,in_progress,resolved',
        ]);

        $complaint->update([
            'status' => $request->status,
            'handled_by' => auth()->user()->villageOfficial->id ?? null,
        ]);

        return redirect()->route('complaint.index')->with('success', 'Status pengaduan berhasil diubah');
    }

    public function destroy(Complaint $complaint)
    {
        // Allowed for admin or the owner
        $user = auth()->user();
        if ($user->role === 'Warga') {
            $resident = Resident::where('user_id', $user->id)->first();
            abort_if(!$resident || $complaint->resident_id !== $resident->id, 403);
        }

        $complaint->delete();
        return redirect()->route('complaint.index')->with('success', 'Pengaduan berhasil dihapus');
    }
}
