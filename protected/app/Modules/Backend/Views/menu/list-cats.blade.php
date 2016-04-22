
@extends('Backend::layouts.master')

@section('content')
<section class="content-header">
    <h1>
        Menu Category List
        <small></small>
    </h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            {!! Form::open(['url' => Request::url() . $qs, 'name' => 'menuForm', 'id' => 'menuForm', 'role' => 'form']) !!}
                <div class="box box-primary">
                    <div class="box-header text-right">
                        <a href="{{ url('admin/menu/category/create') . $qs }}" class="btn btn-success btn-flat"><i class="fa fa-plus"></i> Create Category</a>
                    </div>
                    
                    <div class="box-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th width='15%'>&nbsp;</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                @foreach($cats as $item)
                                <tr>
                                    <td><a href="{{ url('admin/menu', [$item->id]) . $qs }}">{{ $item->cat_name }}</a></td>
                                    <td>{{ $item->position_name }}</td>

                                    <td class="text-right">
                                        
                                        @if($item->published == 1)
                                        <a href="{{url('admin/menu/category/published', [$item->id]) . $qs}}" class="btn btn-sm btn-info btn-flat" data-toggle="tooltip" title="Unlock"><i class="fa fa-unlock-alt"></i></a>
                                        @else
                                        <a href="{{url('admin/menu/category/published', [$item->id]) . $qs}}" class="btn btn-sm btn-default btn-flat" data-toggle="tooltip" title="Locked"><i class="fa fa-lock"></i></a>
                                        @endif
                                        <a href="{{url('admin/menu/category/edit', [$item->id]) . $qs}}" class="btn btn-sm btn-warning btn-flat" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>
                                        <a href="{{url('admin/menu/category/delete', [$item->id]) . $qs}}" class="btn btn-sm btn-danger btn-flat" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            
                            <tfoot>
                                <tr>
                                    <td colspan="4" class="text-right">
                                        {!! $cats->render() !!}
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    
                    <div class="box-footer text-right">
                        <a href="{{ url('admin/menu/category/create') . $qs }}" class="btn btn-success btn-flat"><i class="fa fa-plus"></i> Create Category</a>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</section>
<script type="text/javascript">
    $(function(){
        $('ul.pagination').addClass('pagination-sm no-margin');
    });
</script>

@stop
