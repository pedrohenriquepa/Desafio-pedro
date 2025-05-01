<!-- SCRIPTS -->
<script>
    //CEP 
    document.addEventListener("DOMContentLoaded", function() {
        const allCepInputs = document.querySelectorAll("[id^='cep2']");

        allCepInputs.forEach((cepInput) => {
            cepInput.addEventListener("input", function(e) {
                let value = e.target.value.replace(/\D/g, "").slice(0, 8);

                if (value.length > 5) {
                    value = value.slice(0, 5) + "-" + value.slice(5);
                }

                e.target.value = value;
            });
        });
    });
</script>

<script>
    //SALÁRIO
    document.addEventListener("DOMContentLoaded", function() {
        const salarioInputs = document.querySelectorAll("#salario");

        salarioInputs.forEach((salarioInput) => {
            salarioInput.addEventListener("input", function(e) {
                let value = e.target.value.replace(/\D/g, ""); // Remove tudo que não for número

                if (value.length) { // Se tiver mais de 2 dígitos
                    let reais = value.slice(0, -2); // Particiona o valor em reais e centavos
                    let centavos = value.slice(-2);

                    // Formatação com ponto para milhar e vírgula para separar os centavos
                    let formatted = reais.replace(/\B(?=(\d{3})+(?!\d))/g, ".") + "," +
                    centavos;
                    e.target.value = formatted; // Atualiza o campo com o valor formatado
                } else {
                    // Se o valor for menor que 2, mostra com 0,00
                    e.target.value = "0," + value.padStart(2, "0");
                }
            });
        });
    });
</script>


<!-- SCRIPTS -->
<!-- API DO CEP-->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const cepInput = document.getElementById("cep2");

        cepInput.addEventListener("blur", function() {
            const cep = cepInput.value.replace(/\D/g, "");
            if (cep.length !== 8) return;

            fetch(`https://viacep.com.br/ws/${cep}/json/`)
                .then(response => response.json())
                .then(data => {
                    if (!data.erro) {
                        document.getElementById("rua2").value = data.logradouro || '';
                        document.getElementById("bairro2").value = data.bairro || '';
                        document.getElementById("cidade2").value = data.localidade || '';
                        document.getElementById("estado2").value = data.uf || '';
                    } else {
                        alert("CEP não encontrado.");
                    }
                })

        });
    });
</script>

