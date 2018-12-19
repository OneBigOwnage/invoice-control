<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <div class="mr-auto">

                @inject('BreadCrumbs', '\App\BreadCrumbs')

                @if(!empty($BreadCrumbs->get()))
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">

                            @foreach ($BreadCrumbs->get() as $crumbText => $crumbURL)

                                @if ($loop->last)
                                    <li class="breadcrumb-item active" aria-current="page">
                                        {{ $crumbText }}
                                    </li>
                                @else
                                    <li class="breadcrumb-item">
                                        <a href="{!! $crumbURL !!}">
                                            {{ $crumbText }}
                                        </a>
                                    </li>
                                @endif

                            @endforeach

                        </ol>
                    </nav>
                @endif

            </div>
        </div>
    </div>
</div>
