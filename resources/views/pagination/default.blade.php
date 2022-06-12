
   
@if ($paginator->lastPage() > 1)
<style> 

    .pagination {
        display: flex;
        justify-content: center;
    }
    .pagination li {
        list-style: none;
    }
    .page-link-item{
        padding: 4px 10px;
    }
</style>
<ul class="pagination d-flex mb-0">
    <li class="page-item {{ ($paginator->currentPage() == 1) ? ' disabled' : '' }}">
        <a class="page-link" href="{{ $paginator->url(1) }}">Trang trước</a>
    </li>
    @for ($i = 1; $i <= $paginator->lastPage(); $i++)
        <li class="page-item {{ ($paginator->currentPage() == $i) ? ' active' : '' }}">
            <a class="page-link page-link-item" href="{{ $paginator->url($i) }}">{{ $i }}</a>
        </li>
    @endfor
    <li class="page-item {{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}">
        <a class="page-link" href="{{ $paginator->url($paginator->currentPage()+1) }}" >Trang sau</a>
    </li>
</ul>
@endif