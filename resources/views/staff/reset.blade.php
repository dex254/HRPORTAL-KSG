<div>
    <!-- It is not the man who has too little, but the man who craves more, that is poor. - Seneca -->
    <!-- resources/views/staff/reset.blade.php -->
<form action="{{ route('password.reset') }}" method="POST">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">

    <label for="email">Email:</label>
    <input type="email" name="email" required>

    <label for="password">New Password:</label>
    <input type="password" name="password" required>

    <label for="password_confirmation">Confirm Password:</label>
    <input type="password" name="password_confirmation" required>

    <button type="submit">Reset Password</button>

    @if ($errors->any())
        <div>
            <strong>{{ $errors->first('email') }}</strong>
        </div>
    @endif
</form>

</div>
