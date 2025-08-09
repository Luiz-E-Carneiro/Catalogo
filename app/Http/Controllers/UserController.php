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
    public function auth_login(Request $request) {
        $data = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
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

    public function auth_logon(Request $request) {
        $data = $request->validate([
            "name" => ['required', "min:5", "max:25"],
            "email" => ['required', 'email', 'unique:users,email'],
            "password" => ['required', "confirmed", Password::min(8)->letters()->numbers()],
        ]);

        $data["password"] = Hash::make($data["password"]);
        $user = User::create($data);
        Auth::login($user);
        
        return redirect()->route("index")->with('Success', 'Conta criada com sucesso');
    }
    public function logout() {
        Auth::logout();
        return redirect()->route("index");
    }

    public function index() {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        //
    }
}
