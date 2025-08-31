@php use Illuminate\Support\Str; @endphp
@props([
    'columns',
    'values',
    'edit_route' => null,
    'delete_route' => null,
    'view_route' => null,
    'hidden_field' => [],
    'status_route' => null,
    'action' => null,
    'view_mode' => 'modal',
])

<div class="mt-3">
    @if (empty($values[0]))
        <h4 class="mt-2 text-muted text-center">No data found!</h4>
    @else
        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>SN</th>
                        @foreach ($values[0]->getAttributes() as $key => $val)
                            @if (!in_array($key, $hidden_field))
                                <th scope="col">{{ Str::ucfirst(str_replace('_', ' ', $key)) }}</th>
                            @endif
                        @endforeach
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($values as $value)
                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            {{-- Image column --}}
                            @isset($value->image)
                                <td>
                                    <div class="avatar avatar-md">
                                        <img src="{{ $value->image }}" class="avatar-img" alt="">
                                    </div>
                                </td>
                            @endisset

                            {{-- Dynamic Columns --}}
                            @foreach ($value->getAttributes() as $key => $val)
                                @if (!in_array($key, $hidden_field))
                                    <td>
                                        @if ($key === 'description' || $key === 'categories')
                                            {!! Str::limit(strip_tags($val), 30, '...') !!}
                                        @elseif ($key === 'viewed')
                                            @if ($val == 0)
                                                <span class="badge bg-success">New</span>
                                            @endif
                                        @elseif (Str::endsWith($key, '_id'))
                                            @php
                                                $relation = Str::beforeLast($key, '_id');
                                                $related = $value->$relation ?? null;
                                            @endphp
                                            {{ $related?->name ?? ($related?->title ?? ($related?->email ?? '—')) }}
                                        @elseif ($key === 'status')
                                            <form action="{{ route($status_route, $value->id) }}" method="POST"
                                                style="display:inline-block;">
                                                @csrf
                                                @method('PATCH')
                                                <select name="status" onchange="this.form.submit()"
                                                    class="form-select form-select-sm">
                                                    @foreach (['pending', 'confirmed', 'shipped', 'delivered', 'completed', 'cancelled'] as $statusOption)
                                                        <option value="{{ $statusOption }}"
                                                            {{ $value->status === $statusOption ? 'selected' : '' }}>
                                                            {{ ucfirst($statusOption) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </form>
                                        @else
                                            {{ Str::limit($val, 30, '...') }}
                                        @endif
                                    </td>
                                @endif
                            @endforeach

                            {{-- Actions --}}
                            <td>
                                {{-- View Modal --}}
                                {{-- View --}}
                                @if ($view_route)
                                    @if ($view_mode === 'link')
                                        {{-- Link to full page --}}
                                        <a href="{{ route($view_route, [$value->id]) }}" class="btn btn-sm">
                                            <i class="fe fe-eye"></i>
                                        </a>
                                    @else
                                        {{-- Old Modal View --}}
                                        <button type="button" class="btn btn-sm" data-toggle="modal"
                                            data-target="#view{{ $value->id }}">
                                            <i class="fe fe-eye"></i>
                                        </button>

                                        <div class="modal fade bd-example-modal-xl" id="view{{ $value->id }}"
                                            tabindex="-1" role="dialog" aria-labelledby="verticalModalTitle"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="verticalModalTitle">View</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <x-admin.table-view :values="$value" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endif


                                <div class="modal fade bd-example-modal-xl" id="view{{ $value->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="verticalModalTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="verticalModalTitle">View</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <x-admin.table-view :values="$value" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Edit --}}
                                @if ($edit_route)
                                    <a href="{{ route($edit_route, [$value->id]) }}">
                                        <i class="fe fe-edit"></i>
                                    </a>
                                @endif

                                {{-- Delete Modal --}}
                                @if ($delete_route)
                                    <button type="button" class="btn btn-sm text-danger" data-toggle="modal"
                                        data-target="#deleteModal{{ $value->id }}">
                                        <i class="fe fe-trash"></i>
                                    </button>

                                    <div class="modal fade" id="deleteModal{{ $value->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="verticalModalTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Delete Confirmation</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close"><span>&times;</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete this item?
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="{{ route($delete_route, [$value->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        <input type="submit" value="Delete" class="btn btn-danger">
                                                    </form>
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="my-4 d-flex justify-content-center">
            {{ $values->links() }}
        </div>
    @endif
</div>
