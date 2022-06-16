const container = document.getElementById('produto');
const urlParams = new URLSearchParams(window.location.search);

//MODAIS DE ERRO E SUCESSO NA COMPRA
const ThanksModal = document.getElementById('thanks-modal');
const ErrorModal = document.getElementById('error-modal');

function toggleError(){
    ErrorModal.classList.toggle('active');
}
function toggleThanks(){
    ThanksModal.classList.toggle('active');
}


async function loadJson(){
    //GET ID
    const id= urlParams.get('id');

    const status = urlParams.get('status');
    if(status == 'ok'){
        toggleThanks()
    } else if(status == 'error'){
        toggleError()
    }

    //FETCH
    const response = await fetch('produtos.json');
    const data = await response.json();

    //PRINTA AS INFORMAÇÕES DO JSON
    const produto = document.createElement('div');
    if(data[id] != undefined){
        produto.innerHTML = `
            <div class="produto-imagem">
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
                <a class="botao-produto" href="api/comprar.php?id=${id}">
                    Compre agora
                </a>
            </div>
        `
        container.appendChild(produto);
    } else {
        //SE ESSE ID NÃO TA DEFINIDO COLOCAR UM AVISO
        container.innerHTML = ` <h2 style="text-align: center"> Desculpe, mas não encontramos esse produto :( </h2>`
    }
}
loadJson();