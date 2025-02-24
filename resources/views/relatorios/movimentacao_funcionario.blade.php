@extends('relatorios.default')
@section('content')

<style type="text/css">
    .b-top{
        border-top: 1px solid #000;
    }
    .b-bottom{
        border-bottom: 1px solid #000;
    }
    .tabela-produtos {
        margin-bottom: 10px;
        width: 100%;
        font-size: 10px;
    }
    .cabecalho {
        text-align: left;
        background-color: #213363;
        color: white;
    }
    .produto, .devolucao {
        border-bottom: 1px solid rgb(206, 206, 206);
    }
    .devolucao {
        background-color: #f5f5f5;
    }
</style>

@foreach($data as $codigo => $emprestimos)
    <table class="table-sm table-borderless tabela-produtos" style="border: 1px solid">
        <thead>
            <tr class="cabecalho">
                <th colspan="3">Data: {{ \Carbon\Carbon::parse($emprestimos[0]['created_at'])->format('d/m/Y H:i') }}</th>
            </tr>
        </thead>

        @foreach($emprestimos as $key => $item)

            <tr class="pure-table-odd">
                <td colspan="3">
                    <strong style="color: @if($item->devolvido) green @else red @endif" >Item: {{$item->produto->id}} - {{$item->produto->nome}} @if($item->patrimonio_produto) PAT: {{$item->patrimonio_produto}} @endif | {{number_format($item->quantidade, 2, ',', '.')}} {{$item->produto->unidade}}</strong>
                </td>
            </tr>

            @if($item->devolucoes->isNotEmpty())
                <tr>
                    <td colspan="3">
                        <strong>Devoluções:</strong>
                        <ul style="list-style-type: none; padding-left: 0;">
                            @foreach($item->devolucoes as $dev)
                                <li>
                                    {{ $dev->quantidade_devolvida }} {{$item->produto->unidade}} em {{ \Carbon\Carbon::parse($dev->data_devolucao)->format('d/m/Y H:i') }}
                                </li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
            @endif
        @endforeach
    </table>

    <br>
@endforeach

@endsection
