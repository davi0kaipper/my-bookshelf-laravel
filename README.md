# My Bookshelf API Project

## Introdução

Este documento explicita a estrutura da API de accesso à aplicação My Bookshelf - Laravel.

O acesso aos entrypoints deve ser feito usando o seguinte bearer token: "4d75de08227c474188a331b04c3ff176".

## 1. Lista os Livros

### Descrição

Este entrypoint é utilizado para listar os livros cadastrados.
### Entrypoint

`GET /books`

### Requisição

Sem corpo de requisição.

### Respostas

#### Códigos de Resposta

##### `200` - ok

A requisição retornará o código de resposta `200` quando uma lista de livros for retornada com sucesso.

##### Corpo da Resposta:
```json
[
    {
        "name" : "Petrus Logus - O Guardião do Tempo",
        "author" : "Augusto Cury",
        "number_of_pages" : 296,
        "genre" : ["Aventura", "Fantasia"],
        "is_national" : true,
        "publisher" : "Benvirá",
        "description" : "Um jovem príncipe na trajetória da justiça.",
        "cover": "image.png",
        "created_at": "2022-03-14T20:44:02.000000Z",
        "updated_at": "2022-02-23T04:15:27.000000Z"
    }
]
```

##### `401` - unauthorized

A requisição retornará o código de resposta `401` quando a chamada for feita por um usuário não autenticado.

## 2. Obtém um livro

### Descrição

Este entrypoint é utilizado para apresentar um livro cadastrado usando seu id.

### Entrypoint

`GET /books/{id}`

### Requisição

Sem corpo de requisição.

### Respostas

#### Códigos de Resposta

##### `200` - ok

A requisição retornará o código de resposta `200` quando uma instância de livro for retornada com sucesso.

##### Corpo da Resposta:
```json
{
    "name" : "Petrus Logus - O Guardião do Tempo",
    "author" : "Augusto Cury",
    "number_of_pages" : 296,
    "genre" : ["Aventura", "Fantasia"],
    "is_national" : true,
    "publisher" : "Benvirá",
    "description" : "Um jovem príncipe na trajetória da justiça.",
    "cover": "image.png",
    "created_at": "2022-03-14T20:44:02.000000Z",
    "updated_at": "2022-02-23T04:15:27.000000Z"
}
```

##### `401` - unauthorized

A requisição retornará o código de resposta `401` quando a chamada for feita por um usuário não autenticado.

##### `403` - forbidden

A requisição retornará o código de resposta `403` quando a chamada for feita por um usuário sem permissão de acesso a esse entrypoint.

##### `404` - not found

A requisição retornará o código de resposta `404` quando a chamada for feita usando um id sem livro correspondente.

## 3. Cria um livro

### Descrição

Este entrypoint é utilizado para cadastrar um livro.

### Entrypoint

`POST /books`

### Requisição
#### Corpo da Requisição
```json
{
    "name" : "Petrus Logus - O Guardião do Tempo",
    "author" : "Augusto Cury",
    "number_of_pages" : 296,
    "genre" : ["Aventura", "Fantasia"],
    "is_national" : true,
    "publisher" : "Benvirá",
    "description" : "Um jovem príncipe na trajetória da justiça.",
    "cover": "image.png"
}
```

* `name` *(string)*
  * o nome do livro
* `author` *(string)*
  * o nome do autor livro
* `genre` *(array)*
  * o gênero do livro
* `is_national` *(boolean)*
  * a propriedade do livro ter publicação nacional
* `publisher` *(string)*
  * o nome da editora de publicação
* `description` *(string)*
  * a descrição do livro
* `cover` *(string)*
  * o nome do arquivo da capa do livro

### Respostas

#### Códigos de Resposta

##### `201` - created
A requisição retornará o código de resposta `201` quando uma instância de livro for criada com sucesso.

##### `400` - bad request
A requisição retornará o código de resposta `400` quando houver um erro na tentiva de cadastro. Este erro terá relação com um quebra de regra de negócio.

Ex.:

##### Corpo da Requisição

```json
{
    "name" : "Petrus Logus - O Guardião do Tempo",
    "author" : "Augusto Cury",
    "number_of_pages" : 296,
    "genre" : ["Comédia"], //não consta na lista de gêneros pré-definidos
    "is_national" : true,
    "publisher" : "Benvirá",
    "description" : "Um jovem príncipe na trajetória da justiça.",
    "cover": "image.png"
}
```

##### Corpo da Resposta

```json
{
    "type": "NonExistentGenre",
    "message": "O campo gênero contém um ou mais gêneros não cadastrados no catálogo."
}
```

##### `401` - unauthorized

A requisição retornará o código de resposta `401` quando a chamada for feita por um usuário não autenticado.

##### `403` - forbidden

A requisição retornará o código de resposta `403` quando a chamada for feita por um usuário sem permissão de acesso a esse entrypoint.

