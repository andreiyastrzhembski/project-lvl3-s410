<?php ?>
@extends('layouts.app')

@section('content')
<div class="jumbotron">
  <h1 class="display-4">Page Analyzer</h1>
  <p class="lead">Enter URL to start</p>
  <form action="{{ route('domainsAdd') }}" method="POST" class="form-inline">
    <div class="form-group mx-sm-1">
      <input type="text" name="url" id="inputUrl" required class="form-control">
    </div>
    <br>
    <button type="submit" class="btn btn-primary btn-lg">Submit</button>
  </form>
</div>

@if (isset($error))
  <div class="alert alert-danger" role="alert">
    {{ $error }}
  </div>
@endif
@endsection