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
    </div> --}}
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
                <img src="{{ asset('assets/maria.png') }}" alt="" srcset="">
            </div>
            <div class="content">
                <h2>Maria hill</h2>
                <p>@mariahill</p>
            </div>
        </div>
        <div class="options"><i class='icon action tx-neutral bxr bx-menu bx-bounce'></i></div>
    </div>
    <div class="chatting">
        <div class="msg-container">
            <div class="msg-other msg-all">
                Hey! Long time no see 👋
                <small>03:45pm</small>
            </div>

            <div class="msg-you msg-all">
                Hey Jordan! Yeah, it’s been ages 😄
                <small>03:46pm
                    <img src="{{ asset('assets/tick2.png') }}" alt="">
                </small>
            </div>

            <div class="msg-you msg-all">
                How’s everything going on your end?
                <small>03:46pm
                    <img src="{{ asset('assets/tick2.png') }}" alt="">
                </small>
            </div>

            <div class="msg-other msg-all">
                Pretty good actually. Just got back from a hiking trip last weekend.
                <small>03:47pm</small>
            </div>

            <div class="msg-other msg-all">
                First time unplugging in months 😂
                <small>03:47pm</small>
            </div>

            <div class="msg-you msg-all">
                That sounds awesome! Where did you go?
                <small>03:48pm
                    <img src="{{ asset('assets/tick2.png') }}" alt="">
                </small>
            </div>

            <div class="msg-other msg-all">
                Upstate — Catskills. The view at the top was totally worth the climb.
                <small>03:48pm</small>
            </div>

            <div class="msg-you msg-all">
                I’ve always wanted to go there. Was it super crowded?
                <small>03:49pm
                    <img src="{{ asset('assets/tick2.png') }}" alt="">
                </small>
            </div>

            <div class="msg-other msg-all">
                Not really. We went super early in the morning. Plus, it was cloudy, so fewer people.
                <small>03:50pm</small>
            </div>

            <div class="msg-you msg-all">
                Smart move 👍
                <small>03:50pm
                    <img src="{{ asset('assets/tick2.png') }}" alt="">
                </small>
            </div>

            <div class="msg-you msg-all">
                So... how's work treating you lately?
                <small>03:51pm
                    <img src="{{ asset('assets/tick2.png') }}" alt="">
                </small>
            </div>

            <div class="msg-other msg-all">
                Busy, as always. But I just wrapped up a big project, so feeling kinda proud 😎
                <small>03:52pm</small>
            </div>

            <div class="msg-you msg-all">
                That’s awesome! Congrats! What was the project about?
                <small>03:52pm
                    <img src="{{ asset('assets/tick2.png') }}" alt="">
                </small>
            </div>

            <div class="msg-other msg-all">
                We built a new dashboard for internal analytics — using Vue and Laravel.
                <small>03:53pm</small>
            </div>

            <div class="msg-other msg-all">
                Learned a ton from it.
                <small>03:53pm</small>
            </div>

            <div class="msg-you msg-all">
                Sounds like something I’d love to see! You always build cool stuff.
                <small>03:54pm
                    <img src="{{ asset('assets/tick2.png') }}" alt="">
                </small>
            </div>

            <div class="msg-other msg-all">
                Thanks! Maybe I’ll give you a quick demo sometime next week?
                <small>03:55pm</small>
            </div>

            <div class="msg-you msg-all">
                Definitely. Let’s set something up. Maybe Tuesday?
                <small>03:55pm
                    <img src="{{ asset('assets/tick2.png') }}" alt="">
                </small>
            </div>

            <div class="msg-other msg-all">
                Tuesday works for me. I'll send over a calendar invite.
                <small>03:56pm</small>
            </div>
            <div class="msg-you msg-all">
                Perfect
                <small>03:58pm
                    <img src="{{ asset('assets/tick.png') }}" alt="">
                </small>
            </div>

        </div>


        <div class="input">
            <input type="text" placeholder="Type a Message" name="message">
            <i class='icon action tx-neutral bxr bx-send-alt'></i>
        </div>
    </div>
    @push('js')
        <script src="{{ asset('universal/search.js') }}"></script>
    @endpush
@endsection
