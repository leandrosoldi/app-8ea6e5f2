<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>


## Projeto Teste - API Rest de Cadastro de Produtos.

<p>O objetivo deste projeto é criar uma API para efetuar o cadastro de produtos e a manutenção do estoque dos mesmos.</p> 

<p>Efetue a instalação do projeto e execute o comando abaixo:</p>

```
php artisan migrate
```

<p>OBS: API sem a necessidade de autenticação, haja vista a finalidade ser para testes.</p>


# Cadastro
<p>método: POST</p>
<p>endpoint: /api/produto/new </p>

| Parâmetro 	| Type  	  | Required    | Description                     |  
|---------------|-------------|-------------|---------------------------------|
| nome	    	| String	  | true		| Nome do Produto                 |  
| sku	    	| String	  | true		| SKU do produto                  |
| quantidade	|Integer	  | true		| Quantidade Inicial no estoque   |

Ex: Retorno
```
{
    "success": true,
    "message": "Produto cadastrado com sucesso!"
}

```


# Manutenção do Estoque
<p>método: POST<p>
<p>endpoint: /api/produto/update </p>

|Parâmetro 	 |Type	   |Required | Description                      |
|------------|---------|---------|----------------------------------|
|action		 |Integer  | true	 |	1 = Adiciona, 2 = Remove        |
|sku		 |String   | true	 |	SKU do produto (case sensitive) |
|quantidade	 |Integer  | true	 |	Quantidade Inicial no estoque   |

Ex: Retorno
```
{
    "success": true,
    "message": "Produto alterado com sucesso!"
}
```

# Histórico de Movimentação
<p>médoto: GET</p>
<p>endpoint: /api/produto/moviment/{sku?}</p>

| Parâmetro 	| Type	  | Required  | Description                                          |
|---------------|---------|-----------|------------------------------------------------------|
| sku		| String	  | false	  |	Ao fornecer SKU do produto (case sensitive), o histórico será específico, caso contrário, trará a listagem geral.|
					
Ex: Retorno
```
{
    "success": true,
    "data": [
        {
            "acao": "Atualização",
            "produto": "Produto Y",
            "sku": "prody01",
            "quantidade": 5,
            "qtde_anterior": 10,
            "qtde_atual": 15,
            "data": "04/04/2022 12:16"
        },
        {
            "acao": "Criação",
            "produto": "Produto Y",
            "sku": "prody01",
            "quantidade": 10,
            "qtde_anterior": 0,
            "qtde_atual": 10,
            "data": "04/04/2022 12:15"
        }
    ]
}
```



# Tecnologias e versões

* PHP: 8.0
* Laravel: 8.8
* Postgres: 9.5 (usado no desenvolvimento)
