                <nav class="navbar navbar-expand-sm bg-primary" data-bs-theme="dark">

                    <div class="container-xxl">
                        <a href="/">
                            <img href="/" src="/pics/my-hiking-logo.png" alt="logo" style="width:2.5rem;">
                        </a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarColor01">
                            <ul class="navbar-nav me-auto">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('secondPage') }}">Add a-y</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('activities.index') }}">Activities</a>
                                </li>
                            </ul>


                            @if (Route::has('login'))
                                <div class="flex items-center lg:order-2">
                                    @auth
                                        <div class="btn-group dropstart" role="group">
                                            <button id="btnGroupDrop1" type="button" class="btn btn-info dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                @if (Auth::user()->avatar)
                                                <img src="{{Auth::user()->avatar}}" style="height:2rem" class="rounded" alt="{{Auth::user()->name}}">
                                                @endif
                                                {{ Auth::user()->name }}
                                            </button>
                                            <div class="dropdown-menu bg-info" aria-labelledby="btnGroupDrop1">
                                                <a class="dropdown-item text-light" href="{{ route('logout') }}" data-method="post" rel="nofollow">{{ __('Log Out') }}</a>
                                            </div>
                                        </div>                                        
                                    @else
                                        <a href="{{ route('login') }}" class="btn btn-info">
                                            Log In
                                        </a>
                                    @endauth
                                </div>
                            @endif

                        </div>
                    </div>
                </nav>