@props(['count', 'label', 'icon', 'color', 'route'])

<div class="col-md-6 col-xl-3">
    <div class="card text-white bg-{{ $color }} h-100">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div>
                <h2 class="fw-bold">{{ $count }}</h2>
                <p class="mb-0">{{ $label }}</p>
            </div>
            <i class="bi bi-{{ $icon }} fs-1 text-white-50"></i>
        </div>
        <div class="card-footer text-end">
            <a href="{{ route($route) }}" class="text-white text-decoration-none px-2 py-1 dashboard-btn">
                More info <i class="bi bi-arrow-right-circle"></i>
            </a>
        </div>
    </div>
</div>
