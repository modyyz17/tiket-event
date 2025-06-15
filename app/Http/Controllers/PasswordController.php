<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
public function update(Request $request)
{
    $request->validate([
        'current_password' => ['required', 'current_password'],
        'password' => ['required', 'confirmed', 'min:8'],
    ]);

    $user = auth()->user();
    $user->update([
        'password' => Hash::make($request->password),
    ]);

    return back()->with('success', 'Password berhasil diubah.');
}

}