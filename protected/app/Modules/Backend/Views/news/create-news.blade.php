@extends('Backend::layouts.master')
{{--
@section('meta_description', $meta_description)
@section('meta_keywords', $meta_keywords)
--}}
@section('content')
<script src="{{ asset('media/libs/summernote/plugin/summernote-ext-linebreak.js') }}"></script>
<script src="{{ asset('media/libs/summernote/plugin/summernote-ext-video.js') }}"></script>
<section class="content-header">
    <h1>
        Create Content
        <small></small>
    </h1>
    
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            {!! Form::open(['url' => Request::url() . $qs, 'name' => 'contactForm', 'id' => 'contactForm', 'role' => 'form', 'files' => true]) !!}
            <div class="box box-primary">
                <!--div class="box-header">
                    <h3 class="box-title"></h3>
                </div-->
                
                <div class="box-body">
                    <div class="col-md-7">
                        <div class="form-group @if($errors->has('title')) has-error @endif">
                            <label for="title">Title</label>
                            {!! Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title', 'id' => 'title']) !!}
                            @if ($errors->has('title'))<p><small class="text-red">{!!$errors->first('title')!!}</small></p> @endif
                        </div>
                        

                        <div class="form-group">
                            <label for="alias">Alias</label>
                            {!! Form::text('alias', '', ['class' => 'form-control', 'placeholder' => '', 'id' => 'alias']) !!}
                        </div>

                        <div class="form-group @if($errors->has('content_text')) has-error @endif">
                            <label for="content_text">Content</label>
                            {!! Form::textarea('content_text', '', ['class' => 'form-control news-content', 'placeholder' => '', 'id'=>'content_text']) !!}
                            @if ($errors->has('content_text'))<p><small class="text-red">{!!$errors->first('content_text')!!}</small></p> @endif
                        </div>    
                        
                        <div class="form-group">
                            <label for="published">Published</label>
                            <div class="">
                                <label class="radio-inline">
                                    {!! Form::radio('published', 1, true) !!} Yes
                                </label>
                                <label class="radio-inline">
                                    {!! Form::radio('published', 0, false) !!} No
                                </label>
                            </div>
                        </div>
                        
                    </div>
                    
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="meta_description">Meta Description</label>
                            {!! Form::textarea('meta_description', '', ['class' => 'form-control', 'placeholder' => '', 'id'=>'meta_description', 'style' => 'height: 100px;']) !!}                           
                        </div>
                        
                        <div class="form-group">
                            <label for="meta_keywords">Meta Keywords</label>
                            {!! Form::textarea('meta_keywords', '', ['class' => 'form-control', 'placeholder' => '', 'id'=>'meta_keywords', 'style' => 'height: 100px;']) !!}                           
                        </div>
                        
                    </div>
                </div>
                
                <div class="box-footer">
                    <div class="text-right">
                        <button type="button" id="cmdSave" class="btn btn-success btn-flat"><i class="fa fa-save"></i> Save</button>
                        <a href="{{ url('admin/content') . $qs }}" class="btn btn-danger btn-flat"><i class="fa fa-ban"></i> Cancel</a>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</section>
<script type="text/javascript">
    $(function () {
        
        $(".news-content").summernote({
            height: 250,
            airMode: false,
            toolbar: [
                ['style', ['style']],
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['picture', 'link', 'video']],
                ['misc', ['fullscreen', 'codeview', 'linebreak', 'help']],
            ]
        });
        
        $('#cmdSave').on('click', function(){
            
            var code = $(".news-content").code();
            if(code == "<p><br></p>" || code == '<br>')
                $(".news-content").code('');
            
            $('form:first').submit();
        });
        
        $('input').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue',
        });
    });
</script>
@stop