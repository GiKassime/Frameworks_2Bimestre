# EasyMVC - Gerador Automático de Framework MVC

Um gerador automático de estrutura MVC em PHP que cria um framework completo baseado em tabelas de banco de dados MySQL, incluindo models, views, controllers e DAOs.

## 📋 Funcionalidades

- **Conexão Dinâmica**: Interface para conexão com qualquer banco MySQL
- **Seleção Automática**: Lista automática de bancos disponíveis via `SHOW DATABASES`
- **Geração MVC Completa**: Cria automaticamente toda estrutura MVC
- **Formulários Inteligentes**: Gera formulários baseados nos tipos de dados das tabelas
- **Estilos Responsivos**: CSS moderno e responsivo para todas as views
- **Download Automático**: Compacta e disponibiliza o framework gerado em ZIP

## 🚀 Como Usar

### 1. Configuração Inicial
1. Clone o repositório
2. Configure seu servidor WAMP/XAMPP
3. Acesse `http://localhost/Frameworks_2Bimestre/`

### 2. Conectar ao Banco
1. Informe os dados de conexão:
   - **Servidor**: `localhost` (padrão)
   - **Porta**: `3308` (WAMP) ou `3306` (XAMPP)
   - **Usuário**: `root` (padrão)
   - **Senha**: (deixe em branco se padrão)

2. Selecione o banco de dados da lista

### 3. Gerar Framework
O sistema criará automaticamente:
```
sistema/
├── model/
│   ├── conexao.php
│   └── [Tabela].php
├── view/
│   └── [tabela].php
├── control/
│   └── [tabela]Control.php
├── dao/
│   └── [Tabela]Dao.php
└── styles/
    └── views.css
```


## 📁 Estrutura do Projeto

```
Frameworks_2Bimestre-1/
├── models/
│   └── Conexao.php          # Classe de conexão com BD
├── index.php                # Página principal
├── creator.php              # Gerador do framework MVC
├── estilos.css              # Estilos da interface
├── mensagem.php             # Sistema de mensagens
└── readme.md                # Este arquivo
```



## 🚨 Tratamento de Erros

- Conexão com banco de dados
- Criação de diretórios
- Geração de arquivos
- Compactação de arquivos
- Redirecionamentos informativos

