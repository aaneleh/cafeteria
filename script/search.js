
const container = document.getElementById('produtos');

let condicoes = {
    categoria: 'todos',
    preco: 'todos',
    pesquisa: null
};
async function loadJson(){
    const response = await fetch('data/produtos.json');
    const data = await response.json();
    
    /*
    if(condicoes.preco != 'todos'){
        switch(condicoes.preco){
            case 'asce':
                
                break;

            case 'desc':
                
                break;
        }
    }
    */

    //PRINTA AS INFORMAÇÕES DO JSON
    container.innerHTML = "";
    for(i=0; i < data.length; i++){
        if(condicoes.categoria == 'todos' || data[i].categoria == condicoes.categoria){ //CHECA SE O PRODUTO ATUAL DO LOOP ATINGE A CONDICAO DA CATEGORIA, SE NÃO ATINGIR NÃO PRINTA
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
                <a href="produto?id=${data[i].id}" class="buy-button"> Compre agora </a>
            `
            container.appendChild(produto);
        }
    }
    //SE NADA FOI PRINTADO COLOCA UM AVISO
    if(container.textContent == ""){
        container.innerHTML = ` <h2 style="text-align: center"> Desculpe, mas não encontramos um produto que atinja suas buscas :( </h2>`
    }
}
loadJson();

function toggleSearch() {
    const searchBar = document.getElementById('search-bar');
    searchBar.classList.toggle('active');
}
const search_input = document.getElementById('pesquisa').addEventListener('keyup', function(event){
    if(event.keyCode == 13){
        pesquisar();
    }
});
function pesquisar() {
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

    if(categoria != null || preco != null || search_input != null){
        loadJson();
    }
}