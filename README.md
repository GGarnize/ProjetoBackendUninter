## SGHSS API (Laravel 12.x + Sanctum + SQLite)

API REST para gestão hospitalar simples, seguindo Laravel 12.x (Routing, Authentication, Sanctum) e práticas LGPD.

### Requisitos
- PHP 8.4 (WSL)
- Composer
- SQLite3

### Setup (WSL)
1. Instalar dependências: `composer install`
2. Copiar env: `cp .env.example .env`
3. Banco SQLite: `touch database/database.sqlite`
4. Definir `.env` com `DB_CONNECTION=sqlite` e `DB_DATABASE=/absolute/path/database/database.sqlite` se necessário
5. Chave e migrações: `php artisan key:generate && php artisan migrate`
6. Sanctum/API: `php artisan install:api`
7. Seeds dev: `php artisan db:seed --class=DevUsersSeeder`
8. Servidor: `php artisan serve`

### Rotas principais (prefixo /api)
- Auth: POST `/auth/register`, POST `/auth/login`, GET `/me`, POST `/auth/logout`
- Pacientes: `Route::apiResource('pacientes')`
- Profissionais: `Route::apiResource('profissionais')`
- Consultas: `Route::apiResource('consultas')->only(index,store,show,update,destroy)`
- Prontuários: GET `/prontuarios/paciente/{id}` + `apiResource` only index,store,show

### Regras/LGPD
- Senhas com hash forte (padrão Laravel hashed cast)
- CPF nunca armazenado em claro; `cpf_hash = sha256(CPF + APP_KEY)`
- RBAC simples via `users.role` (ADMIN|MEDICO|ATENDENTE)
- Prontuário: apenas `MEDICO` cria
- Consultas: impede sobreposição por profissional (409)
- Auditoria: middleware grava `audit_logs` com `payload_hash` e metadados, sem dados sensíveis

### PRAGMAs SQLite (WSL)
Aplicados em `App\Providers\AppServiceProvider::boot()`:
- `PRAGMA journal_mode=WAL;`
- `PRAGMA synchronous=NORMAL;`
- `PRAGMA foreign_keys=ON;`
- `PRAGMA busy_timeout=5000;`

### Testes
- Banco de testes: SQLite memória (configurado em `phpunit.xml`)
- Rodar: `composer test` ou `php artisan test`
- Cobertura crítica: Auth, Paciente CRUD (hash CPF), Consulta conflito 409, Prontuário RBAC 403

### Postman
- Coleção em `docs/postman_collection.json`
- Variáveis: `{{baseUrl}} = http://localhost:8000`, `{{token}}`

### Observações
- DBeaver (read-only) pode abrir `\wsl.localhost\Ubuntu\home\<user>\projects\sghss-api\database\database.sqlite`

### Licença
MIT
