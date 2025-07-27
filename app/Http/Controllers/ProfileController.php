<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([

            'username' => [
                'required',
                'string',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'bio' => 'required|string|min:5|max:60',
            'name' => 'required|string|min:5|max:15',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg|max:12048',
            'password' => 'nullable|min:4|confirmed'
        ]);

        $data = [
            'username' => $validated['username'],
            'bio' => $validated['bio'],
            'name' => $validated['name']
        ];

        if ($request->hasFile('picture')) {
            if ($user->picture !== 'profile_pictures/default.jpg') {
                Storage::disk('public')->delete($user->picture);
            }
            $path = $request->file('picture')->store('profile_pictures', 'public');
            $data['picture'] = $path;
        }

        if ($request->filled('password')) {
            $data['password'] = bcrypt($validated['password']);
        }

        $user->update($data);

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
    public function setDefaultPicture()
    {
        $user = Auth::user();
        $defaultPicture = 'profile_pictures/default.jpg';
        $user->update([
            'picture' => $defaultPicture
        ]);
        return back()->with('success', 'Profile picture set to default.');
    }
    public function profileShow($username)
    {
        $user = Auth::user();
        $userId = Auth::id();
        $username = ltrim($username, '@');
        $data = User::where('username', $username)->firstOrFail();
        $otherUser = User::where('username', ltrim($username, '@'))->firstOrFail();

        $messages = Chat::where('sender_id', $userId)
            ->orWhere('receiver_id', $userId)
            ->with(['sender', 'receiver'])
            ->latest()
            ->get()
            ->groupBy(fn($message) => $message->sender_id == $userId ? $message->receiver_id : $message->sender_id)
            ->map(fn($group) => [
                'user' => $group->first()->sender_id == $userId ? $group->first()->receiver : $group->first()->sender,
                'latest_message' => $group->sortByDesc('created_at')->first()->message,
            ])
            ->values();
        return view('user-profile', compact('data', 'messages'));
    }
}
