# 📊 Microserviço Go — `go-reports`

Serviço escrito em **Go (Golang)** para geração de **relatórios JSON e XLSX**, parte da arquitetura distribuída do projeto **exemplo-tech**.

---

## 🚀 Funcionalidades

- Gera relatórios dinâmicos de produtos (simulados)
- Retorna dados em formato **JSON** ou **XLSX**
- Pode ser consumido via backend Laravel (`ReportService`)
- Inclui limpeza automática de arquivos antigos

---

## 🧩 Estrutura

internal/
├── handlers/ # Handlers HTTP (rotas)
├── reports/ # Lógica de geração de relatórios
└── utils/ # Funções auxiliares (limpeza, arquivos)


---

## ▶️ Execução

### Localmente

```bash
cd microservices/go-reports
go mod tidy
go run main.go
