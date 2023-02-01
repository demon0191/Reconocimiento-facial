#Importando librerias necesarias para trabajar
from tkinter import *
import tkinter as tk
from PIL import Image, ImageTk
import cv2
import imutils
import tensorflow as tf
import keras
from keras.models import load_model
import numpy as np
import mysql.connector
from conexion import conexion as conn #Archivo de conexion a la base de datos

#Variables globales
root = tk.Tk()
db = conn.Database()
alum=[]
prof=[]
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
    #nombre_foto = "aux.png"
    cv2.imwrite("auxiliar.jpg", frame)
    print("Foto tomada correctamente con el nombre {}".format("auxiliar.jpg"))
  else:
    print("Error al acceder a la cámara")
  video.release()
  video = cv2.VideoCapture(0)
  select_image()

#Función para comparar la foto
model = load_model('authorized_personnel_model.h5')

#Fecha y hora actual de la ciudad de mexico
import datetime

current_date_time = datetime.datetime.now()

date = current_date_time.date()
time = current_date_time.time()

#Funciones para corroborar que es personal autorizado
def alumnoEncontrado(matricula):
  query = "SELECT Matricula_Alumno FROM alumnos WHERE Matricula_Alumno=%s"
  data=(matricula,)
  results = db.execute_query(query,data)
  if listaVacia(results):
    return False
  else:
    return True
def profesorEncontrado(matricula):
  query = "SELECT Matricula_Profesor FROM profesores WHERE Matricula_Profesor=%s"
  data=(matricula,)
  results = db.execute_query(query,data)
  if listaVacia(results):
    return False
  else:
    return True
def personalEncontrado(matricula):
  if alumnoEncontrado(matricula)==True:
    #Insertar datos alumno
    if ingresoPrevioAlumno(matricula)==False or encontrandoElemento(alum, matricula)==False:
      db = conn.Database()
      data = {
        'Fecha': date,
        'Hora_entrada': time,
        'En_uso': 1,
        'fkMatricula_Alumno': matricula,
        'fkMatricula_Profesor': matriculaProfesor(matricula),
        'idCategoria': 3
        }
      table = 'acceso_alumnos'
      db.insert(table, data)
      db.close()
      if encontrandoElemento(alum, matricula)==True:
        #192H21384
        tabla='acceso_alumnos'
        campo='fkMatricula_Alumno'
        insertHoraSalida(tabla,matricula,campo)
        titulo='Salida registrada'
        mensajeExitoso(titulo)
      else:
        alum.append(matricula)
        titulo='Ingreso registrado1'
        mensajeExitoso(titulo)
    else:
      tabla='acceso_alumnos'
      campo='fkMatricula_Alumno'
      insertHoraSalida(tabla,matricula,campo)
      titulo='Salida registrada'
      mensajeExitoso(titulo)
  elif profesorEncontrado(matricula)==True:
      #Insertar datos profesor
    db = conn.Database()
    data = {
      'Fecha': date,
      'Hora_entrada': time,
      'En_uso': 1,
      'fkMatricula_Profesor': matricula,
      'idCategoria': 2
      }
    table = 'acceso_profesores'
    db.insert(table, data)
    db.close()
    titulo="Ingreso registrado"
    mensajeExitoso(titulo)
  else:
    #Mostrar mensaje de error
    titulo = "Personal no autorizado"
    mensajeError(titulo)

def ingresoPrevioPersonal(matricula,categoria):
  #Saber si el personal ya cuenta con un ingreso el dia actual
  bandera=True
  if categoria == 2:
    query = "SELECT * FROM acceso_profesores WHERE fkMatricula_Profesor=%s and Fecha=%s"
    data=(matricula,date)
    results = db.execute_query(query,data)
    if listaVacia(results):
      bandera = False
    else:
      bandera = True
  elif categoria ==3:
    query = "SELECT * FROM acceso_alumnos WHERE fkMatricula_Alumno=%s and Fecha=%s"
    data=(matricula,date)
    results = db.execute_query(query,data)
    if listaVacia(results):
      bandera = False
    else:
      bandera = True
