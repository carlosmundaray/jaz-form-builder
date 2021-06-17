@extends('formbuilder::layout')

@section('content')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8"></div>
<div class="container-fluid mt--7">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card rounded-0">
                <div class="card-header">
                    <h5 class="card-title">
                        {{ $pageTitle }} ({{ $submissions->count() }})

                        <a href="{{ route('formbuilder::forms.index') }}" class="btn btn-primary float-md-right btn-sm" title="Back To My Forms">
                            <i class="fa fa-th-list"></i> Regresar
                        </a>
                    </h5>
                </div>
                <div>
                    
                        @if (count($errors) > 0)
                          <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                               @foreach ($errors->all() as $error)
                                 <li>{{ $error }}</li>
                               @endforeach
                            </ul>
                          </div>
                        @endif

                            @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                              <p>{{ $message }}</p>
                            </div>
                            @endif

                        <form action="{{ route('formbuilder::almacen.almacen_save') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Ejecutar:</strong>
                                    {!! Form::select('tipo', array("Export","Import"), null, ['id' => 'slt_a','class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Guias:</strong>
                                    {!! Form::select('tipo_task', $forms, null, ['class' => 'form-control']) !!}
                                </div>
                            </div>

                            <div id="slt_b" class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Archivo:</strong>
                                    <input type="file" name="file" class="form-control">
                                </div>
                            </div>

                            <br>
                            <button class="btn btn-success">Enviar</button>
                        </form>
                </div>


            </div>
        </div>
    </div>
</div>
@endsection
