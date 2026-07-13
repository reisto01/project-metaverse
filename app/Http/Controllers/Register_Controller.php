<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\user_roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class Register_Controller extends Controller
{
    public function login_view()
    {
        return view('authPage.login', ['tittle' => 'Welcome To MetaWorld']);
    }

    public function registered_view()
    {
        return view('authPage.register', ['tittle' => 'Welcome To MetaWorld']);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username_login' => ['required', 'string', 'max:255'],
            'password_login' => ['required', 'string'],
        ]);

        $user = User::where('username', $credentials['username_login'])
            ->where('is_deleted', 1)
            ->first();

        $passwordMatches = $user && Hash::check($credentials['password_login'], $user->password);
        $legacyPasswordMatches = $user
            && preg_match('/^[a-f0-9]{32}$/i', $user->password)
            && hash_equals(strtolower($user->password), md5($credentials['password_login']));

        if (! $passwordMatches && ! $legacyPasswordMatches) {
            return back()->withErrors([
                'username_login' => 'The supplied credentials are invalid.',
            ])->onlyInput('username_login');
        }

        if ($legacyPasswordMatches) {
            $user->forceFill(['password' => Hash::make($credentials['password_login'])])->save();
        }

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->intended((int) $user->role_id === 1 ? '/adminpage' : '/');
    }

    public function registered(Request $request)
    {
        $data = $request->validate([
            'username' => ['required', 'string', 'max:255', 'unique:users,username'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'max:255'],
        ]);

        User::create([
            'username' => $data['username'],
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'picture' => User::DEFAULT_PICTURE,
            'role_id' => 2,
            'is_deleted' => 1,
        ]);

        return redirect('/login')->with('alert-notif', 'Pendaftaran Berhasil');
    }

    public function createAccountAdmin(Request $request)
    {
        $data = $request->validate([
            'username' => ['required', 'string', 'max:255', 'unique:users,username'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'max:255'],
        ]);

        User::create([
            'username' => $data['username'],
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'picture' => User::DEFAULT_PICTURE,
            'role_id' => 1,
            'is_deleted' => 1,
        ]);

        return redirect('/kelolaAkun')->with('alert-notif', 'Pendaftaran Berhasil');
    }

    public function updateAccountAdmin(Request $request)
    {
        $user = User::where('is_deleted', 1)->findOrFail($request->integer('id'));

        $data = $request->validate([
            'username_register' => ['required', 'string', 'max:255', Rule::unique('users', 'username')->ignore($user->id)],
            'email_register' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'name_register' => ['required', 'string', 'max:255'],
            'password_register' => ['nullable', 'string', 'min:8', 'max:255'],
            'role_register' => ['nullable', Rule::in([1, 2])],
        ]);

        $user->fill([
            'username' => $data['username_register'],
            'email' => $data['email_register'],
            'name' => $data['name_register'],
        ]);

        if (isset($data['role_register'])) {
            $user->role_id = $data['role_register'];
        }

        if (! empty($data['password_register'])) {
            $user->password = Hash::make($data['password_register']);
        }

        $user->save();

        return redirect('/kelolaAkun')->with('alert-notif', 'Perubahan Akun Berhasil');
    }

    public function updateAccountUser(Request $request)
    {
        $user = $request->user();
        $data = $request->validate([
            'username_register' => ['required', 'string', 'max:255', Rule::unique('users', 'username')->ignore($user->id)],
            'email_register' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'name_register' => ['required', 'string', 'max:255'],
            'phone_register' => ['nullable', 'string', 'max:30', Rule::unique('users', 'phone_number')->ignore($user->id)],
            'address_register' => ['nullable', 'string', 'max:1000'],
            'gender_register' => ['nullable', Rule::in(['Gentlemen', 'Ladies'])],
            'password_register' => ['nullable', 'string', 'min:8', 'max:255'],
            'name_img' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ]);

        $user->fill([
            'username' => $data['username_register'],
            'email' => $data['email_register'],
            'name' => $data['name_register'],
            'phone_number' => $data['phone_register'] ?? null,
            'address' => $data['address_register'] ?? null,
            'gender' => $data['gender_register'] ?? null,
        ]);

        if (! empty($data['password_register'])) {
            $user->password = Hash::make($data['password_register']);
        }

        if ($request->hasFile('name_img')) {
            $path = $request->file('name_img')->store('image/userimg', 'public');
            $user->picture = '/storage/'.$path;
        }

        $user->save();

        return redirect('/profile')->with('alert-notif', 'Perubahan Akun Berhasil');
    }

    public function getData(int $id)
    {
        $user = User::where('is_deleted', 1)->findOrFail($id);

        return response()->json([
            'data' => $user->only(['id', 'username', 'email', 'name', 'role_id']),
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function delete_account(Request $request)
    {
        $data = $request->validate(['id_data' => ['required', 'integer', 'exists:users,id']]);
        abort_if((int) $data['id_data'] === (int) $request->user()->id, 422, 'You cannot delete your own account.');

        User::whereKey($data['id_data'])->update(['is_deleted' => 0]);

        return redirect('/kelolaAkun');
    }

    public function kelola_akun(Request $request)
    {
        $search = $request->string('search_me')->trim()->toString();
        $users = User::where('is_deleted', 1)
            ->when($search, fn ($query) => $query->where('name', 'like', '%'.$search.'%'))
            ->orderByDesc('created_at')
            ->paginate(10)
            ->withQueryString();

        return view('adminpage.kelolaAkun', [
            'Page' => 'Kelola Akun',
            'user' => $users,
            'get_total' => $users->total(),
            'page_now' => $users->currentPage(),
            'search' => $search,
            'pagin' => $users->lastPage(),
            'roles' => user_roles::where('is_deleted', 1)->get(),
        ]);
    }
}
