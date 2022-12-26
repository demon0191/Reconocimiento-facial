#Importando librerias necesarias para trabajar
from tkinter import *
import tkinter as tk
import mysql.connector
from PIL import Image, ImageTk
import cv2
import imutils
import uuid
#from conexion import conexion
#from administrador import iniciar_sesion as adm

root = tk.Tk()
#Función para inicar sesión del administrador
def _iniciar_sesion():
  print("Iniciar sesión")

#Función de ayuda
def _ayuda():
  print("Ayuda")
  
#Función Acerca de
def _acerca_de():
  print("Acerca de")

#Finciones para iniciar video
video = None
def video_stream():
  global video
  video = cv2.VideoCapture(0)
  iniciar()

def iniciar():
  global video
  ret, frame = video.read()
  if ret==True:
    frame=imutils.resize(frame, width=640)
    frame = cv2.cvtColor(frame, cv2.COLOR_BGR2RGB)
    img = Image.fromarray(frame)
    image = ImageTk.PhotoImage(image=img)
    etiq_de_video.configure(image=image)
    etiq_de_video.image = image
    etiq_de_video.after(10, iniciar)

def tomar_Foto():
  global video
  video = cv2.VideoCapture(0)
  ret, frame = video.read()
  if ret == True:
    nombre_foto = str(uuid.uuid4()) + ".png"
    cv2.imwrite(nombre_foto, frame)
    print("Foto tomada correctamente con el nombre {}".format(nombre_foto))
  else:
    print("Error al acceder a la cámara")
  video.release()

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

#etiquetas para marcar el video
etiq_de_video = tk.Label(root, bg="black")
etiq_de_video.place(x=170, y=0)

boton = tk.Button(root, text="Tomar foto", bg="blue", relief="flat", cursor="hand2", command=tomar_Foto, width=15, height=2, font=("Calisto MT", 12, "bold"))
boton.place(x=405, y=505)

ancho = 1000
alto = 600


#Ejecutando el código
video_stream()
root.geometry("%dx%d" % (ancho, alto))
root.update()
centrarPantalla(root, ancho, alto)
root.mainloop()