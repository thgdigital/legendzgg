@extends('layouts.default')
@section('pageTitle', 'Cadastrar cartão')
@section('content')


    <div class="box-list-credit">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('status'))
                <div class="alert alert-warning">
                    {{ session('status') }}
                </div>
            @endif
            @if (session('warning'))
                <div class="alert alert-warning">
                    {{ session('warning') }}
                </div>
            @endif
            <a href="{{url("suporte/create")}}" class="btn btn-primary">Cadastrar novo Ticket</a>
            <br/>
            <br/>
            <br/>

            <table class="table" id="cadList">
                <thead class="thead-light">
                <tr>
                    <th scope="col">Topico</th>
                    <th scope="col">Outros</th>
                    <th scope="col">Detalhes</th>
                    <th scope="col">Status</th>
                    <th scope="col">Data de Criação</th>
                    <th scope="col">Data de atualização</th>
                    <th scope="col">Acão</th>
                </tr>
                </thead>
                <tbody>
                @if ($suportes)
                    @foreach ($suportes as $suporte)

                        <?php
                                $status = "";
                                $tipico = "";
                                $classTipico = "default";
                                $classStatus = "primary";

                          if($suporte->topico == 1){
                              $tipico = "COMPRA DE CRÉDITOS";

                          }else if($suporte->topico == 2){

                            $tipico = "CONTA";

                          }else if($suporte->topico == 3){
                              $tipico = "LOJA";
                          }else if($suporte->topico == 4){
                              $tipico = "RIFA";
                          }else{
                              $tipico = "SAQUE";
                          }

                        if($suporte->status == 1){
                            $status = "Aberto";
                        }else if($suporte->status == 2){
                            $status = "Respondido";
                            $classStatus = "warning";
                        }else{
                            $status = "Fechado";
                            $classStatus = "danger";
                        }
                        ?>
                        <tr>
                            <td><span class="label label-<?php echo $classTipico; ?>">{{$tipico}}</span></td>
                            <td>{{$suporte->outros}}</td>
                            <td><?php echo substr($suporte->detalhe, 0, -5)?>...</td>
                            <td><span class="label label-<?php echo $classStatus; ?>">{{$status}}</span></td>
                            <td>
                                <?php echo date('d/m/Y', strtotime($suporte->created_at))?></td>
                            <td>
                                <?php echo date('d/m/Y', strtotime($suporte->updated_at))?>


                            <td>


                            </td>
                        </tr>
                     @endforeach
                @endif
                </tbody>
            </table>
    </div>
@stop
@push('scripts')
<script src="{{ asset('assets/js/cardList.js') }}"></script>
@endpush