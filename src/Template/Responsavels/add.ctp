<!-- SEDUC DPID - FLAVIA A S SILVA RF:47093 em 08/04/2022 -->

<body onload="chama">

    <?= $this->Form->create($responsavel, ['id' => 'form-candidato', 'novalidate']) ?>
    <div class="panel panel-info">
        <div class="title">Ficha de Inscrição</div>
        <div class="panel-body mb-4">

            <div class="col-md-12 justify-content-between">
                <div class="col-md-12 ml-md-3 col-sm-12 mt-4 pt-2 brTitle d-flex justify-content-center">
                    <p>Dados do Responsável</p>
                </div>
                <div class="col-12 d-flex justify-content-center">

                    <?= $this->Form->control('vl_cpf', ['id' => 'cpf', 'class' => 'cpf', 'label' => 'CPF', 'value' => $responsavel->vl_cpf]); ?>
                    <input type="button" value="OK!" style="width: 8em; height: 2em; margin-top: 2.2em; margin-left: 0.5em; border-radius: 0.3em;">

                </div>
                <div class="w-100" id="tableAjax">

                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4 d-flex justify-content-center">

        <button type="button" onclick="history.back()" class="btn btn-warning mr-5" style="color: white;"><i class="fas fa-reply" style="padding-right: 5px"></i>Voltar</button>
        <button class="btn btn-success float-right ml-5" id="subir" type="submit"><i class="fas fa-check" style="padding-right: 5px"></i>Enviar</button>

    </div>
    <?php echo $this->form->end(); ?>

</body>
<script>
    $('input').click(function() {
        var searchkey = document.getElementById('cpf').value;

        searchTags(searchkey);
        // alert(searchkey);

        function searchTags(keyword) {
            var data = keyword;
            // alert(data);
            if (!data) data = 'A';
            $.ajax({
                method: 'get',
                url: "<?php echo $this->Url->build(['controller' => 'Responsavels', 'action' => 'search']); ?>",
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
</script>