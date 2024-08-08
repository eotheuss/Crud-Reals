<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <form id="formUpdate" name="formUpdate" method="POST" action="{{ route('users.update', $user->id) }}">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <h1>Edição de Usuário</h1>
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="nome" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="nome" name="name" value="{{ old('name', $user->name) }}" placeholder="Digite seu nome">
                        </div>
                        <div class="col-md-6">
                            <label for="cpf" class="form-label">CPF</label>
                            <input type="text" class="form-control" id="cpf" name="cpf" value="{{ old('cpf', $user->cpf) }}" placeholder="Digite seu CPF">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            <label for="data-nascimento" class="form-label">Data de Nascimento</label>
                            <input type="date" class="form-control" id="data-nascimento" name="birthdate" value="{{ old('birthdate', $user->birthdate) }}">
                        </div>
                        <div class="col-md-9">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" placeholder="Digite seu e-mail">
                        </div>
                    </div>            
                    <br>
                    <div class="row">
                        <div class="col-md-8">
                            <label for="endereco" class="form-label">Endereço</label>
                            <input type="text" class="form-control" id="endereco" name="address" value="{{ old('address', $user->address) }}" placeholder="Digite seu endereço">
                        </div>
                        <div class="col-md-4">
                            <label for="telefone" class="form-label">Telefone</label>
                            <input type="tel" class="form-control" id="telefone" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="Digite seu telefone">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="estado" class="form-label">Estado</label>
                            <select id="estado" name="state" class="form-control" onchange="carregarCidades()">
                                <option value="">Selecione um estado</option>
                                @foreach($estados as $estado)
                                    <option value="{{ $estado }}" {{ old('state', $user->state) == $estado ? 'selected' : '' }}>{{ $estado }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="cidade" class="form-label">Cidade</label>
                            <select id="cidade" name="city" class="form-control">
                                <option value="">Selecione uma cidade</option>
                                @if(old('state', $user->state))
                                    @foreach($cidades as $cidade)
                                        <option value="{{ $cidade }}" {{ old('city', $user->city) == $cidade ? 'selected' : '' }}>{{ $cidade }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" style="width: 100%;" class="btn btn-primary">Atualizar</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
        </form>
    </div>
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-mask-plugin@1.14.16/dist/jquery.mask.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
