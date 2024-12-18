@extends('layouts.admin')

@php
$is_update = false;
if(isset($category)){
    $is_update = true;
}
@endphp
@section('title') {{ $is_update ? 'Edit' : 'Add' }} Category @endsection

@section('breadcrumb')
<div class="row page-title align-items-center">
    <div class="col-sm-6 col-xl-6">
        <h4 class="mb-1 mt-0 font-weight-medium">{{ $is_update ? 'Edit' : 'Add New' }} Category</h4>
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
                        <form method="POST" action="{{ $is_update ? route('admin.category.update') : route('admin.category.store') }}" class="form-horizontal form-validate" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            @if($is_update)
                            <input type="hidden" name="id" value="{{ $category->id }}">
                            @endif
                            <div class="row mb-2">
                                <div class="form-group col-md-6">
                                    <label>Category Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Category Name" name="name" id="name" value="{{ $is_update ? (old('name') != "" ? old('name') : $category->name) : old('name') }}">
                                    @error('name')
                                        <label id="name-error" class="invalid-feedback" for="name">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-actions center">
                                <a href="{{ route('admin.category') }}"><button type="button" class="btn btn-danger mr-1 btn-min-width">Cancel</button></a>
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
    var exists_url = "{{ route('admin.category.exists') }}";
</script>
<script defer src="{{ Helper::assets('assets/libs/validation/validate.min.js') }}" type="text/javascript"></script>
<script src="{{ Helper::assets('assets/js/pages/admin/category.js') }}" type="text/javascript"></script>
@endsection