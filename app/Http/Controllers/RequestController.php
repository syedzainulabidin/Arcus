<?php

namespace App\Http\Controllers;

use App\Models\FriendRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;

class RequestController extends Controller
{
    public function sendRequest(Request $request, $username)
    {
        $username = ltrim($username, '@');
        $receiver = User::where('username', $username)->firstOrFail();
        $senderId = Auth::id();

        // Prevent sending request to self
        if ($senderId === $receiver->id) {
            return redirect()->back()->with('error', 'You cannot send a friend request to yourself.');
        }

        // Check if a friend request or friendship already exists
        $existingRequest = FriendRequest::where('sender_id', $senderId)
            ->where('receiver_id', $receiver->id)
            ->whereIn('status', ['pending', 'accepted'])
            ->exists();

        if ($existingRequest) {
            return redirect()->back()->with('error', 'A friend request or friendship already exists.');
        }

        // Create friend request
        FriendRequest::create([
            'sender_id' => $senderId,
            'receiver_id' => $receiver->id,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Friend request sent to @' . $username . '!');
    }

    public function removeFriend($id)
    {
        $userId = Auth::id();

        // Find the accepted friend request (either direction)
        $friendRequest = FriendRequest::where('status', 'accepted')
            ->where(function ($query) use ($userId, $id) {
                $query->where('sender_id', $userId)->where('receiver_id', $id)
                    ->orWhere('sender_id', $id)->where('receiver_id', $userId);
            })
            ->firstOrFail();

        // Delete the friend request to remove the friendship
        $friendRequest->delete();

        return redirect()->back()->with('success', 'Friend removed successfully.');
    }

    public function request()
    {
        $user = Auth::user();

        $pendingRequests = $user->receivedFriendRequests()
            ->where('status', 'pending')
            ->with('sender')
            ->get()->map(function ($request) {
                $request->requestTime = Carbon::parse($request->created_at)->diffForHumans();
                return $request;
            });

        $requestCount = $pendingRequests->count();

        return view('request', compact('pendingRequests', 'requestCount'));
    }

    public function profileView($username)
    {
        $user = Auth::user();
        $usernameForQuery = ltrim($username, '@');
        $userProfile = User::where('username', $usernameForQuery)->firstOrFail();
        $friendCount = $userProfile->friends()->count();
        $pendingRequests = $user->receivedFriendRequests()
            ->where('status', 'pending')
            ->with('sender')
            ->get()->map(function ($request) {
                $request->requestTime = Carbon::parse($request->created_at)->diffForHumans();
                return $request;
            });

        $requestCount = $pendingRequests->count();

        return view('request', compact('pendingRequests', 'requestCount', 'userProfile', 'friendCount'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $currentUserId = Auth::id();

        $users = User::where('username', 'LIKE', "%{$query}%")
            ->where('id', '!=', $currentUserId)
            ->pluck('username');

        return response()->json($users);
    }

    public function accept($id)
    {
        $request = FriendRequest::where('id', $id)
            ->where('receiver_id', Auth::id())
            ->where('status', 'pending')
            ->firstOrFail();
        $request->update(['status' => 'accepted']);
        return redirect()->route('request')->with('success', 'Friend request accepted!');
    }

    public function decline($id)
    {
        $request = FriendRequest::where('id', $id)
            ->where('receiver_id', Auth::id())
            ->where('status', 'pending')
            ->firstOrFail();
        $request->delete(); // Delete instead of updating to declined to allow new requests
        return redirect()->route('request')->with('success', 'Friend request declined.');
    }
}
