import tkinter as tk
from tkinter import ttk
#import util.generic as utl

class FormLoginDesigner():
        
    def verificar(self):
        pass
    
    def userRegister(self):
        pass
    

ventana = tk.Tk()
ventana.title('Inicio de sesion')
ventana.geometry('1000x600')
ventana.config(bg='#fcfcfc')
ventana.resizable(width=0, height=0)


logo = tk.PhotoImage(file = './img/logo_dacb.png')



frame_logo = tk.Frame(ventana, bd=0, width=300,
                     relief=tk.SOLID, padx=10, pady=10, bg='cyan')
frame_logo.pack(side="left", expand=tk.YES, fill=tk.BOTH)
label = tk.Label(frame_logo, image=logo, bg='cyan')
label.place(x=0, y=0, relwidth=1, relheight=1)

# frame_form
frame_form = tk.Frame(ventana, bd=0,
                      relief=tk.SOLID, bg='#fcfcfc')
frame_form.pack(side="right", expand=tk.YES, fill=tk.BOTH)
# frame_form

# frame_form_top
frame_form_top = tk.Frame(
    frame_form, height=50, bd=0, relief=tk.SOLID, bg='black')
frame_form_top.pack(side="top", fill=tk.X)
title = tk.Label(frame_form_top, text="Inicio de sesion", font=(
    'Times', 30), fg="#666a88", bg='#fcfcfc', pady=50)
title.pack(expand=tk.YES, fill=tk.BOTH)
# end frame_form_top

# frame_form_fill
frame_form_fill = tk.Frame(
    frame_form, height=50,  bd=0, relief=tk.SOLID, bg='#fcfcfc')
frame_form_fill.pack(side="bottom", expand=tk.YES, fill=tk.BOTH)

etiqueta_usuario = tk.Label(frame_form_fill, text="Usuario", font=(
    'Times', 14), fg="#666a88", bg='#fcfcfc', anchor="w")
etiqueta_usuario.pack(fill=tk.X, padx=20, pady=5)
usuario = ttk.Entry(frame_form_fill, font=('Times', 14))
usuario.pack(fill=tk.X, padx=20, pady=10)

etiqueta_password = tk.Label(frame_form_fill, text="Contraseña", font=(
    'Times', 14), fg="#666a88", bg='#fcfcfc', anchor="w")
etiqueta_password.pack(fill=tk.X, padx=20, pady=5)
password = ttk.Entry(frame_form_fill, font=('Times', 14))
password.pack(fill=tk.X, padx=20, pady=10)
password.config(show="*")

inicio = tk.Button(frame_form_fill, text="Iniciar sesion", font=(
    'Times', 15), bg='#3a7ff6', bd=0, fg="#fff")
inicio.pack(fill=tk.X, padx=20, pady=20)
inicio.bind("<Return>", (lambda event: verificar()))


inicio = tk.Button(frame_form_fill, text="Registrar usuario", font=(
    'Times', 15), bg='#fcfcfc', bd=0, fg="#3a7ff6")
inicio.pack(fill=tk.X, padx=20, pady=20)
inicio.bind("<Return>", (lambda event: userRegister()))

# end frame_form_fill
ventana.mainloop()