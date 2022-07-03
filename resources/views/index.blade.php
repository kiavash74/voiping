<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <title>voiping test</title>
</head>
<body>

<div>

    {{--    select user for display calls START--}}
    <form method="POST" action="{{ route('show') }}">
        @csrf
        <div class="form-group">
            <label for="user">Select User</label>
            <select name="id" id="user">
                @if (empty($users))
                    <option value="">empty</option>
                @else
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">
                            {{ $user->name }}
                        </option>
                    @endforeach
                @endif
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    {{--    select user form for display calls END--}}

    {{--    calls list START--}}
    @if(session('calls'))
        @php
            $calls = session('calls');
        @endphp
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#id</th>
                    <th scope="col">Contact Name</th>
                    <th scope="col">Last Call</th>
                </tr>
            </thead>
            <tbody>
                @foreach($calls as $call)
                    <tr>
                        <th scope="row">{{$call->id}}</th>
                        <td>{{$call->name}}</td>
                        <td>{{$call->call_date}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    {{--    calls list END--}}
</div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</html>
