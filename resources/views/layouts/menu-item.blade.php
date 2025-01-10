@if ($item['children'] == [])
<li>
    <a class="group relative flex items-center gap-2.5 rounded-sm px-4 py-2 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4"
        href="{{ url($item['url']) }}"
        class="bg-graydark dark:bg-meta-4">
        <i class="far {{ $item['attributes']['icon'] }} nav-icon mr-2"></i>
        <p class="ml-3">{{ $item['title'] }}</p>
    </a>
</li>
@else
<li class="relative group">
    <a href="{{ url($item['url']) }}" class="group relative flex items-center gap-2.5 rounded-sm px-4 py-2 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4">
        <i class="nav-icon fas {{ $item['attributes']['icon'] }}"></i>
        <span class="hidden w-72.5:block ml-3">{{ $item['title'] }}</span>
        <i class="right fas fa-angle-left ml-auto transition-transform duration-300 ease-in-out group-hover:rotate-90"></i>
    </a>
    <ul class="hidden group-hover:block">
        @foreach ($item['children'] as $submenu)
            @if (empty($submenu['children']))
                <li class="relative">
                    <a href="{{ url($submenu['url']) }}" class="group relative flex items-center gap-2.5 rounded-sm px-4 py-2 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4">
                        <i class="far {{ $submenu['attributes']['icon'] }} nav-icon"></i>
                        <span class="hidden w-72.5:block ml-3">{{ $submenu['title'] }}</span>
                    </a>
                </li>
            @else
                @include('layouts/menu-item', ['item' => $submenu])
            @endif
        @endforeach
    </ul>
</li>

@endif
