@extends('welcome')

@section('content')
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create">
    <img src="{{ asset('iconess/usercreate.svg') }}" alt="Novo" style="width: 16px; height: 16px; margin-right: 5px;">
    Novo
  </button>

<div class="table-responsive pt-3">
    <table class="table tabela-custom">
        <thead class="tabela-cabecalho">
            <tr>
                <th scope="col"><img src="{{ asset('iconess/key.svg') }}" alt="Nome" width="16" height="16" style="margin-right: 2px;">ID </th>
                <th scope="col"> <img src="{{ asset('iconess/users.svg') }}" alt="Nome" width="16" height="16" style="margin-right: 3px;">Nome</th>
                <th scope="col"><img src="{{ asset('iconess/calendar.svg') }}" alt="Nome" width="16" height="16" style="margin-right: 2px;">Idade</th>
                <th scope="col"><img src="{{ asset('iconess/compass.svg') }}" alt="Nome" width="16" height="16" style="margin-right: 2px;">CEP </th>
                <th scope="col"><img src="{{ asset('iconess/map.svg') }}" alt="Nome" width="16" height="16" style="margin-right: 2px;">Cidade</th>
                <th scope="col"><img src="{{ asset('iconess/map2.svg') }}" alt="Nome" width="16" height="16" style="margin-right: 2px;">Estado</th>
                <th scope="col"><img src="{{ asset('iconess/rua.svg') }}" alt="Nome" width="16" height="16" style="margin-right: 2px;">Rua </th>
                <th scope="col"><img src="{{ asset('iconess/city-solid.svg') }}" alt="Nome" width="16" height="16" style="margin-right: 2px;">Bairro</th>
                <th scope="col"><img src="{{ asset('iconess/ensino.svg') }}" alt="Nome" width="16" height="16" style="margin-right: 2px;">Ensino Médio</th>
                <th scope="col"><img src="{{ asset('iconess/gener.svg') }}" alt="Nome" width="16" height="16" style="margin-right: 2px;">Sexo</th>
                <th scope="col"><img src="{{ asset('iconess/money.svg') }}" alt="Nome" width="16" height="16" style="margin-right: 2px;">Salário</th>
                <th scope="col"><img src="{{ asset('iconess/file.svg') }}" alt="Nome" width="16" height="16" style="margin-right: 2px;">Anexo</th>
                <th><th>
            </tr>
        </thead>
        <tbody>

        @foreach ($dados as $row)
            <tr class="">
                <td scope="row">{{ $row->id }}</td>
                <td>{{ $row->nome }}</td>
                <td>{{ $row->idade }}</td>
                <td>{{ $row->cep }}</td>
                <td>{{ $row->cidade }}</td>
                <td>{{ $row->estado }}</td>
                <td>{{ $row->rua }}</td>
                <td>{{ $row->bairro }}</td>
                <td>{{ $row->ensino_medio == 1 ? 'Completo' : 'Incompleto' }}</td>
                <td>{{ $row->sexo }}</td>
                <td>R${{ number_format($row->salario, 2, ',', '.') }}</td>
                <td>
                    @php
                        $anexos = json_decode($row->anexo, true); // Caso sejam vários anexos
                        if (!is_array($anexos)) {
                            $anexos = [$row->anexo]; // Se for um só
                        }
                    @endphp
                
                    @foreach ($anexos as $anexo)
                        @php
                            $ext = pathinfo($anexo, PATHINFO_EXTENSION);
                        @endphp
                
                        @if(in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                            <img src="{{ asset('assets/storage/' . $anexo) }}" alt="Imagem" style="width: 60px; height: auto; margin: 2px; border-radius: 4px;">
                        @elseif($ext === 'pdf')
                            <a href="{{ asset('assets/storage/' . $anexo) }}" target="_blank">Ver PDF</a>
                        @else
                            <a href="{{ asset('assets/storage/' . $anexo) }}" target="_blank">Download</a>
                        @endif
                    @endforeach
                </td>
                
                
                <td>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#edit{{$row->id}}"><img src="{{ asset('iconess/edit.svg') }}" alt="Editar" style="width: 15px; height: 15px; margin-right: 1px;">
                        Editar
                      </button>                    
                </td>
                <td>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete{{$row->id}}"><img src="{{ asset('iconess/exc.svg') }}" alt="Excluir" style="width: 15px; height: 15px; margin-right: 1px;">
                        Excluir
                      </button>                    
                </td>
            </tr>
            @include('avelar.info')
            @endforeach
        </tbody>
    </table>
</div>
@include('avelar.create')
@endsection