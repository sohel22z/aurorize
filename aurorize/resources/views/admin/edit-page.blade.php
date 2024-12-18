@extends('layouts.admin')

@php
$is_update = false;
if(isset($settings)){
    $is_update = true;
}
@endphp

@section('breadcrumb')
<div class="row page-title align-items-center">
    <div class="col-sm-6 col-xl-6">
        <h4 class="mb-1 mt-0 font-weight-medium">Edit {{ $page_title }}</h4>
    </div>
</div>
@endsection

@section('title') Edit {{ $page_title }} @endsection

@section('content')
<section id="summernote-edit-save">
    <div class="row">
        <div class="col-12">
            <div class="card border-info border-bottom-2">
                <div class="card-content collapse show">
                    <div class="card-body">
                        <form class="form-horizontal edit-page-form-validate" method="post" action="{{ route('admin.save.pageContent') }}">
                            @csrf
                            <div class="form-group ckeditor">
                                <textarea class="hidden1" name="page_content" id="page_content">{{ $pagecontent }}</textarea>
                            </div>
                            <input type="hidden" name="file_name" value="{{ $file_name }}">
                            <input type="hidden" name="page_title" value="{{ $page_title }}">
                            <button id="save" class="btn btn-primary btn-min-width" type="submit">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script-bottom')
<script type="text/javascript">
    var imageuploadurl = "{{ route('upload-ck-editor-images', ['_token' => csrf_token() ]) }}"; 
</script>
<script defer type="text/javascript" src="{{ Helper::assets('assets/libs/validation/validate.min.js') }}"></script>
<script defer type="text/javascript" src="{{ Helper::assets('assets/libs/ckeditor/ckeditor.js') }}"></script>
<script defer type="text/javascript" src="{{ Helper::assets('assets/js/pages/admin/editPageContent.js') }}"></script>
@endsection
