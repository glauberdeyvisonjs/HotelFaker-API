import './bootstrap';

document.getElementById('btn-cadastro').addEventListener('click', function(e) {
    e.preventDefault();
    alert('Cadastro realizado com sucesso!')
})

document.getElementById('btn-recuperar').addEventListener('click', function(e) {
    e.preventDefault();
    alert('Caso seu e-mail esteja associado a uma conta em nossos sistemas, enviaremos um e-mail contendo um link para a recuperação!')
})