{!! Form::open(
    array(
        'action'=>'ImageUploadController@store',
        'class' => 'form',
        'novalidate' => 'novalidate',
        'files' => true)) !!}

<div class="form-group">
    {!! Form::label('Product Name') !!}
    {!! Form::text('name', null, array('placeholder'=>'Chess Board')) !!}
</div>

<div class="form-group">
    {!! Form::label('Product SKU') !!}
    {!! Form::text('sku', null, array('placeholder'=>'1234')) !!}
</div>

<div class="form-group">
    {!! Form::label('Product Image') !!}
    {!! Form::file('image', null) !!}
</div>

<div class="form-group">
    {!! Form::submit('Create Product!') !!}
</div>
{!! Form::close() !!}
</div>