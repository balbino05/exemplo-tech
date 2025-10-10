"""
Serviço de análise de dados
Executa rotinas de geração de relatórios analíticos (ex: vendas, estoque)
"""

import pandas as pd
import random

def run_analytics():
    # Simula dados analíticos para demonstração
    data = {
        "produto": ["Notebook", "Mouse", "Teclado", "Monitor"],
        "vendas": [random.randint(100, 500) for _ in range(4)],
        "lucro": [round(random.uniform(1000, 5000), 2) for _ in range(4)],
    }

    df = pd.DataFrame(data)
    resumo = {
        "total_vendas": int(df["vendas"].sum()),
        "lucro_total": float(df["lucro"].sum()),
        "top_produto": df.loc[df["vendas"].idxmax(), "produto"],
    }

    return {
        "summary": resumo,
        "details": df.to_dict(orient="records"),
    }
