@php
    $existSubMenu = isset($item['submenu']);
@endphp

@if (empty($item['is_hidden']))
    <li class="nav-item">
        <a href="{{ $existSubMenu ? '#' : url($item['url']) }}" class="nav-link">
            <i class="nav-icon {{ $item['icon'] ?? 'far fa-circle' }}"></i>
            <p>
                {{ $item['text'] }}
                @if ($existSubMenu)
                    <i class="right fas fa-angle-left"></i>
                @endif
            </p>
        </a>
        @if ($existSubMenu)
            <ul class="nav nav-treeview">
                @each('admin._share.menu', $item['submenu'], 'item')
            </ul>
        @endif
    </li>
@endif
