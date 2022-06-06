const container = document.getElementById('produto');
async function loadJson(){
    //GET ID
    const urlParams = new URLSearchParams(window.location.search);
    const id= urlParams.get('id');

    //FETCH
    const response = await fetch('api/data/produtos.json');
    const data = await response.json();

    //PRINTA AS INFORMAÇÕES DO JSON
    const produto = document.createElement('div');
    if(data[id] != undefined){
        produto.innerHTML = `
            <div class="produto-imagem container-imagem">
                <img src="images/${data[id].arquivo}" alt="${data[id].nome}">
            </div>
            <div class="produto-descricao">
                <h2>
                    ${data[id].nome}
                </h2>
                <p>${data[id].descricao}</p>
                <h2>
                    <sup> R$ </sup>
                    ${data[id].preco}
                </h2>
                <p class="clicavel buy-button"> Compre agora </p>
            </div>
        `
        container.appendChild(produto);
    } else {
        //SE ESSE ID NÃO TA DEFINIDO COLOCAR UM AVISO
        container.innerHTML = ` <h2 style="text-align: center"> Desculpe, mas não encontramos esse produto :( </h2>`
    }
}
loadJson();