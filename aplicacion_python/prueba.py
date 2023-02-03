from PIL import Image, ImageTk
import cv2
import imutils
import tensorflow as tf
import keras
from keras.models import load_model
import numpy as np
import mysql.connector
from conexion import conexion as conn 

# Load the trained CNN model
model = keras.models.load_model('authorized_personnel_model.h5')

# Load the image
image = cv2.imread("auxiliar.jpg")

# Use OpenCV's Haar cascade classifier to detect faces in the image
face_cascade = cv2.CascadeClassifier("haarcascade_frontalface_default.xml")
faces = face_cascade.detectMultiScale(image, scaleFactor=1.1, minNeighbors=5)

# Loop through each face detected in the image
for (x, y, w, h) in faces:
    # Crop the face from the image
    face = image[y:y+h, x:x+w]
    
    # Resize the cropped face to the desired size
    face = cv2.resize(face, (640, 480))
    
    # Predict if the face is authorized
    prediction = model.predict(face.reshape(-1, 640, 480, 3))
    
    # If the face is authorized, display "Authorized" on the image
    if prediction > 0.5:
        cv2.putText(image, "Authorized", (x, y-10), cv2.FONT_HERSHEY_SIMPLEX, 1, (0, 255, 0), 2)
    # If the face is not authorized, display "Not authorized" on the image
    else:
        cv2.putText(image, "Not authorized", (x, y-10), cv2.FONT_HERSHEY_SIMPLEX, 1, (0, 0, 255), 2)

# Display the image with text annotations
if image.shape[0] > 0 and image.shape[1] > 0:
    cv2.imshow("Authorized personnel", image)
else:
    print("Invalid image size")
cv2.waitKey(0)
cv2.destroyAllWindows()
