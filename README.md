Exemplo Tech — Fullstack Challenge

Plataforma de demonstração técnica com arquitetura moderna e escalável, integrando Laravel (GraphQL), Quasar (Vue 3), Hyperf, Go e Python com mensageria RabbitMQ e Redis.

💡 Objetivo: demonstrar domínio em backend PHP moderno, frontend reativo, microserviços, processamento de dados massivos e visualização analítica.

🚀 Tecnologias principais
Camada	Tecnologia	Função
Frontend	Vue 3 + Quasar + Apollo	Interface SPA com GraphQL
Backend	Laravel 10 + Rebing GraphQL	API central e autenticação JWT
Microserviços	Hyperf (PHP), Go e Python	Processamento paralelo e análise
Infra	RabbitMQ, Redis, MySQL	Mensageria, cache e persistência
Dashboard	ApexCharts / ECharts	Visualização de dados em tempo real
⚙️ Instalação
📦 Backend Laravel
cd api-laravel
cp .env.example .env
composer install
php artisan key:generate
php artisan migrate --seed
php artisan serve

🧱 Frontend Quasar
cd web-quasar
npm install
quasar dev

🐇 RabbitMQ + Redis (via Docker)
docker-compose up -d redis rabbitmq

⚡ Hyperf
cd services/hyperf
composer install
php bin/hyperf.php start

🐹 Go Service
cd services/go
go mod tidy
go run main.go

🧠 Python Analytics
cd services/python
pip install -r requirements.txt
python app.py

🧩 Arquitetura do Sistema

(diagrama ou link para imagem gerada)

Comunicação assíncrona via RabbitMQ

Cada microserviço tem responsabilidades claras

JWT entre cliente e Laravel, chaves internas entre serviços

Redis atua como cache central e canal Pub/Sub para WebSockets

🔄 Fluxo de comunicação

1️⃣ Quasar → GraphQL (JWT Auth)
2️⃣ Laravel → RabbitMQ (evento)
3️⃣ Hyperf → Go → Python (pipeline de processamento)
4️⃣ Python → Redis (resultado)
5️⃣ Hyperf → WebSocket → Quasar (dashboard atualiza)

📊 Dashboard

Gráficos em tempo real com ApexCharts

Dados processados por Go e Python

Atualização automática via WebSocket

🧠 Futuras melhorias

Adicionar autenticação OAuth2

Implementar cache distribuído com Redis Cluster

Adicionar CI/CD com GitHub Actions

Melhorar monitoramento com Prometheus e Grafana

👨‍💻 Contribuições

Pull requests são bem-vindos!
Sugestões de melhorias podem ser abertas como issues.

📄 Licença

MIT © Ivan Cássio Balbino
