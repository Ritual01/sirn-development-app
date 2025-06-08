from fastapi import FastAPI
from pydantic import BaseModel
from modelo import load_model, predict, retrain_model_with_new_data
import pandas as pd
import os

app = FastAPI()

class InputData(BaseModel):
    ph: float
    turbidez: float
    temperatura: float
    contaminante: float

@app.on_event("startup")
async def startup_event():
    global model
    model = load_model()

@app.post("/predict")
def make_prediction(data: InputData):
    input_data = [[data.ph, data.turbidez, data.temperatura, data.contaminante]]
    prediction = predict(model, input_data)[0]

    new_data = pd.DataFrame(
        data=[[data.ph, data.turbidez, data.temperatura, data.contaminante, prediction]],
        columns=['ph', 'turbidez', 'temperatura', 'contaminante', 'potabilidad']
    )

    if os.path.exists("log.csv"):
        new_data.to_csv("log.csv", mode='a', header=False, index=False)
    else:
        new_data.to_csv("log.csv", index=False)

    return {"prediction": int(prediction)}

@app.get("/retrain")
def retrain():
    global model
    model = retrain_model_with_new_data()
    return {"message": "Modelo reentrenado con nuevos datos"}