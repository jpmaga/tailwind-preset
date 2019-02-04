<nav class="py-4 relative flex items-center shadow bg-white px-6 text-sm">
    <div class="container flex flex-wrap items-center justify-between">
        <div class="mr-6">
            <a class="text-grey-darkest text-base font-medium no-underline" href="/">
                {{ config('app.name') }}
            </a>
        </div>

        <div class="block md:hidden">
            <a @click.prevent="displayNavigation = !displayNavigation"
               class="flex items-center no-underline text-grey-darkest hover:text-grey-darker" href="#">
                <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/>
                </svg>
            </a>
        </div>

        <div :class="{ hidden: !displayNavigation }"
             class="mt-6 md:mt-0 w-full md:w-auto md:flex md:flex-grow md:items-center">

            <div class="ml-auto">
                <ul class="-mb-6 md:-mr-6 md:mb-0 flex flex-col md:flex-row list-reset">
                    @auth
                        <li class="mb-6 md:mr-6 md:mb-0">
                            <a class="block md:inline text-grey-darkest hover:text-grey-darker no-underline" href="#"
                               onclick="document.querySelector('#logoutForm').submit()">
                                Logout
                            </a>
                        </li>
                        <form id="logoutForm" class="hidden" action="{{ route('logout') }}" method="POST">
                            @csrf
                        </form>
                    @else
                        <li class="mb-6 md:mr-6 md:mb-0">
                            <a class="block md:inline text-grey-darkest hover:text-grey-darker no-underline"
                               href="{{ route('login') }}">
                                Sign in
                            </a>
                        </li>

                        <li class="mb-6 md:mr-6 md:mb-0">
                            <a class="block md:inline text-grey-darkest hover:text-grey-darker no-underline"
                               href="{{ route('register') }}">
                                Sign up
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </div>
</nav>
