# 💰 Sistema de Controle de Gastos

![PHP](https://img.shields.io/static/v1?label=PHP&message=8&color=777BB4&logo=php&logoColor=white)
![MySQL](https://img.shields.io/static/v1?label=MySQL&message=8&color=4479A1&logo=mysql&logoColor=white)
![Tailwind](https://img.shields.io/static/v1?label=Tailwind&message=CSS&color=06B6D4&logo=tailwindcss&logoColor=white)
![HTML5](https://img.shields.io/static/v1?label=HTML&message=5&color=E34F26&logo=html5&logoColor=white)

Sistema web desenvolvido em **PHP**, **MySQL** e **Tailwind CSS** para controle financeiro pessoal, permitindo o gerenciamento de gastos, entradas e acompanhamento de estatísticas financeiras em tempo real.

---

## 🚀 Funcionalidades

### 💸 Gerenciamento de Gastos

* Cadastro de gastos
* Edição de gastos
* Exclusão de gastos
* Listagem completa
* Filtro por mês

### 💰 Gerenciamento de Entradas

* Cadastro de entradas extras
* Edição de entradas
* Exclusão de entradas
* Listagem completa
* Filtro por mês

### 📊 Dashboard Financeiro

* Total gasto
* Total de entradas
* Saldo disponível
* Gastos agrupados por categoria
* Quantidade total de gastos
* Categoria mais utilizada
* Maior gasto registrado

### 📱 Interface

* Layout responsivo para desktop e dispositivos móveis
* Desenvolvido com Tailwind CSS
* Dashboard organizado em cards
* Navegação simples e intuitiva

---

## 🛠 Tecnologias Utilizadas

* PHP 8
* MySQL
* Tailwind CSS
* HTML5
* Git / GitHub
* XAMPP

---

## 📂 Estrutura do Projeto

```text
Controle_de_gastos/
│
├── Actions/
├── Models/
├── Repositories/
├── Views/
├── config/
├── public/
│   └── assets/
│
└── index.php
```

### 🏗 Arquitetura

O projeto utiliza uma arquitetura simples baseada em separação de responsabilidades:

* **Models** — representação dos dados da aplicação
* **Repositories** — consultas e acesso ao banco de dados
* **Actions** — processamento das requisições
* **Views** — interface e apresentação dos dados

Essa organização facilita a manutenção, reutilização de código e escalabilidade do projeto.

---

## 🔒 Segurança

O projeto utiliza **Prepared Statements (Prepared Queries)** para manipulação dos dados no banco de dados, reduzindo riscos de SQL Injection e tornando as consultas mais seguras.

---

## 📚 Aprendizados

Durante o desenvolvimento deste projeto foram praticados conceitos importantes de desenvolvimento web, incluindo:

* Programação Orientada a Objetos (POO)
* Arquitetura em camadas
* Repository Pattern
* CRUD completo
* Prepared Statements
* Manipulação de Sessões
* Integração PHP + MySQL
* Responsividade com Tailwind CSS
* Organização de código e boas práticas

---

## 🗄 Banco de Dados

### Tabela `gastos`

```sql
CREATE TABLE gastos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    descricao VARCHAR(100) NOT NULL,
    categoria VARCHAR(50) NOT NULL,
    valor DECIMAL(10,2) NOT NULL,
    data_gasto DATE NOT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

### Tabela `entradas`

```sql
CREATE TABLE entradas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    descricao VARCHAR(100) NOT NULL,
    valor DECIMAL(10,2) NOT NULL,
    data_entrada DATE NOT NULL
);
```

---

## 📸 Screenshots

### Dashboard
![Dashboard](https://raw.githubusercontent.com/GabrielFuzaro/controle-de-gastos/main/public/assets/img/Imagem-1-Vazia.png)

### Cadastro de Gastos
![Cadastro](https://raw.githubusercontent.com/GabrielFuzaro/controle-de-gastos/main/public/assets/img/Cadastrar-gasto.png)

### Responsividade Mobile
![Mobile](https://raw.githubusercontent.com/GabrielFuzaro/controle-de-gastos/main/public/assets/img/Mobile.png)

---

## ⚙️ Como Executar

### 1. Clone o repositório

```bash
git clone https://github.com/GabrielFuzaro/controle-de-gastos.git
```

### 2. Configure o ambiente

Coloque o projeto dentro da pasta:

```text
htdocs
```

do XAMPP.

### 3. Inicie os serviços

Inicie:

* Apache
* MySQL

pelo painel do XAMPP.

### 4. Crie o banco de dados

Crie o banco de dados e execute os scripts SQL das tabelas apresentadas acima.

### 5. Execute a aplicação

Acesse:

```text
http://localhost/Controle_de_gastos
```

---

## 👨‍💻 Autor

**Gabriel Fuzaro**

Projeto desenvolvido para praticar desenvolvimento web utilizando PHP, MySQL, arquitetura em camadas, Programação Orientada a Objetos e Tailwind CSS.
