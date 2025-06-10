import pandas as pd
from modelo import train_model

# Ruta del archivo de datos
DATA_PATH = "datos.csv"

def entrenamiento_inicial():
    """Realiza el entrenamiento inicial del modelo con los datos de datos.csv."""
    # Cargar los datos
    datos = pd.read_csv(DATA_PATH)

    # Validar que las columnas sean las esperadas
    expected_columns = ['ph', 'turbidez', 'cloro', 'contaminante', 'potabilidad']
    if not all(col in datos.columns for col in expected_columns):
        raise ValueError(f"El archivo {DATA_PATH} no contiene las columnas esperadas: {expected_columns}")

    # Separar características (X) y etiqueta (y)
    X = datos[['ph', 'turbidez', 'cloro', 'contaminante']]
    y = datos['potabilidad']

    # Entrenar el modelo
    modelo = train_model(X, y)

    print("Entrenamiento inicial completado. Modelo guardado en 'modeloEntrenado.pkl'.")

if __name__ == "__main__":
    entrenamiento_inicial()