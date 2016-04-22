@extends('Backend::layouts.master')

@section('content')
<section class="content-header">
    <h1>
        Create Menu
        <small></small>
    </h1>
    
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            {!! Form::open(['url' => Request::url() . $qs, 'method'=>'put', 'name' => 'menuForm', 'id' => 'menuForm', 'role' => 'form', 'files' => true]) !!}
            <div class="box box-primary">
                <!--div class="box-header">
                    <h3 class="box-title"></h3>
                </div-->
                
                <div class="box-body">
                    <div class="col-md-7">
                        <div class="form-group @if($errors->has('title')) has-error @endif">
                            <label for="title">Title [<img src="{{ asset('media/local/images/vi_16.png') }}"/>]</label>
                            {!! Form::text('title', $menu->title, ['class' => 'form-control', 'placeholder' => 'Title', 'id' => 'title']) !!}
                            @if ($errors->has('title'))<p><small class="text-red">{!!$errors->first('title')!!}</small></p> @endif
                        </div>
                        
                        <div class="form-group @if($errors->has('title_en')) has-error @endif">
                            <label for="title_en">Title [<img src="{{ asset('media/local/images/en_16.png') }}"/>]</label>
                            {!! Form::text('title_en', $menu->title_en, ['class' => 'form-control', 'placeholder' => 'Title', 'id' => 'title_en']) !!}
                            @if ($errors->has('title_en'))<p><small class="text-red">{!!$errors->first('title_en')!!}</small></p> @endif
                        </div>
                        
                         <div class="form-group">
                            <label for="alias">Alias</label>
                            {!! Form::text('alias', $menu->alias, ['class' => 'form-control', 'placeholder' => '', 'id' => 'alias']) !!}
                        </div>

                        <div class="form-group">
                            <label for="url">Url</label>
                            {!! Form::text('url', $menu->url, ['class' => 'form-control', 'placeholder' => '', 'id' => 'url']) !!}
                        </div>

                        
                        <div class="form-group">
                            <label for="published">Published</label>
                            <div class="">
                                <label class="radio-inline">
                                    {!! Form::radio('published', 1, $menu->published == 1) !!} Yes
                                </label>
                                <label class="radio-inline">
                                    {!! Form::radio('published', 0, $menu->published == 0) !!} No
                                </label>
                            </div>
                        </div>
                        
                    </div>
                    
                    <div class="col-md-5">
                        
                        
                    </div>
                </div>
                
                <div class="box-footer">
                    <div class="text-right">
                        <button type="submit" id="cmdSave" class="btn btn-success btn-flat"><i class="fa fa-save"></i> Save</button>
                        <a href="{{ url('admin/menu', [$menu->cat_id]) . $qs }}" class="btn btn-danger btn-flat"><i class="fa fa-ban"></i> Cancel</a>
                    </div>
                </div>
            </div>
                {!! Form::hidden('id', $menu->id) !!}
                {!! Form::hidden('cat_id', $menu->cat_id) !!}
            {!! Form::close() !!}
        </div>
    </div>
</section>
<script type="text/javascript">
    $(function () {
        
        $('input').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue',
        });
    });
</script>
@stop