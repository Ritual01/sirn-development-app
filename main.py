from fastapi import FastAPI, HTTPException
from pydantic import BaseModel
from modelos.modelo import load_model, predict, retrain_model_with_new_data
import pandas as pd
import os

app = FastAPI()

class InputData(BaseModel):
    ph: float
    turbidez: float
    temperatura: float
    contaminante: float

class DeleteRequest(BaseModel):
    index: int  # Índice del dato a eliminar en log.csv

@app.on_event("startup")
async def startup_event():
    global model
    model = load_model()

@app.get("/")
def get_report():
    if not os.path.exists("log.csv"):
        return {"message": "No hay datos registrados aún."}
    df = pd.read_csv("log.csv")
    report = {
        "total_registros": len(df),
        "estadisticas": df.describe().to_dict()
    }
    return report

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

#@app.delete("/{id}")
#def delete_data(id: int = Path(..., description="ID del registro a eliminar")):
 #   if not os.path.exists(DATABASE_PATH):
  #      raise HTTPException(status_code=404, detail="No hay datos para eliminar.")
   # df = pd.read_csv(DATABASE_PATH)
    #if id not in df.index:
    #    raise HTTPException(status_code=404, detail="ID no encontrado.")
    #df = df.drop(id)
    #df.to_csv(DATABASE_PATH, index=False)
    #return {"message": f"Registro con id {id} eliminado correctamente."}