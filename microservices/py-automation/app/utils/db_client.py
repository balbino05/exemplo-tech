"""
Cliente de conexão com banco MySQL
Utilizado para ler dados diretamente da base principal (api-laravel)
"""

import mysql.connector
import os

def get_mysql_connection():
    connection = mysql.connector.connect(
        host=os.getenv("MYSQL_HOST", "mysql"),
        user=os.getenv("MYSQL_USER", "root"),
        password=os.getenv("MYSQL_PASSWORD", "Root@12345"),
        database=os.getenv("MYSQL_DATABASE", "devstore"),
        port=os.getenv("MYSQL_PORT", 3306)
    )
    return connection
