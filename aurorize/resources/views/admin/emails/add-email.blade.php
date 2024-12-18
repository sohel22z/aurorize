@extends('layouts.admin')

@php
$is_update = false;
if(isset($email)){
    $is_update = true;
}
@endphp
@section('title') {{ $is_update ? 'Edit' : 'Add' }} Email Template @endsection

@section('breadcrumb')
<div class="row page-title align-items-center">
    <div class="col-sm-6 col-xl-6">
        <h4 class="mb-1 mt-0 font-weight-medium">{{ $is_update ? 'Edit' : 'Add New' }} Email Content</h4>
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
                        <form method="POST" action="{{ $is_update ? route('admin.update.email') : route('admin.store.email') }}" class="form-horizontal   email-form-validate" autocomplete="off">
                            @csrf
                            @if($is_update)
                            <input type="hidden" name="id" value="{{ $email->id }}">
                            @endif
                            <div class="row">
                                <div class="form-group col">
                                    <label>Email Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" placeholder="Email Title" name="title" id="title" value="{{ $is_update ? (old('title') != "" ? old('title') : $email->title) : old('title') }}">
                                    @error('title')
                                        <label id="title-error" class="invalid-feedback" for="title">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col">
                                    <label>Email Subject <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('subject') is-invalid @enderror" placeholder="Email subject" name="subject" id="subject" value="{{ $is_update ? (old('subject') != "" ? old('subject') : $email->subject) : old('subject') }}">
                                    @error('subject')
                                        <label id="subject-error" class="invalid-feedback" for="subject">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col ckeditor">
                                    <label>Email Body <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('body') is-invalid @enderror" placeholder="Email body" name="body" id="body">{{ $is_update ? (old('body') != "" ? old('body') : $email->body) : old('body') }}</textarea>
                                    @error('body')
                                        <label id="body-error" class="invalid-feedback" for="body">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-actions center">
                                <a href="{{ route('admin.email') }}"><button type="button" class="btn btn-danger mr-1 btn-min-width">Cancel</button></a>
                                <button type="submit" class="btn btn-primary btn-min-width">{{ $is_update ? 'Update' : 'Save' }}</button>
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
    var imageuploadurl = "{{ route('upload-ck-editor-images', ['_token' => csrf_token() ]) }}";
</script>
<script defer src="{{ Helper::assets('assets/libs/validation/validate.min.js') }}" type="text/javascript"></script>
<script defer src="{{ Helper::assets('assets/libs/ckeditor/ckeditor.js') }}" type="text/javascript"></script>
<script defer src="{{ Helper::assets('assets/js/pages/admin/email_template.js') }}" type="text/javascript"></script>
@endsection
