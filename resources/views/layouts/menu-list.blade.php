<li class="pc-item pc-caption">
    <label>Navigation</label>
</li>

@can('concession-concession-module')
    <li class="pc-item pc-hasmenu">
        <a href="{{ route('concessions.index') }}" class="pc-link">
            <span class="pc-micon">
                <i class="ph-duotone ph-atom"></i>
            </span>
            <span class="pc-mtext">Concessions</span>
        </a>
    </li>
@endcan