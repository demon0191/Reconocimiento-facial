import tkinter as tk
from ayuda import acerca_de as acd


def mostrar_secundaria():
    principal.pack_forget()
    acd.pack(side="top", fill="both", expand=True)

def mostrar_principal():
    acd.pack_forget()
    principal.pack(side="top", fill="both", expand=True)


root = tk.Tk()
root.maxsize(width=200, height=200)
root.minsize(width=200, height=200)
principal = tk.Frame(root)
boton = tk.Button(principal, text="Boton", command=mostrar_secundaria)
boton.place(x=10, y=10)
acd = acd.ventana_secundaria(root, mostrar_principal)
mostrar_principal()
root.mainloop()