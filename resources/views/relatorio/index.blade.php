@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Relatório de Despesas e Rendas</h1>
                </div>
                {{-- <div class="col-sm-6">
                    <a class="btn btn-primary float-right"
                       href="{{ route('rendas.create') }}">
                        Cadastrar Nova
                    </a>
                </div> --}}
            </div>
        </div>
    </section>
    <div class="content px-3">
        @include('flash::message')
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-sm-6">
                <div class="card card-primary">
                    {!! Form::open(['method' => 'get']) !!}
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {!! Form::label('year', 'Ano', ['class' => 'control-label']) !!}
                                    {!! Form::select(
                                        'y',
                                        array_combine(range(date('Y'), 1900), range(date('Y'), 1900)),
                                        old('y', Request::get('y', date('Y'))),
                                        ['class' => 'form-control'],
                                    ) !!}
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {!! Form::label('month', 'Mês', ['class' => 'control-label']) !!}
                                    {!! Form::select('m', cal_info(0)['months'], old('m', Request::get('m', date('m'))), [
                                        'class' => 'form-control',
                                    ]) !!}
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="card-footer">
                        {!! Form::submit('Selecionar Mês', ['class' => 'btn btn-primary float-right']) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card card-primary">
                    {!! Form::open([
                        'method' => 'GET',
                        'target' => '_blank',
                        'url' => ['imprimir/relatorio'],
                        'style' => 'display:inline',
                    ]) !!}
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {!! Form::label('year', 'Ano', ['class' => 'control-label']) !!}
                                    {!! Form::select(
                                        'y',
                                        array_combine(range(date('Y'), 1900), range(date('Y'), 1900)),
                                        old('y', Request::get('y', date('Y'))),
                                        ['class' => 'form-control'],
                                    ) !!}
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {!! Form::label('month', 'Mês', ['class' => 'control-label']) !!}
                                    {!! Form::select('m', cal_info(0)['months'], old('m', Request::get('m', date('m'))), [
                                        'class' => 'form-control',
                                    ]) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        {!! Form::button('<i class="fas fa-print"></i> Imprimir<span class="label label-default">' . '</span>', [
                            'data-toggle' => 'modal',
                            'data-target' => '#modal-print',
                            'class' => 'btn bg-success float-right',
                            'title' => 'Imprimir',
                        ]) !!}
                        <br />
                    </div>
                    @include('common.print_dialog')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <div class="card card-primary">
            <div class="card-header">
                <h4>Relatório Total</h4>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered">
                    <thead class="bg-light-green">
                        <th>Descrição</th>
                        <th>Valor</th>
                    </thead>
                    <tbody>
                        <tr>
                            <th>Recitas</th>
                            <td>{{ number_format($inc_total, 2) }}</td>
                        </tr>
                        <tr>
                            <th>Despesas</th>
                            <td>{{ number_format($exp_total, 2) }}</td>
                        </tr>
                        <tr>
                            <th>Lucro</th>
                            <td>{{ number_format($profit, 2) }}</td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
        <div class="card card-primary">
            <div class="card-header">
                <h4>Relatório de Rendas</h4>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered">
                    <thead class="bg-light-green">
                        <th>Descrição</th>
                        <th>Valor</th>
                    </thead>
                    <tbody>
                        @foreach ($inc_summary as $inc)
                            <tr>
                                <th>{{ $inc['nome'] }}</th>
                                <td>{{ number_format($inc['valor'], 2) }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <th>Total de Receitas no Mês</th>
                            <td>{{ number_format($inc_total, 2) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card card-primary">
            <div class="card-header">
                <h4>Relatório de Despesas</h4>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered">
                    <thead class="bg-light-green">
                        <th>Descrição</th>
                        <th>Valor</th>
                    </thead>
                    <tbody>
                        @foreach ($exp_summary as $inc)
                            <tr>
                                <th>{{ $inc['nome'] }}</th>
                                <td>{{ number_format($inc['valor'], 2) }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <th>Total de Despesas no Mês</th>
                            <td>{{ number_format($exp_total, 2) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    @endsection
