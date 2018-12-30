@extends('_layout')

@section('title', 'Add Transaction')

@section('content')
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">Add Transaction</div>

                <form class="card-body" method="post" action="{{ route('transactions.add') }}">
                    @include('_alerts')

                    <p>Add a new transaction:</p>

                    <div class="form-group">
                        <input type="text" name="title" class="form-control" placeholder="Title"
                               value="{{ old('title') }}" required pattern="[A-Za-z0-9\.\-]{2,}">
                    </div>

                    <div class="input-group mb-3 pl-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Helper:</span>
                        </div>
                        <input type="number" id="helper" class="form-control" placeholder="I have paid..."
                               min="100" max="100000000">
                    </div>

                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <input type="checkbox" id="{{ $u->username }}_box" aria-label="" checked
                                       class="contributor-box">
                            </div>
                        </div>
                        <input type="number" name="{{ $u->username }}" class="form-control contributor"
                               placeholder="{{ '@' . $u->username }}" value="{{ old($u->username) }}"
                               max="10000000">
                    </div>

                    @foreach($users as $user)
                        @if($user->id == Auth::id()) @continue @endif

                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <input type="checkbox" id="{{ $user->username }}_box" aria-label="" checked
                                           class="contributor-box">
                                </div>
                            </div>
                            <input type="number" name="{{ $user->username }}" class="form-control contributor"
                                   placeholder="{{ '@'.$user->username }}" value="{{ old($user->username) }}">
                        </div>
                    @endforeach

                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Add">
                        <a href="{{ route('transactions') }}" class="btn btn-secondary">Back to transactions</a>
                    </div>

                    {{ csrf_field() }}
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Find the related field to the given checkbox
        let relatedField = function (obj) {
            let id = obj.attr('id');
            return '[name=' + id.substr(0, id.length - 4) + ']';
        };

        // Disable/enable field based on checkbox state
        $('.contributor-box').on('change', function () {
            if ($(this).prop('checked')) {
                $(relatedField($(this))).prop('disabled', false)
            } else {
                $(relatedField($(this))).val('').prop('disabled', true)
            }

            $('#helper').keyup();
        });

        // On using helper
        $('#helper').on('keyup', function () {
            let value = $(this).val();
            if (value <= 0) {
                return;
            }

            let firstBox = $('.contributor-box:first');
            firstBox.prop('checked', true);

            $('.contributor-box:not(:checked)').each(function () {
                $(relatedField($(this))).val('');
            });

            let contributorsCount = $('.contributor-box:checked').length;

            if (contributorsCount < 2) {
                return;
            }

            let mother = Math.floor(value - value / contributorsCount);
            let others = Math.ceil(value / contributorsCount * -1);

            $(relatedField(firstBox)).val(mother);

            $('.contributor-box:checked:not(:first)').each(function () {
                $(relatedField($(this))).val(others);
            });
        });
    </script>
@endsection