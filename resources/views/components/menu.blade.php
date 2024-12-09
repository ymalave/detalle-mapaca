<div>
    {{--  class="absolute left-0 top-0 z-9999 flex h-screen w-72.5 flex-col overflow-y-hidden bg-indigo-900 duration-300 ease-linear
         dark:bg-boxdark lg:static lg:translate-x-0 hover:translate-x-0"  --}}
    <aside :class="sidebarToggle ? 'translate-x-0 w-72.5' : 'w-0 sm:-translate-x-full lg:translate-x-0 lg:w-20'"
        class="absolute left-0 top-0 z-9999 flex h-screen flex-col overflow-y-hidden bg-indigo-900 duration-300 ease-linear
         dark:bg-boxdark lg:static hover:translate-x-0 hover:w-72.5 max-w-72.5"
        @click.outside="sidebarToggle = false">
        <!-- SIDEBAR HEADER -->
        <div class="flex items-center justify-between gap-2 px-6 py-5.5 lg:py-6.5">
            <a href="{{env('APP_URL')}}/dashboard">
                <img src="{{ env('APP_URL') }}/images/logo.png" alt="Logo" />
            </a>
        </div>
        <!-- SIDEBAR HEADER -->
        <div class="no-scrollbar flex flex-col overflow-y-auto duration-300 ease-linear">
            <nav class="mt-2">
                <ul class="mt-2 px-4 py-4 lg:mt-1 lg:px-6" data-widget="treeview" role="menu">
                    @foreach ($menu as $key => $item)
                        @include('./layouts/menu-item', ['item' => $item])
                    @endforeach
                </ul>
            </nav>
        </div>
    </aside>
</div>

