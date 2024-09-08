<form method="POST" action="{{ route('confirm') }}">
    @csrf
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