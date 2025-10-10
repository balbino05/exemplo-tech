"""
Microserviço py-automation
---------------------------
Serviço FastAPI responsável por automações, ETL e análises de dados
para o projeto exemplo-tech.
"""

from fastapi import FastAPI
from app.routes import tasks

app = FastAPI(
    title="py-automation",
    version="1.0.0",
    description="Serviço de automações e análises para exemplo-tech",
)

# 🔗 Rotas do serviço
app.include_router(tasks.router, prefix="/tasks", tags=["Tasks"])


@app.get("/")
async def root():
    """Rota de verificação do serviço"""
    return {"status": "ok", "service": "py-automation", "version": "1.0.0"}
