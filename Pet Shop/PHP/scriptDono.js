
        // floreio -- para o usuário confirmar a exclusão
        function excluir(url){
            if (confirm("Confirma a exclusão?"))
                window.location.href = url; //redireciona para o arquivo que irá efetuar a exclusão
        }

        window.onload = (function (){
            carregaDados();
            document.getElementById('pesquisa').addEventListener('submit',function(ev){
                ev.preventDefault();
                carregaDados();
            });
            document.getElementById('busca').addEventListener('keyup',carregaDados);
        });

        function carregaDados(){
            busca = document.getElementById('busca').value;
            const xhttp = new XMLHttpRequest();  // cria o objeto que fará a conexão assíncrona
            xhttp.onload = function() {  // executa essa função quando receber resposta do servidor
                dados = JSON.parse(this.responseText); // os dados são convertidos para objeto javascript
                montaTabela(dados);
            }
            // configuração dos parâmetros da conexão assíncrona
            xhttp.open("GET", "pesquisaDono.php?busca=" + busca, true);  // arquivo que será acessado no servidor remoto  
            xhttp.send(); // parâmetros para a requisição

        }
        function montaTabela(dados){
            str = "";
            for(Dono of dados){
                editar = '<a href=cadDono.php?acao=editar&id='+Dono.id+'>Alt</a>';
                excluir = "<a href='cadDono' onclick=excluir('acaoDono.php?acao=excluir&id="+Dono.id+"}')>Excluir</a>";
                str += "<tr><td>"+Dono.id+"</td><td>"+Dono.nome+'</td><td>'+Dono.telefone+'</td><td>'+Dono.Endereco+'</td><td>'+editar+'</td><td>'+excluir+'</td></tr>';
            }
            document.getElementById('corpo').innerHTML = str;
        }
