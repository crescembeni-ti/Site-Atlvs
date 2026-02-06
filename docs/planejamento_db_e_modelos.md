# Planejamento de Banco de Dados e Modelos

Este documento detalha as alterações e adições necessárias no banco de dados e nos modelos do sistema para suportar as novas funcionalidades de orçamento, chat em tempo real e pagamentos.

## 1. Alterações em Tabelas Existentes

### 1.1. Tabela `users`
O campo `role` já existe, mas é importante garantir que os valores permitidos sejam consistentes (ex: `admin`, `client`).

### 1.2. Tabela `tickets`
Adicionar campos para suportar o fluxo de orçamento e vinculação ao projeto.

```php
Schema::table('tickets', function (Blueprint $table) {
    $table->foreignId('project_id')->nullable()->constrained()->onDelete('set null');
    $table->string('project_name')->nullable(); // Nome sugerido pelo cliente
    $table->text('project_scope')->nullable(); // Escopo detalhado pelo cliente
});
```

### 1.3. Tabela `projects`
Adicionar campos financeiros e de controle de pagamento.

```php
Schema::table('projects', function (Blueprint $table) {
    $table->decimal('total_value', 10, 2)->nullable();
    $table->decimal('entry_value', 10, 2)->nullable();
    $table->string('payment_status')->default('pending'); // pending, partial, paid
});
```

## 2. Novas Tabelas

### 2.1. Tabela `payments`
Armazenará cada transação financeira associada a um projeto.

```php
Schema::create('payments', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->foreignId('project_id')->constrained()->onDelete('cascade');
    $table->decimal('amount', 10, 2);
    $table->string('status')->default('pending'); // pending, paid, failed, cancelled
    $table->string('method')->nullable(); // pix, credit_card, boleto
    $table->string('gateway_id')->nullable(); // ID da transação no gateway
    $table->date('due_date');
    $table->timestamp('paid_at')->nullable();
    $table->timestamps();
});
```

## 3. Modelos e Relacionamentos

### 3.1. Modelo `User`
*   `projects()`: HasMany `Project`
*   `tickets()`: HasMany `Ticket`
*   `payments()`: HasMany `Payment`

### 3.2. Modelo `Ticket`
*   `user()`: BelongsTo `User`
*   `project()`: BelongsTo `Project`
*   `messages()`: HasMany `TicketMessage`

### 3.3. Modelo `Project`
*   `user()`: BelongsTo `User`
*   `ticket()`: HasOne `Ticket`
*   `payments()`: HasMany `Payment`
*   `comments()`: HasMany `ProjectComment`

### 3.4. Modelo `Payment`
*   `user()`: BelongsTo `User`
*   `project()`: BelongsTo `Project`

## 4. Chat em Tempo Real (Reverb)

Para o chat, utilizaremos as tabelas `ticket_messages` e `project_comments`. O Laravel Reverb será configurado para transmitir eventos quando novas mensagens forem criadas.

### 4.1. Eventos Necessários
*   `MessageSent`: Disparado quando uma nova `TicketMessage` ou `ProjectComment` é criada.
*   `ProjectUpdated`: Disparado quando o status do projeto ou pagamento é alterado.

## 5. Resumo das Migrações a Criar

1.  `2026_02_06_000001_update_tickets_table_for_quotes.php`
2.  `2026_02_06_000002_update_projects_table_for_payments.php`
3.  `2026_02_06_000003_create_payments_table.php`
