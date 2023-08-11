@extends('layouts.dashboard.app')

@section('title', 'Infrastructure')

@section('breadcrumb')
<x-dashboard::breadcrumb title="Infrastructure" page="Infrastructure" active="{{ $infrastructure->title }}" route="{{ route('infrastructure.index') }}" />
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div>
            <p>File: <a href="{{ url('assets/infrastructures/' . $infrastructure->file_pdf) }}" download>{{ $infrastructure->file_pdf }}</a></p>
            <p>Drafter: {{ $infrastructure->drafter }}</p>
            <p>PIC: {{ $infrastructure->user->name }}</p>
            <p>Progress: {{ $infrastructure->progress }}</p>
            <p>Keterangan: {{ $infrastructure->keterangan }}</p>
            <p>
                Revisi:
                <ul>
                    @foreach($infrastructure->revisions as $revisi)
                    <li>{{ $revisi->name . ': ' . $revisi->revisi}}</li>
                    @endforeach
                </ul>
            </p>
        </div>
    </div>
</div>
@endsection
