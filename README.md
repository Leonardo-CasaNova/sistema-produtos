# Sistema de Produtos (Laravel)

Este é um projeto acadêmico de desenvolvimento web construído com Laravel. É um sistema simples para o gerenciamento de **Categorias** e **Produtos** com relacionamento entre as tabelas, busca, filtros e upload de imagens.

## 🚀 Como rodar o projeto localmente

Siga o passo a passo abaixo para rodar o projeto na sua máquina:

### 1. Pré-requisitos
Certifique-se de ter os seguintes programas instalados em sua máquina:
- **PHP** (versão 8.2 ou superior) com as extensões `pdo_sqlite` e `sqlite3` habilitadas.
- **Composer** (Gerenciador de pacotes do PHP).
- **Git** (Opcional, para clonar o repositório).

### 2. Clonar o repositório
Caso não tenha o código na sua máquina, clone-o através do terminal:
```bash
git clone https://github.com/Leonardo-CasaNova/sistema-produtos.git
cd sistema-produtos
```

### 3. Instalar as dependências do projeto
Execute o comando abaixo para instalar as bibliotecas do Laravel:
```bash
composer install
```

### 4. Configurar o arquivo de ambiente (.env)
O projeto necessita de um arquivo de configuração `.env` (que guarda senhas e chaves, logo não vai para o GitHub).

1. Crie uma cópia do arquivo de exemplo fornecido:
   ```bash
   cp .env.example .env
   ```
2. Abra o arquivo `.env` gerado e certifique-se de que a conexão com o banco de dados esteja configurada para `sqlite`. As linhas devem estar assim:
   ```env
   DB_CONNECTION=sqlite
   # Comente ou apague qualquer outra linha que comece com DB_HOST, DB_PORT, DB_DATABASE, etc.
   ```

### 5. Gerar a chave da aplicação
Para que a criptografia e as sessões do Laravel funcionem, gere a chave do app:
```bash
php artisan key:generate
```

### 6. Criar o banco de dados e as tabelas
O banco de dados SQLite é apenas um arquivo. Vamos criar o arquivo, as tabelas (migrations) e popular o banco com dados de exemplo (seeders):

```bash
# Cria o arquivo do banco de dados (no Linux/Mac)
touch database/database.sqlite

# Roda as migrations e os seeders
php artisan migrate --seed
```

### 7. Criar o atalho para as imagens (Storage Link)
Como o sistema tem upload de imagens, precisamos tornar a pasta de imagens pública. Rode:
```bash
php artisan storage:link
```

### 8. Iniciar o servidor
Por fim, inicie o servidor local do Laravel:
```bash
php artisan serve
```

A aplicação estará disponível no seu navegador no endereço:
**[http://127.0.0.1:8000](http://127.0.0.1:8000)**

---

## 💻 Funcionalidades
- Cadastro, edição e exclusão de categorias.
- Cadastro, edição e exclusão de produtos com upload de imagem.
- Produtos estão associados a uma categoria.
- Filtro de produtos por nome e categoria.
- Interface amigável utilizando Bootstrap 5.
