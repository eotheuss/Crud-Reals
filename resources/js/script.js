document.addEventListener('DOMContentLoaded', function() {
    carregarEstados();
    $('#telefone').mask('(00) 00000-0000');
});

async function carregarEstados() {
    const estadoSelect = document.getElementById('estado');
    try {
        const response = await fetch('https://servicodados.ibge.gov.br/api/v1/localidades/estados');
        const estados = await response.json();

        estados.sort((a, b) => a.nome.localeCompare(b.nome)).forEach(estado => {
            const option = document.createElement('option');
            option.value = estado.sigla;
            option.textContent = estado.nome;
            estadoSelect.appendChild(option);
        });
    } catch (error) {
        console.error('Erro ao carregar os estados:', error);
    }
}

async function carregarCidades() {
    const estado = document.getElementById('estado').value;
    const cidadeSelect = document.getElementById('cidade');
    
    cidadeSelect.disabled = true;
    cidadeSelect.innerHTML = '<option value="">Carregando...</option>';
    
    if (estado) {
        fetch(`/cidades/${estado}`)
            .then(response => response.json())
            .then(cidades => {
                cidadeSelect.disabled = false;
                cidadeSelect.innerHTML = '<option value="">Selecione uma cidade</option>';
                cidades.forEach(cidade => {
                    const option = document.createElement('option');
                    option.value = cidade.nome;
                    option.text = cidade.nome;
                    cidadeSelect.appendChild(option);
                });
            });
    } else {
        cidadeSelect.innerHTML = '<option value="">Selecione um estado primeiro</option>';
    }
}