##### `422` - unprocessable entity

A requisição retornará o código de resposta `422` quando houver um erro na tentiva de cadastro. Este erro terá relação com algum erro no schema do payload.

Ex.:

##### Corpo da Requisição

```json
{
    //faltando o campo "number_of_pages"
    "name" : "Petrus Logus - O Guardião do Tempo",
    "author" : "Augusto Cury",
    "genre" : ["Comédia"],
    "is_national" : "true", //string sendo passada, deveria ser boolean
    "publisher" : "Benvirá",
    "description" : "Um jovem príncipe na trajetória da justiça.",
    "cover": "image.png"
}
```

##### Corpo da Resposta

```json
{
    "type": "ValidationError",
    "message": "Houve um erro de validação.",
    "errors": [
        "O campo número de páginas é obrigatório.",
        "O campo publicação nacional deve ser verdadeiro ou falso."
    ]
}
```

## 4. Atualiza um livro

### Descrição

Este entrypoint é utilizado para atualizar um livro cadastrado usando usando seu id.

### Entrypoint

`PUT /books/{id}`

### Requisição
#### Corpo da Requisição
```json
{
    "name" : "Petrus Logus - O Guardião do Tempo",
    "author" : "Augusto Cury",
    "number_of_pages" : 296,
    "genre" : ["Aventura", "Fantasia"],
    "is_national" : true,
    "publisher" : "Arqueiro", //anteriormente "Benvirá"
    "description" : "Um jovem príncipe na trajetória da justiça.",
    "cover": "image.png"
}
```

* `name` *(string)*
  * o nome do livro
* `author` *(string)*
  * o nome do autor livro
* `genre` *(array)*
  * o gênero do livro
* `is_national` *(boolean)*
  * a propriedade do livro ter publicação nacional
* `publisher` *(string)*
  * o nome da editora de publicação
* `description` *(string)*
  * a descrição do livro
* `cover` *(string)*
  * o nome do arquivo da capa do livro

### Respostas

#### Códigos de Resposta

##### `200` - ok
A requisição retornará o código de resposta `200` quando um livro for atualizado com sucesso.

##### `400` - bad request
A requisição retornará o código de resposta `400` quando houver um erro na tentiva de atualização do livro. Este erro terá relação com um quebra de regra de negócio.

Ex.:

##### Corpo da Requisição

```json
{
    "name" : "Petrus Logus - O Guardião do Tempo",
    "author" : "Augusto Cury",
    "number_of_pages" : 296,
    "genre" : ["Comédia"],
    "is_national" : true,
    "publisher" : "Arqueiro", //anteriormente "Benvirá"
    "description" : "Um jovem príncipe na trajetória da justiça.",
    "cover": "image.png"
}
```

##### Corpo da Resposta

```json
{
    "type": "NonExistentGenre",
    "message": "O campo gênero contém um ou mais gêneros não cadastrados no catálogo."
}
```

##### `401` - unauthorized

A requisição retornará o código de resposta `401` quando a chamada for feita por um usuário não autenticado.

##### `403` - forbidden

A requisição retornará o código de resposta `403` quando a chamada for feita por um usuário sem permissão de acesso a esse entrypoint.

##### `404` - not found

A requisição retornará o código de resposta `404` quando a chamada for feita usando um id sem livro correspondente.

##### `422` - unprocessable entity

A requisição retornará o código de resposta `422` quando houver um erro na tentiva de atualização do livro. Este erro terá relação com algum erro no schema do payload.

Ex.:

##### Corpo da Requisição

```json
{
    "name" : "Petrus Logus - O Guardião do Tempo",
    "author" : "Augusto Cury",
    "genre" : ["Comédia"],
    "is_national" : "true",
    "publisher" : "Arqueiro", //anteriormente "Benvirá"
    "description" : "Um jovem príncipe na trajetória da justiça.",
    "cover": "image.png"
}
```

##### Corpo da Resposta

```json
{
    "type": "ValidationError",
    "message": "Houve um erro de validação.",
    "errors": [
        "O campo número de páginas é obrigatório.",
        "O campo publicação nacional deve ser verdadeiro ou falso."
    ]
}
```

## 5. Remove um livro

### Descrição

Este entrypoint é utilizado para apresentar um livro cadastrado usando seu id.

### Entrypoint

`DELETE /books/{id}`

### Requisição

Sem corpo de requisição.

### Respostas

#### Códigos de Resposta

##### `200` - ok

A requisição retornará o código de resposta `200` quando houver uma tentativa de remoção.

##### `401` - unauthorized

A requisição retornará o código de resposta `401` quando a chamada for feita por um usuário não autenticado.

##### `403` - forbidden

A requisição retornará o código de resposta `403` quando a chamada for feita por um usuário sem permissão de acesso a esse entrypoint.