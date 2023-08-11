@extends('layouts.dashboard.app')

@section('title', 'Infrastructure')

@section('breadcrumb')
<x-dashboard::breadcrumb title="Infrastructure" page="Infrastructure" active="Infrastructure" route="{{ route('infrastructure.index') }}" />
@endsection

@section('content')
<div class="row">

  @foreach($infrastructures as $infrastructure)
  <div class="col-sm-6 col-xl-3">
    <div class="card">
      <img class="card-img-top img-fluid" src="{{ asset('assets/infrastructures/' . $infrastructure->thumbnail) }}" alt="Card image cap">
      <div class="card-body">
        <h4 class="card-title mb-2">{{ $infrastructure->title }}</h4>
        <p class="card-text mb-0">{{ strlen($infrastructure->body) > 64 ? substr($infrastructure->body, 0, 64) . '...' : $infrastructure->body }}</p>
      </div>
      <div class="card-footer">
        <a href="{{ route('infrastructure.show', $infrastructure->slug) }}" class="card-link link-secondary">Read More <i class="ri-arrow-right-s-line ms-1 align-middle lh-1"></i></a>
      </div>
    </div><!-- end card -->
  </div><!-- end col -->
  @endforeach

</div>

<div class="py-3">
  {{ $infrastructures->links() }}
</div>
@endsection
