<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;  // <-- WAJIB INI
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        // Pencarian berdasarkan nama atau email
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        // Filter berdasarkan role
        if ($request->role) {
            $query->where('role', $request->role);
        }

        $users = $query->orderBy('name')->paginate(10);

        return view('pages.user.index', compact('users'));
    }
    public function create()
    {
        return view('pages.user.create');
    }
    // public function store(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required|max:100',
    //         'email' => 'required|email|unique:users|max:100',
    //         'password' => 'required|min:6|confirmed',
    //         'role' => 'required|in:admin,operator',
    //     ]);

    //     if ($validator->fails()) {
    //         return redirect()->back()
    //             ->withErrors($validator)
    //             ->withInput()
    //             ->with('error', 'Terjadi kesalahan validasi. Silakan periksa kembali data yang dimasukkan.');
    //     }

    //     try {
    //         User::create([
    //             'name' => $request->name,
    //             'email' => $request->email,
    //             'password' => $request->password, // Akan di-hash otomatis oleh mutator
    //             'role' => $request->role,
    //         ]);

    //         return redirect()->route('admin.user.index')
    //             ->with('success', 'User berhasil ditambahkan.');
    //     } catch (\Exception $e) {
    //         return redirect()->back()
    //             ->withInput()
    //             ->with('error', 'Terjadi kesalahan sistem: ' . $e->getMessage());
    //     }
    // }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'email' => 'required|email|unique:users|max:100',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|in:admin,operator',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $avatarName = null;

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $avatarName = time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/avatars', $avatarName);
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'avatar' => $avatarName, // ✅ BENAR
        ]);

        return redirect()->route('admin.user.index')
            ->with('success', 'User berhasil ditambahkan.');
    }


    public function show(User $user)
    {
        return view('pages.user.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('pages.user.edit', compact('user'));
    }

    // public function update(Request $request, User $user)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required|max:100',
    //         'email' => [
    //             'required',
    //             'email',
    //             'max:100',
    //             Rule::unique('users')->ignore($user->id),
    //         ],
    //         'password' => 'nullable|min:6|confirmed',
    //         'role' => 'required|in:admin,operator',
    //         'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
    //     ]);

    //     if ($validator->fails()) {
    //         return back()->withErrors($validator)->withInput();
    //     }

    //     // Data untuk update
    //     $data = [
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'role' => $request->role,
    //     ];

    //     // Update password jika diisi
    //     if ($request->filled('password')) {
    //         $data['password'] = $request->password;
    //     }

    //     // Hapus avatar jika dicentang
    //     if ($request->has('remove_avatar') && $user->avatar) {
    //         Storage::delete('public/avatars/' . $user->avatar);
    //         $data['avatar'] = null;
    //     }

    //     // Upload avatar baru
    //     if ($request->hasFile('avatar')) {
    //         // Hapus avatar lama jika ada
    //         if ($user->avatar) {
    //             Storage::delete('public/avatars/' . $user->avatar);
    //         }

    //         // Upload baru
    //         $avatarName = time() . '-' . uniqid() . '.' . $request->avatar->getClientOriginalExtension();
    //         $request->avatar->storeAs('public/avatars', $avatarName);
    //         $data['avatar'] = $avatarName;
    //     }

    //     // Update user
    //     $user->update($data);

    //     return redirect()->route('admin.user.index')->with('success', 'User berhasil diperbarui.');
    // }
    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'email' => [
                'required',
                'email',
                'max:100',
                Rule::unique('users')->ignore($user->id),
            ],
            'password' => 'nullable|min:6|confirmed',
            'role' => 'required|in:admin,operator',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Terjadi kesalahan validasi.');
        }

        try {
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
            ];

            // Update password jika diisi
            if ($request->filled('password')) {
                $data['password'] = $request->password;
            }

            // Hapus avatar jika dicentang
            if ($request->has('remove_avatar') && $user->avatar) {
                if (Storage::exists('public/avatars/' . $user->avatar)) {
                    Storage::delete('public/avatars/' . $user->avatar);
                }
                $data['avatar'] = null;
            }

            // Upload avatar baru
            if ($request->hasFile('avatar')) {
                // Hapus avatar lama jika ada
                if ($user->avatar && Storage::exists('public/avatars/' . $user->avatar)) {
                    Storage::delete('public/avatars/' . $user->avatar);
                }

                // Upload baru
                $file = $request->file('avatar');
                $avatarName = time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/avatars', $avatarName);
                $data['avatar'] = $avatarName;
            }

            // Update user
            $user->update($data);

            return redirect()->route('admin.user.index')
                ->with('success', 'User berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan sistem: ' . $e->getMessage());
        }
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.user.index')
                ->with('error', 'Tidak dapat menghapus akun sendiri.');
        }

        try {
            $user->delete();
            return redirect()->route('admin.user.index')
                ->with('success', 'User berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('admin.user.index')
                ->with('error', 'Terjadi kesalahan sistem: ' . $e->getMessage());
        }
    }
    public function showAvatar($filename)
    {
        $path = storage_path('app/public/avatars/' . $filename);

        if (!file_exists($path)) {
            abort(404);
        }

        return response()->file($path);
    }
}
