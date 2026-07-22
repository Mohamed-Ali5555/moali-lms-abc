@php
    $current_route = Route::currentRouteName();
@endphp

<div class="col-lg-3">
    <div class="gradient-border">
        <div class="course-sideBar">
            <div class="profile-info">
                <img class="photo" src="{{ get_image(auth()->user()->photo) }}" alt="">
                <div class="upload-new">
                    <a href="#"
                        onclick="ajaxModal('{{ route('modal', ['frontend.default.upload_profile_pic', 'id' => auth()->user()->id]) }}', '{{ get_phrase('Upload picture') }}')">
                        <span>
                            <i class="fi-rr-cloud-upload"></i><br>
                            {{ get_phrase('Upload New') }}
                        </span>
                    </a>
                </div>
                <h5 class="name">{{ auth()->user()->name }}</h5>
                @php
                    $email = auth()->user()->email;
                @endphp
                <p class="email">{{ strlen($email) > 22 ? substr($email, 0, 22) . '...' : $email }}</p>
            </div>
            <ul class="couses-tab-list">

                <li class="@if ($current_route == 'theme.my.courses') active @endif">
                    <a href="{{ route('theme.my.courses') }}">
                        <dotlottie-player src="{{ asset('assets/frontend/default/image/icons/courses.json') }}"
                            background="transparent" speed="1" style="width: 30px; height: 30px;" part="lottie-svg"
                            loop autoplay @if ($current_route != 'theme.my.courses') hover @endif></dotlottie-player>
                        <span> كورساتي </span>
                    </a>
                </li>
                <li class="@if ($current_route == 'theme.my.books') active @endif">
                    <a href="{{ route('theme.my.books') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M2 3h6a4 4 0 0 1 4 4v14a4 4 0 0 0-4-4H2z" />
                            <path d="M22 3h-6a4 4 0 0 0-4 4v14a4 4 0 0 1 4-4h6z" />
                        </svg>
                        كتبي
                    </a>
                </li>

                <li class="@if (
                    $current_route == 'theme.my.bootcamps' ||
                        $current_route == 'theme.my.bootcamp.details' ||
                        $current_route == 'theme.my.bootcamp.invoice') active @endif">
                    <a href="{{ route('theme.my.bootcamps') }}">
                        <dotlottie-player src="{{ asset('assets/frontend/default/image/icons/bootcamp.json') }}"
                            background="transparent" speed="1" style="width: 30px; height: 30px;" part="lottie-svg"
                            loop autoplay @if ($current_route != 'theme.my.bootcamps') hover @endif></dotlottie-player>
                        <span> معسكراتي </span>
                    </a>
                </li>

                {{-- <li class="@if ($current_route == 'theme.my_bookings' || $current_route == 'theme.booking_invoice') active @endif">
                    <a href="{{ route('theme.my_bookings', ['tab' => 'live-upcoming']) }}" class="bootcamp-sidebar-icon text-capitalize">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" class="m-0">
                            <path d="M1.67188 7.5V6.66667C1.67188 4.16667 3.33854 2.5 5.83854 2.5H14.1719C16.6719 2.5 18.3385 4.16667 18.3385 6.66667V13.3333C18.3385 15.8333 16.6719 17.5 14.1719 17.5H13.3385" stroke="#6B7385" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M3.07812 9.7583C6.92813 10.25 9.75313 13.0833 10.2531 16.9333" stroke="#6B7385" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M2.1875 12.5586C5.0125 12.9169 7.08751 15.0003 7.45417 17.8253" stroke="#6B7385" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M1.65234 15.7168C3.06068 15.9001 4.10235 16.9335 4.28568 18.3501" stroke="#6B7385" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        المعسكرات
                    </a>
                </li> --}}

                {{-- <li class="@if (
                    $current_route == 'theme.my.team.packages' ||
                        $current_route == 'theme.my.team.packages.details' ||
                        $current_route == 'theme.team.package.invoice') active @endif">
                    <a href="{{ route('theme.my.team.packages') }}">
                        <dotlottie-player src="{{ asset('assets/frontend/default/image/icons/Team.json') }}"
                            background="transparent" speed="1" style="width: 30px; height: 30px;" part="lottie-svg"
                            loop autoplay @if ($current_route != 'theme.my.team.packages') hover @endif></dotlottie-player>
                        فريقي
                    </a>
                </li> --}}

                <li class="@if ($current_route == 'theme.my.profile') active @endif">
                    <a href="{{ route('theme.my.profile') }}">
                        <dotlottie-player src="{{ asset('assets/frontend/default/image/icons/user.json') }}"
                            background="transparent" speed="1" style="width: 30px; height: 30px;" part="lottie-svg"
                            loop autoplay @if ($current_route != 'theme.my.profile') hover @endif></dotlottie-player>
                        <span> حسابي </span>
                    </a>
                </li>


                <li class="@if ($current_route == 'theme.my.wallet' || $current_route == 'theme.wallet.charging') active @endif">
                    <a href="{{ route('theme.my.wallet') }}">
                        <dotlottie-player src="{{ asset('assets/frontend/default/image/icons/wallet.json') }}"
                            background="transparent" speed="1" style="width: 30px; height: 30px;" part="lottie-svg"
                            loop autoplay @if ($current_route != 'theme.my.wallet' && $current_route != 'theme.wallet.charging') hover @endif></dotlottie-player>
                        <span> محفظتي </span>
                    </a>
                </li>


                {{-- <li class="@if ($current_route == 'theme.wishlist') active @endif">
                    <a href="{{ route('theme.wishlist') }}">
                        <svg width="20" height="17" viewBox="0 0 20 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M9.99133 16.9092C9.77723 16.9092 9.56217 16.8707 9.34615 16.7938C9.13012 16.7168 8.94005 16.5963 8.77595 16.4322L7.33945 15.1265C5.56637 13.5098 3.98335 11.9217 2.5904 10.3621C1.19745 8.80244 0.500977 7.13162 0.500977 5.34959C0.500977 3.93037 0.979501 2.74224 1.93655 1.78519C2.8936 0.828135 4.08174 0.349609 5.50095 0.349609C6.30735 0.349609 7.10383 0.53551 7.89038 0.90731C8.67691 1.27911 9.38044 1.88296 10.001 2.71886C10.6215 1.88296 11.325 1.27911 12.1115 0.90731C12.8981 0.53551 13.6946 0.349609 14.501 0.349609C15.9202 0.349609 17.1083 0.828135 18.0654 1.78519C19.0224 2.74224 19.5009 3.93037 19.5009 5.34959C19.5009 7.15085 18.7926 8.84027 17.3759 10.4178C15.9593 11.9954 14.3798 13.5701 12.6375 15.1419L11.2163 16.4322C11.0522 16.5963 10.8606 16.7168 10.6413 16.7938C10.4221 16.8707 10.2054 16.9092 9.99133 16.9092ZM9.28173 4.23806C8.74071 3.41369 8.17116 2.80953 7.57308 2.42556C6.97499 2.04158 6.28429 1.84958 5.50095 1.84958C4.50095 1.84958 3.66762 2.18292 3.00095 2.84959C2.33429 3.51625 2.00095 4.34959 2.00095 5.34959C2.00095 6.15215 2.2596 6.99125 2.7769 7.86689C3.2942 8.74252 3.94355 9.61302 4.72495 10.4784C5.50637 11.3438 6.35284 12.1893 7.26438 13.0149C8.17591 13.8406 9.02079 14.6079 9.799 15.3169C9.8567 15.3682 9.92402 15.3938 10.001 15.3938C10.0779 15.3938 10.1452 15.3682 10.2029 15.3169C10.9811 14.6079 11.826 13.8406 12.7375 13.0149C13.6491 12.1893 14.4955 11.3438 15.277 10.4784C16.0584 9.61302 16.7077 8.74252 17.225 7.86689C17.7423 6.99125 18.001 6.15215 18.001 5.34959C18.001 4.34959 17.6676 3.51625 17.001 2.84959C16.3343 2.18292 15.501 1.84958 14.501 1.84958C13.7176 1.84958 13.0269 2.04158 12.4288 2.42556C11.8307 2.80953 11.2612 3.41369 10.7202 4.23806C10.6356 4.36626 10.5292 4.46242 10.401 4.52654C10.2727 4.59064 10.1394 4.62269 10.001 4.62269C9.8625 4.62269 9.72917 4.59064 9.60095 4.52654C9.47275 4.46242 9.36634 4.36626 9.28173 4.23806Z"
                                fill="#6B7385" />
                        </svg>
                        {{ get_phrase('Wishlist') }}
                    </a>
                </li> --}}

                {{-- <li class="@if ($current_route == 'theme.message') active @endif">
                    <a href="{{ route('theme.message') }}">
                        <dotlottie-player src="{{ asset('assets/frontend/default/image/icons/message.json') }}"
                            background="transparent" speed="1" style="width: 30px; height: 30px;" part="lottie-svg"
                            loop autoplay @if ($current_route != 'theme.message') hover @endif></dotlottie-player>
                        <span> الرسائل </span> --}}

                        {{-- @if ($unread_msg =
        App\Models\Message::where('receiver_id', auth()->user()->id)->where('read', null)->count() > 0)
                            <span class="badge bg-danger">{{ $unread_msg }}</span>
                        @endif --}}
                    {{-- </a>
                </li> --}}

                <li class="@if ($current_route == 'theme.purchase.history' || $current_route == 'theme.invoice') active @endif">
                    <a href="{{ route('theme.purchase.history') }}">
                        <dotlottie-player src="{{ asset('assets/frontend/default/image/icons/history.json') }}"
                            background="transparent" speed="1" style="width: 30px; height: 30px;" part="lottie-svg"
                            loop autoplay @if ($current_route != 'theme.purchase.history') hover @endif></dotlottie-player>
                        <span> فواتيري </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('logout') }}" class="d-flex">
                        <dotlottie-player src="{{ asset('assets/frontend/default/image/icons/logout.json') }}"
                            background="transparent" speed="1" style="width: 30px; height: 30px;" part="lottie-svg"
                            loop autoplay hover></dotlottie-player>
                        <span> تسجيل خروج </span>
                    </a>
                </li>
            </ul>
            {{-- @if (auth()->user()->role == 'student' && get_settings('allow_instructor'))
                <div class="my-course-btn justify-content-center mt-5">
                    <a href="{{ route('become.instructor') }}" class="eBtn gradient px-4">{{ get_phrase('Become an instructor') }}</a>
                </div>
            @endif --}}
        </div>
    </div>
</div>
