import tkinter as tk

ventana=tk.Tk()
class iniciar_sesion:
  def __init__(self, arg1):
    self.arg1=arg1
  
  def centrarPantalla(self, windows, ancho, alto):
    altura_pantalla = windows.winfo_screenheight()
    ancho_pantalla = windows.winfo_screenwidth()

    x = (ancho_pantalla // 2)- (ancho // 2)
    y = (altura_pantalla // 2)- (alto // 2)

    ventana.geometry(f"+{x}+{y}")





login=iniciar_sesion("hola")
ancho = 1000
alto = 600
#Ejecutando el código
ventana.geometry("%dx%d" % (ancho, alto))
ventana.update()
login.centrarPantalla(ventana, ancho, alto)
ventana.mainloop()