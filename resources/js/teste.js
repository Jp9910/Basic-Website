//let a = document.querySelector('.botao');
//let lista = document.querySelector('#lista');

let botao = jQuery('#exibir-lista');
let lista = $('#lista');

// a.addEventListener('click',function(){
//     console.log('clicou');
//     lista.classList.remove('invisivel');
// })

botao.on('click',function(){
    console.log('clicou');
    lista.toggleClass('invisivel');
})