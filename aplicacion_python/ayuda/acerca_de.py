import functools
import tkinter as tk



def ventana_secundaria(master, callback=None, args=(), kwargs={}):
    if callback is not None:
        callback = functools.partial(callback, *args, **kwargs)

    main_frame = tk.Frame(master)
    boton2 = tk.Button(main_frame, text="Boton 2")
    boton2.place(x=15, y=30)
    boton_volver = tk.Button(main_frame, text="Volver", command=callback)
    boton_volver.place(x=110, y=30)
    return main_frame