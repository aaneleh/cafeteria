//INICIALIZAÇÃO DE VARIAVEIS GLOBAIS
const container = document.getElementById('produtos');
let categorias = ['bebidas','doces','salgados'];
let preco = 'todos';
let pesquisa = null;


//FUNÇÃO QUE SERÁ USADA PARA ORDENAR OS RESULTADOS POR PREÇO
function ordenarPrecos(modo, objeto){
    var obj = objeto;
    var troca;
    switch(modo){
        case 'asce':
            for (var i = 0; i < obj.length; i ++){
                for (var j = 0; j < obj.length; j ++){
                    if(i != j) {
                        if(obj[i].preco < obj[j].preco){
                            troca = obj[i];
                            obj[i] = obj[j];
                            obj[j] = troca;
                        }
                    }
                }
            }
        break;
        case 'desc':
            for (var i = 0; i < obj.length; i ++){
                for (var j = 0; j < obj.length; j ++){
                    if(i != j) {
                        if(obj[i].preco > obj[j].preco){
                            troca=obj[i];
                            obj[i] = obj[j];
                            obj[j] = troca;
                        }
                    }
                }
            }
        break;
    }
    return obj;
}

//CARREGAR E PRINTAR AS INFORMAÇÕES DO produtos.json
async function loadJson(){
    //FETCH
    const response = await fetch('produtos.json');
    const data = await response.json();
    
    //ORDENAR POR PRECO (ASCENDENTE OU DESCRESCENTE)
    if(preco != 'todos'){
        ordenarPrecos(preco, data);
    }

    //PRINTA AS INFORMAÇÕES DO JSON
    container.innerHTML = "";
    for(i=0; i < data.length; i++){
        //CHECA SE O PRODUTO ATUAL ATINGE A CONDICAO DA CATEGORIA, SE NÃO ATINGIR NÃO PRINTA
        if(categorias.length == 0 || categorias.includes(data[i].categoria)){
            //CHECA SE O PRODUTO ATUAL ATINGE A CONDICAO DA PESQUISA, SE NÃO ATINGIR NÃO PRINTA
            if(pesquisa == null || data[i].nome.toUpperCase().includes( pesquisa.toUpperCase() )) {
                const produto = document.createElement('div');
                produto.innerHTML = `
                    <div class="imagem-produto">
                        <img src="images/${data[i].arquivo}" alt="${data[i].nome}">
                    </div>
                    <p class="produto-nome">
                        ${data[i].nome}
                    </p>
                    <div class="botao-compra">
                        <a class="link-compra" href="produto.html?id=${i}" >
                            <span class="preco">R$ ${data[i].preco}</span>
                            <span class="icone"><i class="bi bi-cart"></i></span>
                        </a>
                    </div>
                `
                produto.classList.add('produto');
                container.appendChild(produto);
            }   
        }
    }
    //SE NADA FOI PRINTADO COLOCA UM AVISO
    if(container.textContent == ""){
        container.innerHTML = ` <h2 style="text-align: center"> Desculpe, mas não encontramos um produto que atinja suas buscas :( </h2>`
    }
}
loadJson(); //inicia o site carregando as informações, claro

function removeCategoria(novaCategoria){
    for(var i = 0;i<categorias.length;i++){
        if(categorias[i] == novaCategoria){
            categorias.splice(i,1);
            i = categorias.length;
            document.getElementById(novaCategoria).classList.remove('ativa');
        }
    }
}

function toggleBebidas(){
    if(!categorias.includes('bebidas')){
        categorias.push('bebidas');
        document.getElementById('bebidas').classList.add('ativa');
    } else removeCategoria('bebidas');
    pesquisar();
}

function toggleDoces(){
    if(!categorias.includes('doces')){
        categorias.push('doces');
        document.getElementById('doces').classList.add('ativa');
    } else removeCategoria('doces');
    pesquisar();
}

function toggleSalgados(){
    if(!categorias.includes('salgados')){
        categorias.push('salgados');
        document.getElementById('salgados').classList.add('ativa');
    } else removeCategoria('salgados');
    pesquisar();
}

//FUNÇÃO DE PESQUISA
function pesquisar() {
    //pega as informações dos inputs
    const precoEl = document.getElementById('preco').value;
    preco = precoEl;
    const searchEl = document.getElementById('pesquisa').value;
    if(searchEl == ""){
        pesquisa = null;
    } else {
        pesquisa = searchEl.toUpperCase();
    }
    //se não foi colocado nenhum parametro na pesquisa ele nem recarrega o json
    if(categorias.length == 0 || preco != null || searchEl != null){
        loadJson();
    }
}
const search_input = document.getElementById('pesquisa').addEventListener('keyup', function(event){
    if(event.keyCode == 13){
        pesquisar();
    }
});
const preco_select = document.getElementById('preco').addEventListener('change', function(event){
    pesquisar();
});