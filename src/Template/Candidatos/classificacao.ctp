<?= $this->Html->css('estilo.css'); ?>
<?= $this->Flash->render() ?>
<!-- <div class="container"> -->
<div class="row justify-content-center">

    <div class="col-12 pr-0">
        <h6 class="mt-1"><i class="fas fa-search"></i> PESQUISA - NOME DO CANDIDATO <span style="font-size:70%;color:#989898;">( Nome )</span></h6>
        <input id="nomeList" class="campo_nome p80 rounded w-100 mb-3" onchange='getId()' value="" onblur="pesquisaCandidato()" list="pesquisa" name="nm_candidato" class="form-control" placeholder="" onload="clear()" required autocomplete="off">
        <datalist id="pesquisa"></datalist>

        <div class="w-100" id="tableAjax">
            <?= $this->Element('candidatoClassifTableIndexSearch') ?>
        </div>

    </div>



    <!-- </div> -->
</div>
<script>
    $('document').ready(function() {
        $('#nomeList').keyup(function() {
            var searchkey = $(this).val();
            searchTags(searchkey);
        });

        function searchTags(keyword) {
            var data = keyword;
            if (!data) data = 'A';
            $.ajax({
                method: 'get',
                url: "<?php echo $this->Url->build(['controller' => 'Candidatos', 'action' => 'searchClass']); ?>",
                data: {
                    keyword: data
                },
                sucess: function(response) {
                    alert('a')
                    // $('#pesquisa').html('<option value="num ">');
                    console.log(response);
                },
                error: function() {
                    alert('b')
                    // $('#pesquisa').html('<option value="num ">');
                },
                complete: function(response) {
                    $('#tableAjax').html(response.responseText);
                }
            })
        }
    });
    document.getElementById('idresp').style.display = 'none';
    nomeList = document.getElementById('nomeList');
    nomeList.value = "";

    function pesquisaCandidato() {
        console.log('AAAAAAAAAAAAAAA');
        test = document.getElementById('nomeList').value
        A = test.split([' -   '])
        console.log(A)
        if (A[1] == undefined) {

            console.log(A);
            document.getElementById('nomeList').value
            document.getElementById('idcandidato').value = 0;
        } else {
            document.getElementById('idcandidato').value = A[0].trim()
            document.getElementById('nomeList').value = A[1].split(' - ')[0]
        }
    }

    function getId() {
        var sel = document.getElementById('nomeList').value;
        getSelectedOption(sel);

        function getSelectedOption(sel) {
            var opt;
            var res = Number.parseInt(sel.split(" ", 1));
        }
    }

    document.getElementById("nomeList").onkeypress = function(e) {
        var chr = String.fromCharCode(e.which);
        if ("qwertyuioplkjhgfdsazxcvbnmQWERTYUIOPLKJHGFDSAZXCVBNM ".indexOf(chr) < 0)
            return false;
    };
</script>