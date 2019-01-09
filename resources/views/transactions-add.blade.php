@extends('_layout')

@section('title', 'Add Transaction')

@section('content')
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">Add Transaction</div>

                <form class="card-body" method="post" action="{{ route('transactions.add') }}">
                    @include('_alerts')

                    <div class="form-group">
                        <input type="text" name="title" class="form-control" placeholder="Title"
                               title="What I have paid for" value="{{ old('title') }}" required
                               pattern="[A-Za-z0-9\.\-\s]{2,}">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Helper:</span>
                        </div>
                        <input type="number" id="helper" class="form-control" placeholder="Paid... (Toman)"
                               min="100" max="10000000" title="Money I have paid...">
                    </div>

                    @foreach($users as $i => $user)
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <input type="checkbox" id="{{ $user->username }}_box" aria-label="" checked
                                           class="contributor-box">
                                    <span class="ml-2 text-left" style="width:50px">{{ $user->username }}</span>
                                </div>
                            </div>
                            <input type="number" name="{{ $user->username }}"
                                   class="form-control contributor"
                                   placeholder="0 Toman" value="{{ old($user->username) }}">
                        </div>
                    @endforeach

                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Add">
                        <a href="{{ route('transactions.index') }}" class="btn btn-secondary">Back to transactions</a>
                    </div>

                    {{ csrf_field() }}
                </form>

                <div class="card-footer text-muted">&copy; {{ date('Y ') . config('app.name') }}</div>
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
        }).change();

        $('.contributor').on('change keyup', function () {
            if ($(this).val() < 0) {
                $(this).css('background', 'rgba(220, 53, 69, 0.2)');
            } else if ($(this).val() > 0) {
                $(this).css('background', 'rgba(40, 167, 69, 0.2)');
            } else {
                $(this).css('background', '');
            }
        });

        // On using helper
        $('#helper').on('change keyup', function () {
            let value = $(this).val();
            let contributors = $('.contributor');

            if (value < 100) {
                contributors.val('');
                return;
            }

            let firstBox = $('.contributor-box:first').prop('checked', true);

            $('.contributor-box:not(:checked)').each(function () {
                $(relatedField($(this))).val('');
            });

            let contributorsCount = $('.contributor-box:checked').length;

            if (contributorsCount < 2) {
                contributors.val('');
                return;
            }

            let mother = Math.floor(value - value / contributorsCount);
            let others = Math.ceil(value / contributorsCount * -1);

            $(relatedField(firstBox)).val(mother);

            $('.contributor-box:checked:not(:first)').each(function () {
                $(relatedField($(this))).val(others);
            });

            contributors.change();
        });
    </script>
@endsection