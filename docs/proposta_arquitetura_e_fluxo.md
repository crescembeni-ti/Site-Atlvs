# Proposta de Arquitetura e Fluxo para o Sistema de Gestão de Projetos

## 1. Visão Geral do Sistema Atual

O repositório `Site-Atlvs` é uma aplicação Laravel que utiliza Livewire e Volt para o desenvolvimento de interfaces interativas. A estrutura atual já contempla:

*   **Autenticação de Usuários**: Gerenciada pelo Laravel Fortify, com suporte a autenticação de dois fatores.
*   **Modelos Existentes**: `User`, `Project`, `Ticket`, `Contact`, `ProjectComment`, `TicketMessage`, `ProjectFile`.
*   **Área Administrativa**: Rotas e controladores (`AdminDashboardController`, `AdminProjectController`, `AdminTicketController`) para gestão de leads, projetos e chamados (tickets).
*   **Área do Cliente**: Rotas e controladores (`DashboardController`, `ProjectController`, `TicketController`) para visualização de dashboard, projetos e chamados.
*   **Sistema de Chamados (Tickets)**: Funcionalidade básica para criação e acompanhamento de tickets, com mensagens associadas (`TicketMessage`). Existe uma rota `tickets.create_quote` que sugere uma intenção de orçamento.
*   **Sistema de Projetos**: Gerenciamento de projetos com nome, descrição, status, prazo e arquivos (`ProjectFile`), além de comentários (`ProjectComment`) que podem ser usados para comunicação.

## 2. Funcionalidades Propostas e Integração

As novas funcionalidades serão integradas ao sistema existente, aproveitando a estrutura Laravel e Livewire/Volt. O foco será em aprimorar o fluxo de solicitação de orçamento, negociação, vinculação de projetos e gestão de pagamentos.

### 2.1. Cadastro de Clientes

**Descrição**: O cliente se cadastrará no site para ter acesso às funcionalidades de solicitação de orçamento e acompanhamento de projetos.

**Integração**: O sistema de autenticação e registro de usuários do Laravel Fortify já está implementado. Novos clientes se registrarão como usuários comuns, e a diferenciação entre cliente e administrador é feita pelo campo `role` na tabela `users`.

### 2.2. Solicitação de Orçamento

**Descrição**: Após o cadastro, o cliente poderá solicitar um orçamento, informando o nome e o escopo do projeto.

**Integração**: A rota `tickets.create_quote` e o modelo `Ticket` já existem. Será necessário adaptar o formulário de criação de ticket para capturar o 
nome do projeto e o escopo de forma mais detalhada, possivelmente adicionando campos específicos ao modelo `Ticket` ou criando um novo modelo `QuoteRequest` que se relaciona com `Ticket`.

**Fluxo**: Cliente acessa `/orcamento` -> Preenche formulário com nome e escopo do projeto -> Submete -> Um novo `Ticket` (ou `QuoteRequest`) é criado com status `pendente`.

### 2.3. Chat Administrativo (Reverb)

**Descrição**: Após a solicitação de orçamento, um chat será aberto entre o cliente e o administrador para negociação do projeto. O usuário mencionou 'Reverb', o que indica a necessidade de uma solução de comunicação em tempo real.

**Integração**: O Laravel Reverb é uma excelente escolha para comunicação em tempo real, utilizando WebSockets. Ele se integra nativamente com Laravel Echo. O sistema já possui `ProjectComment` e `TicketMessage` que podem ser adaptados para o chat. Será necessário:

*   Configurar o Laravel Reverb no ambiente.
*   Integrar o frontend com Laravel Echo para enviar e receber mensagens em tempo real.
*   Adaptar os modelos `TicketMessage` ou `ProjectComment` para armazenar as mensagens do chat, associando-as ao `Ticket` (orçamento) ou `Project` (após vinculação).
*   Desenvolver a interface do chat tanto para o cliente quanto para o administrador, exibindo as mensagens de forma dinâmica.

**Fluxo**: ADM recebe notificação de novo orçamento -> ADM acessa o ticket/orçamento -> ADM inicia chat com o cliente (via interface Reverb) -> Cliente e ADM negociam via chat.

