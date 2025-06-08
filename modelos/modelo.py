import pandas as pd
from sklearn.neural_network import MLPClassifier
from sklearn.model_selection import train_test_split
from sklearn.preprocessing import StandardScaler
import joblib

MODEL_PATH = "modeloEntrenado.pkl"
SCALER_PATH = "scaler.pkl"
LOG_PATH = "log.csv"

def load_model():
    """Carga el modelo entrenado desde un archivo."""
    try:
        model = joblib.load(MODEL_PATH)
    except FileNotFoundError:
        model = None
    return model

def train_model(X, y, hidden_layer_sizes=(100)*5, learning_rate_init=0.000001, max_iter=9990000):
    """Entrena un modelo MLPClassifier con los datos proporcionados."""
    #Escalar las características
    scaler = StandardScaler()
    X_scaled = scaler.fit_transform(X)

    #Dividir los datos en entrenamiento y prueba
    X_train, X_test, y_train, y_test = train_test_split(X_scaled, y, test_size=0.2, random_state=42)

    #Entrenar el modelo
    model = MLPClassifier(
        hidden_layer_sizes=hidden_layer_sizes,
        activation='relu',
        learning_rate_init=learning_rate_init,
        max_iter=max_iter,
        alpha=0.0001,
        solver='adam'
    )
    model.fit(X_train, y_train)

    #Evaluar el modelo
    score = model.score(X_test, y_test)
    print(f"Precisión en el conjunto de prueba: {score:.2f}")

    #Guardar el modelo y el escalador
    joblib.dump(model, MODEL_PATH)
    joblib.dump(scaler, SCALER_PATH)
    return model

def predict(model, input_data):
    """Realiza una predicción con el modelo entrenado."""
    #Cargar el escalador
    scaler = joblib.load(SCALER_PATH)
    input_data_scaled = scaler.transform(input_data)

    #Realizar la predicción
    return model.predict(input_data_scaled)

def retrain_model_with_new_data():
    """Reentrena el modelo con los datos registrados en log.csv."""
    df = pd.read_csv(LOG_PATH)

    #Validar que las columnas sean las esperadas
    expected_columns = ['ph', 'turbidez', 'cloro', 'contaminante', 'potabilidad']
    if not all(col in df.columns for col in expected_columns):
        raise ValueError(f"El archivo {LOG_PATH} no contiene las columnas esperadas: {expected_columns}")

    #Separar características y etiquetas
    X = df[['ph', 'turbidez', 'cloro', 'contaminante']]
    y = df['potabilidad']

    #Reentrenar el modelo
    model = train_model(X, y)
    return model