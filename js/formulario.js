
    //funcao para mostrar o formulario debito ou credito 
    abrirFormulario = function () {
        var credito = document.getElementsByClassName('credito')[0];
        var debito = document.getElementsByClassName('debito')[0];
        if(this.value == 1){
            credito.classList.remove('d-none');
            debito.classList.add('d-none');
        } else {
            debito.classList.remove('d-none');
            credito.classList.add('d-none');
        }
    }

    //adiciona a funcao abrirFormulario ao inputs
    document.getElementsByName('forma').forEach(input => {
        input.addEventListener('click', abrirFormulario);
    })

    // verifica cep e busca na api via cep caso encontre preenche o endereco
    var preencherEndereco = function(){
        var cep = this.value.replace('-','');
        if(cep.length == 8){
            var ajax = new XMLHttpRequest();
            ajax.onreadystatechange = function() {
                if (ajax.readyState == XMLHttpRequest.DONE) {   
                    if (ajax.status == 200) {
                        var endereco = JSON.parse(ajax.responseText);
                        if(endereco.erro){
                            return false;
                        }
                        document.getElementsByName('logradouro')[0].value = endereco.logradouro;
                        document.getElementsByName('bairro')[0].value = endereco.bairro;
                        document.getElementsByName('cidade')[0].value = endereco.localidade;
                        document.getElementsByName('estado')[0].value = endereco.uf;
                    }
                }
            }
            ajax.open("GET", "https://viacep.com.br/ws/"+cep+"/json/", true);
            ajax.send();
        }
    }
    document.getElementsByName('cep')[0].addEventListener('keyup', preencherEndereco);

    //mascara dinheiro
    document.getElementsByName('doacao')[0].addEventListener('keyup', function() {
        var value = this.value.replace(',','');
        this.value = value.substr(0,value.length - 2) + ',' + value.substr(value.length - 2, value.length);
    });
    
    
    // verifica se os campos do formulario foram preenchido 
    verificaCamposPreenchidos = function (event) {
        event.preventDefault();
        var nome = document.getElementsByName('nome')[0];
        var email = document.getElementsByName('email')[0];
        var cpf = document.getElementsByName('cpf')[0];
        var telefone = document.getElementsByName('telefone')[0];
        var nascimento = document.getElementsByName('nascimento')[0];
        var doacao = document.getElementsByName('doacao')[0];
        var cep = document.getElementsByName('cep')[0];
        var logradouro = document.getElementsByName('logradouro')[0];
        var numeroEnd = document.getElementsByName('numero_endereco')[0];
        var bairro = document.getElementsByName('bairro')[0];
        var cidade = document.getElementsByName('cidade')[0];
        var estado = document.getElementsByName('estado')[0];
        var forma = document.getElementsByName('forma');
        var bandeira = document.getElementsByName('bandeira')[0];
        var numero = document.getElementsByName('numero')[0];
        var agencia = document.getElementsByName('agencia')[0];
        var conta = document.getElementsByName('conta')[0];

        var invalido = false;

        if(!nome.value.length){
            nome.classList.add('is-invalid');
            invalido = true;
        } else {
            nome.classList.remove('is-invalid');
        }

        if(!email.value.length){
            email.classList.add('is-invalid');
            invalido = true;
        } else {
            email.classList.remove('is-invalid');
        }

        if(!cpf.value.length){
            cpf.classList.add('is-invalid');
            invalido = true;
        } else {
            cpf.classList.remove('is-invalid');
        }

        if(!telefone.value.length){
            telefone.classList.add('is-invalid');
            invalido = true;
        } else {
            telefone.classList.remove('is-invalid');
        }

        if(!nascimento.value.length){
            nascimento.classList.add('is-invalid');
            invalido = true;
        } else {
            nascimento.classList.remove('is-invalid');
        }
        if(!doacao.value.length){
            doacao.classList.add('is-invalid');
            invalido = true;
        } else {
            doacao.classList.remove('is-invalid');
        }

        if(!cep.value.length){
            cep.classList.add('is-invalid');
            invalido = true;
        } else {
            cep.classList.remove('is-invalid');
        }

        if(!logradouro.value.length){
            logradouro.classList.add('is-invalid');
            invalido = true;
        } else {
            logradouro.classList.remove('is-invalid');
        }

        if(!numeroEnd.value.length){
            numeroEnd.classList.add('is-invalid');
            invalido = true;
        } else {
            numeroEnd.classList.remove('is-invalid');
        }

        if(!bairro.value.length){
            bairro.classList.add('is-invalid');
            invalido = true;
        } else {
            bairro.classList.remove('is-invalid');
        }

        if(!cidade.value.length){
            cidade.classList.add('is-invalid');
            invalido = true;
        } else {
            cidade.classList.remove('is-invalid');
        }

        if(!estado.value.length){
            estado.classList.add('is-invalid');
            invalido = true;
        } else {
            estado.classList.remove('is-invalid');
        }

       if(forma[0].checked){
            if(!bandeira.value.length){
                bandeira.classList.add('is-invalid');
                invalido = true;
            } else {
                bandeira.classList.remove('is-invalid');
            }
            if(!numero.value.length){
                numero.classList.add('is-invalid');
                invalido = true;
            } else {
                numero.classList.remove('is-invalid');
            }

       } else if (forma[1].checked){
            if(!agencia.value.length){
                agencia.classList.add('is-invalid');
                invalido = true;
            } else {
                agencia.classList.remove('is-invalid');
            }
            if(!conta.value.length){
                conta.classList.add('is-invalid');
                invalido = true;
            } else {
                conta.classList.remove('is-invalid');
            }
       }



        if(invalido != true){
            event.currentTarget.submit();
        } else {
            alert('preencha todos os campos do formulario');
        }
    }

    document.getElementsByTagName('form')[0].addEventListener('submit', verificaCamposPreenchidos);
