<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /**
     * Update the authenticated user's profile.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'alpha_dash', 'min:3', 'max:50', Rule::unique('users')->ignore($user->id)],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone_number' => ['nullable', 'string', 'max:20'],
            'password' => [
                'nullable', 
                'confirmed', 
                'min:6', 
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[\W_]).+$/'
            ],
        ], [
            'password.regex' => 'The password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.',
            'password.min' => 'The password must be at least 6 characters.',
        ]);

        $oldName = $user->name;
        $oldUsername = $user->username;
        $oldEmail = $user->email;
        $oldPhone = $user->phone_number;

        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        // Detect changes and build description
        $changes = [];
        if ($oldName !== $user->name) $changes[] = "name";
        if ($oldUsername !== $user->username) $changes[] = "username";
        if ($oldEmail !== $user->email) $changes[] = "email";
        if ($oldPhone !== $user->phone_number) $changes[] = "phone number";
        if ($request->filled('password')) $changes[] = "password";

        $desc = "You updated your profile information" . (empty($changes) ? "." : " (" . implode(', ', $changes) . ").");

        Activity::log('profile_update', $desc);

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}
