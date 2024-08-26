<nav class="bg-white dark:bg-black border-b dark:border-gray-700">
    <div class="px-4 py-3 sm:px-6 lg:px-8 flex justify-between items-center">
        <button @click="sidebarOpen = true" class="md:hidden text-gray-500 dark:text-gray-400">
            <x-slate::icon icon="carbon-menu" />
        </button>
        <div class="flex-nowrap text-nowrap">
            <x-slate::button icon="carbon-flash-filled" color="white">
                {{ config('app.name', 'Electrik') }}
            </x-slate::button>
        </div>
        <div class="hidden w-full md:block md:w-auto" id="navbar-default">
            <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                <li>
                    <a href="{{ url('/') }}" 
                        class="'block py-2 px-3 hover:text-blue-700 dark:hover:text-blue-500 {{ url()->current() == url('/') ? 'underline text-blue-600 dark:text-blue-500' : 'dark:text-white text-gray-900 hover:bg-gray-100'}}'"
                        aria-current="page">Home</a>
                </li>
                <li>
                    <a href="{{ url('docs') }}" 
                    class="'block py-2 px-3 hover:text-blue-700 dark:hover:text-blue-500 {{ request()->routeIs('docs.show') ? 'underline text-blue-600 dark:text-blue-500' : 'dark:text-white text-gray-900 hover:bg-gray-100'}}'"
                    >Documentation</a>
                </li>
            </ul>

        </div>
        <div class="inline-flex items-center space-x-4">
            <div><x-slate::dark-mode-toggle /></div>
            <div><x-slate::button size="sm" color="black" icon="carbon-logo-github" href="https://github.com/electrikhq" target=_blank>Github</x-slate::button></div>
        </div>
    </div>
</nav>