def matriculaProfesor(matriculaAlum):
  query = "SELECT  Matricula_Profesor FROM alumnos WHERE Matricula_Alumno=%s"
  data=(matriculaAlum,)
  results = db.execute_query(query,data)
  return results[0][0]
#Funciones de insertar datos
def insertNoAutorizados():
  db = conn.Database()
  data = {
    'Fecha': date,
    'Hora': time}
  table = 'no_autorizados'
  db.insert(table, data)
  db.close()
def insertHoraSalida(tabla, matricula, campo):
  #datos para modificar
  db = conn.Database()
  data = {
    'Hora_salida': time,
    'En_uso': 0
    }
  where = {
    campo: matricula,
    'Fecha': date
    }
  db.update(tabla, data, where)
  db.close()

  
def select_image():
    # Load the selected image and resize it to the same size as the training images
    #image = keras.preprocessing.image.load_img(file_path, target_size=(640, 360))
    #image_array = keras.preprocessing.image.img_to_array(image)
    from PIL import Image
    image = Image.open("auxiliar.jpg")
    image = image.resize((360, 640))
    image_array = np.array(image)
    result = False
    # Use the model to make a prediction on the selected image
    predictions = model.predict(np.array([image_array]))

    # Display the prediction in the GUI
    if predictions[0][0] > 0.5:
        label = tk.Label(root, text="Authorized personnel")
        result=True
    else:
        label = tk.Label(root, text="Not authorized personnel")
        result=False
    label.pack()
    mensajeResultado(result)

def mensajeResultado(result):
    if result==True:
      titulo="Acceso consedido"
      accesoConsedido(titulo)
    else:
      titulo="Acceso denegado"
      accesoDenegado(titulo)
#Función que muestra la ventana de acceso consedido
def accesoConsedido(titulo):
  mensajeConsedido = Toplevel(root)
  mensajeConsedido.title(titulo)
  mensajeConsedido.resizable(0,0)
  mensajeConsedido.geometry("500x200")
  Label(mensajeConsedido,text =titulo, font=("Calisto MT", 18, "bold")).pack()
  
  entryMatricula = Entry(mensajeConsedido, width=25, font=("Calisto MT", 12, "bold"))
  entryMatricula.insert(0,'Inserte su matricula')
  entryMatricula.pack()
  btnAceptar= tk.Button(mensajeConsedido, text="Aceptar", bg="blue", relief="flat",cursor="hand2",command=lambda:personalEncontrado(entryMatricula.get()), width=15, height=1, font=("Calisto MT", 12, "bold"))
  btnAceptar.place(x=168, y=76)
  btnTomarOtraFoto= tk.Button(mensajeConsedido, text="Tomar otra foto", bg="blue", relief="flat",cursor="hand2",command=mensajeConsedido.destroy, width=15, height=1, font=("Calisto MT", 12, "bold"))
  btnTomarOtraFoto.place(x=168, y=120)
  center_window(mensajeConsedido, 500, 200)
#Función que muestra la ventana de acceso denegado
def accesoDenegado(titulo):
  insertNoAutorizados() #Se registra el intento de ingreso de personal no autorizado 
  mensaje = Toplevel(root)
  mensaje.title(titulo)
  mensaje.resizable(0,0)
  mensaje.geometry("500x200")
  Label(mensaje,text =titulo, font=("Calisto MT", 18, "bold")).pack()

  btnTomarOtraFoto= tk.Button(mensaje, text="Tomar otra foto", bg="blue", relief="flat",cursor="hand2",command=mensaje.destroy, width=15, height=1, font=("Calisto MT", 12, "bold"))
  btnTomarOtraFoto.place(x=168, y=76)
  btnCancelar= tk.Button(mensaje, text="Cancelar", bg="red", relief="flat",cursor="hand2",command=mensaje.destroy, width=15, height=1, font=("Calisto MT", 12, "bold"))
  btnCancelar.place(x=168, y=120)
  
  center_window(mensaje, 500, 200)
