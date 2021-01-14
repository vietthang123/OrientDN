@extends('layouts.admin')
@section('content')
@can('post_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
        <button type="button" class="custom-btn btn-7"
            onclick="location.href='{{ route('admin.posts.create') }}'">
            <span><strong>{{ trans('global.add') }} {{ trans('cruds.post.title_singular') }}</strong></span>
        </button>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.post.title_singular') }} {{ trans('global.list') }}
    </div><br>

    <div class="row col-lg-12">
        <div class="col-lg-3 col-md-6">
            <form class="d-flex flex-row">
                <select class="form-control form-control-sm" id="author_filter" name="author" onchange="filter()">
                  <option value="">Select author</option>
                  @foreach ($user as $u)
                    <option class="form-control" value="{{$u->id}}"
                    {{(Request::query('author') && Request::query('author')==$u->id)?'selected':''}}
                    >{{$u->name}}</option>
                  @endforeach
                </select>
                &nbsp;
                @if(Request::query('author'))
                  <a class="btn btn-success btn-sm" href="{{route('admin.posts.index')}}">Reset</a>
                @endif
                </form>
                
        </div>
        <div class="col-lg-3 col-md-6">
            <form class="d-flex flex-row">
                <select class="form-control form-control-sm" id="category_filter" name="category" onchange="filter()">
                  <option value="">Select Category</option>
                  @if(count($categories))
                    @foreach($categories as $category)
                      <option value="{{$category->name}}"
                        {{(Request::query('category') && Request::query('category')==$category->name)?'selected':''}}
                      >{{$category->name}}
                      </option>
                    @endforeach
                  @endif
                </select>&nbsp;
                @if(Request::query('category'))
                  <a class="btn btn-success btn-sm" href="{{route('admin.posts.index')}}">Reset</a>
                @endif
              </form>
              
        </div>
        <div class="col-lg-3">
            <form >
                <input value="{{Request::query('start')}}" {{(Request::query('start'))?'selected':''}}
                    type="date" id="start_filter" name="start" class="form-control form-control-sm" 
                    style="width: 150px;" onchange="filter()">
                <input value="{{Request::query('end')}}" {{(Request::query('end'))?'selected':''}}
                  type="date" id="end_filter" name="end" class="form-control form-control-sm" 
                  style="width: 150px;" onchange="filter()">   
                  &nbsp;
              @if(Request::query('start') || Request::query('end'))
                  <a class="btn btn-success btn-sm" href="{{route('admin.posts.index')}}" style="height: 30px;">Reset</a>
              @endif                 
              </form>
        </div>
        <div class="col-lg-3">
            <form class="d-flex flex-row">
                <select class="form-control form-control-sm" id="status_filter" name="status" onchange="filter()">
                  <option value="">Select status</option>
                  <option value="Draft" {{(Request::query('status') && Request::query('status')=='Draft')?'selected':''}}>Draft</option>
                  <option value="Pending" {{(Request::query('status') && Request::query('status')=='Pending')?'selected':''}}>Pending</option>
                  <option value="Publish" {{(Request::query('status') && Request::query('status')=='Publish')?'selected':''}}>Publish</option>
                </select>&nbsp;
                @if(Request::query('status'))
                  <a class="btn btn-success btn-sm" href="{{route('admin.posts.index')}}">Reset</a>
                @endif
              </form>
              
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Post">
                <thead>
                    <tr>
                        <th width="10">
                        </th>
                        <th>
                            {{ trans('cruds.post.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.post.fields.user') }}
                        </th>
                        <th>
                            {{ trans('cruds.post.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.post.fields.image') }}
                        </th>
                        <th>
                            {{ trans('cruds.post.fields.slug') }}
                        </th>
                        <th>
                            {{ trans('cruds.post.fields.category') }}
                        </th>
                        <th>
                            {{ trans('cruds.post.fields.created') }}
                        </th>
                        <th>
                            {{ trans('cruds.post.fields.status') }}
                        </th>
                        <th>
                            {{ trans('cruds.post.fields.approve') }}
                        </th>
                        <th>
                            {{ trans('cruds.post.fields.action') }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $key => $post)
                        <tr data-entry-id="{{ $post->id }}">
                            <td></td>
                            <td>
                                {{ $post->id ?? '' }}
                            </td>
                            <td>
                                {{ $post->user->name ?? '' }}
                            </td>
                            <td>
                                {{ $post->name ?? '' }}
                            </td>
                            <td>
                                <img alt="" src="/public/uploads/post/{{ $post->image }}" height="100" width="100">
                            </td>
                            <td>
                                {{ $post->slug ?? '' }}
                            </td>
                            <td>
                                @foreach($post->categories as $key => $item)
                                    <span class="badge badge-info">{{ $item->name }}</span>
                                @endforeach
                            </td>
                            
                            <td>
                                {{ $post->created_at ?? '' }}
                            </td>

                            <td>
                                <span class="badge badge-info">{{ $post->status ?? '' }}</span>
                                
                            </td>

                            <td>
                                @can('post_approve')
                                @csrf
                                @if($post->status == 'Pending' || ($post->status == 'Draft'))
                                    <form action="{{ route('admin.posts.approve') }}" method="POST" 
                                    onsubmit="return confirm('{{ trans('global.approve') }}');" style="display: inline-block;">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="id" value="{{$post->id}}">
                                    <input type="submit" class="btn btn-xs btn-success" value="{{ trans('global.Approve') }}">
                                    </form>
                                @endif
                                @endcan
                            </td>

                            <td>
                                @can('post_show')
                                    <a class="btn btn-xs  btn-info" href="{{ route('admin.posts.show', $post->id) }}">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </a>
                                @endcan

                                @can('post_edit')
                                    <a class="btn btn-xs btn-warning" href="{{ route('admin.posts.edit', $post->id) }}">
                                        {{-- {{ trans('global.edit') }} --}}
                                        {{-- <i class="fa fa-pencil" aria-hidden="true"></i> --}}
                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                    </a>
                                @endcan

                                @can('post_delete')
                                    <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger " value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('post_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.posts.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });

  let table = $('.datatable-Post:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection