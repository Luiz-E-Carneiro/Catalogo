<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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
    public function edit(string $id) {
        $user = Auth::user();
        return view('user.edit', compact('user'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id) {
        $data = $request->validated();

        $user = User::findOrFail($id);
        $user->update($data);

        return redirect()->route('user.edit', $user->id)->with('success', 'Dados atualizados com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        // Verificar se é admin ou não, dps exclui. Dependendo de quem for, faz o logout.
    }
}
