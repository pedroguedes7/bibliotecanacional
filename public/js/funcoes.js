function verCliente(id) {
    $('#modalVerCliente').modal('show');
    $("#conteudoModal").load('/cliente/ver/'+id);
}

function verLivro(id) {
    $('#modalVerLivro').modal('show');
    $("#conteudoModal").load('/livro/ver/'+id);
}
