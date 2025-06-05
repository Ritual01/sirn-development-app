from keras.models import Sequential
from keras.layers import Dense
import numpy as np

class RedNeuronal:
    def __init__(self, input_dim, output_dim):
        self.modelo = Sequential()
        self.modelo.add(Dense(10, input_dim=input_dim, activation='relu'))
        self.modelo.add(Dense(10, activation='relu'))
        self.modelo.add(Dense(output_dim, activation='sigmoid'))
        self.modelo.compile(loss='binary_crossentropy', optimizer='adam', metrics=['accuracy'])

    def entrenar(self, X, y, epochs=100, batch_size=10):
        self.modelo.fit(X, y, epochs=epochs, batch_size=batch_size)

    def predecir(self, X):
        return self.modelo.predict(X)