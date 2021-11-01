<form method="POST" action="/login">
    @csrf
    <label for="email_login">Email</label>
    <br>
    <input type="text" id="email_login" name="email" required>
    <br>
    <label for="password_login">Password</label>
    <br>
    <input type="password" id="password_login" name="password" required>
    <br>
    <input type="submit" value="Login">
</form>
