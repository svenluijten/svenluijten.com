@php use App\Http\Controllers\Auth\AttemptLogin; @endphp

<form action="{{ action(AttemptLogin::class) }}" method="post">
    {{ csrf_field() }}

    <div>
        <label for="username">Username</label>
        <input type="text" id="username" name="username">
    </div>

    <div>
        <label for="password">Password</label>
        <input type="password" id="password" name="password">
    </div>

    <button type="submit">Login</button>
</form>
