const body = document.querySelector('body');
const botao = document.getElementById('muda-modo');

botao.addEventListener('click', () => {
    //MUDA PARA ESCURO SE CLICOU NA LUA
    if(botao.classList.contains('bi-moon-stars')){
        //coloca o icone de lua
        botao.classList.remove('bi-moon-stars');
        botao.classList.add('bi-brightness-high');
        
        //muda o tema pra escuro
        body.classList.remove('tema-claro');
        body.classList.add('tema-escuro');

    //MUDA PARA CLARO SE CLICOU NO SOL
    } else {
        //coloca o icone de sol
        botao.classList.remove('bi-brightness-high');
        botao.classList.add('bi-moon-stars');

        //muda o tema pra claro
        body.classList.add('tema-claro');
        body.classList.remove('tema-escuro');

    }
})