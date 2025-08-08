<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login()
    {
        return view("user.login");
    }
    public function logon()
    {
        return view("user.logon");
    }
    public function auth_login(UserRequest $request)
    {
        $request->merge(['is_logon' => false]);
        $data = $request->validated();

        $user = User::where("email", "=", $data["email"])->first();
        if (empty($user) || !Hash::check($data["password"], $user["password"])) {
            return redirect()->route("user.login")->withErrors([
                "Login" => "Email e/ou senha inválidos"
            ])->withInput([
                "email" => $data["email"],
                "password" => $data["password"]
            ]);
        }

        if (Auth::attempt(["email" => $data["email"], "password" => $data["password"]])) {
            $request->session()->regenerate();
            return redirect("/");
        }

        // Fallback
        return redirect()->route("user.login")->withErrors([
            "Login" => "Erro ao autenticar... Tente novamente..."
        ]);
    }

    public function auth_logon(UserRequest $request)
    {
        $request->merge(['is_logon' => true]);
        $data = $request->validated();

        $data->password = Hash::make($data->password);
        $user = User::create($data);
        Auth::login($user);
        
        return redirect('/')->with('Success', 'Conta criado com sucesso');
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
