@extends('Backend::layouts.master')

@section('content')
<section class="content-header">
    <h1>
        Edit Contact
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            {!! Form::open(['url' => Request::url() . $qs, 'method' => 'put', 'name' => 'contactForm', 'id' => 'contactForm', 'role' => 'form', 'files' => true]) !!}
            <div class="box box-primary">
                <!--div class="box-header">
                    <h3 class="box-title"></h3>
                </div-->
                
                <div class="box-body">
                    <div class="col-md-6">
                        <div class="form-group @if($errors->has('building_name')) has-error @endif">
                            <label for="contact_name">Building Name [<img src="{{ asset('media/local/images/vi_16.png') }}"/>]</label>
                            {!! Form::text('building_name', $contact->building_name, ['class' => 'form-control', 'placeholder' => 'Building Name', 'id' => 'building_name']) !!}
                            @if ($errors->has('building_name'))<p><small class="text-red">{!!$errors->first('building_name')!!}</small></p> @endif
                        </div>

                        <div class="form-group @if($errors->has('building_name_en')) has-error @endif">
                            <label for="contact_name">Building Name [<img src="{{ asset('media/local/images/en_16.png') }}"/>]</label>
                            {!! Form::text('building_name_en', $contact->building_name_en, ['class' => 'form-control', 'placeholder' => 'Building Name', 'id' => 'building_name_en']) !!}
                            @if ($errors->has('building_name_en'))<p><small class="text-red">{!!$errors->first('building_name_en')!!}</small></p> @endif
                        </div>

                        <div class="form-group @if($errors->has('address')) has-error @endif">
                            <label for="address">Address [<img src="{{ asset('media/local/images/vi_16.png') }}"/>]</label>
                            {!! Form::text('address', $contact->address, ['class' => 'form-control', 'placeholder' => 'Address', 'id' => 'address']) !!}
                            @if ($errors->has('address'))<p><small class="text-red">{!!$errors->first('address')!!}</small></p> @endif
                        </div>

                        <div class="form-group @if($errors->has('address_en')) has-error @endif">
                            <label for="address_en">Address [<img src="{{ asset('media/local/images/en_16.png') }}"/>]</label>
                            {!! Form::text('address_en', $contact->address_en, ['class' => 'form-control', 'placeholder' => 'Address', 'id' => 'address_en']) !!}
                            @if ($errors->has('address_en'))<p><small class="text-red">{!!$errors->first('address_en')!!}</small></p> @endif
                        </div>

                        <div class="form-group @if($errors->has('phone')) has-error @endif">
                            <label for="phone">Phone</label>
                            {!! Form::text('phone', $contact->phone, ['class' => 'form-control', 'placeholder' => 'Phone', 'id' => 'phone']) !!}
                            @if ($errors->has('phone'))<p><small class="text-red">{!!$errors->first('phone')!!}</small></p> @endif
                        </div>

                        <div class="form-group @if($errors->has('fax')) has-error @endif">
                            <label for="fax">Fax</label>
                            {!! Form::text('fax', $contact->fax, ['class' => 'form-control', 'placeholder' => 'Fax', 'id' => 'fax']) !!}
                            @if ($errors->has('fax'))<p><small class="text-red">{!!$errors->first('fax')!!}</small></p> @endif
                        </div>

                        <div class="form-group @if($errors->has('email')) has-error @endif">
                            <label for="email">Email</label>
                            {!! Form::text('email', $contact->email, ['class' => 'form-control', 'placeholder' => 'Email', 'id' => 'email']) !!}
                            @if ($errors->has('email'))<p><small class="text-red">{!!$errors->first('email')!!}</small></p> @endif
                        </div>

                        <div class="form-group @if($errors->has('hotline')) has-error @endif">
                            <label for="hotline">Hotline</label>
                            {!! Form::text('hotline', $contact->hotline, ['class' => 'form-control', 'placeholder' => 'Hotline', 'id' => 'hotline']) !!}
                            @if ($errors->has('hotline'))<p><small class="text-red">{!!$errors->first('hotline')!!}</small></p> @endif
                        </div>

                        
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group @if($errors->has('map_photo')) has-error @endif">
                            <label for="map_photo">Map Photo</label>
                            {!! Form::file('map_photo', '', ['class' => 'form-control', 'placeholder' => 'Map Photo', 'id' => 'map_photo']) !!}
                            <p class="help-block">File type accepted: *.png, *.jpg.</p>
                            @if ($errors->has('map_photo'))<p><small class="text-red">{!!$errors->first('map_photo')!!}</small></p> @endif
                        </div>
                        
                        <div class="form-group @if($errors->has('gmap_url')) has-error @endif">
                            <label for="gmap_url">Map Url</label>
                            {!! Form::text('gmap_url', $contact->gmap_url, ['class' => 'form-control', 'placeholder' => 'Google Map Url', 'id' => 'gmap_url']) !!}
                            @if ($errors->has('gmap_url'))<p><small class="text-red">{!!$errors->first('gmap_url')!!}</small></p> @endif
                        </div>
                        
                        <div class="form-group @if($errors->has('facebook')) has-error @endif">
                            <label for="gmap_url">Facebook</label>
                            {!! Form::text('facebook', $contact->facebook, ['class' => 'form-control', 'placeholder' => 'Facebook', 'id' => 'facebook']) !!}
                            @if ($errors->has('facebook'))<p><small class="text-red">{!!$errors->first('facebook')!!}</small></p> @endif
                        </div>
                        
                        <div class="form-group @if($errors->has('youtube')) has-error @endif">
                            <label for="youtube">Youtube</label>
                            {!! Form::text('youtube', $contact->youtube, ['class' => 'form-control', 'placeholder' => 'Youtube', 'id' => 'youtube']) !!}
                            @if ($errors->has('youtube'))<p><small class="text-red">{!!$errors->first('youtube')!!}</small></p> @endif
                        </div>
                        
                        <div class="form-group @if($errors->has('instagram')) has-error @endif">
                            <label for="instagram">Instagram</label>
                            {!! Form::text('instagram', $contact->instagram, ['class' => 'form-control', 'placeholder' => 'Instagram', 'id' => 'instagram']) !!}
                            @if ($errors->has('instagram'))<p><small class="text-red">{!!$errors->first('instagram')!!}</small></p> @endif
                        </div>
                        
                        <div class="form-group">
                            <label for="published">Published</label>
                            <div class="">
                                <label class="radio-inline">
                                    {!! Form::radio('published', 1, $contact->published == 1) !!} Yes
                                </label>
                                <label class="radio-inline">
                                    {!! Form::radio('published', 0, $contact->published == 0) !!} No
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="box-footer">
                    <div class="text-right">
                        <button type="submit" class="btn btn-success btn-flat"><i class="fa fa-save"></i> Save</button>
                        <a href="{{ url('admin/contact') . $qs }}" class="btn btn-danger btn-flat"><i class="fa fa-ban"></i> Cancel</a>
                    </div>
                </div>
            </div>
                {!! Form::hidden('id', $contact->id) !!}
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