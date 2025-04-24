# 🗳️ Polls System

Sistema de enquetes online desenvolvido com Laravel, onde um administrador pode criar e gerenciar enquetes e o público em geral pode votar — com verificação por IP para garantir apenas um voto por pessoa.

## 📌 Funcionalidades

- ✅ Autenticação de administrador
- 🛠️ CRUD de enquetes (somente admin)
- 🌐 Votação pública (sem necessidade de login)
- 🔒 Controle de voto único por IP
- 📊 Contagem de votos em tempo real

## ⚙️ Regras de uso

- Apenas usuários autenticados como **admin** podem:
  - Criar novas enquetes
  - Editar ou excluir enquetes existentes
- As enquetes ficam **visíveis ao público**, que pode:
  - Votar em uma das opções disponíveis
  - **Apenas um voto por enquete é permitido**, e o controle é feito por IP

## 🛠️ Tecnologias utilizadas

- Laravel
- MySQL
- Bootstrap ou TailwindCSS
- Railway (deploy)
- Blade + Laravel UI

## 🚀 Como rodar localmente

1. Clone o repositório:
   ```bash
   git clone https://github.com/seu-usuario/polls-system.git
   cd polls-system

2. Instale as dependências:
    composer install

3. Configure o .env:
    cp .env.example .env
    php artisan key:generate

4. Configure o banco e rode as migrations:
    php artisan migrate

5. Suba o servidor local:
    php artisan serve


🌐 Deploy
O projeto está disponível em produção:
https://polls-system-web-production.up.railway.app

👤 Autor
Desenvolvido por Vitor Mariano
📧 Email: vitorma1992@gmail.com

## 📸 Screenshots

![Página de login](public/images/loginView.png)
![Tela de votação](public/images/votesView.png)