@extends('layout')
@section('search')
    <div class="search">
        <input type="text" id="searchInput" placeholder="Search @username" autocomplete="off">
        <i class='icon action tx-dark bxr bx-search'></i>
        <div id="searchResults"></div>
    </div>
@endsection
@section('filter')
    <div class="filters">
        <a href="#" class="filter">
            <div>All</div>
        </a>
        <a href="#" class="filter">
            <div>Favorites</div>
        </a>
        <a href="#" class="filter">
            <div>Unread</div>
        </a>
        <a href="#" class="filter">
            <div>Muted</div>
        </a>
    </div>
@endsection
@section('chat')
    @foreach ($chatUsers as $chatUser)
        <div class="chat-request">
            <div class="picture">
                <a href="{{ route('profile.show', ['username' => '@' . $chatUser['user']->username]) }}">
                    <img src="{{ asset('storage/' . ($chatUser['user']->picture ?? 'default.png')) }}"
                        alt="{{ $chatUser['user']->name ?? $chatUser['user']->username }}'s profile picture">
                </a>
            </div>
            <a href="{{ route('chatting', ['username' => '@' . $chatUser['user']->username]) }}" class="content tx-neutral">
                <div class="user">
                    <h3>{{ $chatUser['user']->name ?? $chatUser['user']->username }}</h3>
                </div>
                <div class="msg">
                    <p>{{ $chatUser['latest_message'] ? Str::limit($chatUser['latest_message'], 50) : 'No messages yet' }}
                    </p>
                </div>
            </a>
        </div>
    @endforeach
@endsection
@section('messages')
    <div class="header">
        <div class="info">
            <div class="picture">
                <img src="{{ asset('storage/' . ($otherUser->picture ?? 'default.png')) }}"
                    alt="{{ $otherUser->username }}'s profile picture">
            </div>
            <div class="content">
                <h2>{{ $otherUser->name ?? $otherUser->username }}</h2>
                <p>{{ '@' . $otherUser->username }}</p>
            </div>
        </div>
        <div class="options">
            <i class='icon action tx-neutral bxr bx-menu bx-bounce'></i>
        </div>
    </div>
    <div class="chatting">
        <div class="msg-container">
            @foreach ($messages as $message)
                <div class="{{ $message->sender_id == Auth::id() ? 'msg-you' : 'msg-other' }} msg-all">
                    {{ $message->message }}
                    <small>
                        {{ $message->created_at->format('h:i A') }}
                        @if ($message->sender_id == Auth::id())
                            <img src="{{ asset('assets/tick2.png') }}" alt="Sent">
                        @endif
                    </small>
                </div>
            @endforeach
        </div>
        <form action="{{ route('chat.send') }}" method="POST">
            <div class="input">
                @csrf
                <input type="hidden" name="receiver_id" value="{{ $otherUser->id }}">
                <input type="text" placeholder="Type a Message" name="message">
                <button type="submit"><i class='icon action tx-neutral bxr bx-send-alt'></i></button>
            </div>
        </form>
    </div>
    @push('js')
        <script src="{{ asset('universal/search.js') }}"></script>
    @endpush
@endsection
