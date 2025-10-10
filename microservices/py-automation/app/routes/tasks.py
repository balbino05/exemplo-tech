from fastapi import APIRouter, Query
from app.services.analytics_service import run_analytics
from app.services.etl_service import run_etl_job

router = APIRouter()

@router.get("/run")
async def run_task(job: str = Query(..., description="Nome do job a ser executado")):
    """
    Executa uma automação específica com base no nome do job.
    - `analyze_sales`: Gera relatório analítico de vendas.
    - `sync_products`: Executa sincronização de produtos.
    """
    if job == "analyze_sales":
        result = run_analytics()
    elif job == "sync_products":
        result = run_etl_job()
    else:
        return {"status": "error", "message": f"Job '{job}' não reconhecido"}

    return {"status": "ok", "job": job, "result": result}
