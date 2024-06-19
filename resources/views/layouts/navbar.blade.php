<div class="navbar bg-base-100">
    <div class="flex-1 navbar-start">
        <a href="{{ route('dashboard') }}" class="btn btn-ghost text-xl">SwapInStyle</a>
    </div>
    <div class="navbar-center">
        @unless(Request::Is('*/create') || Request::Is('*/edit/*'))
            @if (Request::routeIs('dashboard') || Request::Is('dashboard/*') || Request::routeIs('product.*')  || Request::Is('transaction'))
            <a href="{{route("product.create")}}" class="btn btn-primary text-xl">
                Nouveau article
                <svg class="stroke-current" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="8" x2="12" y2="16"></line>
                    <line x1="8" y1="12" x2="16" y2="12"></line>
                </svg>
            </a>
            @endif
            @if (Request::routeIs('category.*'))
            <a href="{{route('category.create')}}" class="btn btn-primary text-xl">
                Nouvelle catégorie
                <svg class="stroke-current" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="8" x2="12" y2="16"></line>
                    <line x1="8" y1="12" x2="16" y2="12"></line>
                </svg>
            </a>
            @endif
        @endunless
    </div>
    <div class="flex-none navbar-end">
        <ul class="menu menu-horizontal px-1 gap-2">
            <li class="font-bold pt-1">
                <a href="{{route("conversation.index")}}">
                    <svg class="stroke-current" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21.5 12H16c-.7 2-2 3-4 3s-3.3-1-4-3H2.5" />
                        <path
                            d="M5.5 5.1L2 12v6c0 1.1.9 2 2 2h16a2 2 0 002-2v-6l-3.4-6.9A2 2 0 0016.8 4H7.2a2 2 0 00-1.8 1.1z" />
                    </svg>
                </a>
            </li>
            <div class="dropdown dropdown-end">
                <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                    @unless (Auth::user()->profile_photo)
                        <div class="bg-neutral text-neutral-content rounded-full w-10">
                            <span class="text-3xl hover:cursor-default select-none">{{ Str::upper(Auth::user()->name[0]) }}</span>
                        </div>
                    @else
                        <div class="w-10 rounded-full">
                            <img alt="Tailwind CSS Navbar component"
                                src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg" />
                        </div>
                    @endunless

                </div>
                <ul tabindex="0"
                    class="mt-1 z-[1] p-2 shadow menu menu-sm dropdown-content bg-base-100 rounded-box gap-1">
                    <li><a href="{{route("profile", ['user' => Auth::id()] )}}">Profil</a></li>
                    <li><a href="{{route("transaction.index")}}">Transactions</a></li>
                    @if (Auth::user()->is_admin === 1)
                        <li><a href="{{ route('category.index') }}">Catégories</a></li>
                    @endif
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm text-red-500" type="submit">Deconnexion</button>
                    </form>
                </ul>


            </div>
        </ul>
    </div>
</div>
<div class="avatar placeholder">

</div>
