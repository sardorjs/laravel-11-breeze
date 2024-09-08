<form method="POST" action="{{ route('my-login') }}">
    @csrf

    <input type="text" name="email"><br>
    <input type="password" name="password"><br>
    

    <input type="submit" value="Submit"> <br>
</form>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif