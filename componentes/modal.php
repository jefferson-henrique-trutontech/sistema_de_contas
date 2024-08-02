<div id="modal">
    <button onclick="fecharModal()">Fechar modal</button>
    <div id="modal_content">
        
    </div>
</div>

<script>
    $modal = document.querySelector('#modal');
    $modal_content = document.querySelector('#modal_content');
    function fecharModal(){
        $modal.style.display = 'none';
    }
    function gerarModal(html){
        $modal_content.innerHTML = html;
    }
    function mostrarModal(){
        $modal.style.display = 'block';
    }
</script>