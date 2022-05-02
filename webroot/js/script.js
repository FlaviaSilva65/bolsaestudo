function verificaContato() {
    var telefone = document.getElementById('tel').value;
    var celular = document.getElementById('cel').value;

    // alert(telefone);

    if (telefone == '' && celular == '') {
        // if(){
        alert('Deve colocar ao menos um número de telefone!');
        document.getElementById("tel").focus();
    }

    // }
};

function ativaDadosBolsa() {
    var elemento = document.getElementById('concessao_fam').value;
    // document.getElementById('informacoesBolsa1').style.display = "none";
    // document.getElementById('informacoesBolsa2').style.display = "none";

    if (elemento == 3) {
        document.getElementById('informacoesBolsa1').style.display = "none";
        document.getElementById('informacoesBolsa2').style.display = "none";
    } else {
        document.getElementById('informacoesBolsa1').style.display = "block";
        document.getElementById('informacoesBolsa2').style.display = "block";
    }

    // alert(elemento);
};

function ativaDadosEmpresa() {
    var elemento = document.getElementById('chkAutonomo');
    var informacoesTrabalho = document.getElementById("informacoesTrabalho");
    var informacoesProfissao = document.getElementById("informacoesProfissao");

    if (elemento.checked) {
        document.getElementById('dsProfissao').value = "Autônomo";
        informacoesTrabalho.style.display = "none";
        informacoesProfissao.style.display ="block";    
          
    } else {
        document.getElementById('nomeEmpresa').value = "";
    }
};

function ativaDadosEmpresa2() {
    var elemento = document.getElementById('chkAutonomo2');
    var informacoesTrabalho2 = document.getElementById("informacoesTrabalho2");
    var informacoesProfissao2 = document.getElementById("informacoesProfissao2");

    if (elemento.checked) {
        document.getElementById('dsProfissao2').value = "Autônomo";
        informacoesTrabalho2.style.display = "block";
        informacoesProfissao2.style.display = "none";    
    } else {
        document.getElementById('nomeEmpresa2').value = "";
    }
};

function ativaDadosEmpresaAposentado() {
    var elemento = document.getElementById('chkAposentado');
    var informacoesProfissao = document.getElementById('informacoesProfissao');
    var informacoesTrabalho = document.getElementById('informacoesTrabalho');

    if (elemento.checked) {
        document.getElementById('dsProfissao').value = "Aposentado";
        informacoesTrabalho.style.display = "none";
        informacoesProfissao.style.display = "none";
        
    } else {
        document.getElementById('nomeEmpresa').value = "";
    }
};

function ativaDadosEmpresaAposentado2() {
    var elemento = document.getElementById('chkAposentado2');
    var informacoesTrabalho2 = document.getElementById('informacoesTrabalho');
    var informacoesProfissao2 = document.getElementById('informacoesProfissao');
    
    if (elemento.checked) {
        document.getElementById('dsProfissao2').value = "Aposentado";
        informacoesTrabalho2.style.display = "none";
        informacoesProfissao2.style.display = "none";
        
    } else {
        document.getElementById('nomeEmpresa2').value = "";
    }
};

function ativaDadosEmpregado() {
    var elemento = document.getElementById('chkEmpregado');
    var informacoesProfissao = document.getElementById('informacoesProfissao');
    var informacoesTrabalho = document.getElementById('informacoesTrabalho');
    
    if (elemento.checked) {
        document.getElementById('dsProfissao').value = "";
        informacoesTrabalho.style.display = "block";
        informacoesProfissao.style.display = "block";
        
    } else {
        document.getElementById('nomeEmpresa').value = "";
    }
};
function ativaDadosEmpregado2() {
    var elemento = document.getElementById('chkEmpregado2');
    var informacoesProfissao2 = document.getElementById('informacoesProfissao2');
    var informacoesTrabalho2 = document.getElementById('informacoesTrabalho2');
    
    if (elemento.checked) {
        document.getElementById('dsProfissao2').value = "";
        informacoesTrabalho2.style.display = "block";
        informacoesProfissao2.style.display = "block";
        
    } else {
        document.getElementById('nomeEmpresa2').value = "";
    }
};

$(document).ready(function () {
    $("#escola").on("change", function () {
        $("#tipo").empty();
        // var select = document.getElementById('escola');
        // var escola = select.options[select.selectedIndex].value;
        var escola = $("#escola").val();
        alert(escola);
        var urlEnviada = document.getElementById("urltipo").value;
        // alert(urlEnviada);
        $.ajax({
            url: urlEnviada,
            method: "get",
            data: {
                id: escola
            },
            success: function (resposta) {
                $("#xx").html(resposta);
            }

        });
    });

});


function chama(tipo) {
    var urlTipoEnviada = document.getElementById("urlano").value;
    // alert(urlTipoEnviada);
    $.ajax({
        url: urlTipoEnviada,
        method: "get",
        data: {
            id: tipo
        },
        success: function (resposta) {
            $("#anoid").html(resposta);
        }
    });
    // alert(xx);
}

function limitText(limitField, limitNum) {
    document.getElementById('countdown').innerHTML = limitNum - limitField.value.length
}

function goBack() {
    window.history.back(-2);
}

function ativaAnosEI() {
    var elementoei = document.getElementById('tipo_id[1]');

    if (elementoei.checked) {
        document.getElementById('infantil').style.display = "block";
        // alert('OI');
    } else {
        document.getElementById('infantil').style.display = "none";
    }

}

function ativaAnosEF() {
    var elementoef = document.getElementById('tipo_id[2]');
    if (elementoef.checked) {
        document.getElementById('fundamental').style.display = "block";
        // alert('OI');
    } else {
        document.getElementById('fundamental').style.display = "none";
    }
}

function ativaAnosEM() {
    var elementoem = document.getElementById('tipo_id[3]');
    if (elementoem.checked) {
        document.getElementById('medio').style.display = "block";
        // alert('OI');
    } else {
        document.getElementById('medio').style.display = "none";
    }
}

$(document).ready(function () {
    $("#tipo_id[1]").on("change", function () {
        // $("#ano").empty();
        var tipo = $("#tipo_id[1]").val();
        // alert (escola);
        alert('OI');
        var urlEnviada = document.getElementById("urlano").value;
        $.ajax({
            url: urlEnviada,
            method: "get",
            data: {
                id: tipo
            },
            success: function (resposta) {
                $("#xx").html(resposta);
            }

        });
    });

});