### 2.4. Fechamento de Negócio e Vinculação de Projeto

**Descrição**: Na tela do administrador, dentro da conversa do chat, haverá um botão para 'Fechar Negócio'. Ao clicar, o administrador vinculará o orçamento a um novo projeto.

**Integração**: Será necessário adicionar uma funcionalidade no controlador do administrador (`AdminTicketController` ou um novo `AdminQuoteController`) para:

*   Mudar o status do `Ticket` (orçamento) para `negociado` ou `aprovado`.
*   Criar um novo `Project` com base nas informações do `Ticket` (nome, descrição, `user_id`).
*   Vincular o `Ticket` ao `Project` (adicionar `project_id` ao `Ticket` ou vice-versa).
*   Possivelmente, desativar o chat do `Ticket` e ativar o chat do `Project` para futuras comunicações relacionadas ao desenvolvimento.

**Fluxo**: ADM e Cliente negociam via chat -> ADM clica em 'Fechar Negócio' -> Sistema cria `Project` e vincula ao `Ticket` e `User`.

### 2.5. Sistema de Pagamentos

**Descrição**: O projeto só terá início após o pagamento de um valor de entrada. O cliente poderá pagar o restante no final do projeto ou em parcelas, com acesso ao histórico de pagamentos dentro do próprio site.

**Integração**: Esta é a funcionalidade mais complexa e exigirá a integração com um gateway de pagamento (ex: Stripe, PagSeguro, Mercado Pago) e a criação de novos modelos e interfaces.

**Modelos Necessários**:

*   `Payment`: Para registrar cada transação (valor, data, status, método, `user_id`, `project_id`).
*   `Invoice` (Opcional, mas recomendado): Para gerar faturas para cada pagamento ou parcela.

**Funcionalidades**:

*   **Geração de Cobrança**: O administrador poderá gerar cobranças (entrada, parcelas) para o cliente, associadas a um `Project`.
*   **Interface de Pagamento para o Cliente**: O cliente terá uma área no dashboard para visualizar as cobranças pendentes e efetuar pagamentos via gateway.
*   **Histórico de Pagamentos**: O cliente poderá visualizar todos os pagamentos realizados e pendentes, com status e detalhes.
*   **Notificações**: Envio de e-mails ou notificações no sistema para pagamentos pendentes, confirmados, etc.

**Fluxo**: ADM gera cobrança de entrada para `Project` -> Cliente recebe notificação -> Cliente acessa dashboard, vê cobrança e paga via gateway -> Sistema registra `Payment` -> ADM é notificado e `Project` muda de status para `em_andamento` -> ADM gera parcelas/cobrança final -> Cliente paga -> Sistema registra `Payment`.

## 3. Estrutura de Banco de Dados (Alterações e Adições)

### 3.1. Tabela `users`

Nenhuma alteração estrutural é estritamente necessária, pois o campo `role` já existe para diferenciar administradores de clientes.

### 3.2. Tabela `tickets`

Será necessário adicionar um campo `project_id` para vincular o ticket de orçamento ao projeto criado após a negociação.

| Campo       | Tipo      | Descrição                                        |
| :---------- | :-------- | :----------------------------------------------- |
| `project_id`| `foreignId` | Chave estrangeira para `projects.id`, nullable.  |

### 3.3. Nova Tabela `payments`

Esta tabela armazenará todos os registros de pagamentos relacionados aos projetos.

| Campo         | Tipo        | Descrição                                        |
| :------------ | :---------- | :----------------------------------------------- |\n| `id`          | `bigIncrements` | Chave primária.                                  |
| `user_id`     | `foreignId` | Chave estrangeira para `users.id` (cliente).     |
| `project_id`  | `foreignId` | Chave estrangeira para `projects.id`.            |
| `amount`      | `decimal`   | Valor do pagamento.                              |
| `status`      | `string`    | Status do pagamento (pendente, pago, falhou).    |
| `method`      | `string`    | Método de pagamento (cartão, boleto, pix).       |
| `transaction_id` | `string`    | ID da transação no gateway de pagamento.         |
| `due_date`    | `date`      | Data de vencimento do pagamento.                 |
| `paid_at`     | `timestamp` | Data e hora em que o pagamento foi efetuado.      |
| `created_at`  | `timestamp` | Data e hora de criação do registro.              |
| `updated_at`  | `timestamp` | Data e hora da última atualização do registro.   |

