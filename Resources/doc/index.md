Iniciando o BFOSFreteBundle
==================================

Symfony2 bundle para ajudar na tarefa de cálculo de frete. A primeira versão implementa a integração com a API dos Correios.

## Pré requisitos

Esta versão do bundle requer Symfony 2.1 .x.

## Instalação

O processo de instalação é realizado em 2 passos:

1. Download BFOSFreteBundle usando o composer
2. Habilitando o Bundle

### Passo 1: Download BFOSFreteBundle usando o composer

Adicionando o BFOSFreteBundle em no composer.json:

```js
{
    "require": {
        "brazilianfriendsofsymfony/frete-bundle":"dev-master"
    }
}
```

Agora faça o download do bundle utilizando a seguinte linha de comando do composer:

``` bash
$ php composer.phar update brazilianfriendsofsymfony/frete-bundle
```

Composer irá instalar o bundle no diretório do seu projeto `vendor/brazilianfriendsofsymfony

### Passo 2: Habilitando o bundle

Habilitando o bundle no kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new BFOS\FreteBundle\BFOSFreteBundle(),
    );
}
```

### Próximos Passos

Agora que você concluiu a instalação e configuração básica do BFOSFreteBundle, você está pronto para aprender sobre os recursos mais avançados do bundle.


Os seguintes documentos estão disponíveis:

- [Manual de Implementação](correios/manual_implementacao_calculo_remoto_de_precos_e_prazos.pdf)
