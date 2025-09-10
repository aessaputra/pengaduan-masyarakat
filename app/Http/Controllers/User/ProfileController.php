<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $resident = Auth::user()->resident;

        $activeReportsCount = 0;
        $completedReportsCount = 0;

        if ($resident) {
            $reports = $resident->reports()->with('latestStatus')->get();

            $activeReportsCount = $reports->filter(function ($report) {
                return $report->latestStatus && !in_array($report->latestStatus->status, ['completed', 'rejected']);
            })->count();

            $completedReportsCount = $reports->filter(function ($report) {
                return $report->latestStatus && $report->latestStatus->status === 'completed';
            })->count();
        }

        return view('pages.app.profile', [
            'activeReportsCount' => $activeReportsCount,
            'completedReportsCount' => $completedReportsCount,
        ]);
    }

    public function edit()
    {
        return view('pages.app.profile.edit');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = Auth::user();
        $resident = $user->resident;

        $user->update([
            'name' => $request->name,
        ]);

        if ($request->hasFile('avatar')) {
            if ($resident->avatar && !Str::isUrl($resident->avatar)) {
                Storage::disk('public')->delete($resident->avatar);
            }

            $path = $request->file('avatar')->store('avatars', 'public');

            $resident->update([
                'avatar' => $path,
            ]);
        }

        return redirect()->route('profile')->with('success', 'Profil berhasil diperbarui!');
    }

    public function editPassword()
    {
        if (!Auth::user()->password) {
            return redirect()->route('profile');
        }
        return view('pages.app.profile.password-edit');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        Auth::user()->update([
            'password' => $request->password,
        ]);

        return redirect()->route('profile')->with('success', 'Kata sandi berhasil diperbarui!');
    }

    public function help()
    {
        return view('pages.app.profile.help');
    }
}
