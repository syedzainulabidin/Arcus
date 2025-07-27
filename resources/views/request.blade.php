@extends('layout')
@section('search')
    {{-- <div class="search">
        <input type="text" id="searchInput" placeholder="Search @username" autocomplete="off">
        <i class='icon action tx-dark bxr bx-search'></i>
        <div id="searchResults"></div>
    </div> --}}

    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
@endsection

{{-- @section('filter')
    <div class="filters">
        <a href="#" class="filter">
            <div>Recieved</div>
        </a>
        <a href="#" class="filter">
            <div>Sent</div>
        </a>
    </div>
@endsection --}}

@section('chat')
    {{-- <div class="chat-request request">
        <div class="info">
            <div class="picture">
                <img src="{{ asset('assets/maria.png') }}" alt="" srcset="">
            </div>
            <div class="content tx-neutral">
                <div class="user">
                    <h3>@mariahill</h3>
                </div>
                <div class="msg">
                    <p>Working at Sheild Working at Sheild Working at Sheild</p>
                </div>
            </div>
            <div class="profile">
                <i class='icon action tx-neutral bxr bx-arrow-up-right-stroke'></i>
            </div>
        </div>
        <div class="request-btns">
            <a href="#">
                <div class="request-btn"><i class='bxr  bx-check'></i> Approve</div>
            </a>
            <a href="#">
                <div class="request-btn"><i class='bxr  bx-x'></i> Reject</div>
            </a>
        </div>
    </div>
    <div class="chat-request request">
        <div class="info">
            <div class="picture">
                <img src="{{ asset('assets/maria.png') }}" alt="" srcset="">
            </div>
            <div class="content tx-neutral">
                <div class="user">
                    <h3>@mariahill</h3>
                </div>
                <div class="msg">
                    <p>Working at Sheild Working at Sheild Working at Sheild</p>
                </div>
            </div>
            <div class="profile">
                <i class='icon action tx-neutral bxr bx-arrow-up-right-stroke'></i>
            </div>
        </div>
        <div class="request-btns">
            <a href="#">
                <div class="request-btn"><i class='bxr  bx-check'></i> Approve</div>
            </a>
            <a href="#">
                <div class="request-btn"><i class='bxr  bx-x'></i> Reject</div>
            </a>
        </div>
    </div>
    <div class="chat-request request">
        <div class="info">
            <div class="picture">
                <img src="{{ asset('assets/maria.png') }}" alt="" srcset="">
            </div>
            <div class="content tx-neutral">
                <div class="user">
                    <h3>@mariahill</h3>
                </div>
                <div class="msg">
                    <p>Working at Sheild Working at Sheild Working at Sheild</p>
                </div>
            </div>
            <div class="profile">
                <i class='icon action tx-neutral bxr bx-arrow-up-right-stroke'></i>
            </div>
        </div>
        <div class="request-btns">
            <a href="#">
                <div class="request-btn"><i class='bxr  bx-check'></i> Approve</div>
            </a>
            <a href="#">
                <div class="request-btn"><i class='bxr  bx-x'></i> Reject</div>
            </a>
        </div>
    </div>
    <div class="chat-request request">
        <div class="info">
            <div class="picture">
                <img src="{{ asset('assets/maria.png') }}" alt="" srcset="">
            </div>
            <div class="content tx-neutral">
                <div class="user">
                    <h3>@mariahill</h3>
                </div>
                <div class="msg">
                    <p>Working at Sheild Working at Sheild Working at Sheild</p>
                </div>
            </div>
            <div class="profile">
                <i class='icon action tx-neutral bxr bx-arrow-up-right-stroke'></i>
            </div>
        </div>
        <div class="request-btns">
            <a href="#">
                <div class="request-btn"><i class='bxr  bx-check'></i> Approve</div>
            </a>
            <a href="#">
                <div class="request-btn"><i class='bxr  bx-x'></i> Reject</div>
            </a>
        </div>
    </div> --}}
    @foreach ($pendingRequests as $request)
        <div class="chat-request request">
            <div class="info">
                <div class="picture">
                    <img src="{{ '/storage/' . $request->sender->picture }}" alt="" srcset="">
                </div>
                <div class="content tx-neutral">
                    <div class="user">
                        <h3><span>@</span>{{ $request->sender->username }}</h3>
                        {{-- <h3><span>@</span>{{ $request->sender->username }}</h3> --}}
                        <p>{{ $request->requestTime }}</p>
                    </div>
                    <div class="msg">
                        <p>{{ $request->sender->bio }}</p>
                    </div>
                </div>


                {{-- <form action="{{ route('profile.view', ['username' => '@'.$request->sender->username]) }}" method="GET">
                    <button type="submit" class="profile-button">
                        <div class="profile">
                            <i class='icon action tx-neutral bxr bx-arrow-up-right-stroke'></i>
                        </div>
                    </button>
                </form> --}}

                <a href="{{ route('profile.view', ['username' => '@' . $request->sender->username]) }}"
                    class="profile-button">
                    <div class="profile">
                        <i class='icon action tx-neutral bxr bx-arrow-up-right-stroke'></i>
                    </div>
                </a>


                {{-- <a href="{{ route('profile.view', ['username' => $request->sender->username]) }}">
                    <div class="profile">
                        <i class='icon action tx-neutral bxr bx-arrow-up-right-stroke'></i>
                    </div>
                </a> --}}

            </div>
            <div class="request-btns">
                <form action="{{ route('friend.accept', $request->id) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="request-btn"><i class='bxr bx-check'></i> Approve</button>
                </form>
                <form action="{{ route('friend.decline', $request->id) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="request-btn"><i class='bxr bx-x'></i> Reject</button>
                </form>
            </div>
        </div>
    @endforeach
@endsection
@section('messages')
    @isset($userProfile)
        <div class="request-header">
            <div class="request-info">
                <div class="content tx-neutral">
                    <a href="{{ route('request') }}">
                        <i class='icon action tx-highlight bxr bx-arrow-left-stroke'></i>
                    </a>
                    <h2>Profile</h2>
                </div>
            </div>
        </div>
        <div class="request-container">
            <div class="img-container">
                <img src="{{ '/storage/' . $userProfile->picture }}" alt="">
            </div>
            <h2><span>@</span>{{ $userProfile->username }}</h2>
            <div class="bio">
                <p>{{ $userProfile->bio }}</p>
            </div>
            <div class="about-user">
                <div class="bx bg-light tx-highlight">
                    <p>Requested on 12-05-2025</p>
                </div>
                <div class="bx bg-light tx-highlight">
                    <p>Joined on {{ $userProfile->created_at }}</p>
                </div>
                <div class="bx bg-light tx-highlight">
                    <p>{{ $friendCount }} Friends</p>
                </div>
                <div class="bx bg-highlight tx-neutral tx-center">
                    <p>Report <span>@</span>{{ $userProfile->username }}</p>
                </div>
            </div>
        </div>
    @else
        <div class="request-msg">
            <h1>You got {{ $requestCount }} Request</h1>
        </div>
    @endisset
    @push('js')
        <script src="{{ asset('universal/search.js') }}"></script>
    @endpush
@endsection
