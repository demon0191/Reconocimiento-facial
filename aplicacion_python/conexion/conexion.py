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
    def update(self, table, data, where):
      set_clause = ", ".join([f"{key}=%s" for key in data.keys()])
      where_clause = " AND ".join([f"{key}=%s" for key in where.keys()])
      sql = f"UPDATE {table} SET {set_clause} WHERE {where_clause}"
      values = list(data.values()) + list(where.values())
      self.cursor.execute(sql, values)
      self.conn.commit()
    def close(self):
        self.cursor.close()
        self.conn.close()