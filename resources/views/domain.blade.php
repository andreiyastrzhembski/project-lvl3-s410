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
      <th scope="col">Status code</th>
      <th scope="col">Content length</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($domains as $domain)
    <tr>
      <th scope="row">{{ $domain->id }}</th>
      <td><a href="{{ route('domainsShow', ['id' => $domain->id]) }}">{{ $domain->name }}</a></td>
      <td>{{ $domain->updated_at }}</td>
      <td>{{ $domain->created_at }}</td>
      <td>{{ $domain->status_code }}</td>
      <td>{{ $domain->content_length }}</td>
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