<!-- SCRIPTS -->
<script>
    //CEP 
    document.addEventListener("DOMContentLoaded", function () {
    const allCepInputs = document.querySelectorAll("[id^='cep']");

    allCepInputs.forEach((cepInput) => {
        cepInput.addEventListener("input", function (e) {
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
    //SALARIO
    document.addEventListener("DOMContentLoaded", function () {
    const salarioInput = document.getElementById("salario");

    salarioInput.addEventListener("input", function (e) {
        let value = e.target.value;

        // Remove tudo que não for número
        value = value.replace(/\D/g, "");

        // Formata para o padrão brasileiro (milhar com ponto e decimal com vírgula)
        let formatted = "";
        if (value.length) {
            let cents = value.slice(-2);  // Centavos
            let reais = value.slice(0, -2);  // Reais
            formatted = reais.replace(/\B(?=(\d{3})+(?!\d))/g, ".") + "," + cents;
        } else {
            // Caso o valor tenha menos de 3 dígitos, apenas adicione os centavos corretamente
            formatted = "0," + value.padStart(2, "0");
        }

        // Evita adicionar zeros a mais caso o valor já tenha a formatação
        e.target.value = formatted;
    });
});

</script>
<!-- API DO CEP-->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const cepInput = document.getElementById("cep");
    
        cepInput.addEventListener("blur", function () {
            const cep = cepInput.value.replace(/\D/g, "");
            if (cep.length !== 8) return;
    
            fetch(`https://viacep.com.br/ws/${cep}/json/`)
                .then(response => response.json())
                .then(data => {
                    if (!data.erro) {
                        document.getElementById("rua").value = data.logradouro || '';
                        document.getElementById("bairro").value = data.bairro || '';
                        document.getElementById("cidade").value = data.localidade || '';
                        document.getElementById("estado").value = data.uf || '';
                    } else {
                        alert("CEP não encontrado.");
                    }
                })
                .catch(() => {
                    alert("Erro ao buscar o CEP.");
                });
        });
    });
    </script>
    

<!-- SCRIPTS -->

<!-- Modal -->
<div class="modal fade" id="create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Preencher com seus dados</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('avelar.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Nome</label>
                        <input type="text" class="form-control" name="nome" id="nome"
                            aria-describedby="helpId" placeholder="Nome"pattern="^[A-Za-zÀ-ÿ\s]+$" 
                            title="Digite apenas letras (sem números ou caracteres especiais)" required />
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Idade</label>
                        <input type="text" class="form-control" name="idade" id="idade" maxlength="2"
                            aria-describedby="helpId" placeholder="Idade" required pattern="^[1-9][0-9]?$" title="Digite uma idade entre 1 e 99 (somente números)" />
                    </div>                    
                    <div class="mb-3">
                        <label for="cep" class="form-label">CEP</label>
                        <input type="text" class="form-control" name="cep" id="cep" maxlength="9"
                            aria-describedby="helpId" pattern="\d{5}-\d{3}" placeholder="99999-999" required />
                        <small class="text-muted">CEP: formato 99999-999</small>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Cidade</label>
                        <input type="text" class="form-control" name="cidade" id="cidade"
                            aria-describedby="helpId" placeholder="Cidade" pattern="^[A-Za-zÀ-ÿ\s]+$" 
                            title="Digite apenas letras (sem números ou caracteres especiais)" required />

                    </div>
                    <div class="mb-3">
                        <label for="estado" class="form-label">Estado (UF)</label>
                        <select class="form-select" name="estado" id="estado" required>
                            <option value="" selected disabled>Selecione</option>
                            <option value="AC">Acre</option>
                            <option value="AL">Alagoas</option>
                            <option value="AP">Amapá</option>
                            <option value="AM">Amazonas</option>
                            <option value="BA">Bahia</option>
                            <option value="CE">Ceará</option>
                            <option value="DF">Distrito Federal</option>
                            <option value="ES">Espírito Santo</option>
                            <option value="GO">Goiás</option>
                            <option value="MA">Maranhão</option>
                            <option value="MT">Mato Grosso</option>
                            <option value="MS">Mato Grosso do Sul</option>
                            <option value="MG">Minas Gerais</option>
                            <option value="PA">Pará</option>
                            <option value="PB">Paraíba</option>
                            <option value="PR">Paraná</option>
                            <option value="PE">Pernambuco</option>
                            <option value="PI">Piauí</option>
                            <option value="RJ">Rio de Janeiro</option>
                            <option value="RN">Rio Grande do Norte</option>
                            <option value="RS">Rio Grande do Sul</option>
                            <option value="RO">Rondônia</option>
                            <option value="RR">Roraima</option>
                            <option value="SC">Santa Catarina</option>
                            <option value="SP">São Paulo</option>
                            <option value="SE">Sergipe</option>
                            <option value="TO">Tocantins</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Rua</label>
                        <input type="text" class="form-control" name="rua" id="rua"
                            aria-describedby="helpId" pattern="^[A-Za-zÀ-ÿ0-9\s]+$" 
                            title="Digite apenas letras, números e espaços (sem caracteres especiais)" placeholder="Rua" required />

                    </div>
                    <div class="mb-3">
                        <label for="bairro" class="form-label">Bairro</label>
                        <input type="text" class="form-control" name="bairro" id="bairro"
                            aria-describedby="helpId" placeholder="Bairro"
                            pattern="^[A-Za-zÀ-ÿ\s]+$" 
                            title="Digite apenas letras (sem números ou caracteres especiais)" required />
                    </div>
                    
                    <div class="mb-3">
                        <label for="ensino_medio" class="form-label">Ensino Médio</label>
                        <div class="form-check">
                            <input type="hidden" name="ensino_medio" value="0">
                            
                            <input type="checkbox" class="form-check-input" name="ensino_medio" id="ensino_medio"
                                value="1" {{ old('ensino_medio') == 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="ensino_medio">Concluído</label>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="sexo" class="form-label">Sexo</label>
                        <select class="form-select" name="sexo" id="sexo" required>
                            <option value="" selected disabled>Selecione</option>
                            <option value="Masculino">Masculino</option>
                            <option value="Feminino">Feminino</option>
                            <option value="Outro">Outro</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="salario" class="form-label">Salário</label>
                        <input type="text" class="form-control" name="salario" id="salario" maxlength="10"
                            aria-describedby="helpId" placeholder="Ex: 1.234,56" required />
                    </div>

                    <div class="mb-3">
                        <label for="anexo" class="form-label">Anexo</label>
                        <input 
                            type="file" 
                            class="form-control" 
                            name="anexo[]" 
                            id="anexo" 
                            accept="image/*,application/pdf" 
                            multiple
                        >
                    </div>
                                    
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
            </form>
        </div>
    </div>
</div>
