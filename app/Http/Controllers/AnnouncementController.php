<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Announcement;
use App\Models\VillageOfficial;

class AnnouncementController extends Controller
{
    public function index()
    {
        // Warga and Admin can view index.
        $announcements = Announcement::with('author.user')->latest('published_at')->get();
        $title = 'Pengumuman Desa';
        return view('announcement.index', compact('announcements', 'title'));
    }

    public function create()
    {
        abort_if(auth()->user()->role === 'Warga', 403, 'Unauthorized');

        $title = 'Tambah Pengumuman';
        return view('announcement.create', compact('title'));
    }

    public function store(Request $request)
    {
        abort_if(auth()->user()->role === 'Warga', 403, 'Unauthorized');

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'published_at' => 'required|date',
        ], [
            'title.required' => 'Judul pengumuman wajib diisi',
            'title.max' => 'Judul pengumuman maksimal 255 karakter',
            'content.required' => 'Isi pengumuman wajib diisi',
            'published_at.required' => 'Tanggal publikasi wajib diisi',
            'published_at.date' => 'Format tanggal tidak valid',
        ]);

        $villageOfficial = VillageOfficial::where('user_id', auth()->id())->first();
        if (!$villageOfficial) {
            return redirect()->back()->withErrors(['msg' => 'Anda tidak memiliki profil perangkat desa.']);
        }

        Announcement::create([
            'author_id' => $villageOfficial->id,
            'title' => $request->title,
            'content' => $request->content,
            'published_at' => $request->published_at,
        ]);

        return redirect()->route('announcement.index')->with('success', 'Pengumuman berhasil ditambahkan');
    }

    public function edit(Announcement $announcement)
    {
        abort_if(auth()->user()->role === 'Warga', 403, 'Unauthorized');

        $title = 'Edit Pengumuman';
        return view('announcement.edit', compact('announcement', 'title'));
    }

    public function update(Request $request, Announcement $announcement)
    {
        abort_if(auth()->user()->role === 'Warga', 403, 'Unauthorized');

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'published_at' => 'required|date',
        ], [
            'title.required' => 'Judul pengumuman wajib diisi',
            'title.max' => 'Judul pengumuman maksimal 255 karakter',
            'content.required' => 'Isi pengumuman wajib diisi',
            'published_at.required' => 'Tanggal publikasi wajib diisi',
            'published_at.date' => 'Format tanggal tidak valid',
        ]);

        $announcement->update([
            'title' => $request->title,
            'content' => $request->content,
            'published_at' => $request->published_at,
        ]);

        return redirect()->route('announcement.index')->with('success', 'Pengumuman berhasil diubah');
    }

    public function destroy(Announcement $announcement)
    {
        abort_if(auth()->user()->role === 'Warga', 403, 'Unauthorized');

        $announcement->delete();

        return redirect()->route('announcement.index')->with('success', 'Pengumuman berhasil dihapus');
    }
}
