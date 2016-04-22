
@extends('Backend::layouts.master')

@section('content')
<section class="content-header">
    <h1>
        Contact List
        <small></small>
    </h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            {!! Form::open(['url' => Request::url() . $qs, 'name' => 'contactForm', 'id' => 'contactForm', 'role' => 'form']) !!}
                <div class="box box-primary">
                    <div class="box-header text-right">
                        <a href="{{ url('admin/contact/create') . $qs }}" class="btn btn-success btn-flat"><i class="fa fa-plus"></i> Create Contact</a>
                    </div>
                    
                    <div class="box-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Building Name</th>
                                    <th>Address</th>
                                    <th width="8%">Orders <button type="submit" id="cmd_ordering" class="btn btn-xs btn-success btn-flat" formaction="{{ url('admin/contact/ordering') .$qs }}" data-toggle="tooltip" title="Save Orders"><i class="fa fa-save"></i></button></th>
                                    <th width='15%'>&nbsp;</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                @foreach($contacts as $item)
                                <tr>
                                    <td>{{ $item->building_name }}</td>
                                    <td>{{ $item->address }}</td>
                                    <td>
                                        {!! Form::number('ordering[]', $item->ordering, ['class' => 'form-control input-sm', 'min'=>'1', 'required'=>true]) !!}
                                        {!! Form::hidden('ids[]', $item->id) !!}
                                    </td>
                                    <td class="text-right">
                                        
                                        @if($item->published == 1)
                                        <a href="{{url('admin/contact/published', [$item->id]) . $qs}}" class="btn btn-sm btn-info btn-flat" data-toggle="tooltip" title="Unlock"><i class="fa fa-unlock-alt"></i></a>
                                        @else
                                        <a href="{{url('admin/contact/published', [$item->id]) . $qs}}" class="btn btn-sm btn-default btn-flat" data-toggle="tooltip" title="Locked"><i class="fa fa-lock"></i></a>
                                        @endif
                                        <a href="{{url('admin/contact/edit', [$item->id]) . $qs}}" class="btn btn-sm btn-warning btn-flat" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>
                                        <a href="{{url('admin/contact/delete', [$item->id]) . $qs}}" class="btn btn-sm btn-danger btn-flat" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            
                            <tfoot>
                                <tr>
                                    <td colspan="4" class="text-right">
                                        {!! $contacts->render() !!}
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    
                    <div class="box-footer text-right">
                        <a href="{{ url('admin/contact/create') . $qs }}" class="btn btn-success btn-flat"><i class="fa fa-plus"></i> Create Contact</a>
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
