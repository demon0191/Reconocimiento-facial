import mysql.connector
host='localhost'
user='root'
password='ferrari0191'
database='laboratorio_dacb'

class Database:
    def __init__(self):
        self.conn = mysql.connector.connect(
            host=host,
            user=user,
            password=password,
            database=database
        )
        self.cursor = self.conn.cursor()

    def execute_query(self, query, data):
      self.cursor.execute(query, data)
      results = self.cursor.fetchall()
      return results
      
    def insert(self, table, data):
        columns = ", ".join(data.keys())
        values = ", ".join(["%s"] * len(data))
        sql = f"INSERT INTO {table} ({columns}) VALUES ({values})"
        self.cursor.execute(sql, list(data.values()))
        self.conn.commit()
        
    def close(self):
        self.cursor.close()
        self.conn.close()
        
        

'''db = Database()
# Execute a query
matricula="192H20654"
query = "SELECT  Matricula_Profesor FROM alumnos WHERE Matricula_Alumno=%s"
data=(matricula,)
results = db.execute_query(query,data)

aux = results[0][0]
print(aux)

# Close the connection
db.close()'''