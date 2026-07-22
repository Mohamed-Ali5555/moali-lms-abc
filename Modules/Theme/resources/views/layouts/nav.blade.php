<!-- Start Navbar -->
<nav id="main__navbar">
    <div class="container">
        <div class="navbar">
            <div class="brand">
                <!-- Logo Image -->
                <a href="{{ route('theme.home') }}">
                    <img src="{{ asset(get_theme_settings('logo') ?? '') }}" style="height: 50px" class="logo light" />
                    <img src="{{ asset(get_theme_settings('dark_logo') ?? '') }}" style="height: 50px"  class="logo dark" />
                </a>


                <!-- Choose Theme -->
                <div class="theme">
                    <button id="theme__button" class="switch__button" data-theme="light">
                        <svg width="24" height="24" fill="none" class="sun">
                            <path d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" fill="currentColor" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M12 4v1M18 6l-1 1M20 12h-1M18 18l-1-1M12 19v1M7 17l-1 1M5 12H4M7 7 6 6"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            </path>
                        </svg>
                        <svg width="24" height="24" fill="none" class="moon">
                            <path
                                d="M18 15.63c-.977.52-1.945.481-3.13.481A6.981 6.981 0 0 1 7.89 9.13c0-1.185-.04-2.153.481-3.13C6.166 7.174 5 9.347 5 12.018A6.981 6.981 0 0 0 11.982 19c2.67 0 4.844-1.166 6.018-3.37ZM16 5c0 2.08-.96 4-3 4 2.04 0 3 .92 3 3 0-2.08.96-3 3-3-2.04 0-3-1.92-3-4Z"
                                fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                        </svg>
                    </button>
                </div>
                @if (isset($page) && $page == 'play_vedio')
                    <div>
                        <a href="javascript:void(0);" class="video-zoom-btn p-2" id="fullscreen">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_3_915)">
                                    <path
                                        d="M8.08917 11.9108C8.415 12.2367 8.415 12.7633 8.08917 13.0892L2.845 18.3333H6.66667C7.1275 18.3333 7.5 18.7067 7.5 19.1667C7.5 19.6267 7.1275 20 6.66667 20H2.5C1.12167 20 0 18.8783 0 17.5V13.3333C0 12.8733 0.3725 12.5 0.833333 12.5C1.29417 12.5 1.66667 12.8733 1.66667 13.3333V17.155L6.91083 11.9108C7.23667 11.585 7.76333 11.585 8.08917 11.9108ZM17.5 0H13.3333C12.8725 0 12.5 0.373333 12.5 0.833333C12.5 1.29333 12.8725 1.66667 13.3333 1.66667H17.155L11.9108 6.91083C11.585 7.23667 11.585 7.76333 11.9108 8.08917C12.0733 8.25167 12.2867 8.33333 12.5 8.33333C12.7133 8.33333 12.9267 8.25167 13.0892 8.08917L18.3333 2.845V6.66667C18.3333 7.12667 18.7058 7.5 19.1667 7.5C19.6275 7.5 20 7.12667 20 6.66667V2.5C20 1.12167 18.8783 0 17.5 0Z"
                                        fill="#C7C7C7" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_3_915">
                                        <rect width="20" height="20" fill="white" />
                                    </clipPath>
                                </defs>
                            </svg>
                        </a>
                    </div>
                @endif
                <!-- Burger Button -->
                @if (!auth())
                    <button class="menu d-flex d-md-none" id="menu__toggle__btn" aria-label="Main Menu">
                        <svg width="100" height="60" viewBox="0 0 100 100">
                            <path class="line line1"
                                d="M 20,29.000046 H 80.000231 C 80.000231,29.000046 94.498839,28.817352 94.532987,66.711331 94.543142,77.980673 90.966081,81.670246 85.259173,81.668997 79.552261,81.667751 75.000211,74.999942 75.000211,74.999942 L 25.000021,25.000058" />
                            <path class="line line2" d="M 20,50 H 80" />
                            <path class="line line3"
                                d="M 20,70.999954 H 80.000231 C 80.000231,70.999954 94.498839,71.182648 94.532987,33.288669 94.543142,22.019327 90.966081,18.329754 85.259173,18.331003 79.552261,18.332249 75.000211,25.000058 75.000211,25.000058 L 25.000021,74.999942" />
                        </svg>
                    </button>
                @endif
            </div>
            @auth()
                <div class="buttons buttons-afterLogin">
                    {{-- <div class="user-dropdown dropdown">
                  <img src="{{asset('modules/theme/images/blank-user.svg')}}" alt="user" class="dropdown-toggle" data-bs-toggle="dropdown"
                    aria-expanded="false" />
                  <ul class="dropdown-menu">

                    <li>
                        <span class="px-4 py-2 d-flex dropdown-item gap-2" role="menuitem" tabindex="-1" href="#">
                          <span>أهلاً {{auth()->user()->name}} </span>
                        </span>
                    </li>
                    <hr>


                    <li>
                    <a class="px-4 py-2 d-flex dropdown-item gap-2 align-items-center" role="menuitem" tabindex="-1" href="{{ route('theme.my.profile') }}">
                      <span>
                       <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            aria-hidden="true" role="img" class="iconify iconify--carbon" width="1em" height="1em"
                            preserveAspectRatio="xMidYMid meet" viewBox="0 0 32 32">
                            <path fill="none"
                              d="M8.007 24.93A4.996 4.996 0 0 1 13 20h6a4.996 4.996 0 0 1 4.993 4.93a11.94 11.94 0 0 1-15.986 0M20.5 12.5A4.5 4.5 0 1 1 16 8a4.5 4.5 0 0 1 4.5 4.5">
                            </path>
                            <path fill="currentColor"
                              d="M26.749 24.93A13.99 13.99 0 1 0 2 16a13.9 13.9 0 0 0 3.251 8.93l-.02.017c.07.084.15.156.222.239c.09.103.187.2.28.3q.418.457.87.87q.14.124.28.242q.48.415.99.782c.044.03.084.069.128.1v-.012a13.9 13.9 0 0 0 16 0v.012c.044-.031.083-.07.128-.1q.51-.368.99-.782q.14-.119.28-.242q.451-.413.87-.87c.093-.1.189-.197.28-.3c.071-.083.152-.155.222-.24ZM16 8a4.5 4.5 0 1 1-4.5 4.5A4.5 4.5 0 0 1 16 8M8.007 24.93A4.996 4.996 0 0 1 13 20h6a4.996 4.996 0 0 1 4.993 4.93a11.94 11.94 0 0 1-15.986 0">
                            </path>
                          </svg>
                      </span>
                      <span> حسابي</span>
                    </a>
                    </li>


                    <li>
                        <a class="px-4 py-2 d-flex dropdown-item gap-2 align-items-center" role="menuitem" tabindex="-1" href="{{route('theme.my.wallet')}}">
                          <span>
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--solar" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path fill="currentColor" d="M5.75 7a.75.75 0 0 0 0 1.5h4a.75.75 0 0 0 0-1.5z"></path><path fill="currentColor" fill-rule="evenodd" d="M21.188 8.004q-.094-.005-.2-.004h-2.773C15.944 8 14 9.736 14 12s1.944 4 4.215 4h2.773q.106.001.2-.004c.923-.056 1.739-.757 1.808-1.737c.004-.064.004-.133.004-.197V9.938c0-.064 0-.133-.004-.197c-.069-.98-.885-1.68-1.808-1.737m-3.217 5.063c.584 0 1.058-.478 1.058-1.067c0-.59-.474-1.067-1.058-1.067s-1.06.478-1.06 1.067c0 .59.475 1.067 1.06 1.067" clip-rule="evenodd"></path><path fill="currentColor" d="M21.14 8.002c0-1.181-.044-2.448-.798-3.355a4 4 0 0 0-.233-.256c-.749-.748-1.698-1.08-2.87-1.238C16.099 3 14.644 3 12.806 3h-2.112C8.856 3 7.4 3 6.26 3.153c-1.172.158-2.121.49-2.87 1.238c-.748.749-1.08 1.698-1.238 2.87C2 8.401 2 9.856 2 11.694v.112c0 1.838 0 3.294.153 4.433c.158 1.172.49 2.121 1.238 2.87c.749.748 1.698 1.08 2.87 1.238c1.14.153 2.595.153 4.433.153h2.112c1.838 0 3.294 0 4.433-.153c1.172-.158 2.121-.49 2.87-1.238q.305-.308.526-.66c.45-.72.504-1.602.504-2.45l-.15.001h-2.774C15.944 16 14 14.264 14 12s1.944-4 4.215-4h2.773q.079 0 .151.002" opacity=".5"></path></svg>
                          </span>
                          <span> محفظتي</span>
                        </a>
                    </li>


                      <li>
                        <a class="px-4 py-2 d-flex dropdown-item gap-2 align-items-center" role="menuitem" tabindex="-1" href="{{route('theme.my.courses')}}">
                          <span>
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--ph" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 256 256"><g fill="currentColor"><path d="M232 56v144h-72a32 32 0 0 0-32 32a32 32 0 0 0-32-32H24V56h72a32 32 0 0 1 32 32a32 32 0 0 1 32-32Z" opacity=".2"></path><path d="M232 48h-72a40 40 0 0 0-32 16a40 40 0 0 0-32-16H24a8 8 0 0 0-8 8v144a8 8 0 0 0 8 8h72a24 24 0 0 1 24 24a8 8 0 0 0 16 0a24 24 0 0 1 24-24h72a8 8 0 0 0 8-8V56a8 8 0 0 0-8-8M96 192H32V64h64a24 24 0 0 1 24 24v112a39.8 39.8 0 0 0-24-8m128 0h-64a39.8 39.8 0 0 0-24 8V88a24 24 0 0 1 24-24h64Z"></path></g></svg>
                          </span>
                          <span> كورساتي</span>
                        </a>
                    </li>


                    <li>
                      <a class="px-4 py-2 d-flex dropdown-item gap-2 align-items-center" role="menuitem" tabindex="-1" href="{{route('theme.purchase.history')}}">
                        <span>
                          <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                    d="M11.9786 19.9C9.86839 19.9 8.06744 19.1949 6.57577 17.7846C5.0841 16.3744 4.25559 14.6378 4.09022 12.575C4.0697 12.393 4.1229 12.2436 4.24982 12.127C4.37674 12.0103 4.53167 11.9552 4.71462 11.9616C4.88679 11.968 5.0373 12.025 5.16615 12.1327C5.29498 12.2404 5.36645 12.3821 5.38055 12.5577C5.54466 14.2526 6.25236 15.6834 7.50364 16.8501C8.75491 18.0167 10.2466 18.6001 11.9786 18.6001C13.7953 18.6001 15.3495 17.9542 16.6411 16.6626C17.9328 15.3709 18.5786 13.8167 18.5786 12.0001C18.5786 10.1834 17.9328 8.62922 16.6411 7.33756C15.3495 6.04589 13.7953 5.40006 11.9786 5.40006C11.003 5.40006 10.0997 5.58935 9.26882 5.96793C8.43792 6.34652 7.72004 6.86747 7.1152 7.53081H9.0056C9.18974 7.53081 9.34411 7.59262 9.4687 7.71626C9.59328 7.83989 9.65557 7.99309 9.65557 8.17586C9.65557 8.35862 9.59328 8.51346 9.4687 8.64038C9.34411 8.76731 9.18974 8.83078 9.0056 8.83078H5.38254C5.15479 8.83078 4.96389 8.75374 4.80982 8.59966C4.65575 8.44559 4.57872 8.25468 4.57872 8.02693V4.40391C4.57872 4.21974 4.64054 4.06537 4.76417 3.94078C4.8878 3.8162 5.041 3.75391 5.22377 3.75391C5.40654 3.75391 5.56138 3.8162 5.6883 3.94078C5.81521 4.06537 5.87867 4.21974 5.87867 4.40391V7.02316C6.60687 6.13214 7.49533 5.42221 8.54404 4.89336C9.59276 4.36451 10.7376 4.10008 11.9786 4.10008C13.0753 4.10008 14.1025 4.30733 15.0602 4.72183C16.018 5.13631 16.8532 5.69994 17.566 6.41271C18.2788 7.12549 18.8424 7.96069 19.2569 8.91831C19.6714 9.87592 19.8786 10.903 19.8786 11.9995C19.8786 13.096 19.6714 14.1233 19.2569 15.0813C18.8424 16.0392 18.2788 16.8746 17.566 17.5874C16.8532 18.3002 16.018 18.8638 15.0602 19.2783C14.1025 19.6928 13.0753 19.9 11.9786 19.9ZM12.6575 11.3462L15.1575 13.8462C15.2959 13.9847 15.3626 14.1337 15.3575 14.2933C15.3524 14.4529 15.2774 14.6052 15.1325 14.7501C14.9876 14.8949 14.8328 14.9674 14.6681 14.9674C14.5033 14.9674 14.3485 14.8949 14.2037 14.7501L11.6109 12.1573C11.5291 12.0755 11.4665 11.9862 11.4229 11.8894C11.3793 11.7925 11.3575 11.6924 11.3575 11.5891V7.84193C11.3575 7.66006 11.4211 7.50762 11.5482 7.38461C11.6754 7.26157 11.8286 7.20006 12.0078 7.20006C12.1871 7.20006 12.3402 7.26235 12.4671 7.38693C12.594 7.51151 12.6575 7.66588 12.6575 7.85003V11.3462Z"
                                    fill="#6B7385" />
                            </svg>
                          </span>
                        <span> المشتريات</span>
                      </a>
                    </li>

                    <li>
                      <a type="button" onclick="document.getElementById('logoutForm').submit();"
                        class="px-4 py-2 d-flex dropdown-item gap-2 align-items-center" role="menuitem" tabindex="-1">
                        <form action="{{route('logout')}}" method="POST" id="logoutForm" class="d-none">
                          @csrf
                        </form>
                        <span>
                          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            aria-hidden="true" role="img" class="iconify iconify--icomoon-free" width="1em" height="1em"
                            preserveAspectRatio="xMidYMid meet" viewBox="0 0 16 16">
                            <path fill="currentColor" d="M12 10V8H7V6h5V4l3 3zm-1-1v4H6v3l-6-3V0h11v5h-1V1H2l4 2v9h4V9z">
                            </path>
                          </svg>
                        </span>
                        <span>تسجيل خروج</span>
                      </a>
                    </li>
                  </ul>
                </div> --}}

                    <div class="Userprofile">
                        <button class="us-btn dropdown-toggle py-1 border-0" type="button" data-bs-toggle="dropdown"
                            aria-expanded="true">
                            <img class="image-40" src="{{ get_image(Auth()->user()->photo) }}" alt="user-img">
                        </button>
                        <ul class="dropdown-menu dropmenu-end userDropDown " data-popper-placement="bottom-start">
                            <li class="figure_user d-flex">
                                <img src="{{ get_image(Auth()->user()->photo) }}" alt="user-img">
                                <div class="figure_text">
                                    <h4>{{ ucfirst(Auth()->user()->name) }}</h4>
                                    <p>{{ ucfirst(Auth()->user()->role) }}</p>
                                </div>
                            </li>

                            @if (in_array(auth()->user()->role, ['admin', 'instructor']))
                                <li>
                                    <a class="dropdown-item" href="{{ route(auth()->user()->role . '.dashboard') }}">
                                        <dotlottie-player
                                            src="{{ asset('assets/frontend/default/image/icons/dashboard.json') }}"
                                            background="transparent" speed="1" style="width: 30px; height: 30px;"
                                            part="lottie-svg" loop autoplay hover></dotlottie-player>

                                        لوحة التحكم
                                    </a>
                                </li>
                            @endif

                            @if (Auth()->user()->role != 'admin' && Auth()->user()->role != 'instructor')
                                <li>
                                    <a class="dropdown-item" href="{{ route('theme.my.courses') }}">
                                        <dotlottie-player
                                            src="{{ asset('assets/frontend/default/image/icons/courses.json') }}"
                                            background="transparent" speed="1" style="width: 30px; height: 30px;"
                                            part="lottie-svg" loop autoplay hover></dotlottie-player>
                                        كورساتي
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('theme.my.books') }}">
                                        <dotlottie-player
                                            src="{{ asset('assets/frontend/default/image/icons/courses.json') }}"
                                            background="transparent" speed="1" style="width: 30px; height: 30px;"
                                            part="lottie-svg" loop autoplay hover></dotlottie-player>
                                        كتبي
                                    </a>
                                </li>

                                <li>
                                    <a class="dropdown-item" href="{{ route('theme.my.profile') }}">
                                        <dotlottie-player
                                            src="{{ asset('assets/frontend/default/image/icons/user.json') }}"
                                            background="transparent" speed="1" style="width: 30px; height: 30px;"
                                            part="lottie-svg" loop autoplay hover></dotlottie-player>
                                        حسابي
                                    </a>
                                </li>

                                <li>
                                    <a class="dropdown-item" href="{{ route('theme.my.wallet') }}">
                                        <dotlottie-player
                                            src="{{ asset('assets/frontend/default/image/icons/wallet.json') }}"
                                            background="transparent" speed="1" style="width: 30px; height: 30px;"
                                            part="lottie-svg" loop autoplay hover></dotlottie-player>

                                        محفظتي
                                    </a>
                                </li>
                                {{-- <li>
                                    <a class="dropdown-item" href="{{ route('theme.my.bootcamps') }}" id="bootcamp-icon">
                                        <dotlottie-player
                                            src="{{ asset('assets/frontend/default/image/icons/bootcamp.json') }}"
                                            background="transparent" speed="1" style="width: 30px; height: 30px;"
                                            part="lottie-svg" loop autoplay hover></dotlottie-player>
                                        معسكراتي
                                    </a>
                                </li>

                                <li>
                                    <a class="dropdown-item" href="{{ route('theme.message') }}">
                                        <dotlottie-player
                                            src="{{ asset('assets/frontend/default/image/icons/message.json') }}"
                                            background="transparent" speed="1" style="width: 30px; height: 30px;"
                                            part="lottie-svg" loop autoplay hover></dotlottie-player>
                                        الرسائل
                                    </a>
                                </li> --}}

                                <li>
                                    <a class="dropdown-item" href="{{ route('theme.purchase.history') }}">
                                        <dotlottie-player
                                            src="{{ asset('assets/frontend/default/image/icons/history.json') }}"
                                            background="transparent" speed="1" style="width: 30px; height: 30px;"
                                            part="lottie-svg" loop autoplay hover></dotlottie-player>
                                        فواتيري
                                    </a>
                                </li>


                                <li>
                                    <a class="dropdown-item" href="{{ route('theme.my.bootcamps') }}">
                                        <dotlottie-player
                                            src="{{ asset('assets/frontend/default/image/icons/history.json') }}"
                                            background="transparent" speed="1" style="width: 30px; height: 30px;"
                                            part="lottie-svg" loop autoplay hover></dotlottie-player>

                                            معسكراتي
                                    </a>
                                </li>
                            @endif

                            <li>
                                <a class="dropdown-item mb-0" href="{{ route('logout') }}">
                                    <dotlottie-player src="{{ asset('assets/frontend/default/image/icons/logout.json') }}"
                                        background="transparent" speed="1" style="width: 30px; height: 30px;"
                                        part="lottie-svg" loop autoplay hover></dotlottie-player>
                                    خروج
                                </a>
                            </li>
                        </ul>
                    </div>

                    @php
                        $numberof_wishlist_item = App\Models\CartItem::where('user_id', auth()->user()->id)->sum('qty');

                    @endphp

                    <div class="cart-button position-relative" id="cart-button">
                        <a href="{{ route('theme.cart') }}">
                            <dotlottie-player id="cart_icon_player"
                                src="{{ asset('assets/frontend/default/image/icons/cart.lottie') }}"
                                background="transparent" speed="1" style="width: 50px; height: 50px;"
                                part="lottie-svg" loop autoplay></dotlottie-player>
                        </a>


                        <span class="cart-number" id="cart-number">{{ $numberof_wishlist_item }}</span>
                    </div>

                    @if (auth()->check())
                        <div class="balance-container" onclick="window.location.href='{{ route('theme.my.wallet') }}'">
                            <div class="wallet-icon">
                                <dotlottie-player
                                    src="{{ asset('assets/frontend/default/image/icons/wallet-fill.json') }}"
                                    background="transparent" speed="1" style="width: 30px; height: 30px;"
                                    part="lottie-svg" loop autoplay></dotlottie-player>
                            </div>
                            <div class="balance-details">
                                <!--<span class="balance-label">رصيدك</span>-->
                                <div class="balance-amount">
                                    <span>{{ number_format(auth()->user()->wallet, 0) }}</span>
                                    <span class="currency">جنية</span>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            @else
                <div class="buttons d-none d-md-block" id="menu__btns">

                    <a href="{{ route('theme.show_login') }}" class="btn btn-hero-secondary">
                        <span>تسجيل الدخول</span>
                    </a>

                    <a href="{{ route('theme.show_register') }}" class="btn btn-hero-primary">
                        <i data-lucide="user-plus" class="me-2"></i>
                        <span> انشئ حسابك الآن</span>
                    </a>
                </div>
            @endauth()
        </div>
    </div>
    <div class="progress-indicator">
        <div class="progress-bar" id="myBar"></div>
    </div>
</nav>
<!-- End Navbar -->
