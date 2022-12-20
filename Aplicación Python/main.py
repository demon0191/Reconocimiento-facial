#Importando librerias necesarias para trabajar
from tkinter import *
from tkinter import ttk
import tkinter as tk
import mysql.connector

#Función para inicar sesión del administrador
def _iniciar_sesion():
  print("Iniciar sesión")

#Función de ayuda
def _ayuda():
  print("Ayuda")
  
#Función Acerca de
def _acerca_de():
  print("Acerca de")

#Función principal para centrar la ventana
def centrarPantalla(windows, ancho, alto):
  altura_pantalla = windows.winfo_screenheight()
  ancho_pantalla = windows.winfo_screenwidth()

  x = (ancho_pantalla // 2)- (ancho // 2)
  y = (altura_pantalla // 2)- (alto // 2)

  root.geometry(f"+{x}+{y}")

  #root.minsize(1000,500)
  root.title("Sistema de autenticación")
  root.resizable(0,0)
  
  #Creando la barra de menu de opciones
  barraMenu = Menu(root, tearoff=0)
  root.config(menu=barraMenu)

  #Crear los menus
  administrador = Menu(barraMenu, tearoff=0)
  administrador.add_command(label="Iniciar sesión", command=_iniciar_sesion)

  ayuda = Menu(barraMenu, tearoff=0)
  ayuda.add_command(label="Ayuda", command=_ayuda)
  ayuda.add_command(label="Acerca de", command=_acerca_de)

  barraMenu.add_cascade(label="Administrador", menu = administrador)
  barraMenu.add_cascade(label="Ayuda", menu= ayuda)


ancho = 1000
alto = 500


#Ejecutando el código
root = tk.Tk()
root.geometry("%dx%d" % (ancho, alto))
root.update()
centrarPantalla(root, ancho, alto)
root.mainloop()