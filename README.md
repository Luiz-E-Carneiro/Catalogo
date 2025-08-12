# 🎬 Sistema de Gerenciamento de Filmes

## 📌 Descrição do Projeto
Este projeto foi desenvolvido como parte da disciplina **Programação Web 3** do **Instituto Federal de Educação, Ciência e Tecnologia do Rio Grande do Sul (IFRS) – Campus Bento Gonçalves**.  
O sistema permite que usuários se cadastrem, visualizem e filtrem filmes, além de marcarem títulos como favoritos.  
Administradores têm permissões adicionais para gerenciar o catálogo de filmes e visualizar todos os usuários.

---

## 🎯 Objetivos
- Aplicar conceitos de **Laravel** e **PHP** no desenvolvimento de aplicações web.
- Implementar **autenticação e autorização** (incluindo papéis de usuário e administrador).
- Utilizar **relações entre tabelas** no Eloquent.
- Tirar uma excelente nota!!!

---

## 🛠 Tecnologias Utilizadas
- **PHP**
- **Laravel 12**
- **MySQL**
- **Javascript**
- **Blade Templates** (HTML5 + CSS3)
- **Composer** (gerenciador de dependências)
- **Git/GitHub** para controle de versão

---

## 📂 Funcionalidades

### 👤 Usuário comum
- Cadastro e login no sistema.
- Visualização de filmes populares, filtrados e marcados para uturamente assistir.
- Marcar e remover filmes dos favoritos.

### 🛡 Administrador
- Todas as permissões de usuário.
- Criar, editar e excluir filmes.

---

## 🔗 Rotas Principais

| Método | Rota | Descrição | Middleware |
|--------|------|-----------|------------|
| GET | `/` | Página inicial | - |
| GET | `/movie/popular` | Lista de filmes populares | - |
| GET | `/movie/search` | Lista filtrada de filmes | - |
| GET | `/user/{id}` | Perfil do usuário | `owns.account` |
| GET | `/movie/create` | Formulário de criação de filme | `admin` |

---

## 🗄 Estrutura do Banco de Dados

### Tabelas principais
- **users** – Armazena dados de autenticação e perfil.
- **movies** – Lista de filmes cadastrados.
- **categories** – Categorias para organização de filmes.
- **favorites** – Tabela pivot (muitos-para-muitos) entre `users` e `movies`.

---

## ⚙️ Instalação e Execução

1. **Clonar o repositório**
   ```bash
   git clone https://github.com/seu-usuario/seu-repositorio.git
   cd seu-repositorio
