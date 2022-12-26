import mysql.connector

conexion = mysql.connector.connect(user='root', password='ferrari0191',
                                    host='localhost',
                                    database='laboratorio_dacb',
                                    port=3306)
cursor = conexion.cursor()