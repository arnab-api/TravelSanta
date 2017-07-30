{!! Form::open(
    array(
        'action'=>'ImageUploadController@store',
        'class' => 'form',
        'novalidate' => 'novalidate',
        'files' => true,
        ))!!}

<div class="form-group">
    {!! Form::label('Product Image') !!}
    {!! Form::file('image[]',array('multiple'=>true)) !!}
</div>

<div class="form-group">
    {!! Form::submit('Create Product!') !!}
</div>
{!! Form::close() !!}

{{--{!! Form::open(['method'=>'POST' , 'action'=>'ImageUploadController@store']) !!}--}}
{{--<div class="form-group">--}}
    {{--<input type="file" name="image">--}}
    {{--<input type="submit" value="Submit" class="postSubmit">--}}
{{--</div>--}}
{{--{!! Form::close() !!}--}}