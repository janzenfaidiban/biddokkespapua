<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ThemeController extends Controller
{
    public function updateTheme(Request $request)
    {
        // Validate input
        $request->validate([
            'theme' => 'required|string'
        ]);

        // Update the theme for the authenticated user (example)
        $user = Auth::user();
        if ($user) {
            $user->theme = $request->theme;
            $user->save();
            return response()->json(['success' => true, 'message' => 'Theme updated successfully']);
        }

        return response()->json(['success' => false, 'message' => 'User not authenticated'], 401);
    }
}
