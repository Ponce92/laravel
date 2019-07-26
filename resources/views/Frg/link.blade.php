@if ($paginator->lastPage() > 1)
    <nav aria-label="...">
        <ul class="pagination">
            <li class="page-item {{ $paginator->currentPage() == 1 ? ' disabled' : '' }}">
                <a class="page-link" href="{{ $paginator->url(1) }}">Anterior</a>
            </li>
            @for ($i = 1; $i <= $paginator->lastPage(); $i++)
                <li class="page-item {{ $paginator->currentPage() == $i ? ' active' : '' }}">
                    <a class="page-link" href="{{ $paginator->url($i) }}">{{ $i }}</a>
                </li>
            @endfor
            <li class="page-item {{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}">
                <a class="page-link" href="{{ $paginator->url($paginator->currentPage()+1) }}" >Ultimo</a>
            </li>
        </ul>
    </nav>
@endif