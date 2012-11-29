BFOSFreteBundle
===============

Symfony2 bundle para ajudar na tarefa de cálculo de frete. A primeira versão implementa a integração com a API dos Correios.

Parâmetros de entrada (tipo array)

codigo_empresa (string - Não é obrigatório, mas o parâmetro tem que ser passado mesmo vazio):
    Seu código administrativo junto à ECT. O código está disponível no corpo do contrato firmado com os Correios.

senha (string - Não é obrigatório, mas o parâmetro tem que ser passado mesmo vazio):
    Senha para acesso ao serviço, associada ao seu código administrativo. A senha inicial corresponde aos 8 primeiros dígitos do CNPJ informado no contrato.
    A qualquer momento, é possível alterar a senha no endereço http://www.corporativo.correios.com.br/encomendas/servicosonline/recuperaSenha.

codigo_servico (string - obrigatório - Pode ser mais de um numa consulta separados por vírgula):
    40010  SEDEX sem contrato
    40045  SEDEX a Cobrar, sem contrato
    40126  SEDEX a Cobrar, com contrato
    40215  SEDEX 10, sem contrato
    40290  SEDEX Hoje, sem contrato
    40096  SEDEX com contrato
    40436  SEDEX com contrato
    40444  SEDEX com contrato
    40568  SEDEX com contrato
    40606  SEDEX com contrato
    41106  PAC sem contrato
    41068  PAC com contrato
    81019  e-SEDEX, com contrato
    81027  e-SEDEX Prioritário, com conrato
    81035  e-SEDEX Express, com contrato
    81868  (Grupo 1) e-SEDEX, com contrato
    81833  (Grupo 2) e-SEDEX, com contrato
    81850  (Grupo 3) e-SEDEX, com contrato

cep_origem (string - Obrigatório):
    CEP de Origem sem hífen.Exemplo: 05311900

cep_destino (string - Obrigatório):
    CEP de Destino Sem hífem

peso (string - Obrigatório):
    Peso da encomenda, incluindo sua embalagem. O peso deve ser informado em quilogramas. Se o formato for Envelope, o valor máximo permitido será 1 kg.

formato (integer - Obrigatório):
    Formato da encomenda (incluindo embalagem).
    Valores possíveis: 1, 2 ou 3
        1 – Formato caixa/pacote
        2 – Formato rolo/prisma
        3 - Envelope

comprimento (decimal - Obrigatório):
    Comprimento da encomenda (incluindo embalagem), em centímetros.

altura (decimal - Obrigatório):
    Altura da encomenda (incluindo embalagem), em centímetros. Se o formato for envelope, informar zero (0).

largura (decimal - Obrigatório):
    Largura da encomenda (incluindo embalagem), em centímetros.

diametro (decimal - Obrigatório):
    Diâmetro da encomenda (incluindo embalagem), em centímetros.

mao_propria (string - Obrigatório):
    Indica se a encomenda será entregue com o serviço adicional mão própria. Valores possíveis: S ou N   (S – Sim, N – Não).

valor_declarado (decimal - Obrigatório, se não optar pelo serviço informar zero):
    Indica se a encomenda será entregue com o serviço adicional valor declarado. Neste campo deve ser apresentado o valor declarado desejado, em Reais.

aviso_recebimento (string - Obrigatório):
    Indica se a encomenda será entregue com o serviço adicional aviso de recebimento. Valores possíveis: S ou N (S – Sim, N – Não).

tipo_retorno (string - Obrigatório):
    Indica a forma de retorno da consulta.
        XML    -> Resultado em XML.
        Popup  -> Resultado em uma janela popup.
        <URL>  -> Resultado via post em uma página do requisitante.

