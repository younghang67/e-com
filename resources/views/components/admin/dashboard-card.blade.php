@props(['title', 'numbers', 'viewroute'])


<div class="col-lg-2 col-sm-12  my-2 ">
    <div class="card border-1">
        <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
                <div class="avatar flex-shrink-0 ">
                    <img src="{{ asset('images/chart-success.png') }}" alt="chart success" class="rounded">
                </div>
                <div class="dropdown">
                    
                    @php
                        $route = ['services', 'news', 'certifications', 'projects', 'workshop', 'pages'];
                    @endphp
                    <div class="btn p-0" aria-labelledby="cardOpt3">
                        <a class=""
                            href="{{ route(in_array($viewroute, $route) ? 'pages.index' : $viewroute . '.index') }}">
                            <i class="fas fa-eye"></i>
                        </a>

                    </div>
                </div>
            </div>
            <span class="fw-medium d-block mb-1">{{ ucwords($title) }}</span>
            <h3 class="card-title mb-2">{{ $numbers }}</h3>
        </div>
    </div>
</div>
