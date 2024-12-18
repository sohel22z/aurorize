@extends('layouts.admin')

@php
$is_update = false;
if(isset($settings)){
    $is_update = true;
}
@endphp

@section('title') Settings @endsection

@section('breadcrumb')
<div class="row page-title">
    <div class="col-md-12">
        <h4 class="mb-1 mt-0 font-weight-medium">Settings</h4>
    </div>
</div>
@endsection

@section('content')
<div class="content-body">
    <div class="row match-height">
        <div class="col-md-12">
            <div class="card border-info border-bottom-2">
                <div class="card-content collapse show">
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.save.settings') }}" class="form-horizontal settings-form-validate" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            @if($is_update)
                            <input type="hidden" name="id" value="{{ $settings->id }}">
                            @endif
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="android_version"> Total Claim  <span class="text-danger"> * </span></label>
                                    <input type="text" class="form-control @error('android_version') is-invalid @enderror" placeholder="Android Version" name="android_version" id="android_version" value="{{ $is_update ? (old('android_version') != "" ? old('android_version') : $settings->android_version) : old('android_version') }}">
                                    @error('android_version')
                                        <label id="android_version-error" class="invalid-feedback" for="android_version">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="ios_version"> iOS Version <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('ios_version') is-invalid @enderror" placeholder="iOS Version" name="ios_version" id="ios_version" value="{{ $is_update ? (old('ios_version') != "" ? old('ios_version') : $settings->ios_version) : old('ios_version') }}">
                                    @error('ios_version')
                                        <label id="ios_version-error" class="invalid-feedback" for="ios_version">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="ios_version"> iOS Version <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('ios_version') is-invalid @enderror" placeholder="iOS Version" name="ios_version" id="ios_version" value="{{ $is_update ? (old('ios_version') != "" ? old('ios_version') : $settings->ios_version) : old('ios_version') }}">
                                    @error('ios_version')
                                        <label id="ios_version-error" class="invalid-feedback" for="ios_version">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-actions center">
                                <a href="{{ route('admin.dashboard') }}" class="btn btn-md btn-danger btn-min-width mr-1"> {{ __('Cancel') }} </a>
                                <button type="submit" class="btn btn-primary btn-min-width">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 

@section('script-bottom')
<script type="text/javascript"></script>
<script src="{{ Helper::assets('assets/js/pages/admin/settings.js') }}" type="text/javascript"></script>
@endsection
