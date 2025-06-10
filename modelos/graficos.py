import pandas as pd
import matplotlib.pyplot as plt
import seaborn as sns
from mpl_toolkits.mplot3d import Axes3D
import numpy as np
import joblib
import os
from sklearn.metrics import confusion_matrix, ConfusionMatrixDisplay

def mostrar_graficos(csv_path="datos.csv"):
    datos = pd.read_csv(csv_path)

    #1. Distribución de clases
    plt.figure(figsize=(6, 4))
    sns.countplot(x='potabilidad', data=datos)
    plt.title("Distribución de clases (potable vs no potable)")
    plt.xlabel("Clase")
    plt.ylabel("Cantidad")
    plt.show()

    #2. Dispersión 3D con tres variables
    fig = plt.figure(figsize=(8, 6))
    ax = fig.add_subplot(111, projection='3d')

    colores = {0: 'red', 1: 'blue'}  # 0 = no potable, 1 = potable

    for clase in datos['potabilidad'].unique():
        subset = datos[datos['potabilidad'] == clase]
        ax.scatter(
            subset['ph'],
            subset['contaminante'],
            subset['cloro'],  # Cambiado de 'turbidez' a 'cloro'
            label=f"Potable = {clase}",
            color=colores[clase],
            alpha=0.6
        )

    ax.set_xlabel('pH')
    ax.set_ylabel('Contaminante')
    ax.set_zlabel('Cloro')  # Cambiado de 'Turbidez' a 'Cloro'
    ax.set_title('Dispersión 3D: pH vs Contaminantes vs Cloro')  # Cambiado el título
    ax.legend()
    plt.show()

    #3. Mapa de calor de correlación
    plt.figure(figsize=(10, 8))
    sns.heatmap(datos.corr(), annot=True, cmap='coolwarm', fmt=".2f")
    plt.title("Mapa de calor - Correlación de variables")
    plt.show()

def graficar_3d_con_plano(csv_path="datos.csv", model_path="modeloEntrenado.pkl"):
    base_dir = os.path.dirname(__file__)
    model_path = os.path.join(base_dir, model_path)
    # Cargar los datos
    datos = pd.read_csv(csv_path)
    X = datos[['ph', 'cloro', 'contaminante']]  # Cambiado de 'turbidez' a 'cloro'
    y = datos['potabilidad']

    #Cargar el modelo entrenado
    modelo = joblib.load(model_path)

    # Crear el gráfico 3D
    fig = plt.figure(figsize=(10, 8))
    ax = fig.add_subplot(111, projection='3d')

    # Colores para las clases
    colores = {0: 'red', 1: 'blue'}

    #Graficar los puntos
    for clase in y.unique():
        subset = datos[datos['potabilidad'] == clase]
        ax.scatter(
            subset['ph'],
            subset['cloro'],  # Cambiado de 'turbidez' a 'cloro'
            subset['contaminante'],
            label=f"Potable = {clase}",
            color=colores[clase],
            alpha=0.6
        )

    #Crear un plano de decisión
    ph_range = np.linspace(X['ph'].min(), X['ph'].max(), 10)
    cloro_range = np.linspace(X['cloro'].min(), X['cloro'].max(), 10)  # Cambiado de 'turbidez' a 'cloro'
    ph_grid, cloro_grid = np.meshgrid(ph_range, cloro_range)

    # Calcular el plano de decisión
    coef = modelo.coefs_[0]  # Coeficientes de la capa de entrada
    intercept = modelo.intercepts_[0]  # Sesgo de la capa de entrada
    contaminante_grid = -(coef[0][0] * ph_grid + coef[1][0] * cloro_grid + intercept[0]) / coef[2][0]

    #Graficar el plano
    ax.plot_surface(ph_grid, cloro_grid, contaminante_grid, color='green', alpha=0.3)

    # Etiquetas y título
    ax.set_xlabel('pH')
    ax.set_ylabel('Cloro')  # Cambiado de 'Turbidez' a 'Cloro'
    ax.set_zlabel('Contaminante')
    ax.set_title('Dispersión 3D con plano de decisión')
    ax.legend()
    plt.show()

def mostrar_matriz_confusion(csv_path="datos.csv", model_path="modeloEntrenado.pkl"):
    """Genera y muestra la matriz de confusión."""
    # Cargar los datos
    datos = pd.read_csv(csv_path)
    base_dir = os.path.dirname(__file__)
    model_path = os.path.join(base_dir, model_path)
    X = datos[['ph', 'turbidez', 'cloro', 'contaminante']]
    y = datos['potabilidad']

    # Cargar el modelo entrenado
    modelo = joblib.load(model_path)

    # Realizar predicciones
    y_pred = modelo.predict(X)

    # Calcular la matriz de confusión
    cm = confusion_matrix(y, y_pred)
    disp = ConfusionMatrixDisplay(confusion_matrix=cm, display_labels=["No Potable", "Potable"])

    # Mostrar la matriz de confusión
    disp.plot(cmap='Blues')
    plt.title("Matriz de Confusión")
    plt.show()

# Para ejecución directa desde consola
if __name__ == "__main__":
    # Mostrar gráficos existentes
    mostrar_graficos()

    # Generar el gráfico 3D con el plano de decisión
    graficar_3d_con_plano()
