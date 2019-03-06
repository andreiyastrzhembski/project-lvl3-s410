<?php ?>
@extends('layouts.app')

@section('content')
<table class="table">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">Name</th>
      <th scope="col">Updated at</th>
      <th scope="col">Created at</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($domains as $domain)
    <tr>
      <th scope="row">{{ $domain->id }}</th>
      <td><a href="/domains/{{ $domain->id }}">{{ $domain->name }}</a></td>
      <td>{{ $domain->updated_at }}</td>
      <td>{{ $domain->created_at }}</td>
    </tr>
    @endforeach
  </tbody>
</table>
@if (isset($pagination))
<div class="container">
  <div class="row align-items-center">
    {{ $domains->links() }}
  </div>
</div>
@endif
@endsection