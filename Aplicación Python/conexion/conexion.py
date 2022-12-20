import mysql.connector

conexion = mysql.connector.connect(user='r5SxYVoBpc', password='DG1UEJkfCK',
                                    host='remotemysql.com',
                                    database='r5SxYVoBpc',
                                    port='3306')
cursor = conexion.cursor()