# 🧠 Microserviço Python — `py-automation`

Serviço de **automações e análises de dados** desenvolvido em **FastAPI**, parte da arquitetura distribuída do projeto **exemplo-tech**.

---

## 🚀 Funcionalidades

- Executa tarefas automáticas (ETL, sincronização, análise)
- Gera relatórios analíticos em formato JSON
- Integra-se ao backend Laravel via `ReportService`

---

## 📦 Estrutura

app/
├── main.py # Entry point FastAPI
├── routes/tasks.py # Definição das rotas
├── services/ # Lógica de negócios
│ ├── analytics_service.py
│ └── etl_service.py
└── utils/db_client.py # Conexão MySQL


---

## 🧰 Instalação

```bash
cd microservices/py-automation
python -m venv venv
source venv/bin/activate
pip install -r requirements.txt