#Función que muestra la ventana de errores
def mensajeError(titulo):
  mensaje = Toplevel(root)
  mensaje.title(titulo)
  mensaje.resizable(0,0)
  mensaje.geometry("500x200")
  Label(mensaje,text =titulo, font=("Calisto MT", 18, "bold")).pack()

  btnCancelar= tk.Button(mensaje, text="Cerrar", bg="red", relief="flat",cursor="hand2",command=mensaje.destroy, width=15, height=1, font=("Calisto MT", 12, "bold"))
  btnCancelar.place(x=168, y=76)
  center_window(mensaje, 500, 200)
def mensajeExitoso(titulo):
  mensaje = Toplevel(root)
  mensaje.title(titulo)
  mensaje.resizable(0,0)
  mensaje.geometry("500x200")
  Label(mensaje,text =titulo, font=("Calisto MT", 18, "bold")).pack()

  btnCancelar= tk.Button(mensaje, text="Aceptar", bg="red", relief="flat",cursor="hand2",command=mensaje.destroy, width=15, height=1, font=("Calisto MT", 12, "bold"))
  btnCancelar.place(x=168, y=76)
  center_window(mensaje, 500, 200)
#Función principal para centrar la ventana
def center_window(root, width, height):
    # Get the screen width and height
    screen_width = root.winfo_screenwidth()
    screen_height = root.winfo_screenheight()

    # Calculate the position of the window on the screen
    x = (screen_width/2) - (width/2)
    y = (screen_height/2) - (height/2)

    # Set the geometry of the window
    root.geometry("%dx%d+%d+%d" % (width, height, x, y))
#Función para saber si una lista esta vacia
def listaVacia(list):
  return not list
#Función para saber si hay un registro previo el dia actual de dicha persona
def ingresoPrevio(matricula):
  data=(matricula,date)
  if profesorEncontrado(matricula):
    query = "SELECT * FROM acceso_profesores WHERE fkMatricula_Profesor=%s and Fecha=%s"
    results = db.execute_query(query, data)
    tabla="acceso_profesores"
    campo="fkMatricula_Profesor"
    if len(results) > 0:
      insertHoraSalida(tabla, matricula, campo)
      return True
  elif alumnoEncontrado(matricula):
    query = "SELECT * FROM acceso_alumnos WHERE fkMatricula_Alumno=%s and Fecha=%s"
    results = db.execute_query(query, data)
    tabla="acceso_alumnos"
    campo="fkMatricula_Alumno"
    if len(results) > 0:
      insertHoraSalida(tabla, matricula, campo)
      return True
  return False
#Función ingreo previo alumno
def ingresoPrevioAlumno(matricula):
  data=(matricula,date)
  query = "SELECT * FROM acceso_alumnos WHERE fkMatricula_Alumno=%s and Fecha=%s"
  results = db.execute_query(query, data)
  tabla="acceso_alumnos"
  campo="fkMatricula_Alumno"
  if listaVacia(results):
    return False
  return True
#Función para saber si esta el elemento en la lista
def encontrandoElemento(list_var, val):
  for valor in list_var:
    if valor==val:
      return True
  return False

root.title("Sistema de autenticación")
root.resizable(0,0)
#etiquetas para marcar el video
etiq_de_video = tk.Label(root, bg="black")
etiq_de_video.place(x=170, y=0)
boton = tk.Button(root, text="Tomar foto", bg="blue", relief="flat", cursor="hand2", command=tomar_Foto, width=15, height=2, font=("Calisto MT", 12, "bold"))
boton.place(x=405, y=505)
ancho = 1000
alto = 600

#Ejecutando el código
video_stream()
print(alum)
print(prof)
root.geometry("%dx%d" % (ancho, alto))
root.update()
center_window(root, ancho, alto)
root.mainloop()