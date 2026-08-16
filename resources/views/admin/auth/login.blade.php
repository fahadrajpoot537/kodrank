@extends('layouts.admin')

@section('body')
<div class="login-wrap">
  <div class="login-card">
    <h1 style="margin:0 0 6px;font-size:1.5rem">KodRank Admin</h1>
    <p style="margin:0 0 22px;color:#4B5B62">Sign in to manage homepage content</p>
    @if ($errors->any())
      <div class="err" style="margin-bottom:12px">{{ $errors->first() }}</div>
    @endif
    <form method="post" action="{{ route('admin.login.submit') }}">
      @csrf
      <div class="field">
        <label for="email">Email</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
      </div>
      <div class="field">
        <label for="password">Password</label>
        <input id="password" type="password" name="password" required>
      </div>
      <label style="display:flex;gap:8px;align-items:center;margin-bottom:16px;font-size:.9rem">
        <input type="checkbox" name="remember" value="1"> Remember me
      </label>
      <button class="btn" type="submit" style="width:100%;justify-content:center">Sign in</button>
    </form>
  </div>
</div>
@endsection