<!-- Modal edit -->
<div class="modal fade" id="edit{{ $row->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Editar seus dados</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('avelar.update', $row->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="" class="form-label">Nome</label>
                        <input type="text" class="form-control" name="nome" id="nome2"
                            aria-describedby="helpId" value="{{ $row->nome }}" pattern="^[A-Za-zÀ-ÿ\s]+$"
                            title="Digite apenas letras (sem números ou caracteres especiais)" required />
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Idade</label>
                        <input type="text" class="form-control" name="idade" id="idade2{{ $row->id }}"
                            maxlength="2" value="{{ $row->idade }}" required pattern="^[1-9][0-9]?$"
                            title="Digite uma idade entre 1 e 99 (somente números)" />
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Cep</label>
                        <input type="text" class="form-control" name="cep" id="cep2" maxlength="9"
                            aria-describedby="helpId" pattern="\d{5}-\d{3}" value="{{ $row->cep }}" required />

                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Cidade</label>
                        <input type="text" class="form-control" name="cidade" id="cidade2"
                            aria-describedby="helpId" pattern="^[A-Za-zÀ-ÿ\s]+$"
                            title="Digite apenas letras (sem números ou caracteres especiais)"
                            value="{{ $row->cidade }}" required />

                    </div>
                    <div class="mb-3">
                        <label for="estado" class="form-label">Estado (UF)</label>
                        <select class="form-select" name="estado" id="estado" required>
                            <option value="" disabled>Selecione</option>
                            <option value="AC" {{ $row->estado == 'AC' ? 'selected' : '' }}>Acre</option>
                            <option value="AL" {{ $row->estado == 'AL' ? 'selected' : '' }}>Alagoas</option>
                            <option value="AP" {{ $row->estado == 'AP' ? 'selected' : '' }}>Amapá</option>
                            <option value="AM" {{ $row->estado == 'AM' ? 'selected' : '' }}>Amazonas</option>
                            <option value="BA" {{ $row->estado == 'BA' ? 'selected' : '' }}>Bahia</option>
                            <option value="CE" {{ $row->estado == 'CE' ? 'selected' : '' }}>Ceará</option>
                            <option value="DF" {{ $row->estado == 'DF' ? 'selected' : '' }}>Distrito Federal
                            </option>
                            <option value="ES" {{ $row->estado == 'ES' ? 'selected' : '' }}>Espírito Santo</option>
                            <option value="GO" {{ $row->estado == 'GO' ? 'selected' : '' }}>Goiás</option>
                            <option value="MA" {{ $row->estado == 'MA' ? 'selected' : '' }}>Maranhão</option>
                            <option value="MT" {{ $row->estado == 'MT' ? 'selected' : '' }}>Mato Grosso</option>
                            <option value="MS" {{ $row->estado == 'MS' ? 'selected' : '' }}>Mato Grosso do Sul
                            </option>
                            <option value="MG" {{ $row->estado == 'MG' ? 'selected' : '' }}>Minas Gerais</option>
                            <option value="PA" {{ $row->estado == 'PA' ? 'selected' : '' }}>Pará</option>
                            <option value="PB" {{ $row->estado == 'PB' ? 'selected' : '' }}>Paraíba</option>
                            <option value="PR" {{ $row->estado == 'PR' ? 'selected' : '' }}>Paraná</option>
                            <option value="PE" {{ $row->estado == 'PE' ? 'selected' : '' }}>Pernambuco</option>
                            <option value="PI" {{ $row->estado == 'PI' ? 'selected' : '' }}>Piauí</option>
                            <option value="RJ" {{ $row->estado == 'RJ' ? 'selected' : '' }}>Rio de Janeiro</option>
                            <option value="RN" {{ $row->estado == 'RN' ? 'selected' : '' }}>Rio Grande do Norte
                            </option>
                            <option value="RS" {{ $row->estado == 'RS' ? 'selected' : '' }}>Rio Grande do Sul
                            </option>
                            <option value="RO" {{ $row->estado == 'RO' ? 'selected' : '' }}>Rondônia</option>
                            <option value="RR" {{ $row->estado == 'RR' ? 'selected' : '' }}>Roraima</option>
                            <option value="SC" {{ $row->estado == 'SC' ? 'selected' : '' }}>Santa Catarina</option>
                            <option value="SP" {{ $row->estado == 'SP' ? 'selected' : '' }}>São Paulo</option>
                            <option value="SE" {{ $row->estado == 'SE' ? 'selected' : '' }}>Sergipe</option>
                            <option value="TO" {{ $row->estado == 'TO' ? 'selected' : '' }}>Tocantins</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Rua</label>
                        <input type="text" class="form-control" name="rua" id="rua2"
                            aria-describedby="helpId" pattern="^[A-Za-zÀ-ÿ0-9\s]+$"
                            title="Digite apenas letras, números e espaços (sem caracteres especiais)"
                            value="{{ $row->rua }}" />

                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Bairro</label>
                        <input type="text" class="form-control" name="bairro" id="bairro2"
                            aria-describedby="helpId" pattern="^[A-Za-zÀ-ÿ\s]+$"
                            title="Digite apenas letras (sem números ou caracteres especiais)"
                            value="{{ $row->bairro }}" />

                    </div>
                    <div class="mb-3">
                        <label for="ensino_medio" class="form-label">Ensino Médio</label>
                        <div class="form-check">
                            <input type="hidden" name="ensino_medio" value="0">
                            <input type="checkbox" class="form-check-input" name="ensino_medio" id="ensino_medio"
                                value="1" {{ old('ensino_medio', $row->ensino_medio) == 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="ensino_medio">Concluído</label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="sexo" class="form-label">Sexo</label>
                        <select class="form-select" name="sexo" id="sexo" required>
                            <option value="" disabled
                                {{ old('sexo', $row->sexo ?? '') == '' ? 'selected' : '' }}>Selecione</option>
                            <option value="Masculino"
                                {{ old('sexo', $row->sexo ?? '') == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                            <option value="Feminino"
                                {{ old('sexo', $row->sexo ?? '') == 'Feminino' ? 'selected' : '' }}>Feminino</option>
                            <option value="Outro" {{ old('sexo', $row->sexo ?? '') == 'Outro' ? 'selected' : '' }}>
                                Outro</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Salario</label>
                        <input type="text" class="form-control" name="salario" id="salario" maxlength="10"
                            aria-describedby="helpId" value="{{ number_format($row->salario, 2, ',', '.') }}"
                            placeholder="Ex: 1.234,56" required />
                    </div>
                    <div class="mb-3">
                        <label for="anexo{{ $row->id }}" class="form-label">Anexos</label>
                        <input type="file" class="form-control" name="anexo[]" id="anexo{{ $row->id }}"
                            accept="image/*,application/pdf" multiple>

                        @php
                            $anexos = json_decode($row->anexo, true);
                            $anexos = is_array($anexos) ? $anexos : [];
                        @endphp

                        @if (!empty($anexos))
                            <div class="mt-2">
                                <strong>Anexos atuais:</strong>
                                <ul>
                                    @foreach ($anexos as $arquivo)
                                        <li>
                                            <a href="{{ asset('assets/storage/' . $arquivo) }}" target="_blank">
                                                {{ $arquivo }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-primary"> <img src="{{ asset('iconess/useratualiza.svg') }}"
                        alt="Atualizar" style="width: 16px; height: 16px; margin-right: 5px;">Atualizar</button>
            </div>
            </form> <!-- Fechando o formulário corretamente -->
        </div>
    </div>
</div>

<div class="modal fade" id="delete{{ $row->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Apagar Registro</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('avelar.destroy', $row->id) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <!-- Mensagem de confirmação -->
                    Tem certeza que deseja excluir {{ $row->nome }}?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-danger"> <img
                        src="{{ asset('iconess/user-minus-solid.svg') }}" alt="Excluir"
                        style="width: 16px; height: 16px; margin-right: 5px;">Excluir</button>
            </div>
            </form> <!-- Fechando o formulário corretamente -->
        </div>
    </div>
</div>
