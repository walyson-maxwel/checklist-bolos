# Compiladores

## Introducão
walyson maxwel - cake factory


## Observações
Coloquei o .env no projeto pra facilitar a execução
para executar utilize o sail laravel - composer nativo
## Arquitetura
Api - Utilizei apiResources nas rotas\
DB - Models eloquentes com migrations. A modelagem utiliza 2 models (muitos x muitos) com 1 tabela pivô (veja migrations)\
Validação de rotas API - Injeção de dependência na controller com FormsRequests\
Camada intermediária para transformação do resultado das models em JSON utilizando Resources\
Email- queues/jobs





