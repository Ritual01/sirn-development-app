from fastapi import FastAPI, HTTPException
from pydantic import BaseModel
from modelos.modelo import load_model, predict, retrain_model_with_new_data
import pandas as pd
import os
import pymysql

app = FastAPI()

class InputData(BaseModel):
    ph: float
    turbidez: float
    temperatura: float
    contaminante: float

class DeleteRequest(BaseModel):
    index: int  # Índice del dato a eliminar en log.csv

DB_CONFIG = {
    "host": "shinkansen.proxy.rlwy.net",
    "user": "root",
    "password": "MfRHWkDxulehDoyCOLXqGjrFvsFxtecQ",
    "database": "railway"
}

def get_db_connection():
    return pymysql.connect(
        host=DB_CONFIG["host"],
        user=DB_CONFIG["user"],
        password=DB_CONFIG["password"],
        database=DB_CONFIG["database"],
        cursorclass=pymysql.cursors.DictCursor
    )

@app.on_event("startup")
async def startup_event():
    global model
    model = load_model()

@app.get("/")
def get_report():
    try:
        conn = get_db_connection()
        with conn.cursor() as cursor:
            cursor.execute("""
                SELECT 
                    muestras.id,
                    muestras.lugar,
                    muestras.fecha,
                    muestras.nivel_cloro,
                    muestras.turbidez,
                    muestras.ph,
                    usuarios.nombre AS usuario_nombre,
                    usuarios.correo AS usuario_correo,
                    analisis.potabilidad
                FROM muestras
                INNER JOIN usuarios ON muestras.usuario_id = usuarios.id
                INNER JOIN analisis ON analisis.muestra_id = muestras.id
            """)
            rows = cursor.fetchall()
        conn.close()
        if not rows:
            return {"message": "No hay datos registrados aún."}
        df = pd.DataFrame(rows)
        report = {
            "total_registros": len(df),
            "estadisticas": df[["nivel_cloro", "turbidez", "ph", "potabilidad"]].describe().to_dict()
        }
        return report
    except Exception as e:
        raise HTTPException(status_code=500, detail=str(e))

@app.post("/predict")
def make_prediction(data: InputData):
    input_data = [[data.ph, data.turbidez, data.temperatura, data.contaminante]]
    prediction = predict(model, input_data)[0]

    new_data = pd.DataFrame(
        data=[[data.ph, data.turbidez, data.temperatura, data.contaminante, prediction]],
        columns=['ph', 'turbidez', 'cloro', 'contaminante', 'potabilidad']
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