### 3.4. Tabela `projects`

Será necessário adicionar campos relacionados a valores e status de pagamento.

| Campo       | Tipo      | Descrição                                        |
| :---------- | :-------- | :----------------------------------------------- |
| `value`     | `decimal` | Valor total negociado do projeto.                |
| `entry_value` | `decimal` | Valor de entrada negociado.                      |
| `payment_status` | `string` | Status geral do pagamento do projeto (pendente, parcial, pago). |

## 4. Fluxo de Trabalho Detalhado

1.  **Cliente se Cadastra**: Novo usuário se registra no site (`/register`).
2.  **Cliente Solicita Orçamento**: Cliente acessa `/orcamento`, preenche formulário (nome do projeto, escopo) -> Cria um `Ticket` com `status = 'orcamento_pendente'`.
3.  **ADM Recebe Notificação**: ADM é notificado sobre novo `Ticket` de orçamento.
4.  **ADM Inicia Negociação**: ADM acessa o `Ticket` no painel administrativo (`/admin/chamados/{ticket_id}`).
5.  **Chat (Reverb)**: ADM e Cliente se comunicam em tempo real via chat integrado ao `Ticket` (usando `TicketMessage` e Laravel Reverb).
6.  **Fechamento de Negócio**: ADM, na tela do chat, clica em 'Fechar Negócio'.
    *   `Ticket` tem seu `status` atualizado para `negociado`.
    *   Um novo `Project` é criado com `name`, `description`, `user_id` do `Ticket`.
    *   `Project` recebe `value`, `entry_value` e `payment_status = 'pendente'`.
    *   `Ticket.project_id` é preenchido com o `id` do novo `Project`.
7.  **Pagamento de Entrada**: ADM gera uma cobrança de entrada (`Payment`) para o `Project`.
8.  **Cliente Paga Entrada**: Cliente acessa seu dashboard, visualiza a cobrança e efetua o pagamento via gateway.
    *   `Payment` tem seu `status` atualizado para `pago`.
    *   `Project.payment_status` é atualizado para `parcial`.
    *   `Project.status` é atualizado para `em_andamento`.
9.  **Acompanhamento de Parcelas/Pagamento Final**: ADM gera cobranças adicionais (`Payment`s) conforme o acordado.
10. **Cliente Paga Parcelas/Final**: Cliente efetua os pagamentos.
    *   `Payment`s são atualizados para `pago`.
    *   `Project.payment_status` é atualizado para `pago` quando todos os pagamentos forem concluídos.
11. **Acompanhamento do Projeto**: Cliente e ADM utilizam o chat do `Project` (via `ProjectComment` e Reverb) para discutir o desenvolvimento.

## 5. Próximos Passos

1.  **Criação das Migrações**: Implementar as migrações para as novas tabelas e campos no banco de dados.
2.  **Desenvolvimento dos Modelos**: Criar o modelo `Payment` e atualizar os modelos `Ticket` e `Project`.
3.  **Configuração do Laravel Reverb**: Instalar e configurar o Laravel Reverb.
4.  **Desenvolvimento do Frontend**: Implementar as interfaces de usuário para solicitação de orçamento, chat e gestão de pagamentos, utilizando Livewire/Volt.
5.  **Integração com Gateway de Pagamento**: Escolher e integrar um gateway de pagamento.
6.  **Testes**: Realizar testes abrangentes para todas as novas funcionalidades.

## Referências

*   [Laravel Documentation](https://laravel.com/docs) [1]
*   [Livewire Documentation](https://livewire.laravel.com/docs) [2]
*   [Laravel Fortify Documentation](https://laravel.com/docs/fortify) [3]
*   [Laravel Reverb Documentation](https://laravel.com/docs/reverb) [4]
