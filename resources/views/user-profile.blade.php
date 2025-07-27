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
    @foreach ($messages as $message)
        <div class="chat-request">
            <div class="picture">
                <a href="{{ route('profile.show', ['username' => '@' . $message['user']['username']]) }}">
                    <img src="{{ asset('storage/' . $message['user']['picture']) }}"
                        alt="{{ $message['user']['username'] }}'s profile picture">
                </a>
            </div>
            <a href="{{ route('chatting', ['username' => '@' . $message['user']['username']]) }}"
                class="content tx-neutral">
                <div class="user">
                    <h3>{{ $message['user']['name'] }}</h3>
                </div>
                <div class="msg">
                    <p>{{ $message['latest_message'] }}</p>
                </div>
            </a>
        </div>
    @endforeach

    {{-- <div class="chat-request">
        <div class="picture">
            <img src="{{ asset('assets/maria.png') }}" alt="" srcset="">
        </div>
        <div class="content tx-neutral">
            <div class="user">
                <h3>Milly Hill</h3>
            </div>
            <div class="msg">
                <p>Hey there! I'm using Arcus Chatting App. Build on Laravel</p>
            </div>
        </div>
    </div>
    <div class="chat-request">
        <div class="picture">
            <img src="{{ asset('assets/terminator.jpg') }}" alt="" srcset="">
        </div>
        <div class="content tx-neutral">
            <div class="user">
                <h3>Terminator</h3>
            </div>
            <div class="msg">
                <p>Hey there! I'm using Arcus Chatting App. Build on Laravel</p>
            </div>
        </div>
    </div>
    <div class="chat-request">
        <div class="picture">
            <img src="{{ asset('assets/skull.png') }}" alt="" srcset="">
        </div>
        <div class="content tx-neutral">
            <div class="user">
                <h3>Ghost Rider</h3>
            </div>
            <div class="msg">
                <p>Hey there! I'm using Arcus Chatting App. Build on Laravel</p>
            </div>
        </div>
    </div>
    <div class="chat-request">
        <div class="picture">
            <img src="{{ asset('assets/annabelle.png') }}" alt="" srcset="">
        </div>
        <div class="content tx-neutral">
            <div class="user">
                <h3>Annabelle</h3>
            </div>
            <div class="msg">
                <p>Hey there! I'm using Arcus Chatting App. Build on Laravel</p>
            </div>
        </div>
    </div>
    <div class="chat-request">
        <div class="picture">
            <img src="{{ asset('assets/chef.jpg') }}" alt="" srcset="">
        </div>
        <div class="content tx-neutral">
            <div class="user">
                <h3>Chef</h3>
            </div>
            <div class="msg">
                <p>Hey there! I'm using Arcus Chatting App. Build on Laravel</p>
            </div>
        </div>
    </div>
    <div class="chat-request">
        <div class="picture">
            <img src="{{ asset('assets/girl.jpg') }}" alt="" srcset="">
        </div>
        <div class="content tx-neutral">
            <div class="user">
                <h3>Girl</h3>
            </div>
            <div class="msg">
                <p>Hey there! I'm using Arcus Chatting App. Build on Laravel</p>
            </div>
        </div>
    </div>
    <div class="chat-request">
        <div class="picture">
            <img src="{{ asset('assets/bird.jpg') }}" alt="" srcset="">
        </div>
        <div class="content tx-neutral">
            <div class="user">
                <h3>Angry Bird</h3>
            </div>
            <div class="msg">
                <p>Hey there! I'm using Arcus Chatting App. Build on Laravel</p>
            </div>
        </div>
    </div> --}}

    {{-- @foreach ($data->friends->where('sender_id', 4) as $friend)
        {{ $friend }}
    @endforeach --}}
    @php
        $request = \App\Models\FriendRequest::where(function ($query) use ($data) {
            $query->where('sender_id', Auth::id())->where('receiver_id', $data->id);
        })
            ->orWhere(function ($query) use ($data) {
                $query->where('sender_id', $data->id)->where('receiver_id', Auth::id());
            })
            ->first();
    @endphp
@endsection
@section('messages')
    <div class="request-header">
        <div class="request-info">
            <div class="content tx-neutral">
                <a href="{{ route('chat') }}">
                    <i class='icon action tx-highlight bxr bx-arrow-left-stroke'></i>
                </a>
                <h2>Profile</h2>
            </div>
        </div>
    </div>
    <div class="request-container">
        <div class="img-container">
            <img src="{{ '/storage/' . $data->picture }}" alt="">
        </div>
        <h2><span>@</span>{{ $data->username }}</h2>
        <h2>{{ $data->name }}</h2>
        <div class="bio">
            <p>{{ $data->bio }}</p>
        </div>
        <div class="about-user">
            @if ($request)
                <div class="bx bg-light tx-highlight">
                    <p>Requested on {{ $request->created_at->format('d-m-Y') }}</p>
                </div>
            @endif
            <div class="bx bg-light tx-highlight">
                <p>Joined on {{ $data->created_at->format('d-m-Y') }}</p>
            </div>
            <div class="bx bg-light tx-highlight">
                <p>{{ $data->friends()->count() }} Friends</p>
            </div>
            <div class="bx bg-highlight tx-neutral tx-center">
                <p>Report <span>@</span>{{ $data->username }}</p>
            </div>
            @if ($request)
                <!-- Don't show buttons for own profile -->
                @if ($request->status == 'accepted')
                    <!-- Users are friends: Show Chat and Remove Friend buttons -->
                    <div class="bx bg-highlight tx-neutral tx-center">
                        <a href="{{ route('chatting', ['username' => '@' . $data->username]) }}">Chat</a>
                    </div>
                    <div class="bx bg-highlight tx-neutral tx-center">
                        <form action="{{ route('friend.remove', ['id' => $data->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Remove Friend</button>
                        </form>
                    </div>
                @elseif ($request->status == 'pending')
                    <!-- Pending request exists: Show Request Sent button (disabled) -->
                    <div class="bx bg-highlight tx-neutral tx-center">
                        <button type="button" disabled>Request Sent</button>
                    </div>
                @else
                    <!-- No friendship or pending request: Show Send Request button -->
                    <div class="bx bg-highlight tx-neutral tx-center">
                        <form action="{{ route('friend.request', ['username' => '@' . $data->username]) }}" method="POST">
                            @csrf
                            <button type="submit">Send Request</button>
                        </form>
                    </div>
                @endif
            @else
                <div class="bx bg-highlight tx-neutral tx-center">
                    <form action="{{ route('friend.request', ['username' => '@' . $data->username]) }}" method="POST">
                        @csrf
                        <button type="submit">Send Request</button>
                    </form>
                </div>
            @endif

        </div>
    </div>
    @push('js')
        <script src="{{ asset('universal/search.js') }}"></script>
    @endpush
@endsection
