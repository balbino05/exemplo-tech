"""
Serviço de ETL (Extract, Transform, Load)
Utilizado para sincronização e transformação de dados entre APIs externas
ou bancos de dados.
"""

import pandas as pd
from app.utils.db_client import get_mysql_connection

def run_etl_job():
    connection = get_mysql_connection()
    cursor = connection.cursor(dictionary=True)

    cursor.execute("SELECT id, name, price, stock FROM products LIMIT 5")
    products = cursor.fetchall()

    df = pd.DataFrame(products)
    avg_price = df["price"].mean() if not df.empty else 0

    return {
        "rows_fetched": len(products),
        "average_price": avg_price,
        "data_sample": df.head(3).to_dict(orient="records"),
    }
