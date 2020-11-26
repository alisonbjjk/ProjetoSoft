
<!-- C�digo para carregar automaticamente as cidades de acordo com o estado escolhido -->
<script type="text/javascript">
    function CarregaCidades(codEstado, nomeUF, nomeCidade, nomeCarregando)
    {
        if( $('#'+nomeUF).val() ) {
            $('#'+nomeCidade).hide();
            $('#'+nomeCarregando).show();
            $.getJSON('inc/cidades.ajax.php?search=',{cod_estados: $('#'+nomeUF).val(), ajax: 'true'}, function(j){
                var options = '';	
                for (var i = 0; i < j.length; i++) {
                    options += '<option value="' + j[i].cod_cidades + '">' + j[i].nome + '</option>';
                }	
                $('#'+nomeCidade).html(options).show();
                $('#'+nomeCarregando).hide();
            });
        } else {
            $('#'+nomeCidade).html('<option value="">-- ESCOLHA UM ESTADO --</option>');
        }
    };
    
    function DoPrinting(){
        if (!window.print){
            alert("Erro ao tentar Imprimir.")
            return
        }
        window.print();
        window.location.href = 'index.php'; 
    }
    
    
</script>