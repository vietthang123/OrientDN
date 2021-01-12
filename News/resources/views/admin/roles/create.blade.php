@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.role.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.roles.store") }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.role.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                @if($errors->has('title'))
                    <span class="text-danger">{{ $errors->first('title') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.role.fields.title_helper') }}</span>
            </div>

            <!--Profile-->
            <div class="form-group">
                <label class="required" for="permissions">{{ trans('cruds.role.fields.permissions') }}</label>
                    <div><label for="">Select Profile:</label></div>
                    <div style="padding-bottom: 4px">
                        <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                        <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                    </div>
                    <select class="form-control select2 {{ $errors->has('permissions') ? 'is-invalid' : '' }}" 
                        name="permissions[]" id="permissions" multiple>
                        @foreach($permissions as $id => $c)
                            @if(strpos($c, 'profile') !== false)
                                <option value="{{ $id }}" {{ in_array($id, old('permissions', [])) ? 'selected' : '' }}>
                                    {{ucfirst(substr($c,0))}}
                                </option>
                            @endif
                        @endforeach
                        </select>
                        @if($errors->has('permissions'))
                        <span class="text-danger">{{ $errors->first('permissions') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.role.fields.permissions_helper') }}</span>
                    </div>
                <!--end-->

                <!--Category-->
                <div class="form-group">
                <label class="required" for="permissions">{{ trans('cruds.role.fields.permissions') }}</label>
                    <div><label for="">Select Category:</label></div>
                    <div style="padding-bottom: 4px">
                        <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                        <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                    </div>
                    <select class="form-control select2 {{ $errors->has('permissions') ? 'is-invalid' : '' }}" 
                        name="permissions[]" id="permissions" multiple>
                        @foreach($permissions as $id => $c)
                            @if(strpos($c, 'category') !== false)
                                <option value="{{ $id }}" {{ in_array($id, old('permissions', [])) ? 'selected' : '' }}>
                                    {{ucfirst(substr($c,0))}}
                                </option>
                            @endif
                        @endforeach
                        </select>
                        @if($errors->has('permissions'))
                        <span class="text-danger">{{ $errors->first('permissions') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.role.fields.permissions_helper') }}</span>
                    </div>
                <!--end-->
                
                <!--Post-->
                <div class="form-group">
                <div><label for="">Select Post:</label></div>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('permissions') ? 'is-invalid' : '' }}" 
                    name="permissions[]" id="permissions" multiple>
                    @foreach($permissions as $id => $p)  
                        @if(strpos($p, 'post') !== false)
                            <option value="{{ $id }}" {{ in_array($id, old('permissions', [])) ? 'selected' : '' }}>
                                {{ucfirst(substr($p,0))}}
                            </option>      
                        @endif
                    @endforeach
                </select>
                    @if($errors->has('permissions'))
                    <span class="text-danger">{{ $errors->first('permissions') }}</span>
                    @endif
                <span class="help-block">{{ trans('cruds.role.fields.permissions_helper') }}</span>
                </div>
                <!--end-->

                <!--User-->
                    <div class="form-group">
                    <div><label for="">Select User:</label></div>
                    <div style="padding-bottom: 4px">
                        <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                        <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                    </div>
                    <select class="form-control select2 {{ $errors->has('permissions') ? 'is-invalid' : '' }}" 
                        name="permissions[]" id="permissions" multiple >
                        @foreach($permissions as $id => $u)
                            @if(strpos($u, 'user') !== false)
                                <option value="{{ $id }}" {{ in_array($id, old('permissions', [])) ? 'selected' : '' }}>
                                    {{ucfirst(substr($u, 0 ))}}
                                </option>      
                            @endif
                        @endforeach
                    </select>
                        @if($errors->has('permissions'))
                        <span class="text-danger">{{ $errors->first('permissions') }}</span>
                        @endif
                    <span class="help-block">{{ trans('cruds.role.fields.permissions_helper') }}</span>
                    </div>
                <!--end-->

                <!--Role-->
                    <div class="form-group">
                    <div><label for="">select Role</label></div>
                    <div style="padding-bottom: 4px">
                        <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                        <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                    </div>
                    <select class="form-control select2 {{ $errors->has('permissions') ? 'is-invalid' : '' }}" 
                        name="permissions[]" id="permissions" multiple >
                        @foreach($permissions as $id => $r)
                            @if(strpos($r, 'role') !== false)
                                <option value="{{ $id }}" {{ in_array($id, old('permissions', [])) ? 'selected' : '' }}>
                                    {{ucfirst(substr($r,0))}}
                                </option>
                            @endif
                        @endforeach
                        </select>
                        @if($errors->has('permissions'))
                        <span class="text-danger">{{ $errors->first('permissions') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.role.fields.permissions_helper') }}</span>
                    </div>
                <!--end-->

                <!--Permission-->
                <div class="form-group">
                <div><label for="">Select Permission:</label></div>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('permissions') ? 'is-invalid' : '' }}" 
                    name="permissions[]" id="permissions" multiple="multiple">
                    @foreach($permissions as $id => $permissions)
                        @if(strpos($permissions, 'permission') !== false)
                            <option value="{{ $id }}" {{ in_array($id, old('permissions', [])) ? 'selected' : '' }}>
                                {{ucfirst(substr($permissions,0))}}
                            </option>      
                        @endif
                    @endforeach
                </select>
                    @if($errors->has('permissions'))
                    <span class="text-danger">{{ $errors->first('permissions') }}</span>
                    @endif
                <span class="help-block">{{ trans('cruds.role.fields.permissions_helper') }}</span>
                </div>    
                <!--end-->

                <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>

@endsection