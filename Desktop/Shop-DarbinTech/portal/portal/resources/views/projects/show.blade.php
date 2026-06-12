@extends('layouts.portal')
@section('title', $project->name)

@section('content')
    <livewire:client.project-detail :project="$project" />
@endsection
