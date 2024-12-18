@extends('layouts.admin')

@php
$is_update = false;
if(isset($user)){
    $is_update = true;
}
@endphp
@section('title') {{ $is_update ? 'Edit' : 'Add' }} user @endsection

@section('breadcrumb')
<div class="row page-title align-items-center">
    <div class="col-sm-6 col-xl-6">
        <h4 class="mb-1 mt-0 font-weight-medium">{{ $is_update ? 'Edit' : 'Add New' }} user</h4>
    </div>
</div>
@endsection

@section('css')

@endsection

@section('content')
<div class="content-body">
    <div class="row match-height">
        <div class="col-md-12">
            <div class="card border-info border-bottom-2">
                <div class="card-content collapse show">
                    <div class="card-body">
                        <form method="POST" action="{{ $is_update ? route('admin.user.update', $user->id) : route('admin.user.store') }}" class="form-horizontal form-validate" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            @if($is_update)
                            <input type="hidden" name="id" value="{{ $user->id }}">
                            @method('PUT')
                            @endif
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>User Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Name" value="{{ ($is_update ? $user->name : old('name'))}}">
                                    @error('name')
                                        <span id="name-error" class="invalid-feedback" for="name">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Email <span class="text-danger">*</span></label>
                                    <input type="email" name="email" class="form-control" id="email" placeholder="Email" value="{{ ($is_update ? $user->email : old('email'))}}" @if($is_update) disabled @endif>
                                    @error('email')
                                        <span id="email-error" class="invalid-feedback" for="email">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            {{-- <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="photo"> Profile picture</label>
                                    <fieldset>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input form-control @error('photo') is-invalid @enderror" id="photo" name="photo" accept="image/*">
                                            <label class="custom-file-label" for="photo">{{ $is_update && $user->photo != "" ? $user->photo : 'Choose file' }}</label>
                                            <img src="{{ $is_update && $user->photo != "" ? Helper::images(config('constant.profile_image_url') . $user->photo) : '#' }}" class="custom-file-image" style="display: {{ $is_update && $user->photo != "" ? 'inline-block' : 'none' }};" />
                                        </div>
                                        <small class="form-text text-muted">Recommended size: Max 2MB. Accepted file formats: png, jpg and jpeg</small>
                                        @if($is_update)
                                        <input type="hidden" name="old_photo" id="old_photo" value="{{ $user->photo }}">
                                        @endif
                                        @error('photo')
                                            <label id="flag-error" class="invalid-feedback" for="photo">{{ $message }}</label>
                                        @enderror
                                    </fieldset>
                                </div>
                            </div> --}}
                            <div class="form-actions center">
                                <a href="{{ route('admin.user.index') }}"><button type="button" class="btn btn-danger mr-1 btn-min-width">Cancel</button></a>
                                <button type="submit" class="btn btn-primary">Submit</button>
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
<script type="text/javascript">
    var exists_url = "{{ route('admin.user.exists') }}";
</script>
<script defer src="{{ Helper::assets('assets/libs/validation/validate.min.js') }}" type="text/javascript"></script>
<script defer src="{{ Helper::assets('assets/libs/validation/additional-methods.min.js') }}" type="text/javascript"></script>
<script defer src="{{ Helper::assets('assets/js/pages/admin/user.js') }}" type="text/javascript"></script>
@endsection
