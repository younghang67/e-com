@props(['name', 'title'])

<button type="button" class="btn  me-2 d-flex align-content-center" data-toggle="modal" data-target="#{{ $name }}" data-whatever="@mdo">
    <span class="fe fe-plus fe-16 text-muted"></span>&nbsp; Add
</button>


<div class="modal fade bd-example-modal-xl" id="{{ $name }}" tabindex="-1" role="dialog"
    aria-labelledby="varyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="varyModalLabel">{{ $title }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ $slot }}
            </div>

        </div>
    </div>
</div>
