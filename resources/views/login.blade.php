<x-layout>
<div class="container">

<h1 style="margin-bottom: 20px; font-family: 'Arial Black'; font-size: 40px; font-weight: bold">AddressBook</h1>

<form action="/login" method="post">
    @csrf
    <label for="email_login"><b>Email</b></label>
    <input id="email_login" type="text" placeholder="Enter email" name="email" required>

    <label for="password_login"><b>Password</b></label>
    <input id="password_login" type="password" placeholder="Enter Password" name="password" required>

    <button type="submit">Login</button>
    </form>
</div>
</x-layout>
