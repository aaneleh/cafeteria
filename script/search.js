//INICIALIZAÇÃO DE VARIAVEIS GLOBAIS
const container = document.getElementById('produtos');
let condicoes = { categoria: 'todos', preco: 'todos', pesquisa: null };

//FUNÇÃO QUE SERÁ USADA PARA ORDENAR OS RESULTADOS POR PREÇO
function ordenarPrecos(modo, objeto){
    var obj = objeto;
    var troca;
    console.log(modo)
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
    const response = await fetch('data/produtos.json');
    const data = await response.json();
    
    //ORDENAR POR PRECO (ASCENDENTE OU DESCRESCENTE)
    if(condicoes.preco != 'todos'){
        ordenarPrecos(condicoes.preco, data);
    }

    //PRINTA AS INFORMAÇÕES DO JSON
    container.innerHTML = "";
    for(i=0; i < data.length; i++){
        //CHECA SE O PRODUTO ATUAL DO LOOP ATINGE A CONDICAO DA CATEGORIA, SE NÃO ATINGIR NÃO PRINTA
        if(condicoes.categoria == 'todos' || data[i].categoria == condicoes.categoria){ 
            const produto = document.createElement('div');
            produto.innerHTML = `
                <h2>
                    ${data[i].nome}
                </h2>
                <div class="produto-imagem container-imagem">
                    <img src="images/${data[i].arquivo}" alt="${data[i].nome}">
                </div>
                <h2>
                    <sup> R$ </sup>
                    ${data[i].preco}
                </h2>
                <a href="api/produto.html?id=${data[i].id}" class="buy-button"> Compre agora </a>
            `
            container.appendChild(produto);
        }
    }
    //SE NADA FOI PRINTADO COLOCA UM AVISO
    if(container.textContent == ""){
        container.innerHTML = ` <h2 style="text-align: center"> Desculpe, mas não encontramos um produto que atinja suas buscas :( </h2>`
    }
}
loadJson(); //inicia o site carregando as informações, claro

//VISIBILIDADE DA BARRA DE PESQUISA
function toggleSearch() {
    const searchBar = document.getElementById('search-bar');
    searchBar.classList.toggle('active');
}

//FUNÇÃO DE PESQUISA
function pesquisar() {
    //pega as informações dos inputs
    const categoria = document.getElementById('categoria').value;
    condicoes.categoria = categoria;
    const preco = document.getElementById('preco').value;
    condicoes.preco = preco;
    const search_input = document.getElementById('pesquisa').value;
    if(search_input == ""){
        condicoes.pesquisa = null;
    } else {
        condicoes.pesquisa = search_input.toUpperCase();
    }
    //se não foi colocado nenhum parametro na pesquisa ele nem recarrega o json
    if(categoria != null || preco != null || search_input != null){
        loadJson();
    }
}
const search_input = document.getElementById('pesquisa').addEventListener('keyup', function(event){
    if(event.keyCode == 13){
        pesquisar();
    }
});