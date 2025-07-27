<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\FriendRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    private function getChatUsers()
    {
        $userId = Auth::id();

        return Chat::where('sender_id', $userId)
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
    }

    public function index()
    {
        $chatUsers = $this->getChatUsers();
        return view('index', compact('chatUsers'));
    }

    public function profile()
    {
        return view('profile');
    }

    public function chatting($username)
    {
        $userId = Auth::id();
        $otherUser = User::where('username', ltrim($username, '@'))->firstOrFail();

        // Prevent chatting with self
        if ($userId === $otherUser->id) {
            return redirect()->route('profile.show', ['username' => '@' . $otherUser->username])
                ->with('error', 'You cannot chat with yourself.');
        }

        // Check if users are friends
        $isFriend = User::find($userId)->friends()->where('users.id', $otherUser->id)->exists();

        if (FriendRequest::where(function ($query) use ($otherUser) {
            $query->where('sender_id', Auth::id())
                ->where('receiver_id', $otherUser->id)
                ->where('status', 'accepted'); // status should be 'accepted'
        })->orWhere(function ($query) use ($otherUser) {
            $query->where('sender_id', $otherUser->id)
                ->where('receiver_id', Auth::id())
                ->where('status', 'accepted'); // status should be 'accepted'
        })->exists()) {
            // return "Noot allowed";
        } else {
            return redirect()->route('profile.show', ['username' => '@' . $otherUser->username])
                ->with('error', 'You can only chat with friends.');
        }



        // if (!$isFriend) {
        //     return redirect()->route('profile.show', ['username' => '@' . $otherUser->username])
        //         ->with('error', 'You can only chat with friends.');
        // }

        $chatUsers = $this->getChatUsers();

        $messages = Chat::where(function ($query) use ($userId, $otherUser) {
            $query->where('sender_id', $userId)
                ->where('receiver_id', $otherUser->id);
        })->orWhere(function ($query) use ($userId, $otherUser) {
            $query->where('sender_id', $otherUser->id)
                ->where('receiver_id', $userId);
        })
            ->with(['sender', 'receiver'])
            ->orderBy('created_at', 'asc')
            ->get();

        return view('chat', compact('chatUsers', 'messages', 'otherUser'));
    }

    public function send(Request $request)
    {
        $data = $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required|string|max:1000',
        ]);

        $senderId = Auth::id();
        $receiverId = $data['receiver_id'];

        // Prevent sending messages to self
        if ($senderId === $receiverId) {
            return redirect()->back()->with('error', 'You cannot send messages to yourself.');
        }

        // Check if the receiver is a friend
        $isFriend = User::find($senderId)->friends()->where('users.id', $receiverId)->exists();

        if (!$isFriend) {
            return redirect()->back()->with('error', 'You can only send messages to friends.');
        }

        Chat::create([
            'sender_id' => $senderId,
            'receiver_id' => $receiverId,
            'message' => $data['message'],
        ]);

        return redirect()->back();
    }
}
