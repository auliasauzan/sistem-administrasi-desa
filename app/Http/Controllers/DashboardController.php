<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Get generic user counts
        $totalUsers = \App\Models\User::count();
        $adminDesaCount = \App\Models\User::where('role', 'Admin Desa')->count();
        $perangkatDesaCount = \App\Models\User::where('role', 'Perangkat Desa')->count();
        $wargaCount = \App\Models\User::where('role', 'Warga')->count();

        // New Card Metrics
        $totalPenduduk = \App\Models\Resident::count();
        $suratBulanIni = \App\Models\Letter::whereYear('created_at', now()->year)
                                           ->whereMonth('created_at', now()->month)
                                           ->count();
        $pengaduanAktif = \App\Models\Complaint::whereIn('status', ['Menunggu', 'Diproses'])->count();

        // Data for Chart 1: Jumlah Penduduk per RT (Bar chart)
        $residentsPerRt = DB::table('residents')
            ->join('families', 'residents.family_id', '=', 'families.id')
            ->select('families.neighborhood as rt', DB::raw('count(residents.id) as total'))
            ->groupBy('families.neighborhood')
            ->get();
        $chartRtLabels = $residentsPerRt->pluck('rt');
        $chartRtData = $residentsPerRt->pluck('total');

        // Data for Chart 2: Status Surat (Pie chart)
        // using enum: 'Menunggu', 'Diproses', 'Selesai', 'Ditolak'
        $lettersStatus = DB::table('letters')
            ->select('status', DB::raw('count(id) as total'))
            ->groupBy('status')
            ->get();
        $chartLetterLabels = $lettersStatus->pluck('status');
        $chartLetterData = $lettersStatus->pluck('total');

        // Data for Chart 3: Realisasi vs Anggaran per Kategori (Bar chart)
        $budgets = DB::table('budgets')
            ->select('category', DB::raw('SUM(amount) as total_anggaran'))
            ->groupBy('category')
            ->get();
        $chartBudgetLabels = $budgets->pluck('category');
        $chartBudgetAnggaran = $budgets->pluck('total_anggaran');
        // Mock Realisasi (e.g. 75% to 95% of Anggaran)
        $chartBudgetRealisasi = $budgets->map(function ($item) {
            $percentage = rand(75, 95) / 100;
            return $item->total_anggaran * $percentage;
        });

        // Data for Chart 4: Jumlah Pengaduan per status (Pie chart)
        $complaintsStatus = DB::table('complaints')
            ->select('status', DB::raw('count(id) as total'))
            ->groupBy('status')
            ->get();
        $chartComplaintLabels = $complaintsStatus->pluck('status');
        $chartComplaintData = $complaintsStatus->pluck('total');

        return view('dashboard.index', [
            'title' => 'Dashboard',
            'totalUsers' => $totalUsers,
            'adminDesaCount' => $adminDesaCount,
            'perangkatDesaCount' => $perangkatDesaCount,
            'wargaCount' => $wargaCount,
            
            // new variables
            'totalPenduduk' => $totalPenduduk,
            'suratBulanIni' => $suratBulanIni,
            'pengaduanAktif' => $pengaduanAktif,
            'chartRtLabels' => $chartRtLabels,
            'chartRtData' => $chartRtData,
            'chartLetterLabels' => $chartLetterLabels,
            'chartLetterData' => $chartLetterData,
            'chartBudgetLabels' => $chartBudgetLabels,
            'chartBudgetAnggaran' => $chartBudgetAnggaran,
            'chartBudgetRealisasi' => $chartBudgetRealisasi,
            'chartComplaintLabels' => $chartComplaintLabels,
            'chartComplaintData' => $chartComplaintData,
        ]);
    }

    public function show()
    {
        return view('dashboard.show', [
            'title' => 'My Profile',
            'user' => Auth::user()
        ]);
    }

    public function edit()
    {
        return view('dashboard.edit', [
            'title' => 'Edit Profile',
            'user' => Auth::user()
        ]);
    }

    public function update(Request $request)
    {
        try {
            DB::beginTransaction();

            $user = Auth::user();
            $validate = $request->validate([
                'name' => 'required',
                'password' => 'nullable|min:8',
                'passwordconfirm' => 'nullable|same:password',
                'email' => 'required|email|lowercase|unique:users,email,' . $user->id,
                'avatar' => 'nullable|image|mimes:png,jpg,jpeg,svg|max:512'
            ], [
                'name.required' => 'Nama wajib diisi',
                'password.min' => 'Password minimal 8 karakter',
                'passwordconfirm.same' => 'Konfirmasi password tidak cocok',
                'email.required' => 'Email wajib diisi',
                'email.email' => 'Format email tidak valid',
                'email.unique' => 'Email sudah terdaftar',
                'avatar.image' => 'File avatar harus berupa gambar',
                'avatar.mimes' => 'Format avatar harus png, jpg, jpeg, atau svg',
                'avatar.max' => 'Ukuran avatar tidak boleh lebih dari 512 KB',
            ]);

            if ($request->file('avatar')) {
                $validate['avatar'] = $request->file('avatar')->store('img', 'public');
                if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                    Storage::disk('public')->delete($user->avatar);
                }
            }

            if ($request->password) {
                $validate['password'] = bcrypt($request->password);
            } else {
                unset($validate['password']);
            }
            $user->update($validate);

            DB::commit();
            return to_route('dashboard.show')->withSuccess('Data berhasil diubah');
        } catch (\Exception $e) {
            DB::rollBack();
            return to_route('dashboard.edit')->withError('Gagal mengubah data: ' . $e->getMessage());
        }
    }
}
