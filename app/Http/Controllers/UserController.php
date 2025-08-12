<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function login() {
        return view("users.login");
    }
    public function logon() {
        return view("users.logon");
    }
    public function auth_login(UserRequest $request) {
        $data = $request->validated();
        $user = User::where("email", "=", $data["email"])->first();
        if (empty($user) || !Hash::check($data["password"], $user["password"])) {
            return redirect()->route("login")->withErrors([
                "Login" => "Email e/ou senha inválidos"
            ])->withInput([
                "email" => $data["email"],
            ]);
        }
        if (Auth::attempt(["email" => $data["email"], "password" => $data["password"]])) {
            $request->session()->regenerate();
            return redirect()->route("index");
        }
    }

    public function auth_logon(UserRequest $request) {
        $data = $request->validated();

        $data["password"] = Hash::make($data["password"]);
        $user = User::create($data);
        Auth::login($user);

        return redirect()->route("index")->with('Success', 'Conta criada com sucesso');
    }

    public function logout() {
        Auth::logout();
        return redirect()->route("index");
    }

    public function index(User $user) {
        return view("users.profile", [
            "user" => $user,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user) {
        if (Gate::denies("update", $user)) {
            return redirect()->route("user.index", $user->id)->withErrors([
                "Access Dedined" => "Você não possui permissão para acesar esta página"
            ]);
        }
        return view('users.edit', compact('user'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request) {
        $data = $request->validate([
            "name" => ['required', "min:4", "max:25"],
            "email" => ['required', 'email'],
            "password" => ['required'],
            "new_password" => ['nullable', Password::min(8)->letters()->numbers()],
            "password_confirmation" => ['nullable', Password::min(8)->letters()->numbers()],
            "profile" => ["nullable", "mimes:jpeg,png,jpg"],
            "banner" => ["nullable", "mimes:jpeg,png,jpg"],
        ]);
        $user = User::find($request["id"]);
        if (Gate::denies("update", $user)) {
            return redirect()->route("user.index", $user->id)->withErrors([
                "Access Dedined" => "Você não possui permissão para acesar esta página"
            ]);
        }
        if (!Hash::check($data["password"], $user->password)) {
            return redirect()->route("user.edit", $user->id)->withErrors(["password" => "Senha incorreta"]);
        } else {
            $data["password"] = Hash::make($data["password"]);
        }
        if (!empty($data["new_password"])) {
            if ($data["new_password"] != $data["password_confirmation"]) {
                return redirect()->route("user.edit", $user->id)->withErrors(["password_confirmation" => "Senhas não condizem"]);
            } else {
                $data["password"] = Hash::make($data["password_confirmation"]);
            }
        }
        if ($request->hasFile('profile')) {
            $image = $request->file('profile');
            $imagePath = $image->store('users', 'public');

            $data['profile'] = $imagePath;
        } else {
            $data['profile'] = $user->profile;
        }
        if ($request->hasFile('banner')) {
            $image = $request->file('banner');
            $imagePath = $image->store('users', 'public');

            $data['banner'] = $imagePath;
        } else {
            $data['banner'] = $user->banner;
        }
        $user->update([
            "name" => $data["name"],
            "email" => $data["email"],
            "password" => $data["password"],
            "profile" => $data["profile"],
            "banner" => $data["banner"],
        ]);

        return redirect()->route('user.index', $user->id)->with('success', 'Dados atualizados com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user) {
        if (Gate::denies("delete", $user)) {
            return redirect()->route("user.index", $user->id)->withErrors([
                "Access Dedined" => "Você não possui permissão para acesar esta página"
            ]);
        }
        if (Auth::user()->id == $user->id) {
            Auth::logout();
        }
        $user->delete();
        return redirect()->route("index");
    }
}
