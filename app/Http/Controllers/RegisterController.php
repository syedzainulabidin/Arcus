<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function checkUsername(Request $request)
    {
        $username = $request->input('username');
        $exists = User::where('username', $username)->exists();

        return response()->json(['available' => !$exists]);
    }
}