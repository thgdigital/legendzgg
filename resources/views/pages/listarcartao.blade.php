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
            <a href="{{url("jogador/cadastrar-credit")}}" class="btn btn-primary">Cadastrar novo cartão</a>
            <br/>
            <br/>
            <br/>
            <table class="table" id="cadList">
                <thead class="thead-light">
                <tr>
                    <th scope="col">Numero</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Bandeira</th>
                    <th scope="col">Cvv</th>
                    <th scope="col">CPF</th>
                    <th scope="col">Validade</th>
                    <th scope="col">Acão</th>
                </tr>
                </thead>
                <tbody>
                @if ($cards)
                    @foreach ($cards as $card)
                        <tr>
                            <td><?php echo substr($card->number, 0, -8)?></td>
                            <td><?php echo substr($card->name, 0, -10)?>...</td>
                            <td>{{$card->bandeira}}</td>
                            <td>{{$card->cvv}}</td>
                            <td>{{$card->cpf}}</td>
                            <td>{{$card->validade}}</td>
                            <td>
                                <a  href="{{url("jogador/edit-cartao/".$card->id)}}" class="btn btn-primary btn-sm"><i class="far fa-edit"></i></a>
                                <button class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button>

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