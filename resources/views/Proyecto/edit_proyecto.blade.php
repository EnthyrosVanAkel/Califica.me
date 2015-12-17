@extends('becario')

@section('proyectos')
                <h3>Ajustes del Proyecto</h3>
                <!-- General User data -->
                <div class="general-info col-sm-8  col-sm-offset-2">

                <!-- General User data -->
@if ($errors->any())
  <ul class="alert alert-damage">
    @foreach ($errors->all() as $error)
      <li>{{$error}}</li>
    @endforeach
  </u>
@endif

                {!! Form::model($proyecto,['class'=>'form-group col-lg-12','method' => 'PATCH','files' => 'true','action'=>['BecarioController@update_proyecto',$proyecto->id]]) !!}


                <div class="between-form form-group">
                {!! Form::label('logo','Logo del Proyecto') !!}
                {!! Form::file('imagen',['class'=>'form-control inputfile','id'=>'imagen']) !!}
                <label for="imagen">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17">
                <path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/>
                </svg>
                <span>Elige un archivo&hellip;</span>
                </label>
                 </div>

                 <div class="between-form form-group">
                 {!! Form::label('progreso','Progreso del Proyecto') !!}
                 {!! Form::text('progreso',null,['class'=>'form-control']) !!}
                 </div>

                 <div class="between-form form-group">
                 {!! Form::label('nombre','Nombre del Proyecto') !!}
                 {!! Form::text('nombre',null,['class'=>'form-control']) !!}
                 </div>

                 <div class="between-form form-group">
                {!! Form::label('tipo','Tipo del proyecto') !!}
                {!! Form::select('tipo',array('tipo' => ' ','CTIN' => 'CTIN', 'CARSO' => 'CARSO','Operación CTIN' => 'Operación CTIN'),null,['class'=>'form-control']) !!}
                 </div>
                 
                 <div class="between-form form-group">
                {!! Form::label('area','Área') !!}
                {!! Form::select('area',array('area' => ' ','software' => 'software', 'hardware' => 'hardware','diseño' => 'diseño','social' => 'social'),null,['class'=>'form-control']) !!}
                 </div>
                 
                 <div class="between-form form-group">
                 {!! Form::label('start','Fecha de Inicio') !!}
                 <h6>{{ $proyecto->start }}</h6>
                 </div>
                
                <div class="between-form form-group">
                {!! Form::label('end','Término estimado') !!}
                {!! Form::date('end',null,['class'=>'form-control']) !!}
                 </div>                 
                 
                 <div class="between-form form-group">
                 {!! Form::label('descripcion', 'Descripción') !!}
                 </div>

                 <div class="form-group center-form">
                {!! Form::textarea('descripcion',null,['class'=>'form-control']) !!}
                     
                 </div>

                  <div class="end-form form-group text-right">
                {!! Form::submit('Guardar Cambios',['class'=>'btn btn-max-margin']) !!}
                </div>
               {!! Form::close() !!} 

<!--------------------- RECURSOSS -->
               {!! Form::model($proyecto,['class'=>'form-group col-lg-12','method' => 'PATCH','files' => 'true','action'=>['BecarioController@subir_recursos',$proyecto->id]]) !!}

               <h4>Recursos</h4>


               <div class="between-form form-group">
                {!! Form::label('infografia','Infografía del Proyecto') !!}
                {!! Form::file('infografia',['class'=>'form-control inputfile','id'=>'infografia']) !!}
                <label for="infografia">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17">
                <path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/>
                </svg>
                <span>Elige un archivo&hellip;</span>
                </label>
                 </div>


                  <div class="end-form form-group text-right">
                {!! Form::submit('Guardar Cambios',['class'=>'btn btn-max-margin']) !!}
                </div>
               {!! Form::close() !!} 


                </div><!-- General User data -->
@stop

@section('js')
<!-- Custom file input js -->
<script src="/front/js/custom-file-input.js"></script>

@